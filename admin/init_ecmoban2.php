<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$sql = 'SELECT goods_id FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE 1';
$goods_res = $GLOBALS['db']->getAll($sql);
$sql = 'SELECT goods_id,goods_number FROM ' . $GLOBALS['ecs']->table('order_goods') . ' WHERE 1';
$order_res = $GLOBALS['db']->getAll($sql);

foreach ($order_res as $idx => $val) {
	$sql = 'SELECT SUM(og.goods_number) as goods_number ' . 'FROM ' . $GLOBALS['ecs']->table('goods') . ' AS g, ' . $GLOBALS['ecs']->table('order_info') . ' AS o, ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . 'WHERE g.is_on_sale = 1 AND g.is_alone_sale = 1 AND g.is_delete = 0 AND og.order_id = o.order_id AND og.goods_id = g.goods_id ' . 'AND (o.order_status = \'' . OS_CONFIRMED . '\' OR o.order_status = \'' . OS_SPLITED . '\') ' . 'AND (o.pay_status = \'' . PS_PAYED . '\' OR o.pay_status = \'' . PS_PAYING . '\') ' . 'AND (o.shipping_status = \'' . SS_SHIPPED . '\' OR o.shipping_status = \'' . SS_RECEIVED . '\') AND g.goods_id=' . $val['goods_id'];
	$sales_volume = $GLOBALS['db']->getOne($sql);
	$sql = 'update ' . $ecs->table('goods') . (' set sales_volume=\'' . $sales_volume . '\' WHERE goods_id =') . $val['goods_id'];

	if ($db->query($sql)) {
		clear_cache_files();
		$link[0]['text'] = $_LANG['back_stage_home'];
		$link[0]['href'] = 'index.php';
		sys_msg($_LANG['sales_volume_initial_success'], 0, $link);
	}
	else {
		clear_cache_files();
		$link[0]['text'] = $_LANG['back_stage_home'];
		$link[0]['href'] = 'index.php';
		sys_msg($_LANG['sales_volume_initial_fail'], 0, $link);
	}
}

?>
