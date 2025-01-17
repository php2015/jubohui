<?php
/*多点乐资源  禁止倒卖 一经发现停止任何服务*/
function get_admin_logs()
{
	$adminru = get_admin_ru_id();
	$user_id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
	$admin_ip = !empty($_REQUEST['ip']) ? $_REQUEST['ip'] : '';
	$filter = array();
	$filter['sort_by'] = empty($_REQUEST['sort_by']) ? 'al.log_id' : trim($_REQUEST['sort_by']);
	$filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
	$filter['keywords'] = empty($_REQUEST['keywords']) ? '' : trim($_REQUEST['keywords']);
	if (isset($_REQUEST['is_ajax']) && $_REQUEST['is_ajax'] == 1) {
		$filter['keywords'] = json_str_iconv($filter['keywords']);
	}

	$where = ' WHERE 1 ';

	if (!empty($user_id)) {
		$where .= ' AND al.user_id = \'' . $user_id . '\' ';
	}
	else if (!empty($admin_ip)) {
		$where .= ' AND al.ip_address = \'' . $admin_ip . '\' ';
	}

	if (0 < $adminru['ru_id']) {
		$where .= ' AND u.ru_id = \'' . $adminru['ru_id'] . '\' AND suppliers_id = 0';
	}

	if ($filter['keywords']) {
		$where .= ' AND u.user_name LIKE \'%' . mysql_like_quote($filter['keywords']) . '%\' ';
	}

	$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('admin_log') . ' AS al LEFT JOIN ' . $GLOBALS['ecs']->table('admin_user') . ' AS u ON al.user_id = u.user_id ' . $where;
	$filter['record_count'] = $GLOBALS['db']->getOne($sql);
	$filter = page_and_size($filter);
	$list = array();
	$sql = 'SELECT al.*, u.user_name FROM ' . $GLOBALS['ecs']->table('admin_log') . ' AS al ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('admin_user') . ' AS u ON u.user_id = al.user_id ' . $where . ' ORDER by ' . $filter['sort_by'] . ' ' . $filter['sort_order'];
	$res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);

	while ($rows = $GLOBALS['db']->fetchRow($res)) {
		$rows['log_time'] = local_date($GLOBALS['_CFG']['time_format'], $rows['log_time']);
		$list[] = $rows;
	}

	return array('list' => $list, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$smarty->assign('menus', $_SESSION['menus']);
$smarty->assign('action_type', 'privilege');

if (empty($_REQUEST['act'])) {
	$_REQUEST['act'] = 'list';
}
else {
	$_REQUEST['act'] = trim($_REQUEST['act']);
}

if ($_REQUEST['act'] == 'list') {
	admin_priv('logs_manage');
	$smarty->assign('primary_cat', $_LANG['10_priv_admin']);
	$user_id = !empty($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;
	$admin_ip = !empty($_REQUEST['ip']) ? $_REQUEST['ip'] : '';
	$log_date = !empty($_REQUEST['log_date']) ? $_REQUEST['log_date'] : '';
	$ip_list = array();
	$res = $db->query('SELECT DISTINCT ip_address FROM ' . $ecs->table('admin_log'));

	while ($row = $db->FetchRow($res)) {
		$ip_list[$row['ip_address']] = $row['ip_address'];
	}

	$smarty->assign('ur_here', $_LANG['admin_logs']);
	$smarty->assign('ip_list', $ip_list);
	$smarty->assign('full_page', 1);
	$log_list = get_admin_logs();
	$page_count_arr = seller_page($log_list, $_REQUEST['page']);
	$smarty->assign('page_count_arr', $page_count_arr);
	$smarty->assign('log_list', $log_list['list']);
	$smarty->assign('filter', $log_list['filter']);
	$smarty->assign('record_count', $log_list['record_count']);
	$smarty->assign('page_count', $log_list['page_count']);
	$sort_flag = sort_flag($log_list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	assign_query_info();
	$smarty->assign('current', 'admin_logs');
	$smarty->display('admin_logs.dwt');
}
else if ($_REQUEST['act'] == 'query') {
	$log_list = get_admin_logs();
	$page_count_arr = seller_page($log_list, $_REQUEST['page']);
	$smarty->assign('page_count_arr', $page_count_arr);
	$smarty->assign('log_list', $log_list['list']);
	$smarty->assign('filter', $log_list['filter']);
	$smarty->assign('record_count', $log_list['record_count']);
	$smarty->assign('page_count', $log_list['page_count']);
	$sort_flag = sort_flag($log_list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	$smarty->assign('current', 'admin_logs');
	make_json_result($smarty->fetch('admin_logs.dwt'), '', array('filter' => $log_list['filter'], 'page_count' => $log_list['page_count']));
}

if ($_REQUEST['act'] == 'batch_drop') {
	admin_priv('logs_drop');
	$drop_type_date = isset($_POST['drop_type_date']) ? $_POST['drop_type_date'] : '';

	if ($drop_type_date) {
		if ($_POST['log_date'] == '0') {
			ecs_header("Location: admin_logs.php?act=list\n");
			exit();
		}
		else if ('0' < $_POST['log_date']) {
			$where = ' WHERE 1 ';

			switch ($_POST['log_date']) {
			case '1':
				$a_week = gmtime() - 3600 * 24 * 7;
				$where .= ' AND log_time <= \'' . $a_week . '\'';
				break;

			case '2':
				$a_month = gmtime() - 3600 * 24 * 30;
				$where .= ' AND log_time <= \'' . $a_month . '\'';
				break;

			case '3':
				$three_month = gmtime() - 3600 * 24 * 90;
				$where .= ' AND log_time <= \'' . $three_month . '\'';
				break;

			case '4':
				$half_year = gmtime() - 3600 * 24 * 180;
				$where .= ' AND log_time <= \'' . $half_year . '\'';
				break;

			case '5':
				$a_year = gmtime() - 3600 * 24 * 365;
				$where .= ' AND log_time <= \'' . $a_year . '\'';
				break;
			}

			$sql = 'DELETE FROM ' . $ecs->table('admin_log') . $where;
			$res = $db->query($sql);

			if ($res) {
				admin_log('', 'remove', 'adminlog');
				$link[] = array('text' => $_LANG['back_list'], 'href' => 'admin_logs.php?act=list');
				sys_msg($_LANG['drop_sueeccud'], 0, $link);
			}
		}
	}
	else {
		$count = 0;

		foreach ($_POST['checkboxes'] as $key => $id) {
			$sql = 'DELETE FROM ' . $ecs->table('admin_log') . (' WHERE log_id = \'' . $id . '\'');
			$result = $db->query($sql);
			$count++;
		}

		if ($result) {
			admin_log('', 'remove', 'adminlog');
			$link[] = array('text' => $_LANG['back_list'], 'href' => 'admin_logs.php?act=list');
			sys_msg(sprintf($_LANG['batch_drop_success'], $count), 0, $link);
		}
	}
}

?>
