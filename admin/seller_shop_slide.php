<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
function get_seller_slide($seller_theme = '')
{
	$adminru = get_admin_ru_id();
	$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('seller_shopslide') . ' WHERE ru_id = \'' . $adminru['ru_id'] . ('\' AND seller_theme = \'' . $seller_theme . '\'');
	$slide_list = $GLOBALS['db']->getAll($sql);

	foreach ($slide_list as $key => $val) {
		$slide_list[$key]['slide_type'] = $val['slide_type'] == 'roll' ? '滚动' : ($val['slide_type'] == 'shade' ? '渐变' : '');
	}

	return $slide_list;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
include_once ROOT_PATH . 'includes/cls_image.php';
$image = new cls_image($_CFG['bgcolor']);
$exc = new exchange($ecs->table('seller_shopslide'), $db, 'id', 'img_url');
$adminru = get_admin_ru_id();
$sql = 'select id,seller_theme,store_style from ' . $ecs->table('seller_shopinfo') . ' where ru_id = \'' . $adminru['ru_id'] . '\'';
$shop_info = $db->getRow($sql);

if ($_REQUEST['act'] == 'list') {
	admin_priv('seller_store_other');
	$smarty->assign('ur_here', $_LANG['store_slide_list']);
	$smarty->assign('action_link', array('text' => $_LANG['add_store_slide_list'], 'href' => 'seller_shop_slide.php?act=add'));
	$smarty->assign('full_page', 1);
	$slide_list = get_seller_slide($shop_info['seller_theme']);
	$smarty->assign('seller_slide_list', $slide_list);
	assign_query_info();
	$smarty->display('seller_shop_slide.dwt');
}
else if ($_REQUEST['act'] == 'add') {
	$smarty->assign('ur_here', $_LANG['add_store_slide_list']);
	$smarty->assign('action_link', array('text' => $_LANG['store_slide_list'], 'href' => 'seller_shop_slide.php?act=list'));
	$smarty->assign('form_action', 'insert');
	assign_query_info();
	$smarty->display('seller_slide_info.dwt');
}
else if ($_REQUEST['act'] == 'insert') {
	$is_show = isset($_REQUEST['is_show']) ? intval($_REQUEST['is_show']) : 0;
	$slide_type = !empty($_POST['slide_type']) ? stripslashes($_POST['slide_type']) : 'left';
	$img_link = !empty($_POST['img_link']) ? stripslashes($_POST['img_link']) : '#';
	$img_order = isset($_POST['img_order']) ? intval($_POST['img_order']) : 0;
	$img_desc = isset($_REQUEST['img_desc']) ? stripslashes($_REQUEST['img_desc']) : '';
	$allow_file_types = '|GIF|JPG|PNG|BMP|';

	if ($_FILES['img_url']) {
		$file = $_FILES['img_url'];
		if (isset($file['error']) && $file['error'] == 0 || !isset($file['error']) && $file['tmp_name'] != 'none') {
			if (!check_file_type($file['tmp_name'], $file['name'], $allow_file_types)) {
				sys_msg(sprintf($_LANG['msg_invalid_file'], $file['name']));
			}
			else {
				$ext = array_pop(explode('.', $file['name']));
				$file_dir = '../seller_imgs/seller_slide_img/seller_' . $adminru['ru_id'];

				if (!is_dir($file_dir)) {
					mkdir($file_dir);
				}

				$file_name = $file_dir . '/slide_' . gmtime() . '.' . $ext;

				if (move_upload_file($file['tmp_name'], $file_name)) {
					$img_url = $file_name;
					$oss_img_url = str_replace('../', '', $img_url);
					get_oss_add_file(array($oss_img_url));
				}
				else {
					sys_msg($_LANG['img_upload_fail']);
				}
			}
		}
	}
	else {
		sys_msg($_LANG['img_upload_notic']);
	}

	$sql = 'INSERT INTO ' . $ecs->table('seller_shopslide') . '(img_url,img_link, img_desc, is_show, img_order, slide_type,ru_id, seller_theme) ' . ('VALUES (\'' . $img_url . '\', \'' . $img_link . '\', \'' . $img_desc . '\', \'' . $is_show . '\', \'' . $img_order . '\', \'' . $slide_type . '\',\'') . $adminru['ru_id'] . '\',\'' . $shop_info['seller_theme'] . '\')';
	$db->query($sql);
	admin_log('添加幻灯片', 'add', 'seller_nav');
	clear_cache_files();
	$link[0]['text'] = $_LANG['continue_add'];
	$link[0]['href'] = 'seller_shop_slide.php?act=add';
	$link[1]['text'] = $_LANG['back_list'];
	$link[1]['href'] = 'seller_shop_slide.php?act=list';
	sys_msg($_LANG['add_slide_success'], 0, $link);
}
else if ($_REQUEST['act'] == 'edit') {
	$sql = 'SELECT * FROM ' . $ecs->table('seller_shopslide') . (' WHERE id=\'' . $_REQUEST['id'] . '\' and ru_id=\'') . $adminru['ru_id'] . '\'';
	$seller_slide = $db->GetRow($sql);
	$smarty->assign('ur_here', $_LANG['edit_store_slide']);
	$smarty->assign('action_link', array('text' => $_LANG['store_slide_list'], 'href' => 'seller_shop_slide.php?act=list'));
	$smarty->assign('slide', $seller_slide);
	$smarty->assign('form_action', 'updata');
	assign_query_info();
	$smarty->display('seller_slide_info.dwt');
}
else if ($_REQUEST['act'] == 'updata') {
	$is_show = isset($_REQUEST['is_show']) ? intval($_REQUEST['is_show']) : 0;
	$slide_type = !empty($_POST['slide_type']) ? stripslashes($_POST['slide_type']) : 'left';
	$img_link = !empty($_POST['img_link']) ? stripslashes($_POST['img_link']) : '#';
	$old_img = !empty($_POST['old_img']) ? stripslashes($_POST['old_img']) : '';
	$img_order = isset($_POST['img_order']) ? intval($_POST['img_order']) : 0;
	$img_desc = isset($_REQUEST['img_desc']) ? stripslashes($_REQUEST['img_desc']) : '';
	$allow_file_types = '|GIF|JPG|PNG|BMP|';

	if ($_FILES['img_url']) {
		$file = $_FILES['img_url'];
		if (isset($file['error']) && $file['error'] == 0 || !isset($file['error']) && $file['tmp_name'] != 'none') {
			if (!check_file_type($file['tmp_name'], $file['name'], $allow_file_types)) {
				sys_msg(sprintf($_LANG['msg_invalid_file'], $file['name']));
			}
			else {
				$ext = array_pop(explode('.', $file['name']));
				$file_dir = '../seller_imgs/seller_slide_img/seller_' . $adminru['ru_id'];

				if (!is_dir($file_dir)) {
					mkdir($file_dir);
				}

				$file_name = $file_dir . '/slide_' . gmtime() . '.' . $ext;

				if (move_upload_file($file['tmp_name'], $file_name)) {
					$img_url = $file_name;
					$oss_img_url = str_replace('../', '', $img_url);
					get_oss_add_file(array($oss_img_url));
				}
				else {
					sys_msg($_LANG['img_upload_fail']);
				}
			}
		}
	}
	else {
		sys_msg($_LANG['img_upload_notic']);
	}

	$sql = 'SELECT img_url FROM ' . $ecs->table('seller_shopslide') . ' WHERE id = \'' . $_POST['id'] . '\' LIMIT 1';
	$oss_img_url = $db->getOne($sql);

	if (!empty($oss_img_url)) {
		$oss_img_arr = explode('/', $oss_img_url);

		if ($oss_img_arr[1] != 'seller_themes') {
			@unlink($oss_img_url);
		}

		$oss_img_url = str_replace('../', '', $oss_img_url);
		get_oss_del_file(array($oss_img_url));
	}

	$param = 'img_link=\'' . $img_link . '\',img_desc=\'' . $img_desc . '\', is_show=\'' . $is_show . '\',img_order=\'' . $img_order . '\',slide_type=\'' . $slide_type . '\' ';

	if (!empty($img_url)) {
		$param .= ' ,img_url = \'' . $img_url . '\' ';
	}

	if ($exc->edit($param, $_POST['id'])) {
		clear_cache_files();
		admin_log($_LANG['add_store_slide_list'], 'edit', 'seller_shop_slide');
		$link[0]['text'] = $_LANG['back_list'];
		$link[0]['href'] = 'seller_shop_slide.php?act=list';
		sys_msg($_LANG['edit_store_slide_success'], 0, $link);
	}
	else {
		exit($db->error());
	}
}
else if ($_REQUEST['act'] == 'edit_sort_order') {
	$id = intval($_POST['id']);
	$order = intval($_POST['val']);
	$name = $exc->get_name($id);

	if ($exc->edit('img_order = \'' . $order . '\'', $id)) {
		make_json_result($order);
	}
	else {
		make_json_error(sprintf($_LANG['edit_fail'], $name));
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
	$sql = 'SELECT img_url FROM ' . $ecs->table('seller_shopslide') . (' WHERE id = \'' . $id . '\'');
	$img_url = $db->getOne($sql);

	if (!empty($img_url)) {
		$oss_img_arr = explode('/', $img_url);

		if ($oss_img_arr[1] != 'seller_themes') {
			@unlink($img_url);
		}

		$oss_img_url = str_replace('../', '', $img_url);
		get_oss_del_file(array($oss_img_url));
	}

	$exc->drop($id);
	$url = 'seller_shop_slide.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}
else if ($_REQUEST['act'] == 'query') {
	$slide_list = get_seller_slide($shop_info['seller_theme']);
	$smarty->assign('seller_slide_list', $slide_list);
	make_json_result($smarty->fetch('seller_shop_slide.dwt'), '');
}

?>
