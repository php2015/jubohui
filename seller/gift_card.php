<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
function get_type_list($ru_id)
{
	$sql = 'SELECT gift_id, COUNT(*) AS sent_count' . ' FROM ' . $GLOBALS['ecs']->table('gift_gard_type') . ' GROUP BY gift_id';
	$res = $GLOBALS['db']->query($sql);
	$sent_arr = array();

	while ($row = $GLOBALS['db']->fetchRow($res)) {
		$sent_arr[$row['gift_id']] = $row['sent_count'];
	}

	$result = get_filter();

	if ($result === false) {
		$filter['keyword'] = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
		if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1) {
			$filter['keyword'] = json_str_iconv($filter['keyword']);
		}

		$filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'gift_id' : trim($_REQUEST['sort_by']);
		$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
		$where = ' WHERE 1 ';

		if ($ru_id) {
			$where .= ' AND ru_id = \'' . $ru_id . '\'';
		}

		$where .= !empty($filter['keyword']) ? ' AND (ggt.gift_name LIKE \'%' . mysql_like_quote($filter['keyword']) . '%\')' : '';
		$filter['store_search'] = !isset($_REQUEST['store_search']) ? -1 : intval($_REQUEST['store_search']);
		$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
		$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';
		$store_where = '';
		$store_search_where = '';

		if (-1 < $filter['store_search']) {
			if ($ru_id == 0) {
				if (0 < $filter['store_search']) {
					if ($_REQUEST['store_type']) {
						$store_search_where = 'AND msi.shopNameSuffix = \'' . $_REQUEST['store_type'] . '\'';
					}

					if ($filter['store_search'] == 1) {
						$where .= ' AND ggt.ru_id = \'' . $filter['merchant_id'] . '\' ';
					}
					else if ($filter['store_search'] == 2) {
						$store_where .= ' AND msi.rz_shopName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\'';
					}
					else if ($filter['store_search'] == 3) {
						$store_where .= ' AND msi.shoprz_brandName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\' ' . $store_search_where;
					}

					if (1 < $filter['store_search']) {
						$where .= ' AND (SELECT msi.user_id FROM ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' as msi ' . (' WHERE msi.user_id = ggt.ru_id ' . $store_where . ') > 0 ');
					}
				}
				else {
					$where .= ' AND ggt.ru_id = 0';
				}
			}
		}

		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('gift_gard_type') . ' AS ggt' . $where;
		$filter['record_count'] = $GLOBALS['db']->getOne($sql);
		$filter = page_and_size($filter);
		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('gift_gard_type') . ' AS ggt' . (' ' . $where . ' ORDER BY ' . $filter['sort_by'] . ' ' . $filter['sort_order']);
		set_filter($filter, $sql);
	}
	else {
		$sql = $result['sql'];
		$filter = $result['filter'];
	}

	$arr = array();
	$res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

	while ($row = $GLOBALS['db']->fetchRow($res)) {
		$row['send_by'] = $GLOBALS['_LANG']['send_by'][$row['send_type']];
		$row['send_count'] = isset($sent_arr[$row['type_id']]) ? $sent_arr[$row['type_id']] : 0;
		$row['shop_name'] = get_shop_name($row['ru_id'], 1);
		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . (' WHERE gift_id=' . $row['gift_id']);
		$row['gift_count'] = $GLOBALS['db']->getOne($sql);
		$row['effective_date'] = local_date($GLOBALS['_CFG']['time_format'], $row['gift_start_date']) . '--' . local_date($GLOBALS['_CFG']['time_format'], $row['gift_end_date']);
		$arr[] = $row;
	}

	$arr = array('item' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}

function get_bonus_goods($type_id)
{
	$type_arr = $GLOBALS['db']->getRow('SELECT config_goods_id FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $type_id . '\''));
	$sql = 'SELECT goods_id, goods_name FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE goods_id ' . db_create_in($type_arr[config_goods_id]);
	$row = $GLOBALS['db']->getAll($sql);
	return $row;
}

function get_bonus_list($ru_id)
{
	$filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
	if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1) {
		$filter['keywords'] = json_str_iconv($filter['keywords']);

		if (!empty($filter['keywords'])) {
			$srarch_where = ' AND ub.gift_sn=\'' . $filter['keywords'] . '\' OR ub.address=\'' . $filter['keywords'] . '\' OR ub.mobile=\'' . $filter['keywords'] . '\' OR ub.consignee_name=\'' . $filter['keywords'] . '\'';
			$srarch_where2 = ' AND ub.gift_sn=\'' . $filter['keywords'] . '\' OR ub.address LIKE ' . ('\'%' . $filter['keywords'] . '%\'') . (' OR ub.mobile=\'' . $filter['keywords'] . '\' OR ub.consignee_name=\'' . $filter['keywords'] . '\'');
		}
		else {
			$srarch_where = '';
			$srarch_where2 = '';
		}
	}

	$where = ' WHERE 1 ';
	$filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'ub.user_time' : trim($_REQUEST['sort_by']);
	$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
	$filter['bonus_type'] = empty($_REQUEST['bonus_type']) ? 0 : intval($_REQUEST['bonus_type']);
	$where_count = empty($filter['bonus_type']) ? '' : ' AND ub.gift_id=\'' . $filter['bonus_type'] . '\'';
	$where .= empty($filter['bonus_type']) ? '' : ' AND ub.gift_id=\'' . $filter['bonus_type'] . '\'';
	if ($_REQUEST['act'] == 'bonus_list' || $_REQUEST['act'] == 'query_bonus' || $_REQUEST['act'] == 'export_gift_gard') {
		$delete_where = ' AND ub.is_delete = 1';
		$delete_where2 = ' AND ub.is_delete = 1';
		$filter['sort_by'] = 'ub.gift_gard_id';
	}

	if (empty($_REQUEST['bonus_type'])) {
		$where .= ' AND ub.status > 0';
	}

	if ($ru_id) {
		$where .= ' AND bt.ru_id = \'' . $ru_id . '\'';
	}

	$filter['store_search'] = !isset($_REQUEST['store_search']) ? -1 : intval($_REQUEST['store_search']);
	$filter['merchant_id'] = isset($_REQUEST['merchant_id']) ? intval($_REQUEST['merchant_id']) : 0;
	$filter['store_keyword'] = isset($_REQUEST['store_keyword']) ? trim($_REQUEST['store_keyword']) : '';
	$store_where = '';
	$store_search_where = '';

	if (-1 < $filter['store_search']) {
		if ($ru_id == 0) {
			if (0 < $filter['store_search']) {
				if ($_REQUEST['store_type']) {
					$store_search_where = 'AND msi.shopNameSuffix = \'' . $_REQUEST['store_type'] . '\'';
				}

				if ($filter['store_search'] == 1) {
					$where .= ' AND bt.ru_id = \'' . $filter['merchant_id'] . '\' ';
				}
				else if ($filter['store_search'] == 2) {
					$store_where .= ' AND msi.rz_shopName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\'';
				}
				else if ($filter['store_search'] == 3) {
					$store_where .= ' AND msi.shoprz_brandName LIKE \'%' . mysql_like_quote($filter['store_keyword']) . '%\' ' . $store_search_where;
				}

				if (1 < $filter['store_search']) {
					$where .= ' AND (SELECT msi.user_id FROM ' . $GLOBALS['ecs']->table('merchants_shop_information') . ' as msi ' . (' WHERE msi.ru_id = bt.ru_id ' . $store_where . ') > 0 ');
				}
			}
			else {
				$where .= ' AND bt.ru_id = 0';
			}
		}
	}

	$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . ' AS ub' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('gift_gard_type') . ' AS bt ON ub.gift_id = bt.gift_id' . $where . $where_count . $delete_where . $srarch_where;
	$filter['record_count'] = $GLOBALS['db']->getOne($sql);
	$filter = page_and_size($filter);
	if ($_REQUEST['act'] == 'export_gift_gard' || $_REQUEST['act'] == 'take_excel') {
		$filter['sort_by'] = 'gift_gard_id';
		$filter[page_size] = $filter['record_count'];
	}

	$sql = 'SELECT ub.*, bt.ru_id, u.user_name, u.email, o.goods_name, bt.gift_name, bt.gift_menory ' . ' FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . ' AS ub ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('gift_gard_type') . ' AS bt ON bt.gift_id=ub.gift_id ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ON u.user_id=ub.user_id ' . ' LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . (' AS o ON o.goods_id=ub.goods_id ' . $where . ' ' . $delete_where2 . ' ' . $srarch_where2 . ' ') . ' ORDER BY ' . $filter['sort_by'] . ' ' . $filter['sort_order'] . ' LIMIT ' . $filter['start'] . (', ' . $filter['page_size']);
	$row = $GLOBALS['db']->getAll($sql);

	foreach ($row as $key => $val) {
		$row[$key]['emailed'] = $GLOBALS['_LANG']['mail_status'][$row[$key]['emailed']];

		if (!empty($val['user_time'])) {
			$row[$key]['user_time'] = local_date($GLOBALS['_CFG']['time_format'], $val['user_time']);
		}
		else {
			$row[$key]['user_time'] = '';
		}

		$row[$key]['shop_name'] = get_shop_name($val['ru_id'], 1);
	}

	$arr = array('item' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}

function bonus_type_info($bonus_type_id)
{
	$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('gift_gard_type') . (' WHERE gift_id = \'' . $bonus_type_id . '\'');
	return $GLOBALS['db']->getRow($sql);
}

function send_bonus_mail($bonus_type_id, $bonus_id_list)
{
	$bonus_type = bonus_type_info($bonus_type_id);

	if ($bonus_type['send_type'] != SEND_BY_USER) {
		return 0;
	}

	$sql = 'SELECT b.bonus_id, u.user_name, u.email ' . 'FROM ' . $GLOBALS['ecs']->table('user_bonus') . ' AS b, ' . $GLOBALS['ecs']->table('users') . ' AS u ' . ' WHERE b.user_id = u.user_id ' . ' AND b.bonus_id ' . db_create_in($bonus_id_list) . ' AND b.order_id = 0 ' . ' AND u.email <> \'\'';
	$bonus_list = $GLOBALS['db']->getAll($sql);

	if (empty($bonus_list)) {
		return 0;
	}

	$send_count = 0;
	$tpl = get_mail_template('send_bonus');
	$today = local_date($GLOBALS['_CFG']['date_format']);

	foreach ($bonus_list as $bonus) {
		$GLOBALS['smarty']->assign('user_name', $bonus['user_name']);
		$GLOBALS['smarty']->assign('shop_name', $GLOBALS['_CFG']['shop_name']);
		$GLOBALS['smarty']->assign('send_date', $today);
		$GLOBALS['smarty']->assign('sent_date', $today);
		$GLOBALS['smarty']->assign('count', 1);
		$GLOBALS['smarty']->assign('money', price_format($bonus_type['type_money']));
		$content = $GLOBALS['smarty']->fetch('str:' . $tpl['template_content']);

		if (add_to_maillist($bonus['user_name'], $bonus['email'], $tpl['template_subject'], $content, $tpl['is_html'], false)) {
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('user_bonus') . ' SET emailed = \'' . BONUS_MAIL_SUCCEED . '\'' . (' WHERE bonus_id = \'' . $bonus['bonus_id'] . '\'');
			$GLOBALS['db']->query($sql);
			$send_count++;
		}
		else {
			$sql = 'UPDATE ' . $GLOBALS['ecs']->table('user_bonus') . ' SET emailed = \'' . BONUS_MAIL_FAIL . '\'' . (' WHERE bonus_id = \'' . $bonus['bonus_id'] . '\'');
			$GLOBALS['db']->query($sql);
		}
	}

	return $send_count;
}

function add_to_maillist($username, $email, $subject, $content, $is_html)
{
	$time = time();
	$content = addslashes($content);
	$template_id = $GLOBALS['db']->getOne('SELECT template_id FROM ' . $GLOBALS['ecs']->table('mail_templates') . ' WHERE template_code = \'send_bonus\'');
	$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('email_sendlist') . (' ( email, template_id, email_content, pri, last_send) VALUES (\'' . $email . '\', ' . $template_id . ', \'' . $content . '\', 1, \'' . $time . '\')');
	$GLOBALS['db']->query($sql);
	return true;
}

function generate_password($length = 6)
{
	$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
	$password = '';

	for ($i = 0; $i < $length; $i++) {
		$password .= $chars[mt_rand(0, strlen($chars) - 1)];
	}

	if ($GLOBALS['db']->getOne('SELECT * FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . (' WHERE gift_password=\'' . $password . '\''))) {
		$password = generate_password(6);
	}
	else {
		return $password;
	}
}

function get_gift_gard_log($id = 0)
{
	$result = get_filter();

	if ($result === false) {
		if (0 < $id) {
			$filter['id'] = $id;
		}

		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('gift_gard_log') . ' WHERE gift_gard_id = \'' . $filter['id'] . '\' AND handle_type=\'gift_gard\'';
		$filter['record_count'] = $GLOBALS['db']->getOne($sql);
		$filter = page_and_size($filter);
		$sql = 'SELECT a.id,a.addtime,b.user_name,a.delivery_status,a.gift_gard_id FROM' . $GLOBALS['ecs']->table('gift_gard_log') . ' AS a LEFT JOIN ' . $GLOBALS['ecs']->table('admin_user') . ' AS b ON a.admin_id = b.user_id WHERE a.gift_gard_id = \'' . $filter['id'] . '\' AND a.handle_type=\'gift_gard\'  ORDER BY a.addtime DESC LIMIT ' . $filter['start'] . ',' . $filter['page_size'];
		set_filter($filter, $sql);
	}
	else {
		$sql = $result['sql'];
		$filter = $result['filter'];
	}

	$row = $GLOBALS['db']->getAll($sql);

	foreach ($row as $k => $v) {
		if (0 < $v['addtime']) {
			$row[$k]['add_time'] = date('Y-m-d  H:i:s', $v['addtime']);
		}

		if ($v['delivery_status'] == 1) {
			$row[$k]['delivery_status'] = $GLOBALS['_LANG']['status_ship_no'];
		}
		else if ($v['delivery_status'] == 2) {
			$row[$k]['delivery_status'] = $GLOBALS['_LANG']['status_ship_ok'];
		}

		if ($v['gift_gard_id']) {
			$row[$k]['gift_sn'] = $GLOBALS['db']->getOne(' SELECT gift_sn FROM ' . $GLOBALS['ecs']->table('user_gift_gard') . ' WHERE gift_gard_id = \'' . $v['gift_gard_id'] . '\'');
		}
	}

	$arr = array('pzd_list' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
	return $arr;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';

if (empty($_REQUEST['act'])) {
	$_REQUEST['act'] = 'list';
}
else {
	$_REQUEST['act'] = trim($_REQUEST['act']);
}

$smarty->assign('menus', $_SESSION['menus']);
$smarty->assign('action_type', 'bonus');
$adminru = get_admin_ru_id();

if ($adminru['ru_id'] == 0) {
	$smarty->assign('priv_ru', 1);
}
else {
	$smarty->assign('priv_ru', 0);
}

$exc = new exchange($ecs->table('gift_gard_type'), $db, 'gift_id', 'gift_name');
$cat_id = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);

if ($_REQUEST['act'] == 'list') {
	$smarty->assign('controller', 'card_list');
	$smarty->assign('ur_here', $_LANG['gift_gard_type_list']);
	$smarty->assign('action_link', array('text' => $_LANG['gift_gard_type_add'], 'href' => 'gift_gard.php?act=add'));
	$smarty->assign('full_page', 1);
	$store_list = get_common_store_list();
	$smarty->assign('store_list', $store_list);
	$list = get_type_list($adminru['ru_id']);
	$smarty->assign('type_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	assign_query_info();
	$smarty->display('gift_gard_list.dwt');
}

if ($_REQUEST['act'] == 'query') {
	$list = get_type_list($adminru['ru_id']);
	$smarty->assign('type_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('gift_gard_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}

if ($_REQUEST['act'] == 'edit_type_name') {
	check_authz_json('gift_gard_manage');
	$id = intval($_POST['id']);
	$val = json_str_iconv(trim($_POST['val']));

	if (!$exc->is_only('gift_name', $id, $val)) {
		make_json_error($_LANG['type_name_exist']);
	}
	else {
		$exc->edit('gift_name=\'' . $val . '\'', $id);
		make_json_result(stripslashes($val));
	}
}

if ($_REQUEST['act'] == 'edit_type_money') {
	check_authz_json('gift_gard_manage');
	$id = intval($_POST['id']);
	$val = floatval($_POST['val']);
	$sql = 'UPDATE ' . $ecs->table('user_gift_gard') . (' SET express_no=\'' . $val . '\' WHERE gift_gard_id=\'' . $id . '\'');
	$up_id = $db->query($sql);
	make_json_result(stripslashes($val));
}

if ($_REQUEST['act'] == 'confirm_ship') {
	check_authz_json('gift_gard_manage');
	$id = intval($_GET['id']);
	$val = floatval($_GET['val']);

	if (!empty($id)) {
		if ($db->getOne('SELECT COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE status = \'3\' AND gift_gard_id=\'' . $id . '\''))) {
		}
		else if ($db->getOne('SELECT COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE status = \'1\' AND gift_gard_id=\'' . $id . '\''))) {
			$sql = 'UPDATE ' . $ecs->table('user_gift_gard') . (' SET status=\'2\' WHERE gift_gard_id=\'' . $id . '\'');
			$db->query($sql);
			$val = 2;
		}
		else if ($db->getOne('SELECT COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE status = \'2\' AND gift_gard_id=\'' . $id . '\''))) {
			$sql = 'UPDATE ' . $ecs->table('user_gift_gard') . (' SET status=\'1\' WHERE gift_gard_id=\'' . $id . '\'');
			$db->query($sql);
			$val = 1;
		}
		else {
			make_json_error($_LANG['delivery_fail']);
		}
	}
	else {
		make_json_error($_LANG['order_not_exist']);
	}

	if ($val) {
		$db->query(' INSERT INTO' . $ecs->table('gift_gard_log') . ' (`admin_id`,`gift_gard_id`,`delivery_status`,`addtime`,`handle_type`) VALUES (\'' . $_SESSION['seller_id'] . ('\',\'' . $id . '\',\'' . $val . '\',\'') . time() . '\',\'gift_gard\')');
	}

	$url = 'gift_gard.php?act=query_take&' . str_replace('act=confirm_ship', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}

if ($_REQUEST['act'] == 'handle_log') {
	admin_priv('gift_gard_manage');
	$smarty->assign('ur_here', $_LANG['handle_log']);
	$smarty->assign('action_link', array('text' => $_LANG['take_list'], 'href' => 'gift_gard.php?act=take_list'));
	$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
	$gift_gard_log = get_gift_gard_log($id);
	$smarty->assign('full_page', 1);
	$smarty->assign('gift_gard_log', $gift_gard_log['pzd_list']);
	$smarty->assign('filter', $gift_gard_log['filter']);
	$smarty->assign('record_count', $gift_gard_log['record_count']);
	$smarty->assign('page_count', $gift_gard_log['page_count']);
	$smarty->display('gift_gard_log.htm');
}

if ($_REQUEST['act'] == 'Ajax_handle_log') {
	$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
	$gift_gard_log = get_gift_gard_log($id);
	$smarty->assign('gift_gard_log', $gift_gard_log['pzd_list']);
	$smarty->assign('filter', $gift_gard_log['filter']);
	$smarty->assign('record_count', $gift_gard_log['record_count']);
	$smarty->assign('page_count', $gift_gard_log['page_count']);
	make_json_result($smarty->fetch('gift_gard_log.htm'), '', array('filter' => $gift_gard_log['filter'], 'page_count' => $gift_gard_log['page_count']));
}

if ($_REQUEST['act'] == 'edit_min_amount') {
	check_authz_json('gift_gard_manage');
	$id = intval($_POST['id']);
	$val = floatval($_POST['val']);

	if ($val < 0) {
		make_json_error($_LANG['min_amount_empty']);
	}
	else {
		$exc->edit('min_amount=\'' . $val . '\'', $id);
		make_json_result(number_format($val, 2));
	}
}

if ($_REQUEST['act'] == 'remove') {
	check_authz_json('gift_gard_manage');
	$id = intval($_GET['id']);
	$exc->drop($id);
	$db->query('DELETE FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_id = \'' . $id . '\''));
	$url = 'gift_gard.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}

if ($_REQUEST['act'] == 'add') {
	admin_priv('gift_gard_manage');
	$smarty->assign('controller', 'card_add');
	$smarty->assign('lang', $_LANG);
	$smarty->assign('ur_here', $_LANG['gift_gard_type_add']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=list', 'text' => $_LANG['gift_gard_type_list']));
	$smarty->assign('action', 'add');
	$smarty->assign('form_act', 'insert');
	$smarty->assign('cfg_lang', $_CFG['lang']);
	$smarty->assign('cat_list', cat_list($cat_id));
	$smarty->assign('brand_list', get_brand_list());
	$next_month = local_strtotime('+1 months');
	$bonus_arr['send_start_date'] = local_date($GLOBALS['_CFG']['time_format']);
	$bonus_arr['use_start_date'] = local_date($GLOBALS['_CFG']['time_format']);
	$bonus_arr['send_end_date'] = local_date($GLOBALS['_CFG']['time_format'], $next_month);
	$bonus_arr['use_end_date'] = local_date($GLOBALS['_CFG']['time_format'], $next_month);
	$smarty->assign('bonus_arr', $bonus_arr);
	assign_query_info();
	$smarty->display('gift_gard_info.dwt');
}

if ($_REQUEST['act'] == 'gift_add') {
	admin_priv('gift_gard_manage');
	$gift_id = $_GET['bonus_type'];
	$smarty->assign('lang', $_LANG);
	$smarty->assign('ur_here', $_LANG['gift_gard_add']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=bonus_list&bonus_type=' . $gift_id, 'text' => $_LANG['gift_gard_list']));
	$smarty->assign('action', 'add');
	$smarty->assign('form_act', 'gift_insert');
	$smarty->assign('cfg_lang', $_CFG['lang']);
	$smarty->assign('cat_list', cat_list($cat_id));
	$smarty->assign('brand_list', get_brand_list());
	$smarty->assign('gift_id', $gift_id);
	assign_query_info();
	$smarty->display('gift_info.htm');
}

if ($_REQUEST['act'] == 'gift_insert') {
	$gift_sn = !empty($_POST['gift_sn']) ? trim($_POST['gift_sn']) : '';
	$gift_pwd = !empty($_POST['gift_pwd']) ? trim($_POST['gift_pwd']) : '';
	$gift_id = !empty($_POST['type_id']) ? trim($_POST['type_id']) : '0';
	$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_sn=\'' . $gift_sn . '\'');

	if (0 < $db->getOne($sql)) {
		$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
		sys_msg($_LANG['gift_name_exist'], 0, $link);
	}

	$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_password=\'' . $gift_pwd . '\'');

	if (0 < $db->getOne($sql)) {
		$link[0] = array('text' => $_LANG['back_readd'], 'href' => 'javascript:history.back(-1)');
		sys_msg($_LANG['gift_pwd_exist'], 0, $link);
	}

	$sql = 'INSERT INTO ' . $ecs->table('user_gift_gard') . (" (gift_sn, gift_password,gift_id)\r\n\tVALUES ('" . $gift_sn . "',\r\n\t'" . $gift_pwd . "',\r\n\t'" . $gift_id . '\')');
	$db->query($sql);
	admin_log($_POST['gift_sn'], 'add', 'giftgardtype');
	clear_cache_files();
	$link[0]['text'] = $_LANG['back_continue_add'];
	$link[0]['href'] = 'gift_gard.php?act=gift_add&bonus_type=' . $gift_id;
	$link[1]['text'] = $_LANG['gift_card_list_page'];
	$link[1]['href'] = 'gift_gard.php?act=bonus_list&bonus_type=' . $gift_id;
	sys_msg($_LANG['add'] . '&nbsp;' . $_POST['gift_sn'] . '&nbsp;' . $_LANG['attradd_succed'], 0, $link);
}

if ($_REQUEST['act'] == 'insert') {
	$type_name = !empty($_POST['type_name']) ? trim($_POST['type_name']) : '';
	$gift_number = !empty($_POST['gift_number']) ? trim($_POST['gift_number']) : '';
	$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('gift_gard_type') . (' WHERE gift_name=\'' . $type_name . '\'');

	if (0 < $db->getOne($sql)) {
		$link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
		sys_msg($_LANG['type_name_exist'], 0, $link);
	}

	$gift_startdate = local_strtotime($_POST['use_start_date']);
	$gift_enddate = local_strtotime($_POST['use_end_date']);
	$sql = 'INSERT INTO ' . $ecs->table('gift_gard_type') . " (ru_id, gift_name, gift_menory,gift_start_date,gift_end_date, gift_number)\r\n    VALUES ('" . $adminru['ru_id'] . ("',\r\n            '" . $type_name . "',\r\n            '" . $_POST['type_money'] . "',\r\n            '" . $gift_startdate . "',\r\n            '" . $gift_enddate . '\', \'' . $gift_number . '\')');
	$db->query($sql);
	$gift_id = $db->insert_id();
	$num = $db->getOne('SELECT MAX(gift_sn) FROM ' . $ecs->table('user_gift_gard'));
	$num = $num ? floor($num / 1) : 8000000;
	$i = 0;

	for ($j = 0; $i < $gift_number; $i++) {
		$gift_sn = $num + $i;
		$gift_pwd = generate_password(6);
		$db->query('INSERT INTO ' . $ecs->table('user_gift_gard') . (' (gift_sn, gift_password, gift_id) VALUES(\'' . $gift_sn . '\', \'' . $gift_pwd . '\', \'' . $gift_id . '\')'));
		$j++;
	}

	admin_log($_POST['type_name'], 'add', 'giftgardtype');
	clear_cache_files();
	$link[0]['text'] = $_LANG['back_continue_add'];
	$link[0]['href'] = 'gift_gard.php?act=add';
	$link[1]['text'] = $_LANG['gift_gard_list'];
	$link[1]['href'] = 'gift_gard.php?act=list';
	sys_msg($_LANG['add'] . '&nbsp;' . $_POST['type_name'] . '&nbsp;' . $_LANG['attradd_succed'], 0, $link);
}

if ($_REQUEST['act'] == 'edit') {
	admin_priv('gift_gard_manage');
	$type_id = !empty($_GET['type_id']) ? intval($_GET['type_id']) : 0;
	$bonus_arr = $db->getRow('SELECT * FROM ' . $ecs->table('gift_gard_type') . (' WHERE gift_id = \'' . $type_id . '\''));
	$bonus_arr['use_start_date'] = local_date($GLOBALS['_CFG']['time_format'], $bonus_arr['gift_start_date']);
	$bonus_arr['use_end_date'] = local_date($GLOBALS['_CFG']['time_format'], $bonus_arr['gift_end_date']);
	$smarty->assign('lang', $_LANG);
	$smarty->assign('ur_here', $_LANG['edit_gift_card_type']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=list&' . list_link_postfix(), 'text' => $_LANG['gift_gard_type_list']));
	$smarty->assign('form_act', 'update');
	$smarty->assign('bonus_arr', $bonus_arr);
	assign_query_info();
	$smarty->display('gift_gard_info.htm');
}

if ($_REQUEST['act'] == 'update') {
	$use_startdate = local_strtotime($_POST['use_start_date']);
	$use_enddate = local_strtotime($_POST['use_end_date']);
	$type_name = !empty($_POST['type_name']) ? trim($_POST['type_name']) : '';
	$type_id = !empty($_POST['type_id']) ? intval($_POST['type_id']) : 0;
	$gift_number = !empty($_POST['gift_number']) ? intval($_POST['gift_number']) : 0;
	$sql = 'UPDATE ' . $ecs->table('gift_gard_type') . ' SET ' . ('gift_name       = \'' . $type_name . '\', ') . ('gift_menory      = \'' . $_POST['type_money'] . '\', ') . ('gift_start_date  = \'' . $use_startdate . '\', ') . ('gift_end_date    = \'' . $use_enddate . '\' ') . ('WHERE gift_id   = \'' . $type_id . '\'');
	$db->query($sql);
	$num = $db->getOne('SELECT MAX(gift_sn) FROM ' . $ecs->table('user_gift_gard'));
	$num = $num ? floor($num / 1) : 8000000;
	$i = 0;

	for ($j = 0; $i < $gift_number; $i++) {
		$gift_sn = $num + $i;
		$gift_pwd = generate_password(6);
		$db->query('INSERT INTO ' . $ecs->table('user_gift_gard') . (' (gift_sn, gift_password, gift_id) VALUES(\'' . $gift_sn . '\', \'' . $gift_pwd . '\', \'' . $type_id . '\')'));
		$j++;
	}

	admin_log($_POST['type_name'], 'edit', 'giftgrad');
	clear_cache_files();
	$link[] = array('text' => $_LANG['gift_card_list_page'], 'href' => 'gift_gard.php?act=list&' . list_link_postfix());
	sys_msg($_LANG['edit'] . ' ' . $_POST['type_name'] . ' ' . $_LANG['attradd_succed'], 0, $link);
}

if ($_REQUEST['act'] == 'send') {
	admin_priv('gift_gard_manage');
	$id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : '';
	assign_query_info();
	$smarty->assign('ur_here', $_LANG['config_goods']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=list', 'text' => $_LANG['gift_gard_type_list']));
	$bonus_type = $db->GetRow('SELECT gift_id, gift_name FROM ' . $ecs->table('gift_gard_type') . (' WHERE gift_id=\'' . $_REQUEST['id'] . '\''));
	$goods_list = get_bonus_goods($_REQUEST['id']);
	$sql = 'SELECT goods_id FROM ' . $ecs->table('goods') . (' WHERE bonus_type_id > 0 AND bonus_type_id <> \'' . $_REQUEST['id'] . '\'');
	$other_goods_list = $db->getCol($sql);
	$smarty->assign('other_goods', join(',', $other_goods_list));
	$smarty->assign('cat_list', cat_list());
	$smarty->assign('brand_list', get_brand_list());
	$smarty->assign('bonus_type', $bonus_type);
	$smarty->assign('goods_list', $goods_list);
	$smarty->display('gift_gard_by_goods.htm');
}

if ($_REQUEST['act'] == 'send_by_user') {
	$user_list = array();
	$start = empty($_REQUEST['start']) ? 0 : intval($_REQUEST['start']);
	$limit = empty($_REQUEST['limit']) ? 10 : intval($_REQUEST['limit']);
	$validated_email = empty($_REQUEST['validated_email']) ? 0 : intval($_REQUEST['validated_email']);
	$send_count = 0;

	if (isset($_REQUEST['send_rank'])) {
		$rank_id = intval($_REQUEST['rank_id']);

		if (0 < $rank_id) {
			$sql = 'SELECT min_points, max_points, special_rank FROM ' . $ecs->table('user_rank') . (' WHERE rank_id = \'' . $rank_id . '\'');
			$row = $db->getRow($sql);

			if ($row['special_rank']) {
				$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('users') . (' WHERE user_rank = \'' . $rank_id . '\'');
				$send_count = $db->getOne($sql);

				if ($validated_email) {
					$sql = 'SELECT user_id, email, user_name FROM ' . $ecs->table('users') . (' WHERE user_rank = \'' . $rank_id . '\' AND is_validated = 1') . (' LIMIT ' . $start . ', ' . $limit);
				}
				else {
					$sql = 'SELECT user_id, email, user_name FROM ' . $ecs->table('users') . (' WHERE user_rank = \'' . $rank_id . '\'') . (' LIMIT ' . $start . ', ' . $limit);
				}
			}
			else {
				$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('users') . ' WHERE rank_points >= ' . intval($row['min_points']) . ' AND rank_points < ' . intval($row['max_points']);
				$send_count = $db->getOne($sql);

				if ($validated_email) {
					$sql = 'SELECT user_id, email, user_name FROM ' . $ecs->table('users') . ' WHERE rank_points >= ' . intval($row['min_points']) . ' AND rank_points < ' . intval($row['max_points']) . (' AND is_validated = 1 LIMIT ' . $start . ', ' . $limit);
				}
				else {
					$sql = 'SELECT user_id, email, user_name FROM ' . $ecs->table('users') . ' WHERE rank_points >= ' . intval($row['min_points']) . ' AND rank_points < ' . intval($row['max_points']) . (' LIMIT ' . $start . ', ' . $limit);
				}
			}

			$user_list = $db->getAll($sql);
			$count = count($user_list);
		}
	}
	else if (isset($_REQUEST['send_user'])) {
		if (empty($_REQUEST['user'])) {
			sys_msg($_LANG['send_user_empty'], 1);
		}

		$user_array = is_array($_REQUEST['user']) ? $_REQUEST['user'] : explode(',', $_REQUEST['user']);
		$send_count = count($user_array);
		$id_array = array_slice($user_array, $start, $limit);
		$sql = 'SELECT user_id, email, user_name FROM ' . $ecs->table('users') . ' WHERE user_id ' . db_create_in($id_array);
		$user_list = $db->getAll($sql);
		$count = count($user_list);
	}

	$loop = 0;
	$bonus_type = bonus_type_info($_REQUEST['id']);
	$tpl = get_mail_template('send_bonus');
	$today = local_date($_CFG['date_format']);

	foreach ($user_list as $key => $val) {
		$smarty->assign('user_name', $val['user_name']);
		$smarty->assign('shop_name', $GLOBALS['_CFG']['shop_name']);
		$smarty->assign('send_date', $today);
		$smarty->assign('sent_date', $today);
		$smarty->assign('count', 1);
		$smarty->assign('money', price_format($bonus_type['type_money']));
		$content = $smarty->fetch('str:' . $tpl['template_content']);

		if (add_to_maillist($val['user_name'], $val['email'], $tpl['template_subject'], $content, $tpl['is_html'])) {
			$sql = 'INSERT INTO ' . $ecs->table('user_bonus') . '(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed) ' . ('VALUES (\'' . $_REQUEST['id'] . '\', 0, \'' . $val['user_id'] . '\', 0, 0, ') . BONUS_MAIL_SUCCEED . ')';
			$db->query($sql);
		}
		else {
			$sql = 'INSERT INTO ' . $ecs->table('user_bonus') . '(bonus_type_id, bonus_sn, user_id, used_time, order_id, emailed) ' . ('VALUES (\'' . $_REQUEST['id'] . '\', 0, \'' . $val['user_id'] . '\', 0, 0, ') . BONUS_MAIL_FAIL . ')';
			$db->query($sql);
		}

		if ($limit <= $loop) {
			break;
		}
		else {
			$loop++;
		}
	}

	if ($start + $limit < $send_count) {
		$href = 'bonus.php?act=send_by_user&start=' . ($start + $limit) . ('&limit=' . $limit . '&id=' . $_REQUEST['id'] . '&');

		if (isset($_REQUEST['send_rank'])) {
			$href .= 'send_rank=1&rank_id=' . $rank_id;
		}

		if (isset($_REQUEST['send_user'])) {
			$href .= 'send_user=1&user=' . implode(',', $user_array);
		}

		$link[] = array('text' => $_LANG['send_continue'], 'href' => $href);
	}

	$link[] = array('text' => $_LANG['back_list'], 'href' => 'bonus.php?act=list');
	sys_msg(sprintf($_LANG['sendbonus_count'], $count), 0, $link);
}

if ($_REQUEST['act'] == 'send_mail') {
	$bonus_id = intval($_REQUEST['bonus_id']);

	if ($bonus_id <= 0) {
		exit('invalid params');
	}

	include_once ROOT_PATH . 'includes/lib_order.php';
	$bonus = bonus_info($bonus_id);

	if (empty($bonus)) {
		sys_msg($_LANG['bonus_not_exist']);
	}

	$count = send_bonus_mail($bonus['bonus_type_id'], array($bonus_id));
	$link[0]['text'] = $_LANG['back_bonus_list'];
	$link[0]['href'] = 'bonus.php?act=bonus_list&bonus_type=' . $bonus['bonus_type_id'];
	sys_msg(sprintf($_LANG['success_send_mail'], $count), 0, $link);
}

if ($_REQUEST['act'] == 'send_by_print') {
	@set_time_limit(0);
	$bonus_typeid = !empty($_POST['bonus_type_id']) ? $_POST['bonus_type_id'] : 0;
	$bonus_sum = !empty($_POST['bonus_sum']) ? $_POST['bonus_sum'] : 1;
	$num = $db->getOne('SELECT MAX(bonus_sn) FROM ' . $ecs->table('user_bonus'));
	$num = $num ? floor($num / 10000) : 100000;
	$i = 0;

	for ($j = 0; $i < $bonus_sum; $i++) {
		$bonus_sn = $num + $i . str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
		$db->query('INSERT INTO ' . $ecs->table('user_bonus') . (' (bonus_type_id, bonus_sn) VALUES(\'' . $bonus_typeid . '\', \'' . $bonus_sn . '\')'));
		$j++;
	}

	admin_log($bonus_sn, 'add', 'userbonus');
	clear_cache_files();
	$link[0]['text'] = $_LANG['back_bonus_list'];
	$link[0]['href'] = 'bonus.php?act=bonus_list&bonus_type=' . $bonus_typeid;
	sys_msg($_LANG['creat_bonus'] . $j . $_LANG['creat_bonus_num'], 0, $link);
}

if ($_REQUEST['act'] == 'gen_excel') {
	@set_time_limit(0);
	$tid = !empty($_GET['tid']) ? intval($_GET['tid']) : 0;
	$type_name = $db->getOne('SELECT type_name FROM ' . $ecs->table('bonus_type') . (' WHERE type_id = \'' . $tid . '\''));
	$bonus_filename = $type_name . '_bonus_list';

	if (EC_CHARSET != 'gbk') {
		$bonus_filename = ecs_iconv('UTF8', 'GB2312', $bonus_filename);
	}

	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	header('Content-Disposition: attachment; filename=' . $bonus_filename . '.xls');

	if (EC_CHARSET != 'gbk') {
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['bonus_excel_file']) . "\t\n";
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['record_id']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['bonus_sn']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['address']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['consignee_name']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['mobile']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['gift_user_name']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['gift_goods_name']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['gift_user_time']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['confirm_ship']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['express_no']) . '	';
		echo ecs_iconv('UTF8', 'GB2312', $_LANG['status']) . "\t\n";
	}
	else {
		echo $_LANG['bonus_excel_file'] . "\t\n";
		echo $_LANG['record_id'] . '	';
		echo $_LANG['bonus_sn'] . '	';
		echo $_LANG['address'] . '	';
		echo $_LANG['consignee_name'] . '	';
		echo $_LANG['mobile'] . '	';
		echo $_LANG['gift_user_name'] . '	';
		echo $_LANG['gift_goods_name'] . '	';
		echo $_LANG['gift_user_time'] . '	';
		echo $_LANG['confirm_ship'] . '	';
		echo $_LANG['express_no'] . '	';
		echo $_LANG['status'] . "\t\n";
	}

	$val = array();
	$sql = 'SELECT ub.bonus_id, ub.bonus_type_id, ub.bonus_sn, bt.type_name, bt.type_money, bt.use_end_date ' . 'FROM ' . $ecs->table('user_bonus') . ' AS ub, ' . $ecs->table('bonus_type') . ' AS bt ' . ('WHERE bt.type_id = ub.bonus_type_id AND ub.bonus_type_id = \'' . $tid . '\' ORDER BY ub.bonus_id DESC');
	$res = $db->query($sql);
	$code_table = array();

	while ($val = $db->fetchRow($res)) {
		echo $val['bonus_sn'] . '	';
		echo $val['type_money'] . '	';

		if (!isset($code_table[$val['type_name']])) {
			if (EC_CHARSET != 'gbk') {
				$code_table[$val['type_name']] = ecs_iconv('UTF8', 'GB2312', $val['type_name']);
			}
			else {
				$code_table[$val['type_name']] = $val['type_name'];
			}
		}

		echo $code_table[$val['type_name']] . '	';
		echo local_date('Y-m-d', $val['use_end_date']);
		echo "\t\n";
	}
}

if ($_REQUEST['act'] == 'get_goods_list') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$filters = $json->decode($_GET['JSON']);
	$arr = get_goods_list($filters);
	$opt = array();

	foreach ($arr as $key => $val) {
		$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => $val['shop_price']);
	}

	make_json_result($opt);
}

if ($_REQUEST['act'] == 'add_bonus_goods') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	check_authz_json('gift_gard_manage');
	$add_ids = $json->decode($_GET['add_ids']);
	$args = $json->decode($_GET['JSON']);
	$type_id = explode(',', trim($args[0]));
	$add_ids_str = implode(',', $add_ids);

	foreach ($type_id as $key => $val) {
		$sql = 'SELECT config_goods_id FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $val . '\'');
		$config_goods = $db->getRow($sql);
		$add_ids_str .= ',' . $config_goods['config_goods_id'];
		$sql = 'UPDATE ' . $ecs->table('user_gift_gard') . (' SET config_goods_id=\'' . $add_ids_str . '\' WHERE gift_gard_id=\'' . $val . '\'');
		$db->query($sql, 'SILENT') || make_json_error($db->error());
	}

	$gift_gard_id = $type_id[0];
	$arr = get_bonus_goods($gift_gard_id);
	$opt = array();

	foreach ($arr as $key => $val) {
		$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
	}

	make_json_result($opt);
}

if ($_REQUEST['act'] == 'drop_bonus_goods') {
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	check_authz_json('gift_gard_manage');
	$drop_ids = $json->decode($_GET['drop_ids']);
	$args = $json->decode($_GET['JSON']);
	$type_id = explode(',', trim($args[0]));

	foreach ($type_id as $key => $val) {
		$sql = 'SELECT config_goods_id FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $val . '\'');
		$config_goods = $db->getRow($sql);
		$config_goods_arr = explode(',', $config_goods['config_goods_id']);
		$config_goods_id = array_diff($config_goods_arr, $drop_ids);
		$config_goods_id = implode(',', $config_goods_id);
		$db->query('UPDATE ' . $ecs->table('user_gift_gard') . (' SET config_goods_id=\'' . $config_goods_id . '\' WHERE gift_gard_id=\'' . $val . '\''));
	}

	$gift_gard_id = $type_id[0];
	$arr = get_bonus_goods($gift_gard_id);
	$opt = array();

	foreach ($arr as $key => $val) {
		$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
	}

	make_json_result($opt);
}

if ($_REQUEST['act'] == 'search_users') {
	$keywords = json_str_iconv(trim($_GET['keywords']));
	$sql = 'SELECT user_id, user_name FROM ' . $ecs->table('users') . ' WHERE user_name LIKE \'%' . mysql_like_quote($keywords) . '%\' OR user_id LIKE \'%' . mysql_like_quote($keywords) . '%\'';
	$row = $db->getAll($sql);
	make_json_result($row);
}

if ($_REQUEST['act'] == 'bonus_list') {
	$smarty->assign('full_page', 1);
	$smarty->assign('ur_here', $_LANG['gift_gard_list']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=list', 'text' => $_LANG['gift_gard_type_list']));
	$list = get_bonus_list($adminru['ru_id']);
	$bonus_type = bonus_type_info(intval($_REQUEST['bonus_type']));

	if ($bonus_type['send_type'] == SEND_BY_PRINT) {
		$smarty->assign('show_bonus_sn', 1);
	}
	else if ($bonus_type['send_type'] == SEND_BY_USER) {
		$smarty->assign('show_mail', 1);
	}

	$smarty->assign('bonus_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$smarty->assign('action_link2', array('href' => 'gift_gard.php?act=gift_add&bonus_type=' . $list['item'][0]['gift_id'], 'text' => $_LANG['gift_gard_add']));
	$smarty->assign('action_link3', array('href' => 'gift_gard.php?act=export_gift_gard&bonus_type=' . $list['item'][0]['gift_id'], 'text' => $_LANG['gift_gard_export']));
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	assign_query_info();
	$smarty->display('gift_list.htm');
}

if ($_REQUEST['act'] == 'take_list') {
	admin_priv('take_manage');
	$smarty->assign('full_page', 1);
	$smarty->assign('ur_here', $_LANG['gift_gard_list']);
	$smarty->assign('action_link', array('href' => 'gift_gard.php?act=take_excel', 'text' => $_LANG['11_order_export']));
	$store_list = get_common_store_list();
	$smarty->assign('store_list', $store_list);
	$list = get_bonus_list($adminru['ru_id']);
	$bonus_type = bonus_type_info(intval($_REQUEST['bonus_type']));

	if ($bonus_type['send_type'] == SEND_BY_PRINT) {
		$smarty->assign('show_bonus_sn', 1);
	}
	else if ($bonus_type['send_type'] == SEND_BY_USER) {
		$smarty->assign('show_mail', 1);
	}

	$smarty->assign('bonus_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	assign_query_info();
	$smarty->display('take_list.htm');
}

if ($_REQUEST['act'] == 'query_take') {
	$list = get_bonus_list($adminru['ru_id']);
	$smarty->assign('bonus_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('take_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}

if ($_REQUEST['act'] == 'query_bonus') {
	$list = get_bonus_list($adminru['ru_id']);
	$bonus_type = bonus_type_info(intval($_REQUEST['bonus_type']));

	if ($bonus_type['send_type'] == SEND_BY_PRINT) {
		$smarty->assign('show_bonus_sn', 1);
	}
	else if ($bonus_type['send_type'] == SEND_BY_USER) {
		$smarty->assign('show_mail', 1);
	}

	$smarty->assign('bonus_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('gift_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}

if ($_REQUEST['act'] == 'take_excel') {
	$file_name = $_LANG['pic_goods_completed_order'] . '_' . local_date('YmdHis', gmtime());
	$gift_gard_list = get_bonus_list($adminru['ru_id']);
	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	header('Content-Disposition: attachment; filename=' . $file_name . '.xls');
	echo ecs_iconv(EC_CHARSET, $file_name) . "\t\n";
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['record_id']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['gift_card_sn']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['address']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['consignee_name']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['mobile']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['gift_user_name']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['gift_goods_name']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['gift_user_time']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['express_no']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['status']) . "\t\n";

	foreach ($gift_gard_list['item'] as $key => $value) {
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_gard_id']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_sn']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['address']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['consignee_name']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['mobile']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['user_name']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['goods_name']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['user_time']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['express_no']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['transaction_tip_4']) . '	';
		echo "\n";
	}

	exit();
}

if ($_REQUEST['act'] == 'export_gift_gard') {
	$file_name = $_LANG['tab_general'] . '_' . local_date('YmdHis', gmtime());
	$gift_list = get_bonus_list($adminru['ru_id']);
	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	header('Content-Disposition: attachment; filename=' . $file_name . '.xls');
	echo ecs_iconv(EC_CHARSET, $file_name) . "\t\n";
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['record_id']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['card_number']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['password']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['money']) . '	';
	echo ecs_iconv(EC_CHARSET, 'GB2312', $_LANG['card_name']) . "\t\n";

	foreach ($gift_list['item'] as $key => $value) {
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_gard_id']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_sn']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_password']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_menory']) . '	';
		echo ecs_iconv(EC_CHARSET, 'GB2312', $value['gift_name']) . '	';
		echo "\n";
	}

	exit();
}

if ($_REQUEST['act'] == 'query_take') {
	$list = get_bonus_list($adminru['ru_id']);
	$bonus_type = bonus_type_info(intval($_REQsUEST['bonus_type']));

	if ($bonus_type['send_type'] == SEND_BY_PRINT) {
		$smarty->assign('show_bonus_sn', 1);
	}
	else if ($bonus_type['send_type'] == SEND_BY_USER) {
		$smarty->assign('show_mail', 1);
	}

	$smarty->assign('bonus_list', $list['item']);
	$smarty->assign('filter', $list['filter']);
	$smarty->assign('record_count', $list['record_count']);
	$smarty->assign('page_count', $list['page_count']);
	$sort_flag = sort_flag($list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('take_list.htm'), '', array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
else if ($_REQUEST['act'] == 'remove_bonus') {
	check_authz_json('gift_gard_manage');
	$id = intval($_GET['id']);
	$sql = 'SELECT  COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $id . '\' AND user_id > 0');
	$num = $db->getOne($sql);

	if (0 < $num) {
		$db->query('UPDATE ' . $ecs->table('user_gift_gard') . ('SET is_delete = 0  WHERE gift_gard_id=\'' . $id . '\''));
	}
	else {
		$db->query('DELETE FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $id . '\''));
	}

	$url = 'gift_gard.php?act=query_bonus&' . str_replace('act=remove_bonus', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}
else if ($_REQUEST['act'] == 'remove_take') {
	check_authz_json('gift_gard_manage');
	$id = intval($_GET['id']);
	$db->query('UPDATE ' . $ecs->table('user_gift_gard') . (' SET goods_id=0, user_id=0, address=\'\', consignee_name=\'\', mobile=\'\', status=0, express_no=\'\' WHERE gift_gard_id=\'' . $id . '\''));
	$db->query('DELETE FROM ' . $ecs->table('gift_gard_log') . (' WHERE gift_gard_id  = \'' . $id . '\' AND handle_type=\'gift_gard\''));
	$url = 'gift_gard.php?act=query_take&' . str_replace('act=remove_take', '', $_SERVER['QUERY_STRING']);
	ecs_header('Location: ' . $url . "\n");
	exit();
}

if ($_REQUEST['act'] == 'batch') {
	admin_priv('gift_gard_manage');
	$bonus_type_id = intval($_REQUEST['bonus_type']);

	if (isset($_POST['checkboxes'])) {
		$bonus_id_list = $_POST['checkboxes'];

		if (isset($_POST['drop'])) {
			foreach ($bonus_id_list as $key => $val) {
				$sql = 'SELECT  COUNT(*) FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $val . '\' AND user_id > 0');
				$num = $db->getOne($sql);

				if (0 < $num) {
					$db->query('UPDATE ' . $ecs->table('user_gift_gard') . ('SET is_delete = 0  WHERE gift_gard_id=\'' . $val . '\''));
				}
				else {
					$db->query('DELETE FROM ' . $ecs->table('user_gift_gard') . (' WHERE gift_gard_id=\'' . $val . '\''));
				}
			}

			admin_log(count($bonus_id_list), 'remove', 'userbonus');
			clear_cache_files();
			$link[] = array('text' => $_LANG['back_gift_list'], 'href' => 'gift_gard.php?act=bonus_list&bonus_type=' . $bonus_type_id);
			sys_msg(sprintf($_LANG['batch_gift_success'], count($bonus_id_list)), 0, $link);
		}
		else if (isset($_POST['configure_goods'])) {
			assign_query_info();
			$smarty->assign('ur_here', $_LANG['config_goods']);
			$smarty->assign('action_link', array('href' => 'gift_gard.php?act=bonus_list&bonus_type=' . $bonus_type_id, 'text' => $_LANG['gift_gard_list']));
			$bonus_type = $db->GetRow('SELECT gift_id, gift_name FROM ' . $ecs->table('gift_gard_type') . (' WHERE gift_id=\'' . $_REQUEST['id'] . '\''));

			if (count($bonus_id_list) == 1) {
				$goods_list = get_bonus_goods($bonus_id_list[0]);
			}

			$sql = 'SELECT goods_id FROM ' . $ecs->table('goods') . (' WHERE bonus_type_id > 0 AND bonus_type_id <> \'' . $_REQUEST['id'] . '\'');
			$other_goods_list = $db->getCol($sql);
			$smarty->assign('other_goods', join(',', $other_goods_list));
			$smarty->assign('cat_list', cat_list());
			$smarty->assign('brand_list', get_brand_list());
			$smarty->assign('bonus_type', $bonus_type);
			$smarty->assign('goods_list', $goods_list);
			$smarty->assign('gift_goods_id', implode(',', $bonus_id_list));
			$smarty->display('gift_gard_by_goods.htm');
		}
	}
	else {
		sys_msg($_LANG['no_select_bonus'], 1);
	}
}

?>
