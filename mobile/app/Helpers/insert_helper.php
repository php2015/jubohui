<?php
//多点乐资源
function insert_query_info()
{
	if ($GLOBALS['db']->queryTime == '') {
		$query_time = 0;
	}
	else {
		$query_time = number_format(microtime(true) - $GLOBALS['db']->queryTime, 6);
	}

	if ($GLOBALS['_LANG']['memory_info'] && function_exists('memory_get_usage')) {
		$memory_usage = sprintf($GLOBALS['_LANG']['memory_info'], memory_get_usage() / 1048576);
	}
	else {
		$memory_usage = '';
	}

	$gzip_enabled = (gzip_enabled() ? $GLOBALS['_LANG']['gzip_enabled'] : $GLOBALS['_LANG']['gzip_disabled']);
	$online_count = $GLOBALS['db']->getOne('SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table('sessions'));
	$cron_method = (empty($GLOBALS['_CFG']['cron_method']) ? '<img src="api/cron.php?t=' . gmtime() . '" alt="" style="width:0px;height:0px;" />' : '');
	return sprintf($GLOBALS['_LANG']['query_info'], $GLOBALS['db']->queryCount, $query_time, $online_count) . $gzip_enabled . $memory_usage . $cron_method;
}

function insert_history()
{
	$str = '';

	if (!empty($_COOKIE['ECS']['history'])) {
		$where = db_create_in($_COOKIE['ECS']['history'], 'goods_id');
		$sql = 'SELECT goods_id, goods_name, goods_thumb, shop_price FROM ' . $GLOBALS['ecs']->table('goods') . ' WHERE ' . $where . ' AND is_on_sale = 1 AND is_alone_sale = 1 AND is_delete = 0';
		$query = $GLOBALS['db']->query($sql);
		$res = array();

		while ($row = $GLOBALS['db']->fetch_array($query)) {
			$goods['goods_id'] = $row['goods_id'];
			$goods['goods_name'] = $row['goods_name'];
			$goods['short_name'] = 0 < $GLOBALS['_CFG']['goods_name_length'] ? sub_str($row['goods_name'], $GLOBALS['_CFG']['goods_name_length']) : $row['goods_name'];
			$goods['goods_thumb'] = get_image_path($row['goods_thumb']);
			$goods['shop_price'] = price_format($row['shop_price']);
			$goods['url'] = build_uri('goods', array('gid' => $row['goods_id']), $row['goods_name']);
			$str .= '<ul class="clearfix"><li class="goodsimg"><a href="' . $goods['url'] . '" target="_blank"><img src="' . $goods['goods_thumb'] . '" alt="' . $goods['goods_name'] . '" class="B_blue" /></a></li><li><a href="' . $goods['url'] . '" target="_blank" title="' . $goods['goods_name'] . '">' . $goods['short_name'] . '</a><br />' . $GLOBALS['_LANG']['shop_price'] . '<font class="f1">' . $goods['shop_price'] . '</font><br /></li></ul>';
		}

		$str .= '<ul id="clear_history"><a onclick="clear_history()">' . $GLOBALS['_LANG']['clear_history'] . '</a></ul>';
	}

	return $str;
}

function insert_cart_info()
{
	if (!empty($_SESSION['user_id'])) {
		$sess_id = ' user_id = \'' . $_SESSION['user_id'] . '\' ';
	}
	else {
		$sess_id = ' session_id = \'' . real_cart_mac_ip() . '\' ';
	}

	$sql = 'SELECT SUM(goods_number) AS number, SUM(goods_price * goods_number) AS amount' . ' FROM ' . $GLOBALS['ecs']->table('cart') . ' WHERE ' . $sess_id . ' AND rec_type = \'' . CART_GENERAL_GOODS . '\' AND stages_qishu=\'-1\' AND store_id = 0 ';
	$row = $GLOBALS['db']->GetRow($sql);

	if ($row) {
		$number = intval($row['number']);
		$amount = floatval($row['amount']);
	}
	else {
		$number = 0;
		$amount = 0;
	}

	$str = sprintf($GLOBALS['_LANG']['cart_info'], $number, price_format($amount, false));
	return '<a href="flow.php" title="' . $GLOBALS['_LANG']['view_cart'] . '">' . $str . '</a>';
}

function insert_ads($arr, $return = false)
{
	static $static_res;
	$time = gmtime();
	if (!empty($arr['num']) && ($arr['num'] != 1)) {
		$sql = 'SELECT a.ad_id, a.position_id, a.media_type, a.ad_link, a.ad_code, a.ad_name, p.ad_width, ' . 'p.ad_height, p.position_style, RAND() AS rnd ' . 'FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' AS a ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('touch_ad_position') . ' AS p ON a.position_id = p.position_id ' . 'WHERE enabled = 1 AND start_time <= \'' . $time . '\' AND end_time >= \'' . $time . '\' ' . 'AND a.position_id = \'' . $arr['id'] . '\' ' . 'ORDER BY rnd LIMIT ' . $arr['num'];
		$res = $GLOBALS['db']->GetAll($sql);
	}
	else {
		if ($static_res[$arr['id']] === NULL) {
			$sql = 'SELECT a.ad_id, a.position_id, a.media_type, a.ad_link, a.ad_code, a.ad_name, p.ad_width, ' . 'p.ad_height, p.position_style, RAND() AS rnd ' . 'FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' AS a ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('touch_ad_position') . ' AS p ON a.position_id = p.position_id ' . 'WHERE enabled = 1 AND start_time <= \'' . $time . '\' AND end_time >= \'' . $time . '\' ' . 'AND a.position_id = \'' . $arr['id'] . '\' ' . 'ORDER BY rnd LIMIT 1';
			$static_res[$arr['id']] = $GLOBALS['db']->GetAll($sql);
		}

		$res = $static_res[$arr['id']];
	}

	if ($return) {
		return $res;
	}

	$ads = array();
	$position_style = '';

	foreach ($res as $key => $row) {
		if ($row['position_id'] != $arr['id']) {
			continue;
		}

		$position_style = $row['position_style'];

		switch ($row['media_type']) {
		case 0:
			$src = ((strpos($row['ad_code'], 'http://') === false) && (strpos($row['ad_code'], 'https://') === false) ? get_data_path($row['ad_code'], 'afficheimg') : $row['ad_code']);
			$ads[] = '<a href=\'' . url('affiche/index/index', array('ad_id' => $row['ad_id'], 'uri' => urlencode($row['ad_link']))) . '\' target=\'_blank\'><img src=\'' . $src . '\' /></a>';
			break;

		case 1:
			$src = ((strpos($row['ad_code'], 'http://') === false) && (strpos($row['ad_code'], 'https://') === false) ? get_data_path($row['ad_code'], 'afficheimg') : $row['ad_code']);
			$ads[] = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ' . 'codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"  ' . 'width=\'' . $row['ad_width'] . '\' height=\'' . $row['ad_height'] . "'>\r\n                           <param name='movie' value='" . $src . "'>\r\n                           <param name='quality' value='high'>\r\n                           <embed src='" . $src . "' quality='high'\r\n                           pluginspage='http://www.macromedia.com/go/getflashplayer'\r\n                           type='application/x-shockwave-flash' width='" . $row['ad_width'] . "'\r\n                           height='" . $row['ad_height'] . "'></embed>\r\n                         </object>";
			break;

		case 2:
			$ads[] = $row['ad_code'];
			break;

		case 3:
			$ads[] = '<a href=\'' . url('affiche/index/index', array('id' => $row['ad_id'], 'uri' => urlencode($row['ad_link']))) . '\' target=\'_blank\'>' . htmlspecialchars($row['ad_code']) . '</a>';
			break;
		}
	}

	$val = '';

	if (!empty($ads)) {
		$GLOBALS['smarty']->assign('ads', $ads);
		$val = $GLOBALS['smarty']->fetch('', $position_style);
	}

	return $val;
}

function insert_team($arr)
{
	static $static_res;
	$time = gmtime();
	if (!empty($arr['num']) && ($arr['num'] != 1)) {
		if (!empty($arr['tc_id']) && (0 < $arr['tc_id'])) {
			$where .= ' and p.tc_id = \'' . $arr['tc_id'] . '\' and p.tc_type = \'' . $arr['type'] . '\' ';
		}
		else {
			$where .= '';
		}

		$sql = 'SELECT a.ad_id, a.position_id, a.media_type, a.ad_link, a.ad_code, a.ad_name, p.ad_width, ' . 'p.ad_height, p.position_style, RAND() AS rnd ' . 'FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' AS a ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('touch_ad_position') . ' AS p ON a.position_id = p.position_id ' . 'WHERE enabled = 1 AND start_time <= \'' . $time . '\' AND end_time >= \'' . $time . '\' ' . $where . ' ' . 'ORDER BY rnd LIMIT ' . $arr['num'];
		$res = $GLOBALS['db']->GetAll($sql);
	}
	else {
		if (!empty($arr['tc_id']) && (0 < $arr['tc_id'])) {
			$where .= ' and p.tc_id = \'' . $arr['tc_id'] . '\' and p.tc_type = \'' . $arr['type'] . '\' ';
		}
		else {
			$where .= '';
		}

		$sql = 'SELECT a.ad_id, a.position_id, a.media_type, a.ad_link, a.ad_code, a.ad_name, p.ad_width, ' . 'p.ad_height, p.position_style, RAND() AS rnd ' . 'FROM ' . $GLOBALS['ecs']->table('touch_ad') . ' AS a ' . 'LEFT JOIN ' . $GLOBALS['ecs']->table('touch_ad_position') . ' AS p ON a.position_id = p.position_id ' . 'WHERE enabled = 1 AND start_time <= \'' . $time . '\' AND end_time >= \'' . $time . '\' ' . $where . ' ' . 'ORDER BY rnd LIMIT 1';
		$static_res[$arr['id']] = $GLOBALS['db']->GetAll($sql);
		$res = $static_res[$arr['id']];
	}

	$ads = array();
	$position_style = '';

	foreach ($res as $key => $row) {
		$position_style = $row['position_style'];

		switch ($row['media_type']) {
		case 0:
			$src = ((strpos($row['ad_code'], 'http://') === false) && (strpos($row['ad_code'], 'https://') === false) ? get_data_path($row['ad_code'], 'afficheimg') : $row['ad_code']);
			$ads[] = '<a href=\'' . url('affiche/index/index', array('ad_id' => $row['ad_id'], 'uri' => urlencode($row['ad_link']))) . '\' target=\'_blank\'><img src=\'' . $src . '\' /></a>';
			break;

		case 1:
			$src = ((strpos($row['ad_code'], 'http://') === false) && (strpos($row['ad_code'], 'https://') === false) ? get_data_path($row['ad_code'], 'afficheimg') : $row['ad_code']);
			$ads[] = '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" ' . 'codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0"  ' . 'width=\'' . $row['ad_width'] . '\' height=\'' . $row['ad_height'] . "'>\r\n                           <param name='movie' value='" . $src . "'>\r\n                           <param name='quality' value='high'>\r\n                           <embed src='" . $src . "' quality='high'\r\n                           pluginspage='http://www.macromedia.com/go/getflashplayer'\r\n                           type='application/x-shockwave-flash' width='" . $row['ad_width'] . "'\r\n                           height='" . $row['ad_height'] . "'></embed>\r\n                         </object>";
			break;

		case 2:
			$ads[] = $row['ad_code'];
			break;

		case 3:
			$ads[] = '<a href=\'' . url('affiche/index/index', array('id' => $row['ad_id'], 'uri' => urlencode($row['ad_link']))) . '\' target=\'_blank\'>' . htmlspecialchars($row['ad_code']) . '</a>';
			break;
		}
	}

	$val = '';

	if (!empty($ads)) {
		$GLOBALS['smarty']->assign('ads', $ads);
		$val = $GLOBALS['smarty']->fetch('', $position_style);
	}

	return $val;
}

function insert_member_info()
{
	$need_cache = $GLOBALS['smarty']->caching;
	$GLOBALS['smarty']->caching = false;

	if (0 < $_SESSION['user_id']) {
		$GLOBALS['smarty']->assign('user_info', get_user_info());
	}
	else {
		if (!empty($_COOKIE['ECS']['username'])) {
			$GLOBALS['smarty']->assign('ecs_username', stripslashes($_COOKIE['ECS']['username']));
		}

		$captcha = intval($GLOBALS['_CFG']['captcha']);
		if (($captcha & CAPTCHA_LOGIN) && (!($captcha & CAPTCHA_LOGIN_FAIL) || (($captcha & CAPTCHA_LOGIN_FAIL) && (2 < $_SESSION['login_fail']))) && (0 < gd_version())) {
			$GLOBALS['smarty']->assign('enabled_captcha', 1);
			$GLOBALS['smarty']->assign('rand', mt_rand());
		}
	}

	$output = $GLOBALS['smarty']->fetch('library/member_info.lbi');
	$GLOBALS['smarty']->caching = $need_cache;
	return $output;
}

function insert_comments($arr)
{
	$need_cache = $GLOBALS['smarty']->caching;
	$need_compile = $GLOBALS['smarty']->force_compile;
	$GLOBALS['smarty']->caching = false;
	$GLOBALS['smarty']->force_compile = true;
	if ((intval($GLOBALS['_CFG']['captcha']) & CAPTCHA_COMMENT) && (0 < gd_version())) {
		$GLOBALS['smarty']->assign('enabled_captcha', 1);
		$GLOBALS['smarty']->assign('rand', mt_rand());
	}

	$GLOBALS['smarty']->assign('username', stripslashes($_SESSION['user_name']));
	$GLOBALS['smarty']->assign('email', $_SESSION['email']);
	$GLOBALS['smarty']->assign('comment_type', $arr['type']);
	$GLOBALS['smarty']->assign('id', $arr['id']);
	$cmt = assign_comment($arr['id'], $arr['type']);
	$GLOBALS['smarty']->assign('comments', $cmt['comments']);
	$GLOBALS['smarty']->assign('pager', $cmt['pager']);
	$val = $GLOBALS['smarty']->fetch('library/comments_list.lbi');
	$GLOBALS['smarty']->caching = $need_cache;
	$GLOBALS['smarty']->force_compile = $need_compile;
	return $val;
}

function insert_bought_notes($arr)
{
	$need_cache = $GLOBALS['smarty']->caching;
	$need_compile = $GLOBALS['smarty']->force_compile;
	$GLOBALS['smarty']->caching = false;
	$GLOBALS['smarty']->force_compile = true;
	$sql = 'SELECT u.user_name, og.goods_number, oi.add_time, IF(oi.order_status IN (2, 3, 4), 0, 1) AS order_status ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ON oi.user_id = u.user_id, ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . 'WHERE oi.order_id = og.order_id AND ' . time() . ' - oi.add_time < 2592000 AND og.goods_id = ' . $arr['id'] . ' ORDER BY oi.add_time DESC LIMIT 5';
	$bought_notes = $GLOBALS['db']->getAll($sql);

	foreach ($bought_notes as $key => $val) {
		$bought_notes[$key]['add_time'] = local_date('Y-m-d G:i:s', $val['add_time']);
	}

	$sql = 'SELECT count(*) ' . 'FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS oi LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ON oi.user_id = u.user_id, ' . $GLOBALS['ecs']->table('order_goods') . ' AS og ' . 'WHERE oi.order_id = og.order_id AND ' . time() . ' - oi.add_time < 2592000 AND og.goods_id = ' . $arr['id'];
	$count = $GLOBALS['db']->getOne($sql);
	$pager = array();
	$pager['page'] = $page = 1;
	$pager['size'] = $size = 5;
	$pager['record_count'] = $count;
	$pager['page_count'] = $page_count = (0 < $count ? intval(ceil($count / $size)) : 1);
	$pager['page_first'] = 'javascript:gotoBuyPage(1,' . $arr['id'] . ')';
	$pager['page_prev'] = 1 < $page ? 'javascript:gotoBuyPage(' . ($page - 1) . ',' . $arr['id'] . ')' : 'javascript:;';
	$pager['page_next'] = $page < $page_count ? 'javascript:gotoBuyPage(' . ($page + 1) . ',' . $arr['id'] . ')' : 'javascript:;';
	$pager['page_last'] = $page < $page_count ? 'javascript:gotoBuyPage(' . $page_count . ',' . $arr['id'] . ')' : 'javascript:;';
	$GLOBALS['smarty']->assign('notes', $bought_notes);
	$GLOBALS['smarty']->assign('pager', $pager);
	$val = $GLOBALS['smarty']->fetch('library/bought_notes.lbi');
	$GLOBALS['smarty']->caching = $need_cache;
	$GLOBALS['smarty']->force_compile = $need_compile;
	return $val;
}

function insert_vote()
{
	$vote = get_vote();

	if (!empty($vote)) {
		$GLOBALS['smarty']->assign('vote_id', $vote['id']);
		$GLOBALS['smarty']->assign('vote', $vote['content']);
	}

	$val = $GLOBALS['smarty']->fetch('library/vote.lbi');
	return $val;
}


?>
