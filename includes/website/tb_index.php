<?php
//多点乐资源
function get_auth_url($state)
{
	$redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . str_replace('tb_index.php', 'tb_callback.php', $_SERVER['REQUEST_URI']);
	$url = 'https://oauth.taobao.com/authorize';
	$params = array('response_type' => 'code', 'client_id' => APP_KEY, 'redirect_uri' => $redirect_url, 'state' => $state);

	foreach ($params as $key => $val) {
		$get[] = $key . '=' . urlencode($val);
	}

	return $url . '?' . join('&', $get);
}

session_start();
header('Content-type:text/html; charset=UTF-8;');
define('IN_ECS', true);

if (file_exists(dirname(__FILE__) . '/config/taobao_config.php')) {
	include_once dirname(__FILE__) . '/config/taobao_config.php';
}
else {
	echo '后台未正确安装或未启用淘宝插件，请联系管理员！<a href=\'/\'>点击返回</a>';
	exit();
}

$state = time();
$_SESSION['tb_state'] = $state;
$ret_url = get_auth_url($state);
$back_url = (empty($_GET['callback']) ? '/index.php' : $_GET['callback']);
$_SESSION['back_url'] = $back_url;
header('location:' . $ret_url);

?>
