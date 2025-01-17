<?php
//大商创网络
function instheader()
{
	global $charset;
	global $tools_version;
	echo '<html><head>' . ('<meta http-equiv="Content-Type" content="text/html; charset=' . $charset . '">') . ('<title>ECShop 数据库编码转换工具' . $tools_version . '</title>') . '<link href="styles/general.css" rel="stylesheet" type="text/css" />' . '<script type="text/javascript">
        function redirect(url) {
            window.location=url;
        }
        function $(id) {
            return document.getElementById(id);
        }
        </script>
        </head>' . '<body class="body"><div class="main">';
	include ROOT_PATH . 'upgrade/templates/header.php';
	echo '<div id="append_parent"></div>' . '<div class="wrapper">' . ('<div class="tit_install">ECShop 数据库编码转换工具' . $tools_version . '</div>') . '<div class="content">';
}

function instfooter()
{
	echo '</div>' . '<div class="footer"><p>&copy; 2005-2016 <a href="http://www.ecmoban.com" target="_blank">上海商创网络科技有限公司</a>。保留所有权利。</p></div>' . '</div>' . '</div></body></html>';
}

function showmessage($message, $url_forward = '', $msgtype = 'message', $extra = '', $delaymsec = 1000)
{
	if ($msgtype == 'form') {
		$message = '<form method="post" action="' . $url_forward . '" name="hidden_form">' . ('<br><p class="p_indent">' . $message . '</p>
 ' . $extra . '</form><br>') . '<script type="text/javascript">
            setTimeout("document.forms[\'hidden_form\'].submit()", ' . $delaymsec . ');
        </script>';
	}
	else {
		if ($url_forward) {
			$message .= '<script>setTimeout("redirect(\'' . $url_forward . '\');", ' . $delaymsec . ');</script>';
			$message .= '<br><div align="right">[<a href="' . $script_name . '" style="color:red">停止运行</a>]<br><br><a href="' . $url_forward . '">如果您的浏览器长时间没有自动跳转，请点击这里！</a></div>';
		}
		else {
			$message .= '<br /><br /><br />';
		}

		$message = '<br>' . $message . $extra . '<br><br>';
	}

	echo $message;
	instfooter();
	exit();
}

function display($msg)
{
	echo '<div class="msg">' . $msg . '</div>';
}

function get_mysql_charset()
{
	global $db;
	global $prefix;
	$tmp_charset = '';
	$query = $db->query('SHOW CREATE TABLE `' . $prefix . 'users`', 'SILENT');

	if ($query) {
		$tablestruct = $db->fetch_array($query, MYSQL_NUM);
		preg_match('/CHARSET=(\\w+)/', $tablestruct[1], $m);

		if (!empty($m)) {
			if (strpos($m[1], 'utf') === 0) {
				$tmp_charset = str_replace('utf', 'utf-', $m[1]);
			}
			else {
				$tmp_charset = $m[1];
			}
		}
	}

	return $tmp_charset;
}

function getgpc($k, $var = 'G')
{
	switch ($var) {
	case 'G':
		$var = &$_GET;
		break;

	case 'P':
		$var = &$_POST;
		break;

	case 'C':
		$var = &$_COOKIE;
		break;

	case 'R':
		$var = &$_REQUEST;
		break;
	}

	return isset($var[$k]) ? $var[$k] : NULL;
}

function init_convert_tables($file)
{
	if (is_file(ROOT_PATH . $file)) {
		return true;
	}

	global $db;
	global $prefix;
	$tables = array();
	$query = $db->query('SHOW TABLE STATUS');

	while ($result = $db->fetch_array($query)) {
		if (empty($prefix) || !empty($prefix) && strpos($result['Name'], $prefix) === 0) {
			if (preg_match('/_bak$/', $result['Name'])) {
				showmessage('您的数据库已经做过语言编码转换，如需重新转换请先还原数据库后再此执行本程序！');
			}

			$tables[$result['Name']] = 0;
		}
	}

	if (!empty($tables)) {
		$str = '<?php
';
		$str .= '$convert_tables = ' . var_export($tables, true) . ';
';
		$str .= '
?>';
		file_put_contents(ROOT_PATH . $file, $str);
		return true;
	}

	return false;
}

function write_tables($tables, $file, $var_name)
{
	if (!empty($tables)) {
		$str = '<?php
';
		$str .= '$' . $var_name . ' = ' . var_export($tables, true) . ';
';
		$str .= '
?>';
		file_put_contents(ROOT_PATH . $file, $str);
		return true;
	}
}

function backup_tables($tables)
{
	global $db;
	global $convert_tables;
	global $convert_tables_file;
	$suffix = '_bak';
	$backup_count = 0;
	display('正在进行备份数据表');

	if (!empty($tables)) {
		foreach ($tables as $tablename) {
			$db->query('DROP TABLE IF EXISTS `' . $tablename . $suffix . '`;', 'SILENT');
			$rename_sql = 'RENAME TABLE `' . $tablename . '` TO `' . $tablename . $suffix . '`;';

			if ($db->query($rename_sql, 'SILENT')) {
				$backup_count++;
				$convert_tables[$tablename] = 1;
			}
		}

		write_tables($convert_tables, $convert_tables_file, 'convert_tables');
		return $backup_count;
	}

	return 0;
}

function convert_table($table)
{
	if (empty($table)) {
		showmessage('数据表名不能为空，转换中止，如需重新转换请先还原数据库后再此执行本程序！');
	}

	display('正在转换 ' . $table . ' 数据表，请勿关闭本页面或刷新。');
	global $ecshop_charset;
	global $mysql_charset;
	global $mysql_version;
	global $db;
	global $prefix;
	global $convert_tables;
	global $convert_tables_file;
	global $tables_keys;
	global $rpp;
	$s_charset = str_replace('-', '', $mysql_charset);
	$d_charset = str_replace('-', '', $ecshop_charset);

	if ($convert_tables[$table] == 1) {
		$query = $db->query('SHOW CREATE TABLE `' . $table . '_bak`', 'SILENT');

		if ($query) {
			$tablestruct = $db->fetch_array($query, MYSQL_NUM);
			$createtable = $tablestruct[1];
			$createtable = preg_replace('/CREATE TABLE `' . $table . '_bak`/i', 'CREATE TABLE `' . $table . '`', $createtable);

			if ('4.1' <= $mysql_version) {
				$createtable = preg_replace('/CHARSET\\=' . $s_charset . '/i', 'CHARSET=' . $d_charset, $createtable);
			}

			if ($db->query($createtable, 'SILENT')) {
				$convert_tables[$table] = 2;
				write_tables($convert_tables, $convert_tables_file, 'convert_tables');
			}
			else {
				showmessage('创建表 ' . $table . ' 时失败！<br /> ' . $createtable . '<br /> ' . mysql_error($db->link_id));
			}
		}
	}

	if ($convert_tables[$table] == 2) {
		if ('4.1' <= $mysql_version) {
			$db->query('SET NAMES ' . $s_charset);
		}

		$count = isset($_POST['count']) ? intval($_POST['count']) : $db->getOne('SELECT COUNT(*) FROM `' . $table . '_bak`');
		$start = isset($_POST['start']) ? intval($_POST['start']) : 0;
		$query = $db->query('SELECT * FROM `' . $table . '_bak` LIMIT ' . $start . ', ' . $rpp);

		while ($row = $db->fetch_array($query)) {
			$_key = $_value = array();
			$insert_query = 'INSERT INTO `' . $table . '`(`';

			foreach ($row as $k => $v) {
				$_key[] = $k;
				$_value[] = addslashes(ecs_iconv($mysql_charset, $ecshop_charset, $v));
			}

			$_key = implode('`,`', $_key);
			$_value = implode('\',\'', $_value);
			$insert_query .= $_key . '`) VALUES (\'' . $_value . '\');';

			if ('4.1' <= $mysql_version) {
				$db->query('SET NAMES ' . $d_charset);
				$db->query('SET sql_mode=\'\'');
			}

			if (!$db->query($insert_query, 'SILENT')) {
				showmessage('插入 ' . $table . ' 表数据失败！<br /> ' . $insert_query . '<br /> ' . mysql_error($db->link_id));
			}
		}

		if ($count < $start + $rpp) {
			unset($convert_tables[$table]);
			write_tables($convert_tables, $convert_tables_file, 'convert_tables');

			if (count($convert_tables) < 1) {
				@unlink(ROOT_PATH . $convert_tables_file);
				@setcookie('ECCC', $ecshop_charset, 0);
				showmessage('<br /><span style="font-size:14px;font-size:weight">转换结束！</span><br /><a href="index.php"><font size="2"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></font></a>');
			}
			else {
				array_shift($tables_keys);
				$extra = '
                <input type="hidden" name="ecshop_charset" value="' . $ecshop_charset . '" />
                <input type="hidden" name="mysql_charset" value="' . $mysql_charset . '" />
                <input type="hidden" name="act" value="convert" />
                <input type="hidden" name="table_name" value="' . $tables_keys[0] . '" />';
				showmessage('数据表 ' . $table . ' 转换完成，正在进入下一个数据表', '?step=start', 'form', $extra);
			}
		}
		else {
			$next_start = $start + $rpp;
			$extra = '
            <input type="hidden" name="ecshop_charset" value="' . $ecshop_charset . '" />
            <input type="hidden" name="mysql_charset" value="' . $mysql_charset . '" />
            <input type="hidden" name="act" value="convert" />
            <input type="hidden" name="start" value="' . $next_start . '" />
            <input type="hidden" name="count" value="' . $count . '" />
            <input type="hidden" name="table_name" value="' . $tables_keys[0] . '" />';
			showmessage('正在转换数据表 ' . $table . ' 的第 ' . $start . ' - ' . ($count < $start + $rpp ? $count : $start + $rpp) . ' 条数据', '?step=start', 'form', $extra);
		}
	}
}

$charset = 'utf-8';
$tools_version = 'v1.0';
$mysql_version = '';
$ecshop_version = '';
$mysql_charset = '';
$ecshop_charset = '';
$convert_charset = array('utf-8' => 'gbk', 'gbk' => 'utf-8');
$convert_tables_file = 'data/convert_tables.php';
$rpp = 500;
define('ROOT_PATH', str_replace('\\', '/', substr(__FILE__, 0, -19)));
define('IN_ECS', true);
require ROOT_PATH . 'data/config.php';
require ROOT_PATH . 'includes/cls_ecshop.php';
require ROOT_PATH . 'includes/cls_mysql.php';
require ROOT_PATH . 'includes/lib_common.php';
require ROOT_PATH . 'includes/lib_base.php';

if (defined('EC_CHARSET')) {
	$ec_charset = EC_CHARSET;
}
else {
	$ec_charset = '';
}

$ecshop_version = str_replace('v', '', VERSION);
$ecshop_charset = $ec_charset;
$db = new cls_mysql($db_host, $db_user, $db_pass, $db_name, '', 0, 1);
$mysql_version = $db->version;
$mysql_charset = get_mysql_charset();
$step = getgpc('step');
$step = empty($step) ? 1 : $step;

if ($ecshop_version < '1.0') {
	$step = 'halt';
}

ob_start();
instheader();

if ($step == 1) {
	if (!empty($ecshop_charset) && !empty($mysql_charset) && $ecshop_charset == $mysql_charset) {
		$ext_msg = '<div class="tishi"><span>您的程序编码与数据库编码一致，无需进行转换。</span></div><div class="btn_info mt50 mb40"><a href="index.php" class="button">系统升级</a></div>';
	}
	else {
		if (empty($ecshop_charset) && !empty($mysql_charset)) {
			$ext_msg = '<form name="convert_form" method="post" action="?step=start"><b>由于未能确定您的程序编码，该编码由您手动确定。</b><br />
                    <b>您的数据库编码为：<span style="color:blue">' . $mysql_charset . '</span> ，确认您的程序编码是：<span style="color:red">' . $convert_charset[$mysql_charset] . '</span> 才能进行转换</b><br /><br />
        <a href="###" id="runturn"><font size="2"><b>&gt;&gt;&nbsp;如果您已确认完成上面的说明,请点这里进行转换</b></font></a><input type="hidden" name="ecshop_charset" value="' . $convert_charset[$mysql_charset] . '" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><font size="2">&gt;&gt;&nbsp;如果您确认程序与数据库的编码一致，请点这里进行升级</font></a></form>';
			$ecshop_charset = '<span style="color:red">未知</span>';
		}
		else {
			if (empty($mysql_charset) && !empty($ecshop_charset)) {
				$ext_msg = '<form name="convert_form" method="post" action="?step=start"><b>由于未能确定您的数据库编码，该编码由您手动确定。</b><br />
                    <b>您的程序编码为：<span style="color:blue">' . $ecshop_charset . '</span> ，确认您的数据库编码是：<span style="color:red">' . $convert_charset[$ecshop_charset] . '</span> 才能进行转换</b><br /><br />
        <a href="###" id="runturn"><font size="2"><b>&gt;&gt;&nbsp;如果您已确认完成上面的说明,请点这里进行转换</b></font></a><input type="hidden" name="mysql_charset" value="' . $convert_charset[$ecshop_charset] . '" />&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><font size="2">&gt;&gt;&nbsp;如果您确认程序与数据库的编码一致，请点这里进行升级</font></a></form>';
				$mysql_charset = '<span style="color:red">未知</span>';
			}
			else {
				if (empty($ecshop_charset) && empty($mysql_charset)) {
					$charset_option = '';

					foreach ($convert_charset as $c_charset) {
						$charset_option .= '<option value="' . $c_charset . '">' . $c_charset . '</option>';
					}

					$ext_msg = '<form name="convert_form" method="post" action="?step=start"><b>由于未能确定您的程序与数据库编码，该编码由您手动确定。</b><br />
                    <b>您的程序编码为：<select name="ecshop_charset" id="ecshop_charset">' . $charset_option . '</select> ，您的数据库编码为：<select name="mysql_charset" id="mysql_charset">' . $charset_option . '</select></b><br /><b></b><br /><br />
        <a href="###" id="runturn"><font size="2"><b>&gt;&gt;&nbsp;如果您已确认完成上面的说明,请点这里进行转换</b></font></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php"><font size="2"><b>&gt;&gt;&nbsp;如果您确认程序与数据库的编码一致，请点这里进行升级</font></a></form>';
					$mysql_charset = '<span style="color:red">未知</span>';
					$ecshop_charset = '<span style="color:red">未知</span>';
				}
				else {
					$ext_msg = '<a href="?step=start"><font size="2"><b>&gt;&gt;&nbsp;如果您已确认完成上面的说明,请点这里进行转换</b></font></a>';
				}
			}
		}
	}

	$ext_msg .= '
<script type="text/javascript">
    function _o(id) {
        return document.getElementById(id);
    }
    if (_o("runturn")) {
        _o("runturn").onclick = function() {
            document.forms["convert_form"].submit();
        }
    }
    if (_o("ecshop_charset") && _o("mysql_charset")) {
        if (_o("ecshop_charset").options[0].value == "gbk") {
            _o("mysql_charset").options[1].selected = true;
        } else {
            _o("mysql_charset").options[0].selected = true;
        }
        _o("ecshop_charset").onchange = function() {
            if (this.value == "gbk") {
                _o("mysql_charset").options[1].selected = true;
            } else {
                _o("mysql_charset").options[0].selected = true;
            }
        }
        _o("mysql_charset").onchange = function() {
            if (this.value == "gbk") {
                _o("ecshop_charset").options[1].selected = true;
            } else {
                _o("ecshop_charset").options[0].selected = true;
            }
        }
    }
</script>
';
	echo '<fieldset>
<legend>注意事项</legend>
<ul class="list">
<li>本转换程序只能针大商创1.0或者以上版本程序的转换</li>
<li>转换之前务必备份数据库资料，避免转换失败给您带来损失与不便</li>
</ul>
</fieldset>
<fieldset>
<legend>转换程序使用说明</legend>
<ul class="list">
    <li>1、只支持ECShop数据库的转换</li>
    <li>2、根据您上传程序的编码自动转换数据库编码，现在只支持 UTF-8 与 GBK 编码的互换。</li>
    <li>3、本工具在执行过程中不会对您的原数据库进行破坏，会将您的原数据表命名为备份文件，转换后的数据存在原来的表明中。例如：原表名为members（编码为UTF-8）需要转为GBK编码，则转换后为members（编码为GBK），members_bak（编码为UTF-8，即为原表的备份）。</li>
    <li>4、如果中途失败，请恢复数据库的到原备份数据库，去除错误后重新运行本程序</li>
    <li><span class="red">5、进行该操做前请一定备份您的数据库，该转换只能进行一次，如果转换失败请使用您的数据库备份还原数据库后重新进行转换。</span></li>
</ul>
</fieldset>
<fieldset>
<legend>当前信息</legend>
<ul class="list">
    <li>程序版本：' . $ecshop_version . '</li>
    <li>程序编码：' . $ecshop_charset . '</li>
    <li>MySQL版本：' . $mysql_version . '</li>
    <li>MySQL编码：' . $mysql_charset . '</li>
</ul>
</fieldset>
' . $ext_msg;
	instfooter();
}
else if ($step == 'halt') {
	echo '	<fieldset>
		<legend>注意事项</legend>
		<h4>您当前的程序版本小于1.0 ，请先更新您的程序再进行转换。</h4>
	</fieldset>';
	instfooter();
}
else if ($step == 'start') {
	$ecshop_charset = isset($_POST['ecshop_charset']) ? $_POST['ecshop_charset'] : $ecshop_charset;
	$mysql_charset = isset($_POST['mysql_charset']) ? $_POST['mysql_charset'] : $mysql_charset;

	if ($ecshop_charset == $mysql_charset) {
		$ext_msg = '<span style="color:red;font-size:14px;font-weight:bold">您的程序编码与数据库编码一致，无需进行转换。</span><br /><a href="index.php"><font size="2"><b>&gt;&gt;&nbsp;如果您需要执行升级程序，请点这里进行升级</b></font></a>';
		showmessage($ext_msg);
	}

	$act = getgpc('act', 'P');

	if (init_convert_tables($convert_tables_file)) {
		include ROOT_PATH . $convert_tables_file;
	}
	else {
		showmessage('<span style="color:red;font-size:14px;font-weight:bold">没有数据表可以转换</span>');
	}

	$tables_keys = array_keys($convert_tables);

	if (empty($act)) {
		$backup_count = backup_tables($tables_keys);
		$extra = '
        <input type="hidden" name="ecshop_charset" value="' . $ecshop_charset . '" />
        <input type="hidden" name="mysql_charset" value="' . $mysql_charset . '" />
        <input type="hidden" name="act" value="convert" />
        <input type="hidden" name="table_name" value="' . $tables_keys[0] . '" />';
		showmessage('数据库备份完成，' . $backup_count . ' 个原数据表均重命名为以 _bak 为后缀！', '?step=start', 'form', $extra);
	}
	else {
		convert_table(getgpc('table_name', 'P'));
	}
}

ob_end_flush();

?>
