<?php
//大商创网络
function return_url($code)
{
	return __URL__ . '/respond.php?code=' . $code;
}

function notify_url($code)
{
	return __URL__ . '/public/notify/' . $code . '.php';
}

function get_payment($code)
{
	$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('payment') . (' WHERE pay_code = \'' . $code . '\' AND enabled = \'1\'');
	$payment = $GLOBALS['db']->getRow($sql);

	if ($payment) {
		$config_list = unserialize($payment['pay_config']);

		foreach ($config_list as $config) {
			$payment[$config['name']] = $config['value'];
		}
	}

	return $payment;
}

function get_order_id_by_sn($order_sn, $voucher = 'false')
{
	if ($voucher == 'true') {
		if (is_numeric($order_sn)) {
			return $GLOBALS['db']->getOne('SELECT log_id FROM ' . $GLOBALS['ecs']->table('pay_log') . ' WHERE order_id=' . $order_sn . ' AND order_type=1');
		}
		else {
			return '';
		}
	}
	else {
		if (is_numeric($order_sn)) {
			$sql = 'SELECT order_id FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_sn = \'' . $order_sn . '\'');
			$order_id = $GLOBALS['db']->getOne($sql);
		}

		if (!empty($order_id)) {
			$pay_log_id = $GLOBALS['db']->getOne('SELECT log_id FROM ' . $GLOBALS['ecs']->table('pay_log') . ' WHERE order_id=\'' . $order_id . '\'');
			return $pay_log_id;
		}
		else {
			return '';
		}
	}
}

function get_goods_name_by_id($order_id)
{
	$sql = 'SELECT goods_name FROM ' . $GLOBALS['ecs']->table('order_goods') . (' WHERE order_id = \'' . $order_id . '\'');
	$goods_name = $GLOBALS['db']->getCol($sql);
	return implode(',', $goods_name);
}

function check_money($log_id, $money)
{
	if (is_numeric($log_id)) {
		$sql = 'SELECT order_amount FROM ' . $GLOBALS['ecs']->table('pay_log') . (' WHERE log_id = \'' . $log_id . '\'');
		$amount = $GLOBALS['db']->getOne($sql);
	}
	else {
		return false;
	}

	if ($money == $amount) {
		return true;
	}
	else {
		return false;
	}
}

function order_paid($log_id, $pay_status = PS_PAYED, $note = '', $module_name = '', $attach = '')
{
	$module_path = BASE_PATH . 'Modules/' . $module_name;
	if (!empty($module_name) && is_dir($module_path)) {
		$handler = 'order_paid_' . $module_name;

		if (require_cache($module_path . '/Helpers/' . $handler . '.php')) {
			return $handler($log_id, $pay_status = PS_PAYED, $note = '');
		}
	}

	$log_id = intval($log_id);

	if (0 < $log_id) {
		$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('pay_log') . (' WHERE log_id = \'' . $log_id . '\'');
		$pay_log = $GLOBALS['db']->getRow($sql);

		if (!empty($attach)) {
			if ($pay_log['order_type'] == PAY_ORDER) {
				if (is_dir(APP_TEAM_PATH)) {
					$sql = 'SELECT main_order_id, order_id, user_id, order_sn, consignee, address, tel, mobile, shipping_id, pay_status, extension_code, extension_id, goods_amount, is_zc_order, zc_goods_id,team_id,team_parent_id,team_user_id, ' . 'shipping_fee, insure_fee, pay_fee, tax, pack_fee, card_fee, surplus, money_paid, integral_money, bonus, order_amount, discount, pay_id, shipping_status ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_id = \'' . $pay_log['order_id'] . '\'');
				}
				else {
					$sql = 'SELECT main_order_id, order_id, user_id, order_sn, consignee, address, tel, mobile, shipping_id, pay_status, extension_code, extension_id, goods_amount, is_zc_order, zc_goods_id, ' . 'shipping_fee, insure_fee, pay_fee, tax, pack_fee, card_fee, surplus, money_paid, integral_money, bonus, order_amount, discount, pay_id, shipping_status ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_id = \'' . $pay_log['order_id'] . '\'');
				}

				$order = $GLOBALS['db']->getRow($sql);
				if ($order['extension_code'] == 'presale' && $attach == 'retainage') {
					$order_id = $order['order_id'];
					$order_sn = $order['order_sn'];
					$money_paid = $order['money_paid'] + $order['order_amount'];

					if ($order['pay_status'] == PS_PAYED_PART) {
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ' SET pay_status = \'' . PS_PAYED . '\', ' . ' pay_time = \'' . gmtime() . '\', ' . (' money_paid = \'' . $money_paid . '\',') . ' order_amount = 0 ' . ('WHERE order_id = \'' . $order_id . '\'');
						$GLOBALS['db']->query($sql);
						order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, PS_PAYED, $note, L('buyer'));
					}
				}
			}
		}
		else {
			if ($pay_log && $pay_log['is_paid'] == 0) {
				$sql = 'UPDATE ' . $GLOBALS['ecs']->table('pay_log') . (' SET is_paid = \'1\' WHERE log_id = \'' . $log_id . '\'');
				$GLOBALS['db']->query($sql);

				if ($pay_log['order_type'] == PAY_ORDER) {
					if (is_dir(APP_TEAM_PATH)) {
						$sql = 'SELECT main_order_id, order_id, user_id, order_sn, consignee, address, tel, mobile, shipping_id, pay_status, extension_code, extension_id, goods_amount, is_zc_order, zc_goods_id,team_id,team_parent_id,team_user_id, ' . 'shipping_fee, insure_fee, pay_fee, tax, pack_fee, card_fee, surplus, money_paid, integral_money, bonus, order_amount, discount, pay_id, shipping_status ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_id = \'' . $pay_log['order_id'] . '\'');
					}
					else {
						$sql = 'SELECT main_order_id, order_id, user_id, order_sn, consignee, address, tel, mobile, shipping_id, pay_status, extension_code, extension_id, goods_amount, is_zc_order, zc_goods_id, ' . 'shipping_fee, insure_fee, pay_fee, tax, pack_fee, card_fee, surplus, money_paid, integral_money, bonus, order_amount, discount, pay_id, shipping_status ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_id = \'' . $pay_log['order_id'] . '\'');
					}

					$order = $GLOBALS['db']->getRow($sql);
					$main_order_id = $order['main_order_id'];
					$order_id = $order['order_id'];
					$order_sn = $order['order_sn'];
					$pay_fee = order_pay_fee($order['pay_id'], $pay_log['order_amount']);
					$is_zc_order = $order['is_zc_order'];
					$zc_goods_id = $order['zc_goods_id'];
					$user_id = $order['user_id'];
					if ($is_zc_order == 1 && 0 < $user_id) {
						$sql = ' select * from ' . $GLOBALS['ecs']->table('zc_goods') . (' where id = \'' . $zc_goods_id . '\' ');
						$zc_goods_info = $GLOBALS['db']->getRow($sql);
						$pid = $zc_goods_info['pid'];
						$goods_price = $zc_goods_info['price'];
						$sql = ' UPDATE ' . $GLOBALS['ecs']->table('zc_goods') . (' SET backer_num = backer_num+1 WHERE id = \'' . $zc_goods_id . '\' ');
						$GLOBALS['db']->query($sql);
						$sql = 'SELECT backer_list FROM ' . $GLOBALS['ecs']->table('zc_goods') . (' WHERE id = \'' . $zc_goods_id . '\'');
						$backer_list = $GLOBALS['db']->getOne($sql);

						if (empty($backer_list)) {
							$backer_list = $user_id;
						}
						else {
							$backer_list = $backer_list . ',' . $user_id;
						}

						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('zc_goods') . (' SET backer_list=\'' . $backer_list . '\' WHERE id = \'' . $zc_goods_id . '\'');
						$GLOBALS['db']->query($sql);
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('zc_project') . (' SET join_num=join_num+1, join_money=join_money+' . $goods_price . ' WHERE id = \'' . $pid . '\'');
						$GLOBALS['db']->query($sql);
					}

					if ($order['extension_code'] == 'presale') {
						$money_paid = $order['money_paid'] + $order['order_amount'];

						if ($order['pay_status'] == 0) {
							$order_amount = $order['goods_amount'] + $order['shipping_fee'] + $order['insure_fee'] + $order['pay_fee'] + $order['tax'] - $order['money_paid'] - $order['order_amount'];
							$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ' SET order_status = \'' . OS_CONFIRMED . '\', ' . ' confirm_time = \'' . gmtime() . '\', ' . ' pay_status = \'' . PS_PAYED_PART . '\', ' . ' pay_time = \'' . gmtime() . '\', ' . (' money_paid = \'' . $money_paid . '\',') . (' order_amount = \'' . $order_amount . '\' ') . ('WHERE order_id = \'' . $order_id . '\'');
							$GLOBALS['db']->query($sql);
							get_goods_sale($order['order_id']);
							order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, PS_PAYED_PART, $note, L('buyer'));
							update_pay_log($order_id);
						}
						else {
							$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ' SET pay_status = \'' . PS_PAYED . '\', ' . ' pay_time = \'' . gmtime() . '\', ' . (' money_paid = \'' . $money_paid . '\',') . ' order_amount = 0 ' . ('WHERE order_id = \'' . $order_id . '\'');
							$GLOBALS['db']->query($sql);
							order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, PS_PAYED, $note, L('buyer'));
						}
					}
					else if (0 < $order_id) {
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ' SET order_status = \'' . OS_CONFIRMED . '\', ' . ' confirm_time = \'' . gmtime() . '\', ' . (' pay_status = \'' . $pay_status . '\', ') . (' pay_fee = \'' . $pay_fee . '\', ') . ' pay_time = \'' . gmtime() . '\', ' . ' money_paid = money_paid + order_amount,' . ' order_amount = 0 ' . ('WHERE order_id = \'' . $order_id . '\'');
						$GLOBALS['db']->query($sql);
						create_snapshot($order_id);
						$sql = 'SELECT store_id FROM ' . $GLOBALS['ecs']->table('store_order') . (' WHERE order_id = \'' . $order_id . '\' LIMIT 1');
						$store_id = $GLOBALS['db']->getOne($sql);
						if (C('shop.use_storage') == '1' && C('shop.stock_dec_time') == SDT_PAID) {
							include_once BASE_PATH . 'Helpers/order_helper.php';
							change_order_goods_storage($order_id, true, SDT_PAID, 15, 0, $store_id);
						}

						order_action($order_sn, OS_CONFIRMED, SS_UNSHIPPED, $pay_status, $note, L('buyer'));
						$order_sale = array('order_id' => $order_id, 'pay_status' => $pay_status, 'shipping_status' => $order['shipping_status']);
						get_goods_sale($order_id, $order_sale);

						if ($pay_status == PS_PAYED) {
							cloud_confirmorder($order_id);
						}
					}

					$sql = 'SELECT count(*) FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE main_order_id = \'' . $order_id . '\'');
					$child_num = $GLOBALS['db']->getOne($sql);
					if ($main_order_id == 0 && 0 < $child_num && 0 < $order_id) {
						$sql = 'SELECT order_id, order_sn, pay_id, order_amount FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE main_order_id = \'' . $order_id . '\'');
						$order_res = $GLOBALS['db']->getAll($sql);
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('order_info') . ' SET order_status = \'' . OS_CONFIRMED . '\', ' . ' confirm_time = \'' . gmtime() . '\', ' . (' pay_status = \'' . $pay_status . '\', ') . ' pay_time = \'' . gmtime() . '\', ' . ' money_paid = order_amount,' . ' order_amount = 0 ' . ('WHERE main_order_id = \'' . $order_id . '\'');
						$GLOBALS['db']->query($sql);

						foreach ($order_res as $row) {
							order_action($row['order_sn'], OS_CONFIRMED, SS_UNSHIPPED, $pay_status, $note, L('buyer'));
						}
					}

					$sql = 'SELECT ru_id FROM ' . $GLOBALS['ecs']->table('order_goods') . (' WHERE order_id = \'' . $order_id . '\' LIMIT 1');
					$ru_id = $GLOBALS['db']->getOne($sql);

					if ($ru_id == 0) {
						$sms_shop_mobile = $GLOBALS['_CFG']['sms_shop_mobile'];
					}
					else {
						$sql = 'SELECT mobile FROM ' . $GLOBALS['ecs']->table('seller_shopinfo') . (' WHERE ru_id = \'' . $ru_id . '\'');
						$sms_shop_mobile = $GLOBALS['db']->getOne($sql);
					}

					if ($GLOBALS['_CFG']['sms_order_payed'] == '1' && $sms_shop_mobile != '') {
						$message = array('consignee' => $order['consignee'], 'order_mobile' => $order['mobile'], 'ordermobile' => $order['mobile']);
						send_sms($sms_shop_mobile, 'sms_order_payed', $message);
					}

					$sql = 'SELECT id, store_id, order_id FROM ' . $GLOBALS['ecs']->table('store_order') . (' WHERE order_id = \'' . $order_id . '\' LIMIT 1');
					$stores_order = $GLOBALS['db']->getRow($sql);
					if ($stores_order && 0 < $stores_order['store_id']) {
						$pick_code = substr($order['order_sn'], -3) . rand(0, 9) . rand(0, 9) . rand(0, 9);
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('store_order') . (' SET pick_code = \'' . $pick_code . '\' WHERE id = \'') . $stores_order['id'] . '\'';
						$GLOBALS['db']->query($sql);
						$sql = 'SELECT mobile_phone, user_name, nick_name FROM ' . $GLOBALS['ecs']->table('users') . ' WHERE user_id = \'' . $_SESSION['user_id'] . '\'';
						$user_info = $GLOBALS['db']->getRow($sql, true);

						if ($order['mobile']) {
							$user_mobile_phone = $order['mobile'];
						}
						else {
							$user_mobile_phone = !empty($user_info['mobile_phone']) ? $user_info['mobile_phone'] : '';
						}

						if (!empty($user_mobile_phone)) {
							$sql = 'SELECT id, country, province, city, district, stores_address, stores_name, stores_tel FROM ' . $GLOBALS['ecs']->table('offline_store') . ' WHERE id = \'' . $stores_order['store_id'] . '\' LIMIT 1';
							$stores_info = $GLOBALS['db']->getRow($sql);
							$store_address = get_area_region_info($stores_info) . $stores_info['stores_address'];
							$user_name = !empty($user_info['nick_name']) ? $user_info['nick_name'] : $user_info['user_name'];
							$store_smsParams = array('user_name' => $user_name, 'username' => $user_name, 'order_sn' => $order_sn, 'ordersn' => $order_sn, 'code' => $pick_code, 'store_address' => $store_address, 'storeaddress' => $store_address, 'mobile_phone' => $user_mobile_phone, 'mobilephone' => $user_mobile_phone);
							send_sms($user_mobile_phone, 'store_order_code', $store_smsParams);
						}
					}

					if (is_dir(APP_WECHAT_PATH)) {
						$pushData = array(
							'keyword1' => array('value' => $order_sn, 'color' => '#173177'),
							'keyword2' => array('value' => '已付款', 'color' => '#173177'),
							'keyword3' => array('value' => date('Y-m-d', gmtime()), 'color' => '#173177'),
							'keyword4' => array('value' => $GLOBALS['_CFG']['shop_name'], 'color' => '#173177'),
							'keyword5' => array('value' => number_format($pay_log['order_amount'], 2, '.', ''), 'color' => '#173177')
							);
						$order_url = __HOST__ . url('user/order/detail', array('order_id' => $order_id));
						$replace_host = array('public/notify/wxpay.php', 'public/notify/alipay.php');
						$url = str_replace($replace_host, '', $order_url);
						push_template('OPENTM204987032', $pushData, $url, $order['user_id']);
					}

					$team_id = $order['team_id'];

					if (0 < $team_id) {
						$sql = 'select g.id,g.goods_id,g.team_price,g.limit_num, g.team_num,g.validity_time,og.goods_name from ' . $GLOBALS['ecs']->table('team_log') . ' as tl LEFT JOIN ' . $GLOBALS['ecs']->table('team_goods') . ' as g ON tl.t_id = g.id LEFT JOIN ' . $GLOBALS['ecs']->table('goods') . (' as og ON tl.goods_id = og.goods_id  where tl.team_id =' . $team_id . ' ');
						$res = $GLOBALS['db']->getRow($sql);
						$sql = 'SELECT count(order_id) as num  FROM ' . $GLOBALS['ecs']->table('order_info') . ' WHERE team_id = \'' . $team_id . '\' AND extension_code = \'team_buy\'  and pay_status = \'' . PS_PAYED . '\' ';
						$team_count = $GLOBALS['db']->getRow($sql);

						if ($res['team_num'] <= $team_count['num']) {
							$sql = 'UPDATE ' . $GLOBALS['ecs']->table('team_log') . ' SET status = \'1\' ' . ' WHERE team_id = \'' . $team_id . '\' ';
							$GLOBALS['db']->query($sql);

							if (is_dir(APP_WECHAT_PATH)) {
								$sql = 'SELECT order_sn,user_id FROM ' . $GLOBALS['ecs']->table('order_info') . ' WHERE team_id = \'' . $team_id . '\' AND extension_code = \'team_buy\'  and pay_status = \'' . PS_PAYED . '\' ';
								$team_order = $GLOBALS['db']->query($sql);

								foreach ($team_order as $key => $vo) {
									$pushData = array(
										'keyword1' => array('value' => $vo['order_sn'], 'color' => '#173177'),
										'keyword2' => array('value' => $res['goods_name'], 'color' => '#173177')
										);
									$order_url = __HOST__ . url('team/goods/teamwait', array('team_id' => $team_id, 'user_id' => $vo['user_id']));
									$replace_host = array('public/notify/wxpay.php', 'public/notify/alipay.php');
									$url = str_replace($replace_host, '', $order_url);
									push_template('OPENTM407456411', $pushData, $url, $vo['user_id']);
								}
							}
						}

						$limit_num = $res['limit_num'] + 1;
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('team_goods') . (' SET limit_num = \'' . $limit_num . '\' ') . ' WHERE goods_id = \'' . $res['goods_id'] . '\' and id = \'' . $res['id'] . '\' ';
						$GLOBALS['db']->query($sql);

						if (is_dir(APP_WECHAT_PATH)) {
							if (0 < $order['team_parent_id']) {
								$pushData = array(
									'keyword1' => array('value' => $res['goods_name'], 'color' => '#173177'),
									'keyword2' => array('value' => $res['team_price'] . '元', 'color' => '#173177'),
									'keyword3' => array('value' => $res['team_num'], 'color' => '#173177'),
									'keyword4' => array('value' => '普通', 'color' => '#173177'),
									'keyword5' => array('value' => $res['validity_time'] . '小时', 'color' => '#173177')
									);
								$order_url = __HOST__ . url('team/goods/teamwait', array('team_id' => $team_id, 'user_id' => $order['user_id']));
								$replace_host = array('public/notify/wxpay.php', 'public/notify/alipay.php');
								$url = str_replace($replace_host, '', $order_url);
								push_template('OPENTM407307456', $pushData, $url, $order['user_id']);
							}
							else {
								$pushData = array(
									'first'    => array('value' => '您好，您已参团成功'),
									'keyword1' => array('value' => $res['goods_name'], 'color' => '#173177'),
									'keyword2' => array('value' => $res['team_price'] . '元', 'color' => '#173177'),
									'keyword3' => array('value' => $res['validity_time'] . '小时', 'color' => '#173177')
									);
								$order_url = __HOST__ . url('team/goods/teamwait', array('team_id' => $team_id, 'user_id' => $order['user_id']));
								$replace_host = array('public/notify/wxpay.php', 'public/notify/alipay.php');
								$url = str_replace($replace_host, '', $order_url);
								push_template('OPENTM400048581', $pushData, $url, $order['user_id']);
							}
						}
					}

					$virtual_goods = get_virtual_goods($order_id);

					if (!empty($virtual_goods)) {
						$msg = '';

						if (!virtual_goods_ship($virtual_goods, $msg, $order_sn, true)) {
							$pay_success = L('pay_success');
							$pay_success .= '<div style="color:red;">' . $msg . '</div>' . L('virtual_goods_ship_fail');
						}

						if ($order['shipping_id'] == -1 || empty($order['shipping_id'])) {
							$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('order_goods') . (' WHERE order_id = \'' . $order_id . '\' AND is_real = 1');

							if ($GLOBALS['db']->getOne($sql) <= 0) {
								dao('order_info')->where(array('order_id' => $order_id))->save(array('order_status' => OS_SPLITED, 'shipping_status' => SS_SHIPPED, 'shipping_time' => gmtime()));
								order_action($order_sn, OS_CONFIRMED, SS_SHIPPED, $pay_status, $note, L('buyer'));

								if (0 < $order['user_id']) {
									include_once BASE_PATH . 'Helpers/order_helper.php';
									$integral = integral_to_give($order);
									$gave_custom_points = integral_of_value($integral['custom_points']) - $order['integral'];

									if ($gave_custom_points < 0) {
										$gave_custom_points = 0;
									}

									log_account_change($order['user_id'], 0, 0, intval($integral['rank_points']), intval($integral['custom_points']), sprintf(L('order_gift_integral'), $order['order_sn']));
									send_order_bonus($order_id);
								}
							}
						}
					}
				}
				else if ($pay_log['order_type'] == PAY_SURPLUS) {
					$sql = 'SELECT `id` FROM ' . $GLOBALS['ecs']->table('user_account') . (' WHERE `id` = \'' . $pay_log['order_id'] . '\' AND `is_paid` = 1  LIMIT 1');
					$res_id = $GLOBALS['db']->getOne($sql);

					if (empty($res_id)) {
						$sql = 'UPDATE ' . $GLOBALS['ecs']->table('user_account') . ' SET paid_time = \'' . gmtime() . '\', is_paid = 1' . (' WHERE id = \'' . $pay_log['order_id'] . '\' LIMIT 1');
						$GLOBALS['db']->query($sql);
						$sql = 'SELECT user_id, amount, is_paid FROM ' . $GLOBALS['ecs']->table('user_account') . (' WHERE id = \'' . $pay_log['order_id'] . '\'');
						$user_account = $GLOBALS['db']->getRow($sql);
						$_LANG = array();
						include_once LANG_PATH . $GLOBALS['_CFG']['lang'] . '/user.php';
						log_account_change($user_account['user_id'], $user_account['amount'], 0, 0, 0, $_LANG['surplus_type_0'], ACT_SAVING);
						$sql = 'SELECT mobile_phone, email,user_name, user_money, frozen_money FROM ' . $GLOBALS['ecs']->table('users') . ' WHERE user_id = \'' . $user_account['user_id'] . '\'';
						$user_info = $GLOBALS['db']->getRow($sql);
						$smsParams = array('user_name' => $user_info['user_name'], 'username' => $user_info['user_name'], 'user_money' => $user_info['user_money'], 'usermoney' => $user_info['user_money'], 'op_time' => local_date('Y-m-d H:i:s', gmtime()), 'optime' => local_date('Y-m-d H:i:s', gmtime()), 'add_time' => local_date('Y-m-d H:i:s', gmtime()), 'addtime' => local_date('Y-m-d H:i:s', gmtime()), 'examine' => L('through'), 'process_type' => L('surplus_type_0'), 'processtype' => L('surplus_type_0'), 'fmt_amount' => $user_account['amount'], 'fmtamount' => $user_account['amount'], 'mobile_phone' => $user_info['mobile_phone'] ? $user_info['mobile_phone'] : '', 'mobilephone' => $user_info['mobile_phone'] ? $user_info['mobile_phone'] : '');
						send_sms($smsParams['mobile_phone'], 'user_account_code', $smsParams);
					}
				}
				else if ($pay_log['order_type'] == PAY_WHOLESALE) {
					$order_id = $pay_log['order_id'];
					$time = gmtime();
					$sql = ' UPDATE ' . $GLOBALS['ecs']->table('wholesale_order_info') . (' SET pay_status = \'' . $pay_status . '\' ,pay_time = \'' . $time . '\'  WHERE order_id = \'' . $order_id . '\'');
					$GLOBALS['db']->query($sql);
					$sql = 'UPDATE ' . $GLOBALS['ecs']->table('pay_log') . 'SET is_paid = 1 WHERE order_id = \'' . $order_id . '\' AND order_type = \'' . PAY_WHOLESALE . '\'';
					$GLOBALS['db']->query($sql);
					$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('wholesale_order_info') . (' WHERE main_order_id = \'' . $order_id . '\'');
					$child_num = $GLOBALS['db']->getOne($sql);

					if (0 < $child_num) {
						$sql = 'SELECT order_id, order_sn, pay_id, order_amount ' . 'FROM ' . $GLOBALS['ecs']->table('wholesale_order_info') . (' WHERE main_order_id = \'' . $order_id . '\'');
						$order_res = $GLOBALS['db']->getAll($sql);

						foreach ($order_res as $row) {
							$sql = 'UPDATE ' . $GLOBALS['ecs']->table('pay_log') . 'SET is_paid = 1 WHERE order_id = \'' . $row['order_id'] . '\' AND order_type = \'' . PAY_WHOLESALE . '\'';
							$GLOBALS['db']->query($sql);
							$child_pay_fee = order_pay_fee($row['pay_id'], $row['order_amount']);
							$sql = 'UPDATE ' . $GLOBALS['ecs']->table('wholesale_order_info') . (' SET pay_status = \'' . $pay_status . '\', ') . (' pay_time = \'' . $time . '\', ') . (' pay_fee = \'' . $child_pay_fee . '\' ') . 'WHERE order_id = \'' . $row['order_id'] . '\'';
							$GLOBALS['db']->query($sql);
						}
					}
				}
				else if ($pay_log['order_type'] == PAY_REGISTERED) {
					$sql = 'SELECT id FROM ' . $GLOBALS['ecs']->table('drp_shop') . (' WHERE user_id=\'' . $pay_log['order_id'] . '\' AND `isbuy` = 1  LIMIT 1');
					$res_id = $GLOBALS['db']->getOne($sql);
					$sql = 'SELECT value FROM ' . $GLOBALS['ecs']->table('drp_config') . ' WHERE code=\'ischeck\'';
					$ischeck = $GLOBALS['db']->getOne($sql);

					if ($ischeck == 1) {
						$audit = 0;
					}
					else {
						$audit = 1;
					}

					if (empty($res_id)) {
						$time = gmtime();
						$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('drp_shop') . '(user_id,create_time, isbuy, audit ,status) VALUES ' . '(\'' . $pay_log[order_id] . '\',\'' . $time . '\', \'1\', \'' . $audit . '\', \'1\')';
						$GLOBALS['db']->query($sql);
					}
				}
			}
			else {
				$post_virtual_goods = get_virtual_goods($pay_log['order_id'], true);

				if (!empty($post_virtual_goods)) {
					$msg = '';
					$sql = 'SELECT pay_time, order_sn FROM ' . $GLOBALS['ecs']->table('order_info') . (' WHERE order_id = \'' . $pay_log['order_id'] . '\'');
					$row = $GLOBALS['db']->getRow($sql);
					$intval_time = gmtime() - $row['pay_time'];
					if (0 <= $intval_time && $intval_time < 3600 * 12) {
						$virtual_card = array();

						foreach ($post_virtual_goods as $code => $goods_list) {
							if ($code == 'virtual_card') {
								foreach ($goods_list as $goods) {
									if ($info = virtual_card_result($row['order_sn'], $goods)) {
										$virtual_card[] = array('goods_id' => $goods['goods_id'], 'goods_name' => $goods['goods_name'], 'info' => $info);
									}
								}

								$GLOBALS['smarty']->assign('virtual_card', $virtual_card);
							}
						}
					}
					else {
						$msg = '<div>' . L('please_view_order_detail') . '</div>';
					}

					$pay_success = L('pay_success');
					$pay_success .= $msg;
				}

				$virtual_goods = get_virtual_goods($pay_log['order_id'], false);

				if (!empty($virtual_goods)) {
					$pay_success = L('pay_success');
					$pay_success .= '<br />' . L('virtual_goods_ship_fail');
				}
			}
		}
	}
}

function order_payment_info($pay_id)
{
	$sql = 'SELECT * FROM ' . $GLOBALS['ecs']->table('payment') . (' WHERE pay_id = \'' . $pay_id . '\' AND enabled = 1');
	return $GLOBALS['db']->getRow($sql);
}

function order_pay_fee($payment_id, $order_amount, $cod_fee = NULL)
{
	$pay_fee = 0;
	$payment = order_payment_info($payment_id);
	$rate = $payment['is_cod'] && !is_null($cod_fee) ? $cod_fee : $payment['pay_fee'];

	if (strpos($rate, '%') !== false) {
		$val = floatval($rate) / 100;
		$pay_fee = 0 < $val ? $order_amount * $val / (1 - $val) : 0;
	}
	else {
		$pay_fee = floatval($rate);
	}

	return round($pay_fee, 2);
}


?>
