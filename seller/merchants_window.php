<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
function get_seller_window($seller_theme)
{
	$adminru = get_admin_ru_id();
	$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('seller_shopwindow') . ' WHERE ru_id = \'' . $adminru['ru_id'] . '\' AND seller_theme = \'' . $seller_theme . '\' AND	win_type = 1';
	$win_list = $GLOBALS['db']->getAll($sql);

	foreach ($win_list as $key => $val) {
		$win_list[$key]['seller_theme'] = $_LANG['template_mall'] . 'NO.' . substr($val['seller_theme'], -1);
		$win_list[$key]['win_type_name'] = 0 < $val['win_type'] ? $GLOBALS['_LANG']['merchandise_cabinet'] : $GLOBALS['_LANG']['custom_content'];
	}

	return $win_list;
}

function get_win_info($id)
{
	$adminru = get_admin_ru_id();
	$sql = 'select * from ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' where id=\'' . $id . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	return $GLOBALS['db']->getRow($sql);
}

function get_win_goods($id)
{
	$adminru = get_admin_ru_id();
	$sql = 'select id,win_goods from ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' where id=\'' . $id . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	$win_info = $GLOBALS['db']->getRow($sql);

	if (0 < $win_info['id']) {
		$goods_ids = $win_info['win_goods'];
		$goods = array();

		if ($goods_ids) {
			$sql = 'select goods_id,goods_name from ' . $GLOBALS['ecs']->table('goods') . ' where user_id=\'' . $adminru['ru_id'] . ('\' and goods_id in (' . $goods_ids . ')');
			$goods = $GLOBALS['db']->getAll($sql);
		}

		$opt = array();

		foreach ($goods as $val) {
			$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
		}

		return $opt;
	}
	else {
		return 'no_cc';
	}
}

function win_goods_type_list($type = 0)
{
	$arr = array();

	for ($i = 1; $i <= $type; $i++) {
		$arr[$i]['value'] = $i;
		$arr[$i]['name'] = $GLOBALS['_LANG']['style'] . $i;
	}

	return $arr;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
include_once ROOT_PATH . 'includes/cls_image.php';
$image = new cls_image($_CFG['bgcolor']);
$smarty->assign('menus', $_SESSION['menus']);
$smarty->assign('action_type', 'index');
$exc = new exchange($ecs->table('seller_shopwindow'), $db, 'id', 'win_name');
$adminru = get_admin_ru_id();
$sql = 'select * from ' . $ecs->table('seller_shopinfo') . ' where ru_id=\'' . $adminru['ru_id'] . '\'';
$seller_shopinfo = $db->getRow($sql);
$seller_theme = $seller_shopinfo['seller_theme'];
$smarty->assign('primary_cat', $_LANG['19_merchants_store']);
$sql = 'select count(*) from ' . $ecs->table('seller_shopinfo') . ' where ru_id = \'' . $adminru['ru_id'] . '\'';
$shop_id = $db->getOne($sql);

if ($shop_id < 1) {
	$lnk[] = array('text' => $_LANG['set_shop_info'], 'href' => 'index.php?act=merchants_first');
	sys_msg($_LANG['please_set_shop_basic_info'], 0, $lnk);
	exit();
}

$smarty->assign('menu_select', array('action' => '19_merchants_store', 'current' => '07_merchants_window'));

if ($_REQUEST['act'] == 'list') {
	$tab_menu = array();
	$tab_menu[] = array('curr' => 1, 'text' => $_LANG['07_merchants_window'], 'href' => 'merchants_window.php?act=list');
	$tab_menu[] = array('curr' => 0, 'text' => $_LANG['06_merchants_custom'], 'href' => 'merchants_custom.php?act=list');
	$smarty->assign('tab_menu', $tab_menu);
	admin_priv('seller_store_other');
	$smarty->assign('ur_here', $_LANG['shop_windows_list']);
	$smarty->assign('action_link', array('text' => $_LANG['add_shop_window'], 'href' => 'merchants_window.php?act=add', 'class' => 'icon-plus'));
	$smarty->assign('full_page', 1);
	$win_list = get_seller_window($seller_theme);
	$smarty->assign('win_list', $win_list);
	assign_query_info();
	$smarty->assign('current', 'merchants_window');
	$smarty->display('merchants_window_list.dwt');
}
else if ($_REQUEST['act'] == 'add') {
	create_ueditor_editor('win_custom', $seller_win['win_custom'], 586);
	$smarty->assign('ur_here', $_LANG['add_shop_window']);
	$smarty->assign('action_link', array('text' => $_LANG['shop_windows_list'], 'href' => 'merchants_window.php?act=list', 'class' => 'icon-reply'));
	$smarty->assign('form_action', 'insert');
	$sql = 'SELECT seller_theme FROM ' . $ecs->table('seller_shopinfo') . ' WHERE ru_id=\'' . $adminru['ru_id'] . '\'';
	$seller_win = $db->GetRow($sql);
	$seller_win['win_type'] = 1;
	$smarty->assign('seller_win', $seller_win);
	$type_list = win_goods_type_list($seller_shopinfo['win_goods_type']);
	$smarty->assign('type_list', $type_list);
	assign_query_info();
	$smarty->assign('current', 'merchants_window');
	$smarty->display('merchants_window_info.dwt');
}
else if ($_REQUEST['act'] == 'insert') {
	$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('seller_shopwindow') . (' WHERE win_name = \'' . $_POST['winname'] . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	$number = $db->getOne($sql);

	if (0 < $number) {
		sys_msg(sprintf($_LANG['window_name_exist'], stripslashes($_POST['winname'])), 1);
		exit();
	}

	$is_show = isset($_REQUEST['isshow']) ? intval($_REQUEST['isshow']) : 0;
	$win_name = !empty($_POST['winname']) ? stripslashes($_POST['winname']) : '';
	$win_img_link = !empty($_POST['winimglink']) ? stripslashes($_POST['winimglink']) : '#';
	$win_order = isset($_POST['winorder']) ? intval($_POST['winorder']) : 0;
	$win_type = isset($_REQUEST['wintype']) ? intval($_REQUEST['wintype']) : 0;
	$win_goods_type = isset($_REQUEST['win_goods_type']) ? intval($_REQUEST['win_goods_type']) : 1;
	$win_color = isset($_REQUEST['wincolor']) ? stripslashes($_REQUEST['wincolor']) : '';
	$preg = '/<script[\\s\\S]*?<\\/script>/i';
	$win_custom = isset($_REQUEST['win_custom']) ? preg_replace($preg, '', stripslashes($_REQUEST['win_custom'])) : '';

	if ($win_name) {
		$sql = 'INSERT INTO ' . $ecs->table('seller_shopwindow') . '(win_type,win_goods_type,win_order,win_name, is_show, win_color, win_img,win_img_link,ru_id,win_custom,seller_theme) ' . ('VALUES (\'' . $win_type . '\', \'' . $win_goods_type . '\', \'' . $win_order . '\', \'' . $win_name . '\', \'' . $is_show . '\', \'' . $win_color . '\', \'' . $win_img . '\',\'' . $win_img_link . '\',\'') . $adminru['ru_id'] . ('\',\'' . $win_custom . '\',\'' . $seller_theme . '\')');
		$db->query($sql);
		$id = $db->insert_id();
		admin_log($_POST['winname'], 'add', 'seller_shopwindow');
		clear_cache_files();
		$link[0]['text'] = $_LANG['continue_add'];
		$link[0]['href'] = 'merchants_window.php?act=add';
		$link[1]['text'] = $_LANG['back_list'];
		$link[1]['href'] = 'merchants_window.php?act=list';
		$link[2]['text'] = $_LANG['add_window_goods'];
		$link[2]['href'] = 'merchants_window.php?act=add_win_goods&id=' . $id;
		sys_msg($_LANG['window_add_success'], 0, $link);
	}
	else {
		$link[0]['text'] = $_LANG['continue_add'];
		$link[0]['href'] = 'merchants_window.php?act=add';
		sys_msg($_LANG['window_add_fail'], 0, $link);
	}
}
else if ($_REQUEST['act'] == 'edit') {
	$sql = 'SELECT * FROM ' . $ecs->table('seller_shopwindow') . (' WHERE id=\'' . $_REQUEST['id'] . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	$seller_win = $db->GetRow($sql);
	create_ueditor_editor('win_custom', $seller_win['win_custom'], 586);
	$smarty->assign('ur_here', $_LANG['shop_window_edit']);
	$smarty->assign('action_link', array('text' => $_LANG['shop_windows_list'], 'href' => 'merchants_window.php?act=list', 'class' => 'icon-reply'));
	$smarty->assign('seller_win', $seller_win);
	$smarty->assign('form_action', 'update');
	$type_list = win_goods_type_list($seller_shopinfo['win_goods_type']);
	$smarty->assign('type_list', $type_list);
	assign_query_info();
	$smarty->assign('current', 'merchants_window');
	$smarty->display('merchants_window_info.dwt');
}
else if ($_REQUEST['act'] == 'update') {
	$is_show = isset($_REQUEST['isshow']) ? intval($_REQUEST['isshow']) : 0;
	$win_name = !empty($_POST['winname']) ? stripslashes($_POST['winname']) : '';
	$win_img_link = !empty($_POST['winimglink']) ? stripslashes($_POST['winimglink']) : '#';
	$win_order = isset($_POST['winorder']) ? intval($_POST['winorder']) : 0;
	$win_type = isset($_REQUEST['wintype']) ? intval($_REQUEST['wintype']) : 0;
	$win_goods_type = isset($_REQUEST['win_goods_type']) ? intval($_REQUEST['win_goods_type']) : 1;
	$win_color = isset($_REQUEST['wincolor']) ? stripslashes($_REQUEST['wincolor']) : '';
	$preg = '/<script[\\s\\S]*?<\\/script>/i';
	$win_custom = isset($_REQUEST['win_custom']) ? preg_replace($preg, '', stripslashes($_REQUEST['win_custom'])) : '';
	$allow_file_types = '|GIF|JPG|PNG|BMP|';

	if ($_FILES['winimg']) {
		$file = $_FILES['winimg'];
		if (isset($file['error']) && $file['error'] == 0 || !isset($file['error']) && $file['tmp_name'] != 'none') {
			if (!check_file_type($file['tmp_name'], $file['name'], $allow_file_types)) {
				sys_msg(sprintf($_LANG['msg_invalid_file'], $file['name']));
			}
			else {
				$ext = array_pop(explode('.', $file['name']));
				$file_dir = '../seller_imgs/seller_win_img/seller_' . $adminru['ru_id'];

				if (!is_dir($file_dir)) {
					mkdir($file_dir);
				}

				$file_name = $file_dir . '/win_' . gmtime() . '.' . $ext;

				if (move_upload_file($file['tmp_name'], $file_name)) {
					$win_img = $file_name;
				}
				else {
					sys_msg(sprintf($_LANG['msg_upload_failed'], $file['name'], $file_dir));
				}
			}
		}
	}

	$param = 'win_type=\'' . $win_type . '\',win_goods_type=\'' . $win_goods_type . '\', win_order=\'' . $win_order . '\', is_show=\'' . $is_show . '\',win_color=\'' . $win_color . '\',win_img_link=\'' . $win_img_link . '\',win_custom=\'' . $win_custom . '\',seller_theme=\'' . $seller_theme . '\' ';

	if (!empty($win_img)) {
		$param .= ' ,win_img = \'' . $win_img . '\' ';
	}

	$is_only = $exc->is_only('win_name', $_POST['winname']);

	if ($is_only) {
		$param .= ' ,win_name = \'' . $win_name . '\'';
	}

	if ($exc->edit($param, $_POST['id'])) {
		clear_cache_files();
		admin_log($_POST['winname'], 'edit', 'seller_shopwindow');
		$link[0]['text'] = $_LANG['back_list'];
		$link[0]['href'] = 'merchants_window.php?act=list';
		sys_msg($_LANG['shop_window_edit_success'], 0, $link);
	}
	else {
		exit($db->error());
	}
}
else if ($_REQUEST['act'] == 'edit_win_name') {
	$id = intval($_POST['id']);
	$name = json_str_iconv(trim($_POST['val']));
	$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('seller_shopwindow') . (' WHERE win_name = \'' . $name . '\' and ru_id=\'' . $_SESSION['ru_id'] . '\'');
	$number = $db->getOne($sql);

	if (0 < $number) {
		make_json_error(sprintf($_LANG['window_exist'], $name));
	}
	else if ($exc->edit('win_name = \'' . $name . '\'', $id)) {
		admin_log($name, 'edit', 'seller_shopwindow');
		make_json_result(stripslashes($name));
	}
	else {
		make_json_result(sprintf($_LANG['s_edit_fail'], $name));
	}
}
else if ($_REQUEST['act'] == 'edit_sort_order') {
	$id = intval($_POST['id']);
	$order = intval($_POST['val']);
	$name = $exc->get_name($id);

	if ($exc->edit('win_order = \'' . $order . '\'', $id)) {
		make_json_result($order);
	}
	else {
		make_json_error(sprintf($_LANG['s_edit_fail'], $name));
	}
}
else if ($_REQUEST['act'] == 'toggle_show') {
	$id = intval($_POST['id']);
	$val = intval($_POST['val']);
	$exc->edit('is_show=\'' . $val . '\'', $id);
	make_json_result($val);
}
else if ($_REQUEST['act'] == 'remove') {
	$id = intval($_GET['id']);
	$sql = 'SELECT win_img FROM ' . $ecs->table('seller_shopwindow') . (' WHERE id = \'' . $id . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	$win_img = $db->getOne($sql);

	if (!empty($win_img)) {
		@unlink($win_img);
	}

	$exc->drop($id);
	$url = 'merchants_window.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}
else if ($_REQUEST['act'] == 'query') {
	$win_list = get_seller_window($seller_theme);
	$smarty->assign('win_list', $win_list);
	$smarty->assign('current', 'merchants_window');
	make_json_result($smarty->fetch('merchants_window_list.dwt'), '');
}
else if ($_REQUEST['act'] == 'add_win_goods') {
	$smarty->assign('action_link', array('text' => $_LANG['07_merchants_window'], 'href' => 'merchants_window.php?act=list', 'class' => 'icon-reply'));
	$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
	$win_goods = get_win_goods($id);

	if ($win_goods == 'no_cc') {
		sys_msg($_LANG['illegal_date_no_access']);
	}
	else {
		$win_info = get_win_info($id);
		$smarty->assign('win_info', $win_info);
		set_default_filter(0, 0, $adminru['ru_id']);
		$smarty->assign('filter_brand_list', search_brand_list());
		$smarty->assign('ur_here', $_LANG['add_window_goods']);
		$smarty->assign('goods_count', count($win_goods));
		$smarty->assign('filter_result', $win_goods);
		$smarty->assign('data_format', $data_format_array);
		assign_query_info();
		$smarty->assign('current', 'merchants_window');
		$smarty->display('add_win_goods.dwt');
	}
}
else if ($_REQUEST['act'] == 'update_win_goods') {
	$id = !empty($_POST['win_id']) ? intval($_POST['win_id']) : 0;
	$link[0]['text'] = $_LANG['continue_add'];
	$link[0]['href'] = 'merchants_window.php?act=add_win_goods&id=' . $id;
	$link[1]['text'] = $_LANG['back_list'];
	$link[1]['href'] = 'merchants_window.php?act=list';
	sys_msg($_LANG['window_goods_edit_success'], 0, $link);
}
else if ($_REQUEST['act'] == 'insert_win_goods') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$linked_array = $json->decode($_GET['add_ids']);
	$linked_window = $json->decode($_GET['JSON']);
	$id = $linked_window[0];
	$win_goods = $GLOBALS['db']->getOne('select win_goods from ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' where id=\'' . $id . '\''));

	foreach ($linked_array as $val) {
		if (!strstr($win_goods, $val) && !empty($val)) {
			$win_goods .= !empty($win_goods) ? ',' . $val : $val;
		}
	}

	$sql = 'update ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' set win_goods=\'' . $win_goods . '\' where id=\'' . $id . '\'');
	$GLOBALS['db']->query($sql);
	$win_goods = get_win_goods($id);
	$options = array();

	foreach ($win_goods as $val) {
		$options[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
	}

	clear_cache_files();
	make_json_result($options);
}
else if ($_REQUEST['act'] == 'drop_win_goods') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$drop_goods = $json->decode($_GET['drop_ids']);
	$linked_window = $json->decode($_GET['JSON']);
	$id = $linked_window[0];
	$win_goods = $GLOBALS['db']->getOne('select win_goods from ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' where id=\'' . $id . '\''));
	$win_goods_arr = explode(',', $win_goods);

	foreach ($drop_goods as $val) {
		if (strstr($win_goods, $val) && !empty($val)) {
			$key = array_search($val, $win_goods_arr);

			if ($key !== false) {
				array_splice($win_goods_arr, $key, 1);
			}
		}
	}

	$new_win_goods = '';

	foreach ($win_goods_arr as $val) {
		if (!strstr($new_win_goods, $val) && !empty($val)) {
			$new_win_goods .= !empty($new_win_goods) ? ',' . $val : $val;
		}
	}

	$sql = 'update ' . $GLOBALS['ecs']->table('seller_shopwindow') . (' set win_goods=\'' . $new_win_goods . '\' where id=\'' . $id . '\'');
	$GLOBALS['db']->query($sql);
	$win_goods = get_win_goods($id);
	$options = array();

	foreach ($win_goods as $val) {
		$options[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
	}

	clear_cache_files();
	make_json_result($options);
}
else if ($_REQUEST['act'] = 'batch') {
	$checkboxes = isset($_POST['checkboxes']) ? $_POST['checkboxes'] : array();
	$type = isset($_POST['type']) ? intval($_POST['type']) : 0;

	if ($checkboxes) {
		if ($type == 1) {
			$id = implode(',', $checkboxes);
			$sql = 'DELETE FROM ' . $ecs->table('seller_shopwindow') . (' WHERE win_type = 1 AND id in(' . $id . ')');
			$db->query($sql);
		}
	}

	$link[0]['text'] = $_LANG['back_shop_custom_list'];
	$link[0]['href'] = 'merchants_window.php?act=list';
	sys_msg('删除成功', 0, $link);
}

?>
