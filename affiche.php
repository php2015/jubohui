<?php
//zend 商创商城资源  禁止倒卖 一经发现停止任何服务
define('IN_ECS', true);
define('INIT_NO_SMARTY', true);
require dirname(__FILE__) . '/includes/init.php';

if (empty($_GET['ad_id'])) {
	ecs_header("Location: index.php\n");
	exit();
}
else {
	$ad_id = intval($_GET['ad_id']);
}

$_GET['act'] = !empty($_GET['act']) ? trim($_GET['act']) : '';

if ($_GET['act'] == 'js') {
	if (empty($_GET['charset'])) {
		$_GET['charset'] = 'UTF8';
	}

	header('Content-type: application/x-javascript; charset=' . ($_GET['charset'] == 'UTF8' ? 'utf-8' : $_GET['charset']));
	$url = $ecs->url();
	$str = '';
	$sql = 'SELECT ad.ad_id, ad.ad_name, ad.ad_link, ad.ad_code ' . 'FROM ' . $ecs->table('ad') . ' AS ad ' . 'LEFT JOIN ' . $ecs->table('ad_position') . ' AS p ON ad.position_id = p.position_id ' . ('WHERE ad.ad_id = \'' . $ad_id . '\' and ') . gmtime() . ' >= ad.start_time and ' . gmtime() . '<= ad.end_time';
	$ad_info = $db->getRow($sql);

	if (!empty($ad_info)) {
		if ($_GET['charset'] != 'UTF8') {
			$ad_info['ad_name'] = ecs_iconv('UTF8', $_GET['charset'], $ad_info['ad_name']);
			$ad_info['ad_code'] = ecs_iconv('UTF8', $_GET['charset'], $ad_info['ad_code']);
		}

		$_GET['type'] = !empty($_GET['type']) ? intval($_GET['type']) : 0;
		$_GET['from'] = !empty($_GET['from']) ? urlencode($_GET['from']) : '';
		$str = '';

		switch ($_GET['type']) {
		case '0':
			$src = strpos($ad_info['ad_code'], 'http://') === false && strpos($ad_info['ad_code'], 'https://') === false ? $url . DATA_DIR . ('/afficheimg/' . $ad_info['ad_code']) : $ad_info['ad_code'];
			$str = '<a href="' . $url . 'affiche.php?ad_id=' . $ad_info['ad_id'] . '&from=' . $_GET['from'] . '&uri=' . urlencode($ad_info['ad_link']) . '" target="_blank">' . '<img src="' . $src . '" border="0" alt="' . $ad_info['ad_name'] . '" /></a>';
			break;

		case '1':
			$src = strpos($ad_info['ad_code'], 'http://') === false && strpos($ad_info['ad_code'], 'https://') === false ? $url . DATA_DIR . '/afficheimg/' . $ad_info['ad_code'] : $ad_info['ad_code'];
			$str = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0"> <param name="movie" value="' . $src . '"><param name="quality" value="high"><embed src="' . $src . '" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed></object>';
			break;

		case '2':
			$str = $ad_info['ad_code'];
			break;

		case 3:
			$str = '<a href="' . $url . 'affiche.php?ad_id=' . $ad_info['ad_id'] . '&from=' . $_GET['from'] . '&uri=' . urlencode($ad_info['ad_link']) . '" target="_blank">' . nl2br(htmlspecialchars(addslashes($ad_info['ad_code']))) . '</a>';
			break;
		}
	}

	echo 'document.writeln(\'' . $str . '\');';
}
else {
	$site_name = !empty($_GET['from']) ? htmlspecialchars($_GET['from']) : addslashes($_LANG['self_site']);
	$goods_id = !empty($_GET['goods_id']) ? intval($_GET['goods_id']) : 0;
	$_SESSION['from_ad'] = $ad_id;
	$_SESSION['referer'] = stripslashes($site_name);

	if ($ad_id == '-1') {
		$sql = 'SELECT count(*) FROM ' . $ecs->table('adsense') . ' WHERE from_ad = \'-1\' AND referer = \'' . $site_name . '\'';

		if (0 < $db->getOne($sql)) {
			$sql = 'UPDATE ' . $ecs->table('adsense') . ' SET clicks = clicks + 1 WHERE from_ad = \'-1\' AND referer = \'' . $site_name . '\'';
		}
		else {
			$sql = 'INSERT INTO ' . $ecs->table('adsense') . '(from_ad, referer, clicks) VALUES (\'-1\', \'' . $site_name . '\', \'1\')';
		}

		$db->query($sql);
		$sql = 'SELECT goods_name FROM ' . $ecs->table('goods') . (' WHERE goods_id = ' . $goods_id);
		$res = $db->query($sql);
		$row = $db->fetchRow($res);
		$uri = build_uri('goods', array('gid' => $goods_id), $row['goods_name']);
		ecs_header('Location: ' . $uri . "\n");
		exit();
	}
	else {
		$db->query('UPDATE ' . $ecs->table('ad') . (' SET click_count = click_count + 1 WHERE ad_id = \'' . $ad_id . '\''));
		$sql = 'SELECT count(*) FROM ' . $ecs->table('adsense') . ' WHERE from_ad = \'' . $ad_id . '\' AND referer = \'' . $site_name . '\'';

		if (0 < $db->getOne($sql)) {
			$sql = 'UPDATE ' . $ecs->table('adsense') . ' SET clicks = clicks + 1 WHERE from_ad = \'' . $ad_id . '\' AND referer = \'' . $site_name . '\'';
		}
		else {
			$sql = 'INSERT INTO ' . $ecs->table('adsense') . '(from_ad, referer, clicks) VALUES (\'' . $ad_id . '\', \'' . $site_name . '\', \'1\')';
		}

		$db->query($sql);
		$sql = 'SELECT * FROM ' . $ecs->table('ad') . (' WHERE ad_id = \'' . $ad_id . '\'');
		$ad_info = $db->getRow($sql);

		if (!empty($ad_info['ad_link'])) {
			$uri = strpos($ad_info['ad_link'], 'http://') === false && strpos($ad_info['ad_link'], 'https://') === false ? $ecs->http() . urldecode($ad_info['ad_link']) : urldecode($ad_info['ad_link']);
		}
		else {
			$uri = $ecs->url();
		}

		ecs_header('Location: ' . $uri . "\n");
		exit();
	}
}

?>
