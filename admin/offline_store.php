<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
function upload_article_file($upload)
{
	if (!make_dir('../' . DATA_DIR . '/offline_store')) {
		return false;
	}

	$filename = cls_image::random_filename() . substr($upload['name'], strpos($upload['name'], '.'));
	$path = ROOT_PATH . DATA_DIR . '/offline_store/' . $filename;

	if (move_upload_file($upload['tmp_name'], $path)) {
		return DATA_DIR . '/offline_store/' . $filename;
	}
	else {
		return false;
	}
}

function get_offline_store_list()
{
	$adminru = get_admin_ru_id();
	$result = get_filter();

	if ($result === false) {
		$filter['type'] = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;
		$filter['stores_user'] = empty($_REQUEST['stores_user']) ? '' : trim($_REQUEST['stores_user']);
		$filter['stores_name'] = empty($_REQUEST['stores_name']) ? '' : trim($_REQUEST['stores_name']);
		$filter['is_confirm'] = isset($_REQUEST['is_confirm']) ? intval($_REQUEST['is_confirm']) : -1;
		$shop_name = empty($_REQUEST['shop_name']) ? '' : trim($_REQUEST['shop_name']);
		$where = ' WHERE 1 ';

		if ($filter['stores_user']) {
			$sql = 'SELECT store_id FROM' . $GLOBALS['ecs']->table('store_user') . 'stores_user LIKE \'%' . mysql_like_quote($filter['stores_user']) . '%\' AND parent_id = 0';
			$store_id = $GLOBALS['db']->getOne($sql);
			$where .= ' AND id = \'' . $store_id . '\'';
		}

		if ($filter['stores_name']) {
			$where .= ' AND stores_name LIKE \'%' . mysql_like_quote($filter['stores_name']) . '%\'';
		}

		if ($filter['is_confirm'] != -1) {
			$where .= ' AND is_confirm = \'' . $filter['is_confirm'] . '\'';
		}

		if ($filter['type'] == 1) {
			$filter['store_search'] = empty($_REQUEST['store_search']) ? 0 : intval($_REQUEST['store_search']);
			$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
			$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';
			$store_where = '';
			$store_search_where = '';

			if ($filter['store_search'] != 0) {
				if ($adminru['ru_id'] == 0) {
					if ($_REQUEST['store_type']) {
						$store_search_where = 'AND msi.shopNameSuffix = \'' . $_REQUEST['store_type'] . '\'';
					}

					if ($filter['store_search'] == 1) {
						$where .= ' AND o.ru_id = \'' . $filter['merchant_id'] . '\' ';
					}
					else if ($filter['store_search'] == 2) {
						$store_where .= ' AND msi.rz_shopName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\'';
					}
					else if ($filter['store_search'] == 3) {
						$store_where .= ' AND msi.shoprz_brandName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\' ' . $store_search_where;
					}

					if (1 < $filter['store_search'] && $filter['store_search'] != 4) {
						$where .= ' AND (SELECT msi.user_id FROM ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' as msi ' . (' WHERE msi.user_id = o.ru_id ' . $store_where . ') > 0 ');
					}
					else if ($filter['store_search'] == 4) {
						$where .= ' AND o.ru_id = 0';
					}
				}
			}
			else {
				$where .= ' AND o.ru_id > 0';
			}
		}
		else {
			$where .= ' AND o.ru_id = 0';
		}

		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('offline_store') . ' AS o ' . $where;
		$filter['record_count'] = $GLOBALS['db']->getOne($sql);
		$filter = page_and_size($filter);
		$sql = 'SELECT o.ru_id,o.id,o.stores_name,o.stores_address,o.stores_tel,o.stores_opening_hours,' . 'o.stores_traffic_line,o.stores_img,o.is_confirm,a.region_name as country , ' . 'b.region_name as province ,c.region_name as city, d.region_name as district ' . 'FROM' . $GLOBALS['ecs']->table('offline_store') . ' AS o ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' AS a ON a.region_id = o.country ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' AS b ON b.region_id = o.province ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('region') . ' AS c ON c.region_id = o.city ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('region') . (' AS d ON d.region_id = o.district ' . $where . ' ORDER BY o.id ASC LIMIT ') . $filter['start'] . ',' . $filter['page_size'];
		$filter['keywords'] = stripslashes($filter['keywords']);
		set_filter($filter, $sql);
	}
	else {
		$sql = $result['sql'];
		$filter = $result['filter'];
	}

	$row = $GLOBALS['db']->getAll($sql);

	foreach ($row as $k => $v) {
		$row[$k]['shop_name'] = get_shop_name($v['ru_id'], 1);
		$row[$k]['stores_user'] = $GLOBALS['db']->getOne('SELECT stores_user FROM' . $GLOBALS['ecs']->table('store_user') . ' WHERE store_id = \'' . $v['id'] . '\' AND parent_id = 0');
		$row[$k]['stores_img'] = get_image_path(0, $v['stores_img']);
	}

	$arr = array('pzd_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}

function get_status_list($type = 'all')
{
	global $_LANG;
	$list = array();
	if ($type == 'all' || $type == 'order') {
		$pre = $type == 'all' ? 'os_' : '';

		foreach ($_LANG['os'] as $key => $value) {
			$list[$pre . $key] = $value;
		}
	}

	if ($type == 'all' || $type == 'shipping') {
		$pre = $type == 'all' ? 'ss_' : '';

		foreach ($_LANG['ss'] as $key => $value) {
			$list[$pre . $key] = $value;
		}
	}

	if ($type == 'all' || $type == 'payment') {
		$pre = $type == 'all' ? 'ps_' : '';

		foreach ($_LANG['ps'] as $key => $value) {
			$list[$pre . $key] = $value;
		}
	}

	return $list;
}

function get_data_list($type = 0)
{
	$leftJoin = '';
	$where = 1;
	$where .= ' and (select count(*) from ' . $GLOBALS['ecs']->table('order_info') . ' as oi2 where oi2.main_order_id = o.order_id) = 0 ';

	if ($type != 0) {
		$result = get_filter();

		if ($result === false) {
			$filter['type'] = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 0;
			$filter['order_type'] = !empty($_REQUEST['order_type']) ? intval($_REQUEST['order_type']) : 0;
			$filter['date_start_time'] = !empty($_REQUEST['date_start_time']) ? trim($_REQUEST['date_start_time']) : '';
			$filter['date_end_time'] = !empty($_REQUEST['date_end_time']) ? trim($_REQUEST['date_end_time']) : '';
			$filter['store_name'] = !empty($_REQUEST['store_name']) ? trim($_REQUEST['store_name']) : '';
			$filter['shop_name'] = !empty($_REQUEST['shop_name']) ? trim($_REQUEST['shop_name']) : '';
			$filter['order_status'] = isset($_REQUEST['order_status']) ? explode(',', $_REQUEST['order_status']) : '-1';
			$filter['shipping_status'] = isset($_REQUEST['shipping_status']) ? explode(',', $_REQUEST['shipping_status']) : '-1';
			$filter['store_id'] = isset($_REQUEST['store_id']) && !empty($_REQUEST['store_id']) ? intval($_REQUEST['store_id']) : 0;
			if ($filter['date_start_time'] == '' && $filter['date_end_time'] == '') {
				$start_time = local_mktime(0, 0, 0, date('m'), 1, date('Y'));
				$end_time = local_mktime(0, 0, 0, date('m'), date('t'), date('Y')) + 24 * 60 * 60 - 1;
			}
			else {
				$start_time = local_strtotime($filter['date_start_time']);
				$end_time = local_strtotime($filter['date_end_time']);
			}

			$where .= ' AND o.add_time > \'' . $start_time . '\' AND o.add_time < \'' . $end_time . '\'';

			if ($filter['store_name']) {
				$sql = 'SELECT id FROM' . $GLOBALS['ecs']->table('offline_store') . ' WHERE stores_name LIKE \'%' . mysql_like_quote($filter['store_name']) . '%\'';
				$filter['store_id'] = $GLOBALS['db']->getOne($sql);
				$where .= ' AND sto.store_id = \'' . $filter['store_id'] . '\'';
			}

			if ($filter['type']) {
				$filter['store_search'] = empty($_REQUEST['store_search']) ? 0 : intval($_REQUEST['store_search']);
				$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
				$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';
				$store_where = '';
				$store_search_where = '';

				if ($filter['store_search'] != 0) {
					if ($adminru['ru_id'] == 0) {
						if ($_REQUEST['store_type']) {
							$store_search_where = 'AND msi.shopNameSuffix = \'' . $_REQUEST['store_type'] . '\'';
						}

						if ($filter['store_search'] == 1) {
							$where .= ' AND og.ru_id = \'' . $filter['merchant_id'] . '\' ';
						}
						else if ($filter['store_search'] == 2) {
							$store_where .= ' AND msi.rz_shopName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\'';
						}
						else if ($filter['store_search'] == 3) {
							$store_where .= ' AND msi.shoprz_brandName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\' ' . $store_search_where;
						}

						if (1 < $filter['store_search'] && $filter['store_search'] != 4) {
							$where .= ' AND (SELECT msi.user_id FROM ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' as msi ' . (' WHERE msi.user_id = og.ru_id ' . $store_where . ') > 0 ');
						}
					}
				}
				else {
					$where .= ' AND og.ru_id > 0';

					if ($filter['store_id']) {
						$where .= ' AND sto.store_id = \'' . $filter['store_id'] . '\'';
					}
				}
			}
			else {
				$where .= ' AND og.ru_id = 0';
			}

			$filter['page'] = empty($_REQUEST['page']) || intval($_REQUEST['page']) <= 0 ? 1 : intval($_REQUEST['page']);
			if (isset($_REQUEST['page_size']) && 0 < intval($_REQUEST['page_size'])) {
				$filter['page_size'] = intval($_REQUEST['page_size']);
			}
			else {
				if (isset($_COOKIE['ECSCP']['page_size']) && 0 < intval($_COOKIE['ECSCP']['page_size'])) {
					$filter['page_size'] = intval($_COOKIE['ECSCP']['page_size']);
				}
				else {
					$filter['page_size'] = 15;
				}
			}

			if ($filter['order_status'] != '-1') {
				$order_status = implode(',', $filter['order_status']);

				if ($order_status != '') {
					$where .= ' AND o.order_status in(' . $order_status . ')';
				}
			}

			if ($filter['shipping_status'] != '-1') {
				$shipping_status = implode(',', $filter['shipping_status']);

				if ($shipping_status != '') {
					$where .= ' AND o.shipping_status in(' . $shipping_status . ')';
				}
			}

			if (0 < $filter['order_type']) {
				$where .= ' AND sto.is_grab_order = 1 ';
			}

			$sql_all = 'SELECT og.goods_id, og.order_id, og.goods_id, og.goods_name, og.ru_id, og.goods_sn, og.goods_price, o.add_time, ' . '(' . order_amount_field('o.') . ') AS total_fee, og.goods_number ,sto.store_id ' . ' FROM ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' AS o ' . ' ON o.order_id = og.order_id ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('store_order') . ' AS sto ON sto.order_id = o.order_id ' . ' WHERE ' . $where . ' AND sto.store_id > 0  GROUP BY o.order_id ORDER BY og.goods_id DESC';
			$sql = $sql_all . ' LIMIT ' . ($filter['page'] - 1) * $filter['page_size'] . (',' . $filter['page_size']);
			set_filter($filter, $sql);
		}
		else {
			$sql = $result['sql'];
			$filter = $result['filter'];
		}
	}

	$data_list = $GLOBALS['db']->getAll($sql);
	$filter['record_count'] = count($GLOBALS['db']->getAll($sql_all));
	$filter['page_count'] = 0 < $filter['record_count'] ? ceil($filter['record_count'] / $filter['page_size']) : 1;
	$store_total = 0;

	if ($type != 0) {
		for ($i = 0; $i < count($data_list); $i++) {
			$data_list[$i]['shop_name'] = get_shop_name($data_list[$i]['ru_id'], 1);
			$store_total += $data_list[$i]['total_fee'] = $data_list[$i]['goods_number'] * $data_list[$i]['goods_price'];
			$data_list[$i]['stores_name'] = $GLOBALS['db']->getOne('SELECT stores_name FROM ' . $GLOBALS['ecs']->table('offline_store') . '  WHERE id = \'' . $data_list[$i]['store_id'] . '\' ');
			$data_list[$i]['add_time'] = local_date($GLOBALS['_CFG']['time_format'], $data_list[$i]['add_time']);
		}

		if ($filter['sort_by'] == 'goods_number') {
			$data_list = get_array_sort($data_list, 'goods_number', 'DESC');
		}

		$arr = array('data_list' => $data_list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count'], 'store_total' => price_format($store_total));
		return $arr;
	}
}

function order_amount_field($alias = '', $ru_id = 0)
{
	return '   ' . $alias . 'goods_amount + ' . $alias . 'tax + ' . $alias . 'shipping_fee' . (' + ' . $alias . 'insure_fee + ' . $alias . 'pay_fee + ' . $alias . 'pack_fee') . (' + ' . $alias . 'card_fee ');
}

function stat_filter()
{
	$start_time = local_strtotime($_REQUEST['start_time']);
	$end_time = local_strtotime($_REQUEST['end_time']);
	$where = 1;
	$where .= ' and (select count(*) from ' . $GLOBALS['ecs']->table('order_info') . ' as oi2 where oi2.main_order_id = o.order_id) = 0 ';
	$where .= ' AND o.add_time > \'' . $start_time . '\' AND o.add_time < \'' . $end_time . '\'';

	if ($_REQUEST['type']) {
		$where .= ' AND og.ru_id > 0';
	}
	else {
		$where .= ' AND og.ru_id = 0';
	}

	$sql = 'SELECT COUNT(o.order_id) AS order_num , SUM(o.goods_amount) AS total_fee ' . ' FROM ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' AS o ' . ' ON o.order_id = og.order_id ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('store_order') . ' AS sto ON sto.order_id = o.order_id ' . ' WHERE ' . $where . ' AND sto.store_id > 0  GROUP BY o.order_id ORDER BY og.goods_id DESC ';
	$list = $GLOBALS['db']->getAll($sql);
	$result = array(
		'order_num'  => '',
		'total_fee'  => '',
		'goods_list' => array()
		);

	foreach ($list as $v) {
		$result['order_num'] += $v['order_num'];
		$result['total_fee'] += $v['total_fee'];
	}

	$sql_all = 'SELECT og.goods_name, og.goods_price, MAX(o.add_time) AS last_sale_time , ' . ' SUM(og.goods_number) AS sales_num ,sto.store_id ' . ' FROM ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('order_info') . ' AS o ' . ' ON o.order_id = og.order_id ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('store_order') . ' AS sto ON sto.order_id = o.order_id ' . ' WHERE ' . $where . ' AND sto.store_id > 0  GROUP BY og.goods_id ORDER BY og.goods_id DESC LIMIT 10 ';
	$result['goods_list'] = $GLOBALS['db']->getAll($sql_all);
	return $result;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
require_once ROOT_PATH . 'includes/cls_image.php';
$exc = new exchange($ecs->table('offline_store'), $db, 'id', 'stores_user', 'stores_name', 'is_confirm', 'stores_tel', 'stores_opening_hours');
$sto = new exchange($ecs->table('store_user'), $db, 'id', 'stores_user', 'store_id');
$allow_file_types = '|GIF|JPG|PNG|';
$adminru = get_admin_ru_id();

if ($adminru['ru_id'] == 0) {
	$smarty->assign('priv_ru', 1);
}
else {
	$smarty->assign('priv_ru', 0);
}

$start_date = $end_date = '';
if (isset($_POST) && !empty($_POST)) {
	$start_date = local_strtotime($_POST['start_date']);
	$end_date = local_strtotime($_POST['end_date']);
}
else {
	if (isset($_GET['start_date']) && !empty($_GET['end_date'])) {
		$start_date = local_strtotime($_GET['start_date']);
		$end_date = local_strtotime($_GET['end_date']);
	}
	else {
		$today = local_strtotime(local_date('Y-m-d'));
		$start_date = $today - 86400 * 7;
		$end_date = $today;
	}
}

if ($_REQUEST['act'] == 'list') {
	admin_priv('offline_store');
	$smarty->assign('menu_select', array('action' => '17_merchants', 'current' => '12_seller_store'));
	$smarty->assign('ur_here', $_LANG['12_offline_store']);
	$smarty->assign('action_link', array('text' => $_LANG['add_stores'], 'href' => 'offline_store.php?act=add'));
	$store_list = get_common_store_list();
	$smarty->assign('store_list', $store_list);
	$offline_store = get_offline_store_list();
	$smarty->assign('offline_store', $offline_store['pzd_list']);
	$smarty->assign('filter', $offline_store['filter']);
	$smarty->assign('record_count', $offline_store['record_count']);
	$smarty->assign('page_count', $offline_store['page_count']);
	$smarty->assign('full_page', 1);
	assign_query_info();
	$smarty->display('offline_store_list.dwt');
}
else if ($_REQUEST['act'] == 'query') {
	admin_priv('offline_store');
	$smarty->assign('ur_here', $_LANG['12_offline_store']);
	$smarty->assign('action_link', array('text' => $_LANG['add_stores'], 'href' => 'offline_store.php?act=add'));
	$store_list = get_common_store_list();
	$smarty->assign('store_list', $store_list);
	$offline_store = get_offline_store_list();
	$smarty->assign('offline_store', $offline_store['pzd_list']);
	$smarty->assign('filter', $offline_store['filter']);
	$smarty->assign('record_count', $offline_store['record_count']);
	$smarty->assign('page_count', $offline_store['page_count']);
	make_json_result($smarty->fetch('offline_store_list.dwt'), '', array('filter' => $offline_store['filter'], 'page_count' => $offline_store['page_count']));
}
else {
	if ($_REQUEST['act'] == 'add' || $_REQUEST['act'] == 'edit') {
		admin_priv('offline_store');
		$smarty->assign('ur_here', $_LANG['add_stores']);
		$href = $_REQUEST['type'] && $_REQUEST['type'] == 1 ? 'offline_store.php?act=list&type=' . intval($_REQUEST['type']) : 'offline_store.php?act=list';
		$smarty->assign('action_link', array('text' => $_LANG['12_offline_store'], 'href' => $href));
		$act = $_REQUEST['act'] == 'add' ? 'insert' : 'update';
		$smarty->assign('act', $act);

		if ($_REQUEST['act'] == 'add') {
			$smarty->assign('countries', get_regions());
			$smarty->assign('provinces', get_regions(1));
			$smarty->assign('cities', array());
			$smarty->assign('districts', array());
		}
		else {
			$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
			$sql = 'SELECT * FROM' . $ecs->table('offline_store') . ('WHERE id = \'' . $id . '\' LIMIT 1');
			$offline_store = $db->getRow($sql);
			$store_user_info = $GLOBALS['db']->getRow('SELECT stores_user, email FROM' . $GLOBALS['ecs']->table('store_user') . ' WHERE store_id = \'' . $offline_store['id'] . '\' AND parent_id = 0');
			$offline_store['stores_user'] = $store_user_info['stores_user'];
			$offline_store['stores_email'] = $store_user_info['email'];
			$offline_store['stores_img'] = get_image_path(0, $offline_store['stores_img']);
			$smarty->assign('countries', get_regions());
			$smarty->assign('provinces', get_regions(1));
			$smarty->assign('cities', get_regions(2, $offline_store['province']));
			$smarty->assign('districts', get_regions(3, $offline_store['city']));
			$smarty->assign('offline_store', $offline_store);
		}

		$smarty->display('offline_store_info.dwt');
	}
	else {
		if ($_REQUEST['act'] == 'insert' || $_REQUEST['act'] == 'update') {
			$stores_user = isset($_REQUEST['stores_user']) ? $_REQUEST['stores_user'] : '';
			$stores_name = isset($_REQUEST['stores_name']) ? $_REQUEST['stores_name'] : '';
			$country = isset($_REQUEST['country']) ? $_REQUEST['country'] : '';
			$province = isset($_REQUEST['province']) ? $_REQUEST['province'] : '';
			$city = isset($_REQUEST['city']) ? $_REQUEST['city'] : '';
			$district = isset($_REQUEST['district']) ? $_REQUEST['district'] : '';
			$stores_address = isset($_REQUEST['stores_address']) ? $_REQUEST['stores_address'] : '';
			$stores_tel = isset($_REQUEST['stores_tel']) ? $_REQUEST['stores_tel'] : '';
			$stores_email = isset($_REQUEST['stores_email']) ? $_REQUEST['stores_email'] : '';
			$stores_opening_hours = isset($_REQUEST['stores_opening_hours']) ? $_REQUEST['stores_opening_hours'] : '';
			$stores_traffic_line = isset($_REQUEST['stores_traffic_line']) ? $_REQUEST['stores_traffic_line'] : '';
			$is_confirm = isset($_REQUEST['is_confirm']) ? $_REQUEST['is_confirm'] : 0;

			if ($_REQUEST['act'] == 'insert') {
				$stores_pwd = isset($_REQUEST['stores_pwd']) ? $_REQUEST['stores_pwd'] : '';
				$confirm_pwd = isset($_REQUEST['confirm_pwd']) ? $_REQUEST['confirm_pwd'] : '';
				$is_only = $exc->is_only('stores_name', $stores_name, 0);

				if (!$is_only) {
					sys_msg(sprintf($_LANG['title_exist'], stripslashes($stores_name)), 1);
				}

				$is_only_stores_name = $sto->is_only('stores_user', $stores_user, 0);

				if (!$is_only_stores_name) {
					sys_msg($_LANG['only_stores_name']);
				}

				if (strlen($stores_pwd) !== strlen($confirm_pwd)) {
					show_message($_LANG['is_different']);
				}

				$file_url = '';
				if (isset($_FILES['stores_img']['error']) && $_FILES['stores_img']['error'] == 0 || !isset($_FILES['stores_img']['error']) && isset($_FILES['stores_img']['tmp_name']) && $_FILES['stores_img']['tmp_name'] != 'none') {
					if (!check_file_type($_FILES['stores_img']['tmp_name'], $_FILES['stores_img']['name'], $allow_file_types)) {
						sys_msg($_LANG['invalid_file']);
					}

					$res = upload_article_file($_FILES['stores_img']);

					if ($res != false) {
						$file_url = $res;
					}
				}

				if ($file_url == '') {
					$file_url = $_POST['file_url'];
				}

				$ec_salt = rand(1, 9999);
				$stores_pwd = md5(md5($stores_pwd) . $ec_salt);
				$time = gmtime();
				$offline_store = array('stores_name' => $stores_name, 'country' => $country, 'province' => $province, 'city' => $city, 'district' => $district, 'stores_address' => $stores_address, 'stores_tel' => $stores_tel, 'stores_opening_hours' => $stores_opening_hours, 'stores_traffic_line' => $stores_traffic_line, 'stores_img' => $file_url, 'is_confirm' => $is_confirm, 'ru_id' => $adminru['ru_id'], 'add_time' => $time);
				$db->autoExecute($ecs->table('offline_store'), $offline_store);
				$store_id = $db->insert_id();

				if ($store_id) {
					$store_user = array('ru_id' => $adminru['ru_id'], 'store_id' => $store_id, 'stores_user' => $stores_user, 'stores_pwd' => $stores_pwd, 'ec_salt' => $ec_salt, 'store_action' => 'all', 'add_time' => $time, 'tel' => $stores_tel, 'email' => $email);
					$db->autoExecute($ecs->table('store_user'), $store_user);
					$link[0]['text'] = $_LANG['GO_add'];
					$link[0]['href'] = 'offline_store.php?act=add';
					$link[1]['text'] = $_LANG['bank_list'];
					$link[1]['href'] = 'offline_store.php?act=list';
					sys_msg($_LANG['add_succeed'], 0, $link);
				}
			}
			else {
				$newpass = isset($_REQUEST['newpass']) ? $_REQUEST['newpass'] : '';
				$newconfirm_pwd = isset($_REQUEST['newconfirm_pwd']) ? $_REQUEST['newconfirm_pwd'] : '';
				$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
				$is_only = $exc->is_only('stores_name', $stores_name, 0, 'id != ' . $id);

				if (!$is_only) {
					sys_msg(sprintf($_LANG['title_exist'], stripslashes($stores_name)), 1);
				}

				$is_only_stores_name = $sto->is_only('stores_user', $stores_user, 0, 'store_id != ' . $id);

				if (!$is_only_stores_name) {
					sys_msg($_LANG['only_stores_name']);
				}

				if (strlen($newconfirm_pwd) !== strlen($newpass)) {
					show_message($_LANG['is_different']);
				}

				$file_url = '';
				if (isset($_FILES['stores_img']['error']) && $_FILES['stores_img']['error'] == 0 || !isset($_FILES['stores_img']['error']) && isset($_FILES['stores_img']['tmp_name']) && $_FILES['stores_img']['tmp_name'] != 'none') {
					if (!check_file_type($_FILES['stores_img']['tmp_name'], $_FILES['stores_img']['name'], $allow_file_types)) {
						sys_msg($_LANG['invalid_file']);
					}

					$res = upload_article_file($_FILES['stores_img']);

					if ($res != false) {
						$file_url = $res;
					}
				}

				if ($file_url == '') {
					$file_url = $_POST['file_url'];
				}

				$sql = 'SELECT stores_img, ru_id FROM ' . $ecs->table('offline_store') . (' WHERE id = \'' . $id . '\' LIMIT 1');
				$offline_store_info = $db->getRow($sql);
				$old_url = $offline_store_info ? $offline_store_info['stores_img'] : '';
				if ($old_url != '' && $old_url != $file_url && strpos($old_url, 'http: ') === false && strpos($old_url, 'https: ') === false) {
					@unlink(ROOT_PATH . $old_url);
				}

				$sql = 'SELECT ec_salt FROM' . $ecs->table('store_user') . (' WHERE store_id = \'' . $id . '\' AND parent_id = 0');
				$ec_salt = $db->getOne($sql);

				if ($newpass != '') {
					$where = 'stores_pwd = \'' . md5(md5($newpass) . $ec_salt) . '\',';
				}

				$offline_store = array('stores_name' => $stores_name, 'country' => $country, 'province' => $province, 'city' => $city, 'district' => $district, 'stores_address' => $stores_address, 'stores_tel' => $stores_tel, 'stores_opening_hours' => $stores_opening_hours, 'stores_traffic_line' => $stores_traffic_line, 'stores_img' => $file_url, 'is_confirm' => $is_confirm);
				$db->autoExecute($ecs->table('offline_store'), $offline_store, 'UPDATE', 'id = \'' . $id . '\'');
				$sql = 'UPDATE' . $ecs->table('store_user') . (' SET ' . $where . ' stores_user=\'' . $stores_user . '\' , tel = \'' . $stores_tel . '\', email = \'' . $stores_email . '\' WHERE store_id = \'' . $id . '\' AND parent_id = 0');
				$db->query($sql);
				$link[0]['text'] = $_LANG['bank_list'];

				if (0 < $offline_store_info['ru_id']) {
					$link[0]['href'] = 'offline_store.php?act=list&type=1';
				}
				else {
					$link[0]['href'] = 'offline_store.php?act=list';
				}

				sys_msg($_LANG['edit_succeed'], 0, $link);
			}
		}
		else if ($_REQUEST['act'] == 'order_stats') {
			admin_priv('offline_store');
			$smarty->assign('menu_select', array('action' => '17_merchants', 'current' => '16_seller_users_real'));
			$smarty->assign('ur_here', $_LANG['2_order_stats']);
			$smarty->assign('action_link', array('text' => $_LANG['12_offline_store'], 'href' => 'offline_store.php?act=list'));
			$start_time = local_mktime(0, 0, 0, date('m'), 1, date('Y'));
			$end_time = local_mktime(0, 0, 0, date('m'), date('t'), date('Y')) + 24 * 60 * 60 - 1;
			$start_time = local_date($GLOBALS['_CFG']['time_format'], $start_time);
			$end_time = local_date($GLOBALS['_CFG']['time_format'], $end_time);
			$smarty->assign('start_time', $start_time);
			$smarty->assign('end_time', $end_time);
			$smarty->assign('os_list', get_status_list('order'));
			$smarty->assign('ss_list', get_status_list('shipping'));
			$store_list = get_common_store_list();
			$smarty->assign('store_list', $store_list);
			$data = get_data_list($type = 1);
			$smarty->assign('data_list', $data['data_list']);
			$smarty->assign('filter', $data['filter']);
			$smarty->assign('record_count', $data['record_count']);
			$smarty->assign('page_count', $data['page_count']);
			$smarty->assign('store_total', $data['store_total']);
			$smarty->assign('date_start_time', $data['start_time']);
			$smarty->assign('date_end_time', $data['end_time']);
			$smarty->assign('full_page', 1);
			$smarty->assign('sort_order_time', '<img src="images/sort_desc.gif">');
			assign_query_info();
			$smarty->display('store_stats_order.dwt');
		}
		else if ($_REQUEST['act'] == 'order_stats_query') {
			$data = get_data_list(1);
			$smarty->assign('data_list', $data['data_list']);
			$smarty->assign('filter', $data['filter']);
			$smarty->assign('store_total', $data['store_total']);
			$smarty->assign('record_count', $data['record_count']);
			$smarty->assign('page_count', $data['page_count']);
			$sort_flag = sort_flag($data['filter']);
			$smarty->assign($sort_flag['tag'], $sort_flag['img']);
			make_json_result($smarty->fetch('store_stats_order.dwt'), '', array('filter' => $data['filter'], 'page_count' => $data['page_count']));
		}
		else if ($_REQUEST['act'] == 'edit_stores_tel') {
			check_authz_json('offline_store');
			$id = intval($_POST['id']);
			$order = json_str_iconv(trim($_POST['val']));

			if ($exc->edit('stores_tel = \'' . $order . '\'', $id)) {
				clear_cache_files();
				make_json_result(stripslashes($order));
			}
			else {
				make_json_error($db->error());
			}
		}
		else if ($_REQUEST['act'] == 'toggle_show') {
			check_authz_json('offline_store');
			$id = intval($_POST['id']);
			$order = json_str_iconv(trim($_POST['val']));

			if ($exc->edit('is_confirm = \'' . $order . '\'', $id)) {
				clear_cache_files();
				make_json_result(stripslashes($order));
			}
			else {
				make_json_error($db->error());
			}
		}
		else if ($_REQUEST['act'] == 'edit_stores_opening_hours') {
			check_authz_json('offline_store');
			$id = intval($_POST['id']);
			$order = json_str_iconv(trim($_POST['val']));

			if ($exc->edit('stores_opening_hours = \'' . $order . '\'', $id)) {
				clear_cache_files();
				make_json_result(stripslashes($order));
			}
			else {
				make_json_error($db->error());
			}
		}
		else if ($_REQUEST['act'] == 'remove') {
			check_authz_json('offline_store');
			$id = intval($_GET['id']);
			$sql = 'SELECT stores_img FROM ' . $ecs->table('offline_store') . (' WHERE id = \'' . $id . '\'');
			$old_url = $db->getOne($sql);
			if ($old_url != '' && @strpos($old_url, 'http://') === false && @strpos($old_url, 'https://') === false) {
				@unlink(ROOT_PATH . $old_url);
			}

			$exc->drop($id);
			admin_log(addslashes($name), 'remove', 'business');
			$url = 'offline_store.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
			ecs_header('Location: ' . $url . "\n");
			exit();
		}
		else if ($_REQUEST['act'] == 'batch_remove') {
			$checkboxes = !empty($_REQUEST['checkboxes']) ? $_REQUEST['checkboxes'] : array();
			if ($_REQUEST['batch_handle'] == 'open_batch' || $_REQUEST['batch_handle'] == 'off_batch') {
				$is_confirm = '';

				if ($_REQUEST['batch_handle'] == 'open_batch') {
					$is_confirm = 1;
				}
				else if ($_REQUEST['batch_handle'] == 'off_batch') {
					$is_confirm = 0;
				}

				$sql = 'UPDATE' . $ecs->table('offline_store') . (' SET is_confirm = \'' . $is_confirm . '\' WHERE id') . db_create_in($checkboxes);

				if ($db->query($sql) == true) {
					$link[] = array('text' => $_LANG['back_list'], 'href' => 'offline_store.php?act=list&' . list_link_postfix());
					sys_msg($_LANG['handle_succeed'], 0, $link);
				}
			}
			else if ($_REQUEST['batch_handle'] == 'drop_batch') {
				if (!empty($checkboxes)) {
					$sql = ' SELECT stores_img FROM' . $ecs->table('offline_store') . 'WHERE id' . db_create_in($checkboxes);
					$stores_img = $db->getAll($sql);

					if (!empty($stores_img)) {
						foreach ($stores_img as $k => $v) {
							if ($v['stores_img'] != '') {
								@unlink(ROOT_PATH . $v['stores_img']);
							}
						}
					}

					$sql = 'DELETE FROM' . $ecs->table('offline_store') . ' WHERE id' . db_create_in($checkboxes);

					if ($db->query($sql) == true) {
						$link[] = array('text' => $_LANG['back_list'], 'href' => 'offline_store.php?act=list&' . list_link_postfix());
						sys_msg($_LANG['delete_succeed'], 0, $link);
					}
				}
				else {
					$link[] = array('text' => $_LANG['back_list'], 'href' => 'offline_store.php?act=list&' . list_link_postfix());
					sys_msg($_LANG['delete_fail'], 0, $link);
				}
			}
		}
		else if ($_REQUEST['act'] == 'stat') {
			admin_priv('offline_store');
			$smarty->assign('ur_here', $_LANG['sale_stat']);
			$type = $_REQUEST['type'] && $_REQUEST['type'] == 1 ? 1 : 0;
			$href = $type ? 'offline_store.php?act=list&type=' . $type : 'offline_store.php?act=list';
			$smarty->assign('type', $type);
			$smarty->assign('action_link', array('text' => $_LANG['12_offline_store'], 'href' => $href));
			$smarty->assign('start_date', local_date('Y-m-d', $start_date));
			$smarty->assign('end_date', local_date('Y-m-d', $end_date));
			$smarty->display('offline_store_stat.dwt');
		}
		else if ($_REQUEST['act'] == 'stat_filter') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$result = array('error' => 0, 'message' => '', 'content' => '');
			$json = new JSON();
			$res = stat_filter();
			$result['order_num'] = $res['order_num'];
			$result['total_fee'] = $res['total_fee'];
			$smarty->assign('goods_list', $res['goods_list']);
			$result['content'] = $smarty->fetch('templates/library/offline_store_stat_filter.lbi');
			exit(json_encode($result));
		}
	}
}

?>
