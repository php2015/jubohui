<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$exc = new exchange($ecs->table('order_delayed'), $db, 'delayed_id', 'apply_day', 'order_id');

if ($_REQUEST['act'] == 'list') {
	admin_priv('order_delayed');
	$order_delay_list = get_order_delayed_list();
	$smarty->assign('primary_cat', $_LANG['04_order']);
	$smarty->assign('ur_here', $_LANG['order_delay_apply']);
	$smarty->assign('order_delay_list', $order_delay_list['order_delay_list']);
	$smarty->assign('filter', $order_delay_list['filter']);
	$smarty->assign('record_count', $order_delay_list['record_count']);
	$smarty->assign('page_count', $order_delay_list['page_count']);
	$smarty->assign('full_page', 1);
	$page_count_arr = seller_page($order_delay_list, $_REQUEST['page']);
	$smarty->assign('page_count_arr', $page_count_arr);
	assign_query_info();
	$smarty->display('order_delayed_list.dwt');
}
else if ($_REQUEST['act'] == 'query') {
	check_authz_json('order_delayed');
	$order_delay_list = get_order_delayed_list();
	$smarty->assign('order_delay_list', $order_delay_list['order_delay_list']);
	$smarty->assign('filter', $order_delay_list['filter']);
	$smarty->assign('record_count', $order_delay_list['record_count']);
	$smarty->assign('page_count', $order_delay_list['page_count']);
	$sort_flag = sort_flag($order_delay_list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	make_json_result($smarty->fetch('order_delayed_list.dwt'), '', array('filter' => $order_delay_list['filter'], 'page_count' => $order_delay_list['page_count']));
}
else if ($_REQUEST['act'] == 'batch') {
	admin_priv('order_delayed');
	if (!isset($_POST['checkboxes']) || !is_array($_POST['checkboxes'])) {
		sys_msg($_LANG['not_select_any_data'], 1);
	}

	$delay_id_arr = !empty($_POST['checkboxes']) ? $_POST['checkboxes'] : array();
	$review_status = !empty($_POST['review_status']) ? intval($_POST['review_status']) : 0;

	if (isset($_POST['type'])) {
		if ($_POST['type'] == 'batch_remove') {
			$sql = 'DELETE FROM ' . $ecs->table('order_delayed') . ' WHERE delayed_id ' . db_create_in($delay_id_arr);

			if ($db->query($sql)) {
				$lnk[] = array('text' => $_LANG['back_list'], 'href' => 'order_delay.php?act=list');
				sys_msg($_LANG['delete_delay_info_success'], 0, $lnk);
			}

			admin_log('', 'batch_trash', 'users_real');
		}
		else if ($_POST['type'] == 'review_to') {
			$sql = 'SELECT od.review_status,od.apply_day,o.order_sn ,od.delayed_id FROM ' . $GLOBALS['ecs']->table('order_delayed') . 'AS od' . ' LEFT JOIN ' . $ecs->table('order_info') . 'AS o ON od.order_id = o.order_id WHERE od.delayed_id ' . db_create_in($delay_id_arr);
			$ald_review = $GLOBALS['db']->getAll($sql);
			$msj_order = '';

			foreach ($ald_review as $key => $value) {
				if (0 < $value['review_status']) {
					$id_key = array_search($value['delayed_id'], $delay_id_arr);
					unset($delay_id_arr[$id_key]);
				}

				if ($value['apply_day'] == 0 && $review_status == 1) {
					if ($msj_order) {
						$msj_order .= ',' . $value['order_sn'];
					}
					else {
						$msj_order = $value['order_sn'];
					}

					$id_key = array_search($value['delayed_id'], $delay_id_arr);
					unset($delay_id_arr[$id_key]);
				}
			}

			$time = gmtime();
			$sql = 'UPDATE ' . $ecs->table('order_delayed') . (' SET review_status = \'' . $review_status . '\', review_time = \'' . $time . '\', review_admin = \'' . $_SESSION['seller_id'] . '\' ') . ' WHERE delayed_id ' . db_create_in($delay_id_arr);

			if ($db->query($sql)) {
				$sql = 'SELECT order_id, apply_day FROM ' . $GLOBALS['ecs']->table('order_delayed') . ' WHERE delayed_id ' . db_create_in($delay_id_arr);
				$order_id_list = $GLOBALS['db']->getAll($sql);

				foreach ($order_id_list as $key => $value) {
					$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ('SET auto_delivery_time=auto_delivery_time+\'' . $value['apply_day'] . '\' WHERE order_id=\'' . $value['order_id'] . '\'');
					$GLOBALS['db']->query($sql);
				}

				$lnk[] = array('text' => $_LANG['back'], 'href' => 'order_delay.php?act=list');
				$message = $_LANG['delay_exam_state_set_success'];

				if ($msj_order) {
					$message = $message . ',' . $_LANG['delay_time_max_large_0'][0] . $msj_order . $_LANG['delay_time_max_large_0'][1];
				}

				sys_msg($message, 0, $lnk);
			}
		}
	}
}
else if ($_REQUEST['act'] == 'edit_apply_day') {
	check_authz_json('order_delayed');
	$id = intval($_POST['id']);
	$val = json_str_iconv(trim($_POST['val']));

	if ($exc->edit('apply_day = \'' . $val . '\'', $id)) {
		clear_cache_files();
		make_json_result(stripslashes($val));
	}
}

?>
