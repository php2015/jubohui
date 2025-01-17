<?php
//多点乐资源
function dispatch($post)
{
	$func_arr = array('GetDomain', 'UserLogin', 'AddCategory', 'AddBrand', 'AddGoods', 'GetCategory', 'GetBrand', 'GetGoods', 'DeleteBrand', 'DeleteCategory', 'DeleteGoods', 'EditBrand', 'EditCategory', 'EditGoods');
	if (in_array($post['Action'], $func_arr) && function_exists('API_' . $post['Action'])) {
		return call_user_func('API_' . $post['Action'], $post);
	}
	else {
		API_Error();
	}
}

function parse_json(&$json, $str)
{
	if (defined('EC_CHARSET') && (EC_CHARSET == 'gbk')) {
		$str = addslashes(stripslashes(ecs_iconv('utf-8', 'gbk', $str)));
	}

	$json_obj = $json->decode($str, 1);
	$_POST = $json_obj;
}

function show_json(&$json, $array, $convert = false)
{
	$json_str = $json->encode($array, false);
	if (!$convert && defined('EC_CHARSET') && (EC_CHARSET == 'gbk')) {
		$json_str = ecs_iconv('UTF-8', 'GBK', $json_str);
	}

	@header('Content-type:text/html; charset=' . EC_CHARSET);
	exit($json_str);
}

function admin_privilege($priv_str)
{
	if (isset($_SESSION['admin_id']) && (0 < intval($_SESSION['admin_id']))) {
		if ($_SESSION['action_list'] == 'all') {
			return true;
		}

		if (strpos(',' . $_SESSION['action_list'] . ',', ',' . $priv_str . ',') !== false) {
			return true;
		}
	}

	client_show_message(101);
}

function cat_is_exists($cat_name, $parent_cat, $exclude = 0)
{
	$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('category') . ' WHERE parent_id = \'' . $parent_cat . '\' AND cat_name = \'' . $cat_name . '\' AND cat_id<>\'' . $exclude . '\'';
	return 0 < $GLOBALS['db']->getOne($sql) ? true : false;
}

function debug_text($str = '')
{
	$file = 'D:/debug.txt';
	$fp = fopen($file, 'a');

	if ($str == '') {
		$str .= implode('', $_POST);
		$str .= implode('', $_GET);
		$str .= implode('', $_REQUEST);
	}

	fwrite($fp, $str);
	fclose($fp);
}

function random_filename()
{
	$str = '';

	for ($i = 0; $i < 9; $i++) {
		$str .= mt_rand(0, 9);
	}

	return gmtime() . $str;
}

function unique_name($dir)
{
	$filename = '';

	while (empty($filename)) {
		$filename = random_filename();
		if (file_exists($dir . $filename . '.jpg') || file_exists($dir . $filename . '.gif') || file_exists($dir . $filename . '.png')) {
			$filename = '';
		}
	}

	return $filename;
}

function upload_image($str, $dir = '', $img_name = '')
{
	if (empty($str['Data'])) {
		return false;
	}

	$allow_file_type = array('jpg', 'jpeg', 'png', 'gif', 'bmp');

	if (empty($dir)) {
		$dir = date('Ym');
		$dir = ROOT_PATH . '/images/' . $dir;
	}
	else {
		$dir = ROOT_PATH . '/' . $dir;

		if ($img_name) {
			$img_name = basename($img_name);
			$img_name_ext = substr($img_name, strrpos($img_name, '.') + 1);

			if (!in_array($img_name_ext, $allow_file_type)) {
				return false;
			}

			$img_name = $dir . '/' . $img_name;
		}
	}

	if (!file_exists($dir)) {
		if (!make_dir($dir)) {
			return false;
		}
	}

	if (empty($img_name)) {
		$img_name = unique_name($dir);
		$img_name = $dir . '/' . $img_name . '.' . $str['Type'];
	}

	$binary_data = base64_decode($str['Data']);

	if ($fp = @fopen($img_name, 'wb')) {
		@fwrite($fp, $binary_data);
		@fclose($fp);
		return str_replace(ROOT_PATH . '/', '', $img_name);
	}
	else {
		return false;
	}
}

function client_show_message($code = 0, $result = false, $message = '', $id = 0, $custom_message = false, $charset = '')
{
	$msg = $GLOBALS['common_message'];
	$msg['Result'] = $result;
	$msg['MessageCode'] = $code;
	$msg['MessageString'] = $custom_message === false ? $GLOBALS['_ALANG'][$code] . $message : $message;
	$msg['InsertID'] = $id;
	$msg['Charset'] = $charset;
	show_json($GLOBALS['json'], $msg);
}

function client_check_image_size($str)
{
	$max_size = 2097152;
	return strlen($str['Data']) < $max_size;
}

function get_goods_image_url($goods_id, $img_url, $thumb = false)
{
	return str_replace('/api.php', '', preg_replace('/\\/api\\/client/', '', $GLOBALS['ecs']->url())) . $img_url;
}

function process_replace_array($array)
{
	foreach ($array['search'] as $key => $val) {
		$array['search'][$key] = chr(hexdec($val[0] . $val[1])) . chr(hexdec($val[2] . $val[3]));
	}

	return $array;
}

function API_UserLogin($post)
{
	if (get_magic_quotes_gpc()) {
		$post['UserId'] = $post['UserId'];
	}
	else {
		$post['UserId'] = addslashes($post['UserId']);
	}

	$post['username'] = isset($post['UserId']) ? trim($post['UserId']) : '';
	$post['password'] = isset($post['Password']) ? strtolower(trim($post['Password'])) : '';
	$sql = 'SELECT user_id, user_name, password, action_list, last_login' . ' FROM ' . $GLOBALS['ecs']->table('admin_user') . ' WHERE user_name = \'' . $post['username'] . '\'';
	$row = $GLOBALS['db']->getRow($sql);

	if ($row) {
		if ($row['password'] != $post['password']) {
			client_show_message(103);
		}

		require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
		set_admin_session($row['user_id'], $row['user_name'], $row['action_list'], $row['last_login']);
		$GLOBALS['db']->query('UPDATE ' . $GLOBALS['ecs']->table('admin_user') . ' SET last_login=\'' . gmtime() . '\', last_ip=\'' . real_ip() . '\'' . ' WHERE user_id=\'' . $_SESSION['admin_id'] . '\'');
		client_show_message(100, true, VERSION, 0, true, EC_CHARSET);
	}
	else {
		client_show_message(103);
	}
}

function API_AddCategory($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	admin_privilege('cat_manage');
	$cat = array();
	$cat['cat_id'] = !empty($_POST['cat_id']) ? intval($_POST['cat_id']) : 0;
	$cat['parent_id'] = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	$cat['sort_order'] = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
	$cat['keywords'] = !empty($_POST['keywords']) ? addslashes(trim($_POST['keywords'])) : '';
	$cat['cat_desc'] = !empty($_POST['cat_desc']) ? addslashes($_POST['cat_desc']) : '';
	$cat['measure_unit'] = !empty($_POST['measure_unit']) ? addslashes(trim($_POST['measure_unit'])) : '';
	$cat['cat_name'] = !empty($_POST['cat_name']) ? addslashes(trim($_POST['cat_name'])) : '';
	$cat['show_in_nav'] = !empty($_POST['show_in_nav']) ? intval($_POST['show_in_nav']) : 0;
	$cat['style'] = !empty($_POST['style']) ? addslashes(trim($_POST['style'])) : '';
	$cat['is_show'] = !empty($_POST['is_show']) ? intval($_POST['is_show']) : 0;
	$cat['grade'] = !empty($_POST['grade']) ? intval($_POST['grade']) : 0;
	$cat['filter_attr'] = !empty($_POST['filter_attr']) ? intval($_POST['filter_attr']) : 0;

	if (cat_is_exists($cat['cat_name'], $cat['parent_id'])) {
		client_show_message(403);
	}

	if ((10 < $cat['grade']) || ($cat['grade'] < 0)) {
		client_show_message(402);
	}

	if ($GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('category'), $cat) !== false) {
		$insert_id = $GLOBALS['db']->insert_id();

		if ($cat['show_in_nav'] == 1) {
			$vieworder = $GLOBALS['db']->getOne('SELECT max(vieworder) FROM ' . $GLOBALS['ecs']->table('nav') . ' WHERE type = \'middle\'');
			$vieworder += 2;
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('nav') . ' (name, ctype, cid, ifshow, vieworder, opennew, url, type)' . ' VALUES(\'' . $cat['cat_name'] . '\', \'c\', \'' . $insert_id . '\',\'1\',\'' . $vieworder . '\',\'0\', \'' . build_uri('category', array('cid' => $insert_id), $cat['cat_name']) . '\',\'middle\')';
			$GLOBALS['db']->query($sql);
		}

		admin_log($_POST['cat_name'], 'add', 'category');
		clear_cache_files();
		client_show_message(0, true);
	}
}

function API_GetCategory($post)
{
	$sql = 'SELECT c.cat_id, c.cat_name, c.keywords, c.cat_desc, c.parent_id, c.sort_order, c.measure_unit, c.show_in_nav, c.style, c.is_show, c.grade, c.filter_attr, COUNT(s.cat_id) AS has_children ' . 'FROM ' . $GLOBALS['ecs']->table('category') . ' AS c ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('category') . ' AS s ON s.parent_id=c.cat_id ' . ' GROUP BY c.cat_id ' . 'ORDER BY parent_id, sort_order ASC';
	$result = $GLOBALS['db']->getAllCached($sql);

	foreach ($result as $key => $cat) {
		$result[$key]['is_show'] = $cat['is_show'] == 1;
		$result[$key]['show_in_nav'] = $cat['show_in_nav'] == 1;
	}

	show_json($GLOBALS['json'], $result, true);
}

function API_AddBrand($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	require_once ROOT_PATH . ADMIN_PATH . '/includes/cls_exchange.php';
	require_once ROOT_PATH . 'includes/cls_image.php';
	admin_privilege('brand_manage');
	$is_show = (isset($_POST['is_show']) ? 1 : 0);
	$exc = new exchange($GLOBALS['ecs']->table('brand'), $GLOBALS['db'], 'brand_id', 'brand_name');
	$is_only = $exc->is_only('brand_name', $_POST['brand_name'], '', '');

	if (!$is_only) {
		client_show_message(301);
	}

	$img_name = upload_image($_POST['brand_logo'], 'brandlogo');

	if ($img_name !== false) {
		$img_name = basename($img_name);
	}
	else {
		$img_name = '';
	}

	$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('brand') . '(brand_name, site_url, brand_desc, brand_logo, is_show, sort_order) ' . 'VALUES (\'' . $_POST['brand_name'] . '\', \'' . $_POST['site_url'] . '\', \'' . $_POST['brand_desc'] . '\', \'' . $img_name . '\', \'' . $is_show . '\', \'' . $_POST['sort_order'] . '\')';
	$GLOBALS['db']->query($sql);
	$insert_id = $GLOBALS['db']->insert_id();
	admin_log($_POST['brand_name'], 'add', 'brand');
	clear_cache_files();
	client_show_message(0, true);
}

function API_GetBrand($post)
{
	$sql = 'SELECT brand_id, brand_name, brand_logo, brand_desc, site_url, is_show FROM ' . $GLOBALS['ecs']->table('brand') . ' ORDER BY sort_order ASC';
	$result = $GLOBALS['db']->getAllCached($sql);

	foreach ($result as $key => $brand) {
		$result[$key]['is_show'] = $brand['is_show'] == 1;
		$tmp = array();

		if ($brand['brand_logo'] != '') {
			$tmp['Type'] = substr($brand['brand_logo'], strrpos($brand['brand_logo'], '.') + 1);
			$tmp['Data'] = 'data/brandlogo/' . $brand['brand_logo'];
		}
		else {
			$tmp['Type'] = '';
			$tmp['Data'] = '';
		}

		$result[$key]['brand_logo'] = $tmp;
	}

	show_json($GLOBALS['json'], $result, true);
}

function API_AddGoods($post)
{
	global $_CFG;
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_goods.php';
	require_once ROOT_PATH . 'includes/cls_image.php';
	admin_privilege('goods_manage');
	$image = new cls_image($GLOBALS['_CFG']['bgcolor']);
	$code = (empty($_POST['extension_code']) ? '' : trim($_POST['extension_code']));
	$is_insert = $_POST['act'] == 'insert';

	if (!$is_insert) {
		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE goods_id = \'' . $_POST['goods_id'] . '\' AND is_delete = 0';

		if ($GLOBALS['db']->getOne($sql) <= 0) {
			client_show_message(240);
		}
	}

	if ($_POST['goods_sn']) {
		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE goods_sn = \'' . $_POST['goods_sn'] . '\' AND is_delete = 0 AND goods_id <> \'' . $_POST['goods_id'] . '\'';

		if (0 < $GLOBALS['db']->getOne($sql)) {
			client_show_message(200);
		}
	}

	$goods_img = '';
	$goods_thumb = '';
	$original_img = '';
	$old_original_img = '';
	$allow_file_type = array('jpg', 'jpeg', 'png', 'gif');

	if (!empty($_POST['goods_img']['Data'])) {
		if (!in_array($_POST['goods_img']['Type'], $allow_file_type)) {
			client_show_message(201);
		}

		if (client_check_image_size($_POST['goods_img']['Data']) === false) {
			client_show_message(202);
		}

		if (0 < $_POST['goods_id']) {
			$sql = 'SELECT goods_thumb, goods_img, original_img ' . ' FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE goods_id = \'' . $_POST['goods_id'] . '\'';
			$row = $GLOBALS['db']->getRow($sql);
			if (($row['goods_thumb'] != '') && is_file(ROOT_PATH . '/' . $row['goods_thumb'])) {
				@unlink(ROOT_PATH . '/' . $row['goods_thumb']);
			}

			if (($row['goods_img'] != '') && is_file(ROOT_PATH . '/' . $row['goods_img'])) {
				@unlink(ROOT_PATH . '/' . $row['goods_img']);
			}

			if (($row['original_img'] != '') && is_file(ROOT_PATH . '/' . $row['original_img'])) {
			}
		}

		$original_img = upload_image($_POST['goods_img']);

		if ($original_img === false) {
			client_show_message(210);
		}

		$goods_img = $original_img;
		$img = $original_img;
		$pos = strpos(basename($img), '.');
		$newname = dirname($img) . '/' . random_filename() . substr(basename($img), $pos);

		if (!copy(ROOT_PATH . '/' . $img, ROOT_PATH . '/' . $newname)) {
			client_show_message(211);
		}

		$img = $newname;
		$gallery_img = $img;
		$gallery_thumb = $img;
		$img_property = (0 < $image->gd_version() ? getimagesize(ROOT_PATH . '/' . $goods_img) : array());
		if ((0 < $image->gd_version()) && $image->check_img_function($img_property[2])) {
			if (($GLOBALS['_CFG']['image_width'] != 0) || ($GLOBALS['_CFG']['image_height'] != 0)) {
				$goods_img = $image->make_thumb(ROOT_PATH . '/' . $goods_img, $GLOBALS['_CFG']['image_width'], $GLOBALS['_CFG']['image_height']);

				if ($goods_img === false) {
					client_show_message(212);
				}
			}

			if ((0 < intval($GLOBALS['_CFG']['watermark_place'])) && !empty($GLOBALS['_CFG']['watermark'])) {
				if ($image->add_watermark(ROOT_PATH . '/' . $goods_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
					client_show_message(213);
				}

				$newname = dirname($img) . '/' . random_filename() . substr(basename($img), $pos);

				if (!copy(ROOT_PATH . '/' . $img, ROOT_PATH . '/' . $newname)) {
					client_show_message(214);
				}

				$gallery_img = $newname;

				if ($image->add_watermark(ROOT_PATH . '/' . $gallery_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
					client_show_message(213);
				}
			}

			if (($_CFG['thumb_width'] != 0) || ($_CFG['thumb_height'] != 0)) {
				$gallery_thumb = $image->make_thumb(ROOT_PATH . '/' . $img, $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);

				if ($gallery_thumb === false) {
					client_show_message(215);
				}
			}
		}
	}

	if (!empty($_POST['goods_thumb']['Data'])) {
		if (!in_array($_POST['goods_thumb']['Type'], $allow_file_type)) {
			client_show_message(203);
		}

		if (client_check_image_size($_POST['goods_thumb']['Data']) === false) {
			client_show_message(204);
		}

		$goods_thumb = upload_image($_POST['goods_thumb']);

		if ($goods_thumb === false) {
			client_show_message(217);
		}
	}
	else {
		if (isset($_POST['auto_thumb']) && !empty($original_img)) {
			if (($_CFG['thumb_width'] != 0) || ($_CFG['thumb_height'] != 0)) {
				$goods_thumb = $image->make_thumb(ROOT_PATH . '/' . $original_img, $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);

				if ($goods_thumb === false) {
					client_show_message(218);
				}
			}
			else {
				$goods_thumb = $original_img;
			}
		}
	}

	if (empty($_POST['goods_sn'])) {
		$max_id = ($is_insert ? $GLOBALS['db']->getOne('SELECT MAX(goods_id) + 1 FROM ' . $GLOBALS['ecs']->table('goods')) : $_POST['goods_id']);
		$goods_sn = generate_goods_sn($max_id);
	}
	else {
		$goods_sn = $_POST['goods_sn'];
	}

	$is_promote = (isset($_POST['is_promote']) && $_POST['is_promote'] ? 1 : 0);
	$shop_price = (!empty($_POST['shop_price']) ? $_POST['shop_price'] : 0);
	$market_price = (!empty($_POST['market_price']) ? $_POST['market_price'] : $GLOBALS['_CFG']['market_price_rate'] * $shop_price);
	$promote_price = (!empty($_POST['promote_price']) ? floatval($_POST['promote_price']) : 0);
	$promote_start_date = ($is_promote && !empty($_POST['promote_start_date']) ? local_strtotime($_POST['promote_start_date']) : 0);
	$promote_end_date = ($is_promote && !empty($_POST['promote_end_date']) ? local_strtotime($_POST['promote_end_date']) : 0);
	$goods_weight = (!empty($_POST['goods_weight']) ? $_POST['goods_weight'] * $_POST['weight_unit'] : 0);
	$is_best = (isset($_POST['is_best']) && $_POST['is_best'] ? 1 : 0);
	$is_new = (isset($_POST['is_new']) && $_POST['is_new'] ? 1 : 0);
	$is_hot = (isset($_POST['is_hot']) && $_POST['is_hot'] ? 1 : 0);
	$is_on_sale = (isset($_POST['is_on_sale']) && $_POST['is_on_sale'] ? 1 : 0);
	$is_alone_sale = (isset($_POST['is_alone_sale']) && $_POST['is_alone_sale'] ? 1 : 0);
	$goods_number = (isset($_POST['goods_number']) ? $_POST['goods_number'] : 0);
	$warn_number = (isset($_POST['warn_number']) ? $_POST['warn_number'] : 0);
	$goods_type = (isset($_POST['goods_type']) ? $_POST['goods_type'] : 0);
	$goods_name_style = $_POST['goods_name_color'] . '+' . $_POST['goods_name_style'];
	$catgory_id = (empty($_POST['cat_id']) ? '' : intval($_POST['cat_id']));
	$brand_id = (empty($_POST['brand_id']) ? '' : intval($_POST['brand_id']));
	$new_brand_name = (empty($_POST['new_brand_name']) ? '' : trim($_POST['new_brand_name']));
	$new_cat_name = (empty($_POST['new_cat_name']) ? '' : trim($_POST['new_cat_name']));
	if (($catgory_id == '') && ($new_cat_name != '')) {
		if (cat_exists($new_cat_name, $_POST['parent_cat'])) {
			client_show_message(219);
		}
	}

	if (($brand_id == '') && ($new_brand_name != '')) {
		if (brand_exists($new_brand_name)) {
			client_show_message(220);
		}
	}

	if (($catgory_id == '') && ($new_cat_name != '')) {
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('category') . '(cat_name, parent_id, is_show)' . 'VALUES ( \'' . $new_cat_name . '\', \'' . $_POST['parent_cat'] . '\', 1)';
		$GLOBALS['db']->query($sql);
		$catgory_id = $GLOBALS['db']->insert_id();
	}

	if (($brand_id == '') && ($new_brand_name != '')) {
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('brand') . '(brand_name) ' . 'VALUES (\'' . $new_brand_name . '\')';
		$GLOBALS['db']->query($sql);
		$brand_id = $GLOBALS['db']->insert_id();
	}

	$_POST['goods_desc'] = htmlspecialchars_decode($_POST['goods_desc']);

	if ($is_insert) {
		if ($code == '') {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods') . ' (goods_name, goods_name_style, goods_sn, ' . 'cat_id, brand_id, shop_price, market_price, is_promote, promote_price, ' . 'promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, ' . 'seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, ' . 'is_on_sale, is_alone_sale, goods_desc, add_time, last_update, goods_type)' . 'VALUES (\'' . $_POST['goods_name'] . '\', \'' . $goods_name_style . '\', \'' . $goods_sn . '\', \'' . $catgory_id . '\', ' . '\'' . $brand_id . '\', \'' . $shop_price . '\', \'' . $market_price . '\', \'' . $is_promote . '\',\'' . $promote_price . '\', ' . '\'' . $promote_start_date . '\', \'' . $promote_end_date . '\', \'' . $goods_img . '\', \'' . $goods_thumb . '\', \'' . $original_img . '\', ' . '\'' . $_POST['keywords'] . '\', \'' . $_POST['goods_brief'] . '\', \'' . $_POST['seller_note'] . '\', \'' . $goods_weight . '\', \'' . $goods_number . '\',' . ' \'' . $warn_number . '\', \'' . $_POST['integral'] . '\', \'' . intval($_POST['give_integral']) . '\', \'' . $is_best . '\', \'' . $is_new . '\', \'' . $is_hot . '\', \'' . $is_on_sale . '\', \'' . $is_alone_sale . '\', ' . ' \'' . $_POST['goods_desc'] . '\', \'' . gmtime() . '\', \'' . gmtime() . '\', \'' . $goods_type . '\')';
		}
		else {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods') . ' (goods_name, goods_name_style, goods_sn, ' . 'cat_id, brand_id, shop_price, market_price, is_promote, promote_price, ' . 'promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, ' . 'seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, is_real, ' . 'is_on_sale, is_alone_sale, goods_desc, add_time, last_update, goods_type, extension_code)' . 'VALUES (\'' . $_POST['goods_name'] . '\', \'' . $goods_name_style . '\', \'' . $goods_sn . '\', \'' . $catgory_id . '\', ' . '\'' . $brand_id . '\', \'' . $shop_price . '\', \'' . $market_price . '\', \'' . $is_promote . '\', \'' . $promote_price . '\', ' . '\'' . $promote_start_date . '\', \'' . $promote_end_date . '\', \'' . $goods_img . '\', \'' . $goods_thumb . '\', \'' . $original_img . '\', ' . '\'' . $_POST['keywords'] . '\', \'' . $_POST['goods_brief'] . '\', \'' . $_POST['seller_note'] . '\', \'' . $goods_weight . '\', \'' . $goods_number . '\',' . ' \'' . $warn_number . '\', \'' . $_POST['integral'] . '\', \'' . intval($_POST['give_integral']) . '\', \'' . $is_best . '\', \'' . $is_new . '\', \'' . $is_hot . '\', 0, \'' . $is_on_sale . '\', \'' . $is_alone_sale . '\', ' . ' \'' . $_POST['goods_desc'] . '\', \'' . gmtime() . '\', \'' . gmtime() . '\', \'' . $goods_type . '\', \'' . $code . '\')';
		}
	}
	else {
		if ($goods_img && $row['goods_img']) {
			if (is_file(ROOT_PATH . $row['goods_img'])) {
				@unlink(ROOT_PATH . $row['goods_img']);
			}

			@rename(ROOT_PATH . $goods_img, ROOT_PATH . $row['goods_img']);

			if (is_file(ROOT_PATH . $row['original_img'])) {
				@unlink(ROOT_PATH . $row['original_img']);
			}

			@rename(ROOT_PATH . $original_img, ROOT_PATH . $row['original_img']);
		}

		if ($goods_thumb && $row['goods_thumb']) {
			if (is_file(ROOT_PATH . $row['goods_thumb'])) {
				@unlink(ROOT_PATH . $row['goods_thumb']);
			}

			@rename(ROOT_PATH . $goods_thumb, ROOT_PATH . $row['goods_thumb']);
		}

		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods') . ' SET ' . 'goods_name = \'' . $_POST['goods_name'] . '\', ' . 'goods_name_style = \'' . $goods_name_style . '\', ' . 'goods_sn = \'' . $goods_sn . '\', ' . 'cat_id = \'' . $catgory_id . '\', ' . 'brand_id = \'' . $brand_id . '\', ' . 'shop_price = \'' . $shop_price . '\', ' . 'market_price = \'' . $market_price . '\', ' . 'is_promote = \'' . $is_promote . '\', ' . 'promote_price = \'' . $promote_price . '\', ' . 'promote_start_date = \'' . $promote_start_date . '\', ' . 'promote_end_date = \'' . $promote_end_date . '\', ';
		if ($goods_img && empty($row['goods_img'])) {
			$sql .= 'goods_img = \'' . $goods_img . '\', original_img = \'' . $original_img . '\', ';
		}

		if (!empty($goods_thumb)) {
			$sql .= 'goods_thumb = \'' . $goods_thumb . '\', ';
		}

		if ($code != '') {
			$sql .= 'is_real=0, extension_code=\'' . $code . '\', ';
		}

		$sql .= 'keywords = \'' . $_POST['keywords'] . '\', ' . 'goods_brief = \'' . $_POST['goods_brief'] . '\', ' . 'seller_note = \'' . $_POST['seller_note'] . '\', ' . 'goods_weight = \'' . $goods_weight . '\',' . 'goods_number = \'' . $goods_number . '\', ' . 'warn_number = \'' . $warn_number . '\', ' . 'integral = \'' . $_POST['integral'] . '\', ' . 'give_integral = \'' . $_POST['give_integral'] . '\', ' . 'is_best = \'' . $is_best . '\', ' . 'is_new = \'' . $is_new . '\', ' . 'is_hot = \'' . $is_hot . '\', ' . 'is_on_sale = \'' . $is_on_sale . '\', ' . 'is_alone_sale = \'' . $is_alone_sale . '\', ' . 'goods_desc = \'' . $_POST['goods_desc'] . '\', ' . 'last_update = \'' . gmtime() . '\', ' . 'goods_type = \'' . $goods_type . '\' ' . 'WHERE goods_id = \'' . $_POST['goods_id'] . '\' LIMIT 1';
	}

	$GLOBALS['db']->query($sql);
	$goods_id = ($is_insert ? $GLOBALS['db']->insert_id() : $_POST['goods_id']);

	if ($is_insert) {
		admin_log($_POST['goods_name'], 'add', 'goods');
	}
	else {
		admin_log($_POST['goods_name'], 'edit', 'goods');
	}

	if (isset($_POST['attr_id_list']) && isset($_POST['attr_value_list'])) {
		$goods_attr_list = array();
		$keywords_arr = explode(' ', $_POST['keywords']);
		$keywords_arr = array_flip($keywords_arr);

		if (isset($keywords_arr[''])) {
			unset($keywords_arr['']);
		}

		$sql = 'SELECT attr_id, attr_index FROM ' . $GLOBALS['ecs']->table('attribute') . ' WHERE cat_id = \'' . $goods_type . '\' ';
		$attr_res = $GLOBALS['db']->query($sql);
		$attr_list = array();

		while ($row = $GLOBALS['db']->fetchRow($attr_res)) {
			$attr_list[$row['attr_id']] = $row['attr_index'];
		}

		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('goods_attr') . ' WHERE goods_id = \'' . $goods_id . '\' ';
		$res = $GLOBALS['db']->query($sql);

		while ($row = $GLOBALS['db']->fetchRow($res)) {
			$goods_attr_list[$row['attr_id']][$row['attr_value']] = array('sign' => 'delete', 'goods_attr_id' => $row['goods_attr_id']);
		}

		foreach ($_POST['attr_id_list'] as $key => $attr_id) {
			$attr_value = $_POST['attr_value_list'][$key];
			$attr_price = $_POST['attr_price_list'][$key];

			if (!empty($attr_value)) {
				if (isset($goods_attr_list[$attr_id][$attr_value])) {
					$goods_attr_list[$attr_id][$attr_value]['sign'] = 'update';
					$goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
				}
				else {
					$goods_attr_list[$attr_id][$attr_value]['sign'] = 'insert';
					$goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
				}

				$val_arr = explode(' ', $attr_value);

				foreach ($val_arr as $k => $v) {
					if (!isset($keywords_arr[$v]) && ($attr_list[$attr_id] == '1')) {
						$keywords_arr[$v] = $v;
					}
				}
			}
		}

		$keywords = join(' ', array_flip($keywords_arr));
		$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods') . ' SET keywords = \'' . $keywords . '\' WHERE goods_id = \'' . $goods_id . '\' LIMIT 1';
		$GLOBALS['db']->query($sql);

		foreach ($goods_attr_list as $attr_id => $attr_value_list) {
			foreach ($attr_value_list as $attr_value => $info) {
				if ($info['sign'] == 'insert') {
					$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_attr') . ' (attr_id, goods_id, attr_value, attr_price)' . 'VALUES (\'' . $attr_id . '\', \'' . $goods_id . '\', \'' . $attr_value . '\', \'' . $info['attr_price'] . '\')';
				}
				else if ($info['sign'] == 'update') {
					$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods_attr') . ' SET attr_price = \'' . $info['attr_price'] . '\' WHERE goods_attr_id = \'' . $info['goods_attr_id'] . '\' LIMIT 1';
				}
				else {
					$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('goods_attr') . ' WHERE goods_attr_id = \'' . $info['goods_attr_id'] . '\' LIMIT 1';
				}

				$GLOBALS['db']->query($sql);
			}
		}
	}

	if (isset($_POST['user_rank']) && isset($_POST['user_price'])) {
		handle_member_price($goods_id, $_POST['user_rank'], $_POST['user_price']);
	}

	if (isset($_POST['other_cat'])) {
		handle_other_cat($goods_id, array_unique($_POST['other_cat']));
	}

	if ($is_insert) {
		handle_link_goods($goods_id);
		handle_group_goods($goods_id);
		handle_goods_article($goods_id);
	}

	if (isset($img)) {
		$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_gallery') . ' (goods_id, img_url, img_desc, thumb_url, img_original) ' . 'VALUES (\'' . $goods_id . '\', \'' . $gallery_img . '\', \'\', \'' . $gallery_thumb . '\', \'' . $img . '\')';
		$GLOBALS['db']->query($sql);
	}

	if (!empty($_POST['img_url'])) {
		foreach ($_POST['img_url'] as $key => $img_url) {
			if (!in_array($img_url['Type'], $allow_file_type)) {
				client_show_message(205);
			}

			if (client_check_image_size($img_url['Data']) === false) {
				client_show_message(206);
			}

			$img_original = upload_image($img_url);

			if ($img_original === false) {
				continue;
			}

			$img_url = $thumb_url = $img_original;
			$img_desc = $_POST['img_desc'][$key];
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('goods_gallery') . ' (goods_id, img_url, img_desc, thumb_url, img_original) ' . 'VALUES (\'' . $goods_id . '\', \'' . $img_url . '\', \'' . $img_desc . '\', \'' . $thumb_url . '\', \'' . $img_original . '\')';
			$GLOBALS['db']->query($sql);
		}
	}

	if (!$is_insert && isset($_POST['old_img_desc'])) {
		foreach ($_POST['old_img_desc'] as $img_id => $img_desc) {
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods_gallery') . ' SET img_desc = \'' . $img_desc . '\' WHERE img_id = \'' . $img_id . '\' LIMIT 1';
			$GLOBALS['db']->query($sql);
		}
	}

	clear_cache_files();
	client_show_message(0, true, '', $goods_id);
}

function API_GetGoods($post)
{
	$pagesize = intval($_POST['PageSize']);
	$page = intval($_POST['Page']);

	if (empty($pagesize)) {
		$pagesize = 20;
	}

	if ($page < 0) {
		$page = 0;
	}

	$today = gmtime();
	$is_delete = 0;
	$record_count = $GLOBALS['db']->getOne('SELECT count(*) FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE is_delete=\'' . $is_delete . '\' ' . $where . ' ');

	if (floor($record_count / $pagesize) < $page) {
		$page = $record_count / $pagesize;
	}

	$limit = ' LIMIT ' . ($page * $pagesize) . ', ' . $pagesize;
	$sql = 'SELECT goods_id, cat_id, goods_name, goods_sn, brand_id, market_price, shop_price, promote_price, is_on_sale, is_alone_sale, is_best, is_new, is_hot, goods_number, goods_weight, integral, goods_brief, REPLACE(goods_desc, CONCAT(char(170), char(178)), \'\') AS goods_desc, goods_thumb, goods_img, promote_start_date, promote_end_date, ' . ' (promote_price > 0 AND promote_start_date <= \'' . $today . '\' AND promote_end_date >= \'' . $today . '\') AS is_promote, warn_number, keywords, extension_code, seller_note, give_integral ' . ' FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g WHERE is_delete=\'' . $is_delete . '\' ' . $where . ' ORDER BY goods_id DESC ' . $limit;
	$result = array();
	$result['Data'] = $GLOBALS['db']->getAll($sql);
	$result['NextPage'] = false;
	$result['PrevPage'] = false;
	$result['RecordCount'] = $record_count;

	if ($page < floor($record_count / $pagesize)) {
		$result['NextPage'] = true;
	}

	if (0 < $page) {
		$result['PrevPage'] = true;
	}

	foreach ($result['Data'] as $key => $goods) {
		$result['Data'][$key]['is_on_sale'] = $goods['is_on_sale'] == 1;
		$result['Data'][$key]['is_alone_sale'] = $goods['is_alone_sale'] == 1;
		$result['Data'][$key]['is_best'] = $goods['is_best'] == 1;
		$result['Data'][$key]['is_new'] = $goods['is_new'] == 1;
		$result['Data'][$key]['is_hot'] = $goods['is_hot'] == 1;
		$result['Data'][$key]['is_promote'] = $goods['is_promote'] == 1;
		$result['Data'][$key]['goods_desc'] = htmlspecialchars($goods['goods_desc']);
		$result['Data'][$key]['keywords'] = htmlspecialchars($goods['keywords']);
		$result['Data'][$key]['promote_start_date'] = local_date('Y-m-d', $goods['promote_start_date']);
		$result['Data'][$key]['promote_end_date'] = local_date('Y-m-d', $goods['promote_end_date']);
		$tmp = array();

		if ($goods['goods_thumb'] != '') {
			$tmp['Type'] = substr($goods['goods_thumb'], strrpos($goods['goods_thumb'], '.') + 1);
			$tmp['Data'] = get_goods_image_url($goods['goods_id'], $goods['goods_thumb'], true);
		}
		else {
			$tmp['Type'] = '';
			$tmp['Data'] = '';
		}

		$result['Data'][$key]['goods_thumb'] = $tmp;

		if ($goods['goods_img'] != '') {
			$tmp['Type'] = substr($goods['goods_img'], strrpos($goods['goods_img'], '.') + 1);
			$tmp['Data'] = get_goods_image_url($goods['goods_id'], $goods['goods_img'], false);
		}
		else {
			$tmp['Type'] = '';
			$tmp['Data'] = '';
		}

		$result['Data'][$key]['goods_img'] = $tmp;
	}

	show_json($GLOBALS['json'], $result, true);
}

function API_DeleteBrand($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/cls_exchange.php';
	admin_privilege('brand_manage');
	$brand_id = intval($_POST['Id']);
	$exc = new exchange($GLOBALS['ecs']->table('brand'), $GLOBALS['db'], 'brand_id', 'brand_name');
	$brand = $GLOBALS['db']->getRow('SELECT brand_logo FROM ' . $GLOBALS['ecs']->table('brand') . ' WHERE brand_id=\'' . $brand_id . '\'');

	if (!empty($brand['brand_logo'])) {
		@unlink(ROOT_PATH . '/brandlogo/' . $brand['brand_logo']);
	}

	$exc->drop($brand_id);
	$sql = 'UPDATE ' . $GLOBALS['ecs']->table('goods') . ' SET brand_id=0 WHERE brand_id=\'' . $brand_id . '\'';
	$GLOBALS['db']->query($sql);
	client_show_message(0, true);
}

function API_DeleteCategory($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	admin_privilege('cat_manage');
	$cat_id = intval($_POST['Id']);
	$cat_name = $GLOBALS['db']->getOne('SELECT cat_name FROM ' . $GLOBALS['ecs']->table('category') . ' WHERE cat_id=\'' . $cat_id . '\'');
	$cat_count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('category') . ' WHERE parent_id=\'' . $cat_id . '\'');
	$goods_count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE cat_id=\'' . $cat_id . '\'');
	if (($cat_count == 0) && ($goods_count == 0)) {
		$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('category') . ' WHERE cat_id = \'' . $cat_id . '\'';

		if ($GLOBALS['db']->query($sql)) {
			$GLOBALS['db']->query('DELETE FROM ' . $GLOBALS['ecs']->table('nav') . 'WHERE ctype = \'c\' AND cid = \'' . $cat_id . '\' AND type = \'middle\'');
			clear_cache_files();
			admin_log($cat_name, 'remove', 'category');
		}

		client_show_message(0, true);
	}
	else {
		client_show_message(400);
	}
}

function API_DeleteGoods($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/cls_exchange.php';
	$exc = new exchange($GLOBALS['ecs']->table('goods'), $GLOBALS['db'], 'goods_id', 'goods_name');
	admin_privilege('remove_back');
	$goods_id = intval($_POST['Id']);

	if ($exc->edit('is_delete = 1', $goods_id, '')) {
		client_show_message(0, true);
	}
	else {
		client_show_message(230);
	}
}

function API_EditCategory($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	$cat_id = (!empty($_POST['cat_id']) ? intval($_POST['cat_id']) : 0);
	$cat['parent_id'] = !empty($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
	$cat['sort_order'] = !empty($_POST['sort_order']) ? intval($_POST['sort_order']) : 0;
	$cat['keywords'] = !empty($_POST['keywords']) ? trim($_POST['keywords']) : '';
	$cat['cat_desc'] = !empty($_POST['cat_desc']) ? $_POST['cat_desc'] : '';
	$cat['measure_unit'] = !empty($_POST['measure_unit']) ? trim($_POST['measure_unit']) : '';
	$cat['cat_name'] = !empty($_POST['cat_name']) ? trim($_POST['cat_name']) : '';
	$cat['is_show'] = !empty($_POST['is_show']) ? intval($_POST['is_show']) : 0;
	$cat['show_in_nav'] = !empty($_POST['show_in_nav']) ? intval($_POST['show_in_nav']) : 0;
	$cat['style'] = !empty($_POST['style']) ? trim($_POST['style']) : '';
	$cat['grade'] = !empty($_POST['grade']) ? intval($_POST['grade']) : 0;
	$cat['filter_attr'] = !empty($_POST['filter_attr']) ? intval($_POST['filter_attr']) : 0;
	$children = get_array_keys_cat(intval($id));

	if (in_array($cat['parent_id'], $children)) {
		client_show_message(401);
	}

	if ((10 < $cat['grade']) || ($cat['grade'] < 0)) {
		client_show_message(402);
	}

	if (cat_exists($cat['cat_name'], $cat['parent_id'], $cat_id)) {
		client_show_message(403);
	}

	$dat = $GLOBALS['db']->getRow('SELECT cat_name, show_in_nav FROM ' . $GLOBALS['ecs']->table('category') . ' WHERE cat_id = \'' . $cat_id . '\'');

	if ($GLOBALS['db']->autoExecute($GLOBALS['ecs']->table('category'), $cat, 'UPDATE', 'cat_id=\'' . $cat_id . '\'')) {
		if ($cat['cat_name'] != $dat['cat_name']) {
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('nav') . ' SET name = \'' . $cat['cat_name'] . '\' WHERE ctype = \'c\' AND cid = \'' . $cat_id . '\' AND type = \'middle\'';
			$GLOBALS['db']->query($sql);
		}

		if ($cat['show_in_nav'] != $dat['show_in_nav']) {
			if ($cat['show_in_nav'] == 1) {
				$nid = $GLOBALS['db']->getOne('SELECT id FROM ' . $GLOBALS['ecs']->table('nav') . ' WHERE ctype = \'c\' AND cid = \'' . $cat_id . '\' AND type = \'middle\'');

				if (empty($nid)) {
					$vieworder = $GLOBALS['db']->getOne('SELECT max(vieworder) FROM ' . $GLOBALS['ecs']->table('nav') . ' WHERE type = \'middle\'');
					$vieworder += 2;
					$uri = build_uri('category', array('cid' => $cat_id), $cat['cat_name']);
					$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('nav') . ' (name,ctype,cid,ifshow,vieworder,opennew,url,type) VALUES(\'' . $cat['cat_name'] . '\', \'c\', \'' . $cat_id . '\',\'1\',\'' . $vieworder . '\',\'0\', \'' . $uri . '\',\'middle\')';
				}
				else {
					$sql = 'UPDATE ' . $GLOBALS['ecs']->table('nav') . ' SET ifshow = 1 WHERE ctype = \'c\' AND cid = \'' . $cat_id . '\' AND type = \'middle\'';
				}

				$GLOBALS['db']->query($sql);
			}
			else {
				$GLOBALS['db']->query('UPDATE ' . $GLOBALS['ecs']->table('nav') . ' SET ifshow = 0 WHERE ctype = \'c\' AND cid = \'' . $cat_id . '\' AND type = \'middle\'');
			}
		}
	}

	clear_cache_files();
	admin_log($_POST['cat_name'], 'edit', 'category');
	client_show_message(0, true);
}

function API_EditBrand($post)
{
	require_once ROOT_PATH . ADMIN_PATH . '/includes/lib_main.php';
	require_once ROOT_PATH . ADMIN_PATH . '/includes/cls_exchange.php';
	require_once ROOT_PATH . 'includes/cls_image.php';
	admin_privilege('brand_manage');
	$is_show = (isset($_POST['is_show']) ? 1 : 0);
	$brand_id = (!empty($_POST['brand_id']) ? intval($_POST['brand_id']) : 0);
	$exc = new exchange($GLOBALS['ecs']->table('brand'), $GLOBALS['db'], 'brand_id', 'brand_name');
	$is_only = $exc->is_only('brand_name', $_POST['brand_name'], '', '');

	if (!$is_only) {
		client_show_message(301);
	}

	$param = 'brand_name = \'' . $_POST['brand_name'] . '\', site_url=\'' . $_POST['site_url'] . '\', brand_desc=\'' . $_POST['brand_desc'] . '\', is_show=\'' . $is_show . '\', sort_order=\'' . $_POST['sort_order'] . '\' ';
	$img_name = upload_image($_POST['brand_logo'], 'brandlogo');

	if ($img_name !== false) {
		$param .= ' ,brand_logo = \'' . basename($img_name) . '\' ';
	}

	if ($exc->edit($param, $brand_id, '')) {
		clear_cache_files();
		admin_log($_POST['brand_name'], 'edit', 'brand');
		client_show_message(0, true);
	}
	else {
		client_show_message(302);
	}
}

function API_EditGoods($post)
{
	$_POST['act'] = 'update';
	api_addgoods($post);
}

function API_Error()
{
	client_show_message(102);
}

if (!function_exists('htmlspecialchars_decode')) {
	function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT)
	{
		return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
	}
}

?>
