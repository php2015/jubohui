<?php
//大商创网络
function list_link($is_add = true, $extension_code = '')
{
	$href = 'goods.php?act=list';

	if (!empty($extension_code)) {
		$href .= '&extension_code=' . $extension_code;
	}

	if (!$is_add) {
		$href .= '&' . list_link_postfix();
	}

	if ($extension_code == 'virtual_card') {
		$text = $GLOBALS['_LANG']['50_virtual_card_list'];
	}
	else {
		$text = $GLOBALS['_LANG']['01_goods_list'];
	}

	return array('href' => $href, 'text' => $text);
}

function add_link($extension_code = '')
{
	$href = 'goods.php?act=add';

	if (!empty($extension_code)) {
		$href .= '&extension_code=' . $extension_code;
	}

	if ($extension_code == 'virtual_card') {
		$text = $GLOBALS['_LANG']['51_virtual_card_add'];
	}
	else {
		$text = $GLOBALS['_LANG']['02_goods_add'];
	}

	return array('href' => $href, 'text' => $text);
}

function goods_parse_url($url)
{
	$parse_url = @parse_url($url);
	return !empty($parse_url['scheme']) && !empty($parse_url['host']);
}

function handle_volume_price($goods_id, $number_list, $price_list)
{
	$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('volume_price') . (' WHERE price_type = \'1\' AND goods_id = \'' . $goods_id . '\'');
	$GLOBALS['db']->query($sql);

	foreach ($price_list as $key => $price) {
		$volume_number = $number_list[$key];

		if (!empty($price)) {
			$sql = 'INSERT INTO ' . $GLOBALS['ecs']->table('volume_price') . ' (price_type, goods_id, volume_number, volume_price) ' . ('VALUES (\'1\', \'' . $goods_id . '\', \'' . $volume_number . '\', \'' . $price . '\')');
			$GLOBALS['db']->query($sql);
		}
	}
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
require_once ROOT_PATH . '/admin/includes/lib_goods.php';
include_once ROOT_PATH . '/includes/cls_image.php';
$image = new cls_image($_CFG['bgcolor']);
$exc = new exchange($ecs->table('goods'), $db, 'goods_id', 'goods_name');
if ($_REQUEST['act'] == 'list' || $_REQUEST['act'] == 'trash') {
	admin_priv('goods_manage');
	$cat_id = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
	$code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
	$handler_list = array();
	$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=card', 'title' => $_LANG['card'], 'img' => 'icon_send_bonus.gif');
	$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=replenish', 'title' => $_LANG['replenish'], 'img' => 'icon_add.gif');
	$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=batch_card_add', 'title' => $_LANG['batch_card_add'], 'img' => 'icon_output.gif');
	if ($_REQUEST['act'] == 'list' && isset($handler_list[$code])) {
		$smarty->assign('add_handler', $handler_list[$code]);
	}

	$goods_ur = array('' => $_LANG['01_goods_list'], 'virtual_card' => $_LANG['50_virtual_card_list']);
	$ur_here = $_REQUEST['act'] == 'list' ? $goods_ur[$code] : $_LANG['11_goods_trash'];
	$smarty->assign('ur_here', $ur_here);
	$action_link = $_REQUEST['act'] == 'list' ? add_link($code) : array('href' => 'goods.php?act=list', 'text' => $_LANG['01_goods_list']);
	$smarty->assign('action_link', $action_link);
	$smarty->assign('code', $code);
	$smarty->assign('cat_list', cat_list(0, $cat_id));
	$smarty->assign('brand_list', get_brand_list());
	$smarty->assign('intro_list', get_intro_list());
	$smarty->assign('lang', $_LANG);
	$smarty->assign('list_type', $_REQUEST['act'] == 'list' ? 'goods' : 'trash');
	$smarty->assign('use_storage', empty($_CFG['use_storage']) ? 0 : 1);
	$goods_list = goods_list($_REQUEST['act'] == 'list' ? 0 : 1, $_REQUEST['act'] == 'list' ? ($code == '' ? 1 : 0) : -1);
	$smarty->assign('goods_list', $goods_list['goods']);
	$smarty->assign('filter', $goods_list['filter']);
	$smarty->assign('record_count', $goods_list['record_count']);
	$smarty->assign('page_count', $goods_list['page_count']);
	$smarty->assign('full_page', 1);
	$sort_flag = sort_flag($goods_list['filter']);
	$smarty->assign($sort_flag['tag'], $sort_flag['img']);
	assign_query_info();
	$htm_file = $_REQUEST['act'] == 'list' ? 'goods_list.htm' : ($_REQUEST['act'] == 'trash' ? 'goods_trash.htm' : 'group_list.htm');
	$smarty->display($htm_file);
}
else {
	if ($_REQUEST['act'] == 'add' || $_REQUEST['act'] == 'edit' || $_REQUEST['act'] == 'copy') {
		$is_add = $_REQUEST['act'] == 'add';
		$is_copy = $_REQUEST['act'] == 'copy';
		$code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);

		if ($code == 'virual_card') {
			admin_priv('virualcard');
		}
		else {
			admin_priv('goods_manage');
		}

		if (ini_get('safe_mode') == 1 && (!file_exists('../' . IMAGE_DIR . '/' . date('Ym')) || !is_dir('../' . IMAGE_DIR . '/' . date('Ym')))) {
			if (@!mkdir('../' . IMAGE_DIR . '/' . date('Ym'), 511)) {
				$warning = sprintf($_LANG['safe_mode_warning'], '../' . IMAGE_DIR . '/' . date('Ym'));
				$smarty->assign('warning', $warning);
			}
		}
		else {
			if (file_exists('../' . IMAGE_DIR . '/' . date('Ym')) && file_mode_info('../' . IMAGE_DIR . '/' . date('Ym')) < 2) {
				$warning = sprintf($_LANG['not_writable_warning'], '../' . IMAGE_DIR . '/' . date('Ym'));
				$smarty->assign('warning', $warning);
			}
		}

		if ($is_add) {
			$last_choose = array(0, 0);

			if (!empty($_COOKIE['ECSCP']['last_choose'])) {
				$last_choose = explode('|', $_COOKIE['ECSCP']['last_choose']);
			}

			$goods = array(
				'goods_id'           => 0,
				'goods_desc'         => '',
				'cat_id'             => $last_choose[0],
				'brand_id'           => $last_choose[1],
				'is_on_sale'         => '1',
				'is_alone_sale'      => '1',
				'other_cat'          => array(),
				'goods_type'         => 0,
				'shop_price'         => 0,
				'promote_price'      => 0,
				'market_price'       => 0,
				'integral'           => 0,
				'goods_number'       => $_CFG['default_storage'],
				'warn_number'        => 1,
				'promote_start_date' => local_date('Y-m-d'),
				'promote_end_date'   => local_date('Y-m-d', local_strtotime('+1 month')),
				'goods_weight'       => 0,
				'give_integral'      => -1,
				'rank_integral'      => -1
				);

			if ($code != '') {
				$goods['goods_number'] = 0;
			}

			$link_goods_list = array();
			$sql = 'DELETE FROM ' . $ecs->table('link_goods') . ' WHERE (goods_id = 0 OR link_goods_id = 0)' . (' AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
			$db->query($sql);
			$group_goods_list = array();
			$sql = 'DELETE FROM ' . $ecs->table('group_goods') . (' WHERE parent_id = 0 AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
			$db->query($sql);
			$goods_article_list = array();
			$sql = 'DELETE FROM ' . $ecs->table('goods_article') . (' WHERE goods_id = 0 AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('goods_attr') . ' WHERE goods_id = 0';
			$db->query($sql);
			$img_list = array();
		}
		else {
			$sql = 'SELECT * FROM ' . $ecs->table('goods') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\'');
			$goods = $db->getRow($sql);
			if ($is_copy && $code != '') {
				$goods['goods_number'] = 0;
			}

			if (empty($goods) === true) {
				$goods = array(
					'goods_id'           => 0,
					'goods_desc'         => '',
					'cat_id'             => 0,
					'is_on_sale'         => '1',
					'is_alone_sale'      => '1',
					'other_cat'          => array(),
					'goods_type'         => 0,
					'shop_price'         => 0,
					'promote_price'      => 0,
					'market_price'       => 0,
					'integral'           => 0,
					'goods_number'       => 1,
					'warn_number'        => 1,
					'promote_start_date' => local_date('Y-m-d'),
					'promote_end_date'   => local_date('Y-m-d', local_strtotime('+1 month')),
					'goods_weight'       => 0,
					'give_integral'      => -1,
					'rank_integral'      => -1
					);
			}

			if (0 < $goods['goods_weight']) {
				$goods['goods_weight_by_unit'] = 1 <= $goods['goods_weight'] ? $goods['goods_weight'] : $goods['goods_weight'] / 0.001;
			}

			if (!empty($goods['goods_brief'])) {
				$goods['goods_brief'] = $goods['goods_brief'];
			}

			if (!empty($goods['keywords'])) {
				$goods['keywords'] = $goods['keywords'];
			}

			if (isset($goods['is_promote']) && $goods['is_promote'] == '0') {
				unset($goods['promote_start_date']);
				unset($goods['promote_end_date']);
			}
			else {
				$goods['promote_start_date'] = local_date('Y-m-d', $goods['promote_start_date']);
				$goods['promote_end_date'] = local_date('Y-m-d', $goods['promote_end_date']);
			}

			if ($_REQUEST['act'] == 'copy') {
				$goods['goods_id'] = 0;
				$goods['goods_sn'] = '';
				$goods['goods_name'] = '';
				$goods['goods_img'] = '';
				$goods['goods_thumb'] = '';
				$goods['original_img'] = '';
				$sql = 'DELETE FROM ' . $ecs->table('link_goods') . ' WHERE (goods_id = 0 OR link_goods_id = 0)' . (' AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
				$db->query($sql);
				$sql = 'SELECT \'0\' AS goods_id, link_goods_id, is_double, \'' . $_SESSION['admin_id'] . '\' AS admin_id' . ' FROM ' . $ecs->table('link_goods') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\' ');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$db->autoExecute($ecs->table('link_goods'), $row, 'INSERT');
				}

				$sql = 'SELECT goods_id, \'0\' AS link_goods_id, is_double, \'' . $_SESSION['admin_id'] . '\' AS admin_id' . ' FROM ' . $ecs->table('link_goods') . (' WHERE link_goods_id = \'' . $_REQUEST['goods_id'] . '\' ');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$db->autoExecute($ecs->table('link_goods'), $row, 'INSERT');
				}

				$sql = 'DELETE FROM ' . $ecs->table('group_goods') . (' WHERE parent_id = 0 AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
				$db->query($sql);
				$sql = 'SELECT 0 AS parent_id, goods_id, goods_price, \'' . $_SESSION['admin_id'] . '\' AS admin_id ' . 'FROM ' . $ecs->table('group_goods') . (' WHERE parent_id = \'' . $_REQUEST['goods_id'] . '\' ');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$db->autoExecute($ecs->table('group_goods'), $row, 'INSERT');
				}

				$sql = 'DELETE FROM ' . $ecs->table('goods_article') . (' WHERE goods_id = 0 AND admin_id = \'' . $_SESSION['admin_id'] . '\'');
				$db->query($sql);
				$sql = 'SELECT 0 AS goods_id, article_id, \'' . $_SESSION['admin_id'] . '\' AS admin_id ' . 'FROM ' . $ecs->table('goods_article') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\' ');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$db->autoExecute($ecs->table('goods_article'), $row, 'INSERT');
				}

				$sql = 'DELETE FROM ' . $ecs->table('goods_attr') . ' WHERE goods_id = 0';
				$db->query($sql);
				$sql = 'SELECT 0 AS goods_id, attr_id, attr_value, attr_price ' . 'FROM ' . $ecs->table('goods_attr') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\' ');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$db->autoExecute($ecs->table('goods_attr'), addslashes_deep($row), 'INSERT');
				}
			}

			$other_cat_list = array();
			$sql = 'SELECT cat_id FROM ' . $ecs->table('goods_cat') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\'');
			$goods['other_cat'] = $db->getCol($sql);

			foreach ($goods['other_cat'] as $cat_id) {
				$other_cat_list[$cat_id] = cat_list(0, $cat_id);
			}

			$smarty->assign('other_cat_list', $other_cat_list);
			$link_goods_list = get_linked_goods($goods['goods_id']);
			$group_goods_list = get_group_goods($goods['goods_id']);
			$goods_article_list = get_goods_articles($goods['goods_id']);
			if (isset($GLOBALS['shop_id']) && 10 < $GLOBALS['shop_id'] && !empty($goods['original_img'])) {
				$goods['goods_img'] = get_image_path($_REQUEST['goods_id'], $goods['goods_img']);
				$goods['goods_thumb'] = get_image_path($_REQUEST['goods_id'], $goods['goods_thumb'], true);
			}

			$sql = 'SELECT * FROM ' . $ecs->table('goods_gallery') . (' WHERE goods_id = \'' . $goods['goods_id'] . '\'');
			$img_list = $db->getAll($sql);
			if (isset($GLOBALS['shop_id']) && 0 < $GLOBALS['shop_id']) {
				foreach ($img_list as $key => $gallery_img) {
					$gallery_img[$key]['img_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], false, 'gallery');
					$gallery_img[$key]['thumb_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], true, 'gallery');
				}
			}
			else {
				foreach ($img_list as $key => $gallery_img) {
					$gallery_img[$key]['thumb_url'] = '../' . (empty($gallery_img['thumb_url']) ? $gallery_img['img_url'] : $gallery_img['thumb_url']);
				}
			}
		}

		$goods_name_style = explode('+', empty($goods['goods_name_style']) ? '+' : $goods['goods_name_style']);
		create_html_editor('goods_desc', $goods['goods_desc']);
		$smarty->assign('code', $code);
		$smarty->assign('ur_here', $is_add ? (empty($code) ? $_LANG['02_goods_add'] : $_LANG['51_virtual_card_add']) : ($_REQUEST['act'] == 'edit' ? $_LANG['edit_goods'] : $_LANG['copy_goods']));
		$smarty->assign('action_link', list_link($is_add, $code));
		$smarty->assign('goods', $goods);
		$smarty->assign('goods_name_color', $goods_name_style[0]);
		$smarty->assign('goods_name_style', $goods_name_style[1]);
		$smarty->assign('cat_list', cat_list(0, $goods['cat_id']));
		$smarty->assign('brand_list', get_brand_list());
		$smarty->assign('unit_list', get_unit_list());
		$smarty->assign('user_rank_list', get_user_rank_list());
		$smarty->assign('weight_unit', $is_add ? '1' : (1 <= $goods['goods_weight'] ? '1' : '0.001'));
		$smarty->assign('cfg', $_CFG);
		$smarty->assign('form_act', $is_add ? 'insert' : ($_REQUEST['act'] == 'edit' ? 'update' : 'insert'));
		if ($_REQUEST['act'] == 'add' || $_REQUEST['act'] == 'edit') {
			$smarty->assign('is_add', true);
		}

		if (!$is_add) {
			$smarty->assign('member_price_list', get_member_price_list($_REQUEST['goods_id']));
		}

		$smarty->assign('link_goods_list', $link_goods_list);
		$smarty->assign('group_goods_list', $group_goods_list);
		$smarty->assign('goods_article_list', $goods_article_list);
		$smarty->assign('img_list', $img_list);
		$smarty->assign('goods_type_list', goods_type_list($goods['goods_type']));
		$smarty->assign('gd', gd_version());
		$smarty->assign('thumb_width', $_CFG['thumb_width']);
		$smarty->assign('thumb_height', $_CFG['thumb_height']);
		$smarty->assign('goods_attr_html', build_attr_html($goods['goods_type'], $goods['goods_id']));
		$volume_price_list = '';

		if (isset($_REQUEST['goods_id'])) {
			$volume_price_list = get_volume_price_list($_REQUEST['goods_id']);
		}

		if (empty($volume_price_list)) {
			$volume_price_list = array(
				array('number' => '', 'price' => '')
				);
		}

		$smarty->assign('volume_price_list', $volume_price_list);
		assign_query_info();
		$smarty->display('goods_info.htm');
	}
	else {
		if ($_REQUEST['act'] == 'insert' || $_REQUEST['act'] == 'update') {
			$code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
			$proc_thumb = isset($GLOBALS['shop_id']) && 0 < $GLOBALS['shop_id'] ? false : true;

			if ($code == 'virtual_card') {
				admin_priv('virualcard');
			}
			else {
				admin_priv('goods_manage');
			}

			if ($_POST['goods_sn']) {
				$sql = 'SELECT COUNT(*) FROM ' . $ecs->table('goods') . (' WHERE goods_sn = \'' . $_POST['goods_sn'] . '\' AND is_delete = 0 AND goods_id <> \'' . $_POST['goods_id'] . '\'');

				if (0 < $db->getOne($sql)) {
					sys_msg($_LANG['goods_sn_exists'], 1, array(), false);
				}
			}

			if (isset($_FILES['goods_img']['error'])) {
				$php_maxsize = ini_get('upload_max_filesize');
				$htm_maxsize = '2M';

				if ($_FILES['goods_img']['error'] == 0) {
					if (!$image->check_img_type($_FILES['goods_img']['type'])) {
						sys_msg($_LANG['invalid_goods_img'], 1, array(), false);
					}
				}
				else if ($_FILES['goods_img']['error'] == 1) {
					sys_msg(sprintf($_LANG['goods_img_too_big'], $php_maxsize), 1, array(), false);
				}
				else if ($_FILES['goods_img']['error'] == 2) {
					sys_msg(sprintf($_LANG['goods_img_too_big'], $htm_maxsize), 1, array(), false);
				}

				if (isset($_FILES['goods_thumb'])) {
					if ($_FILES['goods_thumb']['error'] == 0) {
						if (!$image->check_img_type($_FILES['goods_thumb']['type'])) {
							sys_msg($_LANG['invalid_goods_thumb'], 1, array(), false);
						}
					}
					else if ($_FILES['goods_thumb']['error'] == 1) {
						sys_msg(sprintf($_LANG['goods_thumb_too_big'], $php_maxsize), 1, array(), false);
					}
					else if ($_FILES['goods_thumb']['error'] == 2) {
						sys_msg(sprintf($_LANG['goods_thumb_too_big'], $htm_maxsize), 1, array(), false);
					}
				}

				foreach ($_FILES['img_url']['error'] as $key => $value) {
					if ($value == 0) {
						if (!$image->check_img_type($_FILES['img_url']['type'][$key])) {
							sys_msg(sprintf($_LANG['invalid_img_url'], $key + 1), 1, array(), false);
						}
					}
					else if ($value == 1) {
						sys_msg(sprintf($_LANG['img_url_too_big'], $key + 1, $php_maxsize), 1, array(), false);
					}
					else if ($_FILES['img_url']['error'] == 2) {
						sys_msg(sprintf($_LANG['img_url_too_big'], $key + 1, $htm_maxsize), 1, array(), false);
					}
				}
			}
			else {
				if ($_FILES['goods_img']['tmp_name'] != 'none') {
					if (!$image->check_img_type($_FILES['goods_img']['type'])) {
						sys_msg($_LANG['invalid_goods_img'], 1, array(), false);
					}
				}

				if (isset($_FILES['goods_thumb'])) {
					if ($_FILES['goods_thumb']['tmp_name'] != 'none') {
						if (!$image->check_img_type($_FILES['goods_thumb']['type'])) {
							sys_msg($_LANG['invalid_goods_thumb'], 1, array(), false);
						}
					}
				}

				foreach ($_FILES['img_url']['tmp_name'] as $key => $value) {
					if ($value != 'none') {
						if (!$image->check_img_type($_FILES['img_url']['type'][$key])) {
							sys_msg(sprintf($_LANG['invalid_img_url'], $key + 1), 1, array(), false);
						}
					}
				}
			}

			$is_insert = $_REQUEST['act'] == 'insert';
			$goods_img = '';
			$goods_thumb = '';
			$original_img = '';
			$old_original_img = '';
			if ($_FILES['goods_img']['tmp_name'] != '' && $_FILES['goods_img']['tmp_name'] != 'none') {
				if (0 < $_REQUEST['goods_id']) {
					$sql = 'SELECT goods_thumb, goods_img, original_img ' . ' FROM ' . $ecs->table('goods') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\'');
					$row = $db->getRow($sql);
					if ($row['goods_thumb'] != '' && is_file('../' . $row['goods_thumb'])) {
						@unlink('../' . $row['goods_thumb']);
					}

					if ($row['goods_img'] != '' && is_file('../' . $row['goods_img'])) {
						@unlink('../' . $row['goods_img']);
					}

					if ($row['original_img'] != '' && is_file('../' . $row['original_img'])) {
					}

					if ($proc_thumb === false) {
						get_image_path($_REQUEST[goods_id], $row['goods_img'], false, 'goods', true);
						get_image_path($_REQUEST[goods_id], $row['goods_thumb'], true, 'goods', true);
					}
				}

				$original_img = $image->upload_image($_FILES['goods_img']);

				if ($original_img === false) {
					sys_msg($image->error_msg(), 1, array(), false);
				}

				$goods_img = $original_img;

				if ($_CFG['auto_generate_gallery']) {
					$img = $original_img;
					$pos = strpos(basename($img), '.');
					$newname = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);

					if (!copy('../' . $img, '../' . $newname)) {
						sys_msg('fail to copy file: ' . realpath('../' . $img), 1, array(), false);
					}

					$img = $newname;
					$gallery_img = $img;
					$gallery_thumb = $img;
				}

				if ($proc_thumb && 0 < $image->gd_version() && $image->check_img_function($_FILES['goods_img']['type'])) {
					if ($_CFG['image_width'] != 0 || $_CFG['image_height'] != 0) {
						$goods_img = $image->make_thumb('../' . $goods_img, $GLOBALS['_CFG']['image_width'], $GLOBALS['_CFG']['image_height']);

						if ($goods_img === false) {
							sys_msg($image->error_msg(), 1, array(), false);
						}
					}

					if ($_CFG['auto_generate_gallery']) {
						$newname = dirname($img) . '/' . $image->random_filename() . substr(basename($img), $pos);

						if (!copy('../' . $img, '../' . $newname)) {
							sys_msg('fail to copy file: ' . realpath('../' . $img), 1, array(), false);
						}

						$gallery_img = $newname;
					}

					if (0 < intval($_CFG['watermark_place']) && !empty($GLOBALS['_CFG']['watermark'])) {
						if ($image->add_watermark('../' . $goods_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
							sys_msg($image->error_msg(), 1, array(), false);
						}

						if ($_CFG['auto_generate_gallery']) {
							if ($image->add_watermark('../' . $gallery_img, '', $GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']) === false) {
								sys_msg($image->error_msg(), 1, array(), false);
							}
						}
					}

					if ($_CFG['auto_generate_gallery']) {
						if ($_CFG['thumb_width'] != 0 || $_CFG['thumb_height'] != 0) {
							$gallery_thumb = $image->make_thumb('../' . $img, $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);

							if ($gallery_thumb === false) {
								sys_msg($image->error_msg(), 1, array(), false);
							}
						}
					}
				}
			}

			if (isset($_FILES['goods_thumb']) && $_FILES['goods_thumb']['tmp_name'] != '' && isset($_FILES['goods_thumb']['tmp_name']) && $_FILES['goods_thumb']['tmp_name'] != 'none') {
				$goods_thumb = $image->upload_image($_FILES['goods_thumb']);

				if ($goods_thumb === false) {
					sys_msg($image->error_msg(), 1, array(), false);
				}
			}
			else {
				if ($proc_thumb && isset($_POST['auto_thumb']) && !empty($original_img)) {
					if ($_CFG['thumb_width'] != 0 || $_CFG['thumb_height'] != 0) {
						$goods_thumb = $image->make_thumb('../' . $original_img, $GLOBALS['_CFG']['thumb_width'], $GLOBALS['_CFG']['thumb_height']);

						if ($goods_thumb === false) {
							sys_msg($image->error_msg(), 1, array(), false);
						}
					}
					else {
						$goods_thumb = $original_img;
					}
				}
			}

			if (empty($_POST['goods_sn'])) {
				$max_id = $is_insert ? $db->getOne('SELECT MAX(goods_id) + 1 FROM ' . $ecs->table('goods')) : $_REQUEST['goods_id'];
				$goods_sn = generate_goods_sn($max_id);
			}
			else {
				$goods_sn = $_POST['goods_sn'];
			}

			$shop_price = !empty($_POST['shop_price']) ? $_POST['shop_price'] : 0;
			$market_price = !empty($_POST['market_price']) ? $_POST['market_price'] : 0;
			$promote_price = !empty($_POST['promote_price']) ? floatval($_POST['promote_price']) : 0;
			$is_promote = empty($promote_price) ? 0 : 1;
			$promote_start_date = $is_promote && !empty($_POST['promote_start_date']) ? local_strtotime($_POST['promote_start_date']) : 0;
			$promote_end_date = $is_promote && !empty($_POST['promote_end_date']) ? local_strtotime($_POST['promote_end_date']) : 0;
			$goods_weight = !empty($_POST['goods_weight']) ? $_POST['goods_weight'] * $_POST['weight_unit'] : 0;
			$is_best = isset($_POST['is_best']) ? 1 : 0;
			$is_new = isset($_POST['is_new']) ? 1 : 0;
			$is_hot = isset($_POST['is_hot']) ? 1 : 0;
			$is_on_sale = isset($_POST['is_on_sale']) ? 1 : 0;
			$is_alone_sale = isset($_POST['is_alone_sale']) ? 1 : 0;
			$goods_number = isset($_POST['goods_number']) ? $_POST['goods_number'] : 0;
			$warn_number = isset($_POST['warn_number']) ? $_POST['warn_number'] : 0;
			$goods_type = isset($_POST['goods_type']) ? $_POST['goods_type'] : 0;
			$give_integral = isset($_POST['give_integral']) ? intval($_POST['give_integral']) : '-1';
			$rank_integral = isset($_POST['rank_integral']) ? intval($_POST['rank_integral']) : '-1';
			$goods_name_style = $_POST['goods_name_color'] . '+' . $_POST['goods_name_style'];
			$catgory_id = empty($_POST['cat_id']) ? '' : intval($_POST['cat_id']);
			$brand_id = empty($_POST['brand_id']) ? '' : intval($_POST['brand_id']);
			$goods_img = empty($goods_img) && !empty($_POST['goods_img_url']) && goods_parse_url($_POST['goods_img_url']) ? htmlspecialchars(trim($_POST['goods_img_url'])) : $goods_img;
			$goods_thumb = empty($goods_thumb) && !empty($_POST['goods_thumb_url']) && goods_parse_url($_POST['goods_thumb_url']) ? htmlspecialchars(trim($_POST['goods_thumb_url'])) : $goods_thumb;
			$goods_thumb = empty($goods_thumb) && isset($_POST['auto_thumb']) ? $goods_img : $goods_thumb;

			if ($is_insert) {
				if ($code == '') {
					$sql = 'INSERT INTO ' . $ecs->table('goods') . ' (goods_name, goods_name_style, goods_sn, ' . 'cat_id, brand_id, shop_price, market_price, is_promote, promote_price, ' . 'promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, ' . 'seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, ' . 'is_on_sale, is_alone_sale, goods_desc, add_time, last_update, goods_type, rank_integral)' . ('VALUES (\'' . $_POST['goods_name'] . '\', \'' . $goods_name_style . '\', \'' . $goods_sn . '\', \'' . $catgory_id . '\', ') . ('\'' . $brand_id . '\', \'' . $shop_price . '\', \'' . $market_price . '\', \'' . $is_promote . '\',\'' . $promote_price . '\', ') . ('\'' . $promote_start_date . '\', \'' . $promote_end_date . '\', \'' . $goods_img . '\', \'' . $goods_thumb . '\', \'' . $original_img . '\', ') . ('\'' . $_POST['keywords'] . '\', \'' . $_POST['goods_brief'] . '\', \'' . $_POST['seller_note'] . '\', \'' . $goods_weight . '\', \'' . $goods_number . '\',') . (' \'' . $warn_number . '\', \'' . $_POST['integral'] . '\', \'' . $give_integral . '\', \'' . $is_best . '\', \'' . $is_new . '\', \'' . $is_hot . '\', \'' . $is_on_sale . '\', \'' . $is_alone_sale . '\', ') . (' \'' . $_POST['goods_desc'] . '\', \'') . gmtime() . '\', \'' . gmtime() . ('\', \'' . $goods_type . '\', \'' . $rank_integral . '\')');
				}
				else {
					$sql = 'INSERT INTO ' . $ecs->table('goods') . ' (goods_name, goods_name_style, goods_sn, ' . 'cat_id, brand_id, shop_price, market_price, is_promote, promote_price, ' . 'promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, ' . 'seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, is_real, ' . 'is_on_sale, is_alone_sale, goods_desc, add_time, last_update, goods_type, extension_code, rank_integral)' . ('VALUES (\'' . $_POST['goods_name'] . '\', \'' . $goods_name_style . '\', \'' . $goods_sn . '\', \'' . $catgory_id . '\', ') . ('\'' . $brand_id . '\', \'' . $shop_price . '\', \'' . $market_price . '\', \'' . $is_promote . '\',\'' . $promote_price . '\', ') . ('\'' . $promote_start_date . '\', \'' . $promote_end_date . '\', \'' . $goods_img . '\', \'' . $goods_thumb . '\', \'' . $original_img . '\', ') . ('\'' . $_POST['keywords'] . '\', \'' . $_POST['goods_brief'] . '\', \'' . $_POST['seller_note'] . '\', \'' . $goods_weight . '\', \'' . $goods_number . '\',') . (' \'' . $warn_number . '\', \'' . $_POST['integral'] . '\', \'' . $give_integral . '\', \'' . $is_best . '\', \'' . $is_new . '\', \'' . $is_hot . '\', 0, \'' . $is_on_sale . '\', \'' . $is_alone_sale . '\', ') . (' \'' . $_POST['goods_desc'] . '\', \'') . gmtime() . '\', \'' . gmtime() . ('\', \'' . $goods_type . '\', \'' . $code . '\', \'' . $rank_integral . '\')');
				}
			}
			else {
				$sql = 'SELECT goods_thumb, goods_img, original_img ' . ' FROM ' . $ecs->table('goods') . (' WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\'');
				$row = $db->getRow($sql);
				if ($proc_thumb && $goods_img && $row['goods_img'] && !goods_parse_url($row['goods_img'])) {
					@unlink(ROOT_PATH . $row['goods_img']);
					@unlink(ROOT_PATH . $row['original_img']);
				}

				if ($proc_thumb && $goods_thumb && $row['goods_thumb'] && !goods_parse_url($row['goods_thumb'])) {
					@unlink(ROOT_PATH . $row['goods_thumb']);
				}

				$sql = 'UPDATE ' . $ecs->table('goods') . ' SET ' . ('goods_name = \'' . $_POST['goods_name'] . '\', ') . ('goods_name_style = \'' . $goods_name_style . '\', ') . ('goods_sn = \'' . $goods_sn . '\', ') . ('cat_id = \'' . $catgory_id . '\', ') . ('brand_id = \'' . $brand_id . '\', ') . ('shop_price = \'' . $shop_price . '\', ') . ('market_price = \'' . $market_price . '\', ') . ('is_promote = \'' . $is_promote . '\', ') . ('promote_price = \'' . $promote_price . '\', ') . ('promote_start_date = \'' . $promote_start_date . '\', ') . ('promote_end_date = \'' . $promote_end_date . '\', ');

				if ($goods_img) {
					$sql .= 'goods_img = \'' . $goods_img . '\', original_img = \'' . $original_img . '\', ';
				}

				if ($goods_thumb) {
					$sql .= 'goods_thumb = \'' . $goods_thumb . '\', ';
				}

				if ($code != '') {
					$sql .= 'is_real=0, extension_code=\'' . $code . '\', ';
				}

				$sql .= 'keywords = \'' . $_POST['keywords'] . '\', ' . ('goods_brief = \'' . $_POST['goods_brief'] . '\', ') . ('seller_note = \'' . $_POST['seller_note'] . '\', ') . ('goods_weight = \'' . $goods_weight . '\',') . ('goods_number = \'' . $goods_number . '\', ') . ('warn_number = \'' . $warn_number . '\', ') . ('integral = \'' . $_POST['integral'] . '\', ') . ('give_integral = \'' . $give_integral . '\', ') . ('rank_integral = \'' . $rank_integral . '\', ') . ('is_best = \'' . $is_best . '\', ') . ('is_new = \'' . $is_new . '\', ') . ('is_hot = \'' . $is_hot . '\', ') . ('is_on_sale = \'' . $is_on_sale . '\', ') . ('is_alone_sale = \'' . $is_alone_sale . '\', ') . ('goods_desc = \'' . $_POST['goods_desc'] . '\', ') . 'last_update = \'' . gmtime() . '\', ' . ('goods_type = \'' . $goods_type . '\' ') . ('WHERE goods_id = \'' . $_REQUEST['goods_id'] . '\' LIMIT 1');
			}

			$db->query($sql);
			$goods_id = $is_insert ? $db->insert_id() : $_REQUEST['goods_id'];

			if ($is_insert) {
				admin_log($_POST['goods_name'], 'add', 'goods');
			}
			else {
				admin_log($_POST['goods_name'], 'edit', 'goods');
			}

			if (isset($_POST['attr_id_list']) && isset($_POST['attr_value_list']) || empty($_POST['attr_id_list']) && empty($_POST['attr_value_list'])) {
				$goods_attr_list = array();
				$keywords_arr = explode(' ', $_POST['keywords']);
				$keywords_arr = array_flip($keywords_arr);

				if (isset($keywords_arr[''])) {
					unset($keywords_arr['']);
				}

				$sql = 'SELECT attr_id, attr_index FROM ' . $ecs->table('attribute') . (' WHERE cat_id = \'' . $goods_type . '\'');
				$attr_res = $db->query($sql);
				$attr_list = array();

				while ($row = $db->fetchRow($attr_res)) {
					$attr_list[$row['attr_id']] = $row['attr_index'];
				}

				$sql = 'SELECT * FROM ' . $ecs->table('goods_attr') . (' WHERE goods_id = \'' . $goods_id . '\'');
				$res = $db->query($sql);

				while ($row = $db->fetchRow($res)) {
					$goods_attr_list[$row['attr_id']][$row['attr_value']] = array('sign' => 'delete', 'goods_attr_id' => $row['goods_attr_id']);
				}

				if (isset($_POST['attr_id_list'])) {
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
								if (!isset($keywords_arr[$v]) && $attr_list[$attr_id] == '1') {
									$keywords_arr[$v] = $v;
								}
							}
						}
					}
				}

				$keywords = join(' ', array_flip($keywords_arr));
				$sql = 'UPDATE ' . $ecs->table('goods') . (' SET keywords = \'' . $keywords . '\' WHERE goods_id = \'' . $goods_id . '\' LIMIT 1');
				$db->query($sql);

				foreach ($goods_attr_list as $attr_id => $attr_value_list) {
					foreach ($attr_value_list as $attr_value => $info) {
						if ($info['sign'] == 'insert') {
							$sql = 'INSERT INTO ' . $ecs->table('goods_attr') . ' (attr_id, goods_id, attr_value, attr_price)' . ('VALUES (\'' . $attr_id . '\', \'' . $goods_id . '\', \'' . $attr_value . '\', \'' . $info['attr_price'] . '\')');
						}
						else if ($info['sign'] == 'update') {
							$sql = 'UPDATE ' . $ecs->table('goods_attr') . (' SET attr_price = \'' . $info['attr_price'] . '\' WHERE goods_attr_id = \'' . $info['goods_attr_id'] . '\' LIMIT 1');
						}
						else {
							$sql = 'DELETE FROM ' . $ecs->table('goods_attr') . (' WHERE goods_attr_id = \'' . $info['goods_attr_id'] . '\' LIMIT 1');
						}

						$db->query($sql);
					}
				}
			}

			if (isset($_POST['user_rank']) && isset($_POST['user_price'])) {
				handle_member_price($goods_id, $_POST['user_rank'], $_POST['user_price']);
			}

			if (isset($_POST['volume_number']) && isset($_POST['volume_price'])) {
				$temp_num = array_count_values($_POST['volume_number']);

				foreach ($temp_num as $v) {
					if (1 < $v) {
						sys_msg($_LANG['volume_number_continuous'], 1, array(), false);
						break;
					}
				}

				handle_volume_price($goods_id, $_POST['volume_number'], $_POST['volume_price']);
			}

			if (isset($_POST['other_cat'])) {
				handle_other_cat($goods_id, array_unique($_POST['other_cat']));
			}

			if ($is_insert) {
				handle_link_goods($goods_id);
				handle_group_goods($goods_id);
				handle_goods_article($goods_id);
			}

			$original_img = reformat_image_name('goods', $goods_id, $original_img, 'source');
			$goods_img = reformat_image_name('goods', $goods_id, $goods_img, 'goods');
			$goods_thumb = reformat_image_name('goods_thumb', $goods_id, $goods_thumb, 'thumb');

			if ($goods_img !== false) {
				$db->query('UPDATE ' . $ecs->table('goods') . (' SET goods_img = \'' . $goods_img . '\' WHERE goods_id=\'' . $goods_id . '\''));
			}

			if ($original_img !== false) {
				$db->query('UPDATE ' . $ecs->table('goods') . (' SET original_img = \'' . $original_img . '\' WHERE goods_id=\'' . $goods_id . '\''));
			}

			if ($goods_thumb !== false) {
				$db->query('UPDATE ' . $ecs->table('goods') . (' SET goods_thumb = \'' . $goods_thumb . '\' WHERE goods_id=\'' . $goods_id . '\''));
			}

			if (isset($img)) {
				$img = reformat_image_name('gallery', $goods_id, $img, 'source');
				$gallery_img = reformat_image_name('gallery', $goods_id, $gallery_img, 'goods');
				$gallery_thumb = reformat_image_name('gallery_thumb', $goods_id, $gallery_thumb, 'thumb');
				$sql = 'INSERT INTO ' . $ecs->table('goods_gallery') . ' (goods_id, img_url, img_desc, thumb_url, img_original) ' . ('VALUES (\'' . $goods_id . '\', \'' . $gallery_img . '\', \'\', \'' . $gallery_thumb . '\', \'' . $img . '\')');
				$db->query($sql);
			}

			handle_gallery_image($goods_id, $_FILES['img_url'], $_POST['img_desc']);
			if (!$is_insert && isset($_POST['old_img_desc'])) {
				foreach ($_POST['old_img_desc'] as $img_id => $img_desc) {
					$sql = 'UPDATE ' . $ecs->table('goods_gallery') . (' SET img_desc = \'' . $img_desc . '\' WHERE img_id = \'' . $img_id . '\' LIMIT 1');
					$db->query($sql);
				}
			}

			if ($proc_thumb && !$_CFG['retain_original_img'] && !empty($original_img)) {
				$db->query('UPDATE ' . $ecs->table('goods') . (' SET original_img=\'\' WHERE `goods_id`=\'' . $goods_id . '\''));
				$db->query('UPDATE ' . $ecs->table('goods_gallery') . (' SET img_original=\'\' WHERE `goods_id`=\'' . $goods_id . '\''));
				@unlink('../' . $original_img);
				@unlink('../' . $img);
			}

			setcookie('ECSCP[last_choose]', $catgory_id . '|' . $brand_id, gmtime() + 86400);
			clear_cache_files();
			$link = array();

			if ($code == 'virtual_card') {
				$link[] = array('href' => 'virtual_card.php?act=replenish&goods_id=' . $goods_id, 'text' => $_LANG['add_replenish']);
			}

			if ($is_insert) {
				$link[] = add_link($code);
			}

			$link[] = list_link($is_insert, $code);
			sys_msg($is_insert ? $_LANG['add_goods_ok'] : $_LANG['edit_goods_ok'], 0, $link);
		}
		else if ($_REQUEST['act'] == 'batch') {
			$code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
			$goods_id = !empty($_POST['checkboxes']) ? join(',', $_POST['checkboxes']) : 0;

			if (isset($_POST['type'])) {
				if ($_POST['type'] == 'trash') {
					admin_priv('remove_back');
					update_goods($goods_id, 'is_delete', '1');
					admin_log('', 'batch_trash', 'goods');
				}
				else if ($_POST['type'] == 'on_sale') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_on_sale', '1');
				}
				else if ($_POST['type'] == 'not_on_sale') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_on_sale', '0');
				}
				else if ($_POST['type'] == 'best') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_best', '1');
				}
				else if ($_POST['type'] == 'not_best') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_best', '0');
				}
				else if ($_POST['type'] == 'new') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_new', '1');
				}
				else if ($_POST['type'] == 'not_new') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_new', '0');
				}
				else if ($_POST['type'] == 'hot') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_hot', '1');
				}
				else if ($_POST['type'] == 'not_hot') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'is_hot', '0');
				}
				else if ($_POST['type'] == 'move_to') {
					admin_priv('goods_manage');
					update_goods($goods_id, 'cat_id', $_POST['target_cat']);
				}
				else if ($_POST['type'] == 'restore') {
					admin_priv('remove_back');
					update_goods($goods_id, 'is_delete', '0');
					admin_log('', 'batch_restore', 'goods');
				}
				else if ($_POST['type'] == 'drop') {
					admin_priv('remove_back');
					delete_goods($goods_id);
					admin_log('', 'batch_remove', 'goods');
				}
			}

			clear_cache_files();
			if ($_POST['type'] == 'drop' || $_POST['type'] == 'restore') {
				$link[] = array('href' => 'goods.php?act=trash', 'text' => $_LANG['11_goods_trash']);
			}
			else {
				$link[] = list_link(true, $code);
			}

			sys_msg($_LANG['batch_handle_ok'], 0, $link);
		}
		else if ($_REQUEST['act'] == 'show_image') {
			if (isset($GLOBALS['shop_id']) && 0 < $GLOBALS['shop_id']) {
				$img_url = $_GET['img_url'];
			}
			else if (strpos($_GET['img_url'], 'http://') === 0) {
				$img_url = $_GET['img_url'];
			}
			else {
				$img_url = '../' . $_GET['img_url'];
			}

			$smarty->assign('img_url', $img_url);
			$smarty->display('goods_show_image.htm');
		}
		else if ($_REQUEST['act'] == 'edit_goods_name') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$goods_name = json_str_iconv(trim($_POST['val']));

			if ($exc->edit('goods_name = \'' . $goods_name . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result(stripslashes($goods_name));
			}
		}
		else if ($_REQUEST['act'] == 'edit_goods_sn') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$goods_sn = json_str_iconv(trim($_POST['val']));

			if (!$exc->is_only('goods_sn', $goods_sn, $goods_id)) {
				make_json_error($_LANG['goods_sn_exists']);
			}

			if ($exc->edit('goods_sn = \'' . $goods_sn . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result(stripslashes($goods_sn));
			}
		}
		else if ($_REQUEST['act'] == 'check_goods_sn') {
			check_authz_json('goods_manage');
			$goods_id = intval($_REQUEST['goods_id']);
			$goods_sn = json_str_iconv(trim($_REQUEST['goods_sn']));

			if (!$exc->is_only('goods_sn', $goods_sn, $goods_id)) {
				make_json_error($_LANG['goods_sn_exists']);
			}

			make_json_result('');
		}
		else if ($_REQUEST['act'] == 'edit_goods_price') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$goods_price = floatval($_POST['val']);
			$price_rate = floatval($_CFG['market_price_rate'] * $goods_price);
			if ($goods_price < 0 || $goods_price == 0 && $_POST['val'] != $goods_price) {
				make_json_error($_LANG['shop_price_invalid']);
			}
			else if ($exc->edit('shop_price = \'' . $goods_price . '\', market_price = \'' . $price_rate . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result(number_format($goods_price, 2, '.', ''));
			}
		}
		else if ($_REQUEST['act'] == 'edit_goods_number') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$goods_num = intval($_POST['val']);
			if ($goods_num < 0 || $goods_num == 0 && $_POST['val'] != $goods_num) {
				make_json_error($_LANG['goods_number_error']);
			}

			if ($exc->edit('goods_number = \'' . $goods_num . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($goods_num);
			}
		}
		else if ($_REQUEST['act'] == 'toggle_on_sale') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$on_sale = intval($_POST['val']);

			if ($exc->edit('is_on_sale = \'' . $on_sale . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($on_sale);
			}
		}
		else if ($_REQUEST['act'] == 'toggle_best') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$is_best = intval($_POST['val']);

			if ($exc->edit('is_best = \'' . $is_best . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($is_best);
			}
		}
		else if ($_REQUEST['act'] == 'toggle_new') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$is_new = intval($_POST['val']);

			if ($exc->edit('is_new = \'' . $is_new . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($is_new);
			}
		}
		else if ($_REQUEST['act'] == 'toggle_hot') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$is_hot = intval($_POST['val']);

			if ($exc->edit('is_hot = \'' . $is_hot . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($is_hot);
			}
		}
		else if ($_REQUEST['act'] == 'edit_sort_order') {
			check_authz_json('goods_manage');
			$goods_id = intval($_POST['id']);
			$sort_order = intval($_POST['val']);

			if ($exc->edit('sort_order = \'' . $sort_order . '\', last_update=' . gmtime(), $goods_id)) {
				clear_cache_files();
				make_json_result($sort_order);
			}
		}
		else if ($_REQUEST['act'] == 'query') {
			$is_delete = empty($_REQUEST['is_delete']) ? 0 : intval($_REQUEST['is_delete']);
			$code = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
			$goods_list = goods_list($is_delete, $code == '' ? 1 : 0);
			$handler_list = array();
			$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=card', 'title' => $_LANG['card'], 'img' => 'icon_send_bonus.gif');
			$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=replenish', 'title' => $_LANG['replenish'], 'img' => 'icon_add.gif');
			$handler_list['virtual_card'][] = array('url' => 'virtual_card.php?act=batch_card_add', 'title' => $_LANG['batch_card_add'], 'img' => 'icon_output.gif');

			if (isset($handler_list[$code])) {
				$smarty->assign('add_handler', $handler_list[$code]);
			}

			$smarty->assign('goods_list', $goods_list['goods']);
			$smarty->assign('filter', $goods_list['filter']);
			$smarty->assign('record_count', $goods_list['record_count']);
			$smarty->assign('page_count', $goods_list['page_count']);
			$smarty->assign('list_type', $is_delete ? 'trash' : 'goods');
			$smarty->assign('use_storage', empty($_CFG['use_storage']) ? 0 : 1);
			$sort_flag = sort_flag($goods_list['filter']);
			$smarty->assign($sort_flag['tag'], $sort_flag['img']);
			$tpl = $is_delete ? 'goods_trash.htm' : 'goods_list.htm';
			make_json_result($smarty->fetch($tpl), '', array('filter' => $goods_list['filter'], 'page_count' => $goods_list['page_count']));
		}
		else if ($_REQUEST['act'] == 'remove') {
			$goods_id = intval($_REQUEST['id']);
			check_authz_json('remove_back');

			if ($exc->edit('is_delete = 1', $goods_id)) {
				clear_cache_files();
				$goods_name = $exc->get_name($goods_id);
				admin_log(addslashes($goods_name), 'trash', 'goods');
				$url = 'goods.php?act=query&' . str_replace('act=remove', '', $_SERVER['QUERY_STRING']);
				ecs_header('Location: ' . $url . '
');
				exit();
			}
		}
		else if ($_REQUEST['act'] == 'restore_goods') {
			$goods_id = intval($_REQUEST['id']);
			check_authz_json('remove_back');
			$exc->edit('is_delete = 0, add_time = \'' . gmtime() . '\'', $goods_id);
			clear_cache_files();
			$goods_name = $exc->get_name($goods_id);
			admin_log(addslashes($goods_name), 'restore', 'goods');
			$url = 'goods.php?act=query&' . str_replace('act=restore_goods', '', $_SERVER['QUERY_STRING']);
			ecs_header('Location: ' . $url . '
');
			exit();
		}
		else if ($_REQUEST['act'] == 'drop_goods') {
			check_authz_json('remove_back');
			$goods_id = intval($_REQUEST['id']);

			if ($goods_id <= 0) {
				make_json_error('invalid params');
			}

			$sql = 'SELECT goods_id, goods_name, is_delete, is_real, goods_thumb, ' . 'goods_img, original_img ' . 'FROM ' . $ecs->table('goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$goods = $db->getRow($sql);

			if (empty($goods)) {
				make_json_error($_LANG['goods_not_exist']);
			}

			if ($goods['is_delete'] != 1) {
				make_json_error($_LANG['goods_not_in_recycle_bin']);
			}

			if (!empty($goods['goods_thumb'])) {
				@unlink('../' . $goods['goods_thumb']);
			}

			if (!empty($goods['goods_img'])) {
				@unlink('../' . $goods['goods_img']);
			}

			if (!empty($goods['original_img'])) {
				@unlink('../' . $goods['original_img']);
			}

			$exc->drop($goods_id);
			admin_log(addslashes($goods['goods_name']), 'remove', 'goods');
			$sql = 'SELECT img_url, thumb_url, img_original ' . 'FROM ' . $ecs->table('goods_gallery') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$res = $db->query($sql);

			while ($row = $db->fetchRow($res)) {
				if (!empty($row['img_url'])) {
					@unlink('../' . $row['img_url']);
				}

				if (!empty($row['thumb_url'])) {
					@unlink('../' . $row['thumb_url']);
				}

				if (!empty($row['img_original'])) {
					@unlink('../' . $row['img_original']);
				}
			}

			$sql = 'DELETE FROM ' . $ecs->table('goods_gallery') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('collect_goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('goods_article') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('goods_attr') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('goods_cat') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('member_price') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('group_goods') . (' WHERE parent_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('group_goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('link_goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('link_goods') . (' WHERE link_goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('tag') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('comment') . (' WHERE comment_type = 0 AND id_value = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('collect_goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('booking_goods') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('goods_activity') . (' WHERE goods_id = \'' . $goods_id . '\'');
			$db->query($sql);

			if ($goods['is_real'] != 1) {
				$sql = 'DELETE FROM ' . $ecs->table('virtual_card') . (' WHERE goods_id = \'' . $goods_id . '\'');
				if (!$db->query($sql, 'SILENT') && $db->errno() != 1146) {
					exit($db->error());
				}
			}

			clear_cache_files();
			$url = 'goods.php?act=query&' . str_replace('act=drop_goods', '', $_SERVER['QUERY_STRING']);
			ecs_header('Location: ' . $url . '
');
			exit();
		}
		else if ($_REQUEST['act'] == 'get_attr') {
			check_authz_json('goods_manage');
			$goods_id = empty($_GET['goods_id']) ? 0 : intval($_GET['goods_id']);
			$goods_type = empty($_GET['goods_type']) ? 0 : intval($_GET['goods_type']);
			$content = build_attr_html($goods_type, $goods_id);
			make_json_result($content);
		}
		else if ($_REQUEST['act'] == 'drop_image') {
			check_authz_json('goods_manage');
			$img_id = empty($_REQUEST['img_id']) ? 0 : intval($_REQUEST['img_id']);
			$sql = 'SELECT img_url, thumb_url, img_original ' . ' FROM ' . $GLOBALS['ecs']->table('goods_gallery') . (' WHERE img_id = \'' . $img_id . '\'');
			$row = $GLOBALS['db']->getRow($sql);
			if ($row['img_url'] != '' && is_file('../' . $row['img_url'])) {
				@unlink('../' . $row['img_url']);
			}

			if ($row['thumb_url'] != '' && is_file('../' . $row['thumb_url'])) {
				@unlink('../' . $row['thumb_url']);
			}

			if ($row['img_original'] != '' && is_file('../' . $row['img_original'])) {
				@unlink('../' . $row['img_original']);
			}

			$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table('goods_gallery') . (' WHERE img_id = \'' . $img_id . '\' LIMIT 1');
			$GLOBALS['db']->query($sql);
			clear_cache_files();
			make_json_result($img_id);
		}
		else if ($_REQUEST['act'] == 'get_goods_list') {
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
		else if ($_REQUEST['act'] == 'add_link_goods') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$linked_array = $json->decode($_GET['add_ids']);
			$linked_goods = $json->decode($_GET['JSON']);
			$goods_id = $linked_goods[0];
			$is_double = $linked_goods[1] == true ? 0 : 1;

			foreach ($linked_array as $val) {
				if ($is_double) {
					$sql = 'INSERT INTO ' . $ecs->table('link_goods') . ' (goods_id, link_goods_id, is_double, admin_id) ' . ('VALUES (\'' . $val . '\', \'' . $goods_id . '\', \'' . $is_double . '\', \'' . $_SESSION['admin_id'] . '\')');
					$db->query($sql, 'SILENT');
				}

				$sql = 'INSERT INTO ' . $ecs->table('link_goods') . ' (goods_id, link_goods_id, is_double, admin_id) ' . ('VALUES (\'' . $goods_id . '\', \'' . $val . '\', \'' . $is_double . '\', \'' . $_SESSION['admin_id'] . '\')');
				$db->query($sql, 'SILENT');
			}

			$linked_goods = get_linked_goods($goods_id);
			$options = array();

			foreach ($linked_goods as $val) {
				$options[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($options);
		}
		else if ($_REQUEST['act'] == 'drop_link_goods') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$drop_goods = $json->decode($_GET['drop_ids']);
			$drop_goods_ids = db_create_in($drop_goods);
			$linked_goods = $json->decode($_GET['JSON']);
			$goods_id = $linked_goods[0];
			$is_signle = $linked_goods[1];

			if (!$is_signle) {
				$sql = 'DELETE FROM ' . $ecs->table('link_goods') . (' WHERE link_goods_id = \'' . $goods_id . '\' AND goods_id ') . $drop_goods_ids;
			}
			else {
				$sql = 'UPDATE ' . $ecs->table('link_goods') . ' SET is_double = 0 ' . (' WHERE link_goods_id = \'' . $goods_id . '\' AND goods_id ') . $drop_goods_ids;
			}

			if ($goods_id == 0) {
				$sql .= ' AND admin_id = \'' . $_SESSION['admin_id'] . '\'';
			}

			$db->query($sql);
			$sql = 'DELETE FROM ' . $ecs->table('link_goods') . (' WHERE goods_id = \'' . $goods_id . '\' AND link_goods_id ') . $drop_goods_ids;

			if ($goods_id == 0) {
				$sql .= ' AND admin_id = \'' . $_SESSION['admin_id'] . '\'';
			}

			$db->query($sql);
			$linked_goods = get_linked_goods($goods_id);
			$options = array();

			foreach ($linked_goods as $val) {
				$options[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($options);
		}
		else if ($_REQUEST['act'] == 'add_group_goods') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$fittings = $json->decode($_GET['add_ids']);
			$arguments = $json->decode($_GET['JSON']);
			$goods_id = $arguments[0];
			$price = $arguments[1];

			foreach ($fittings as $val) {
				$sql = 'INSERT INTO ' . $ecs->table('group_goods') . ' (parent_id, goods_id, goods_price, admin_id) ' . ('VALUES (\'' . $goods_id . '\', \'' . $val . '\', \'' . $price . '\', \'' . $_SESSION['admin_id'] . '\')');
				$db->query($sql, 'SILENT');
			}

			$arr = get_group_goods($goods_id);
			$opt = array();

			foreach ($arr as $val) {
				$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($opt);
		}
		else if ($_REQUEST['act'] == 'drop_group_goods') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$fittings = $json->decode($_GET['drop_ids']);
			$arguments = $json->decode($_GET['JSON']);
			$goods_id = $arguments[0];
			$price = $arguments[1];
			$sql = 'DELETE FROM ' . $ecs->table('group_goods') . (' WHERE parent_id=\'' . $goods_id . '\' AND ') . db_create_in($fittings, 'goods_id');

			if ($goods_id == 0) {
				$sql .= ' AND admin_id = \'' . $_SESSION['admin_id'] . '\'';
			}

			$db->query($sql);
			$arr = get_group_goods($goods_id);
			$opt = array();

			foreach ($arr as $val) {
				$opt[] = array('value' => $val['goods_id'], 'text' => $val['goods_name'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($opt);
		}
		else if ($_REQUEST['act'] == 'get_article_list') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			$filters = (array) $json->decode(json_str_iconv($_GET['JSON']));
			$where = ' WHERE cat_id > 0 ';

			if (!empty($filters['title'])) {
				$keyword = trim($filters['title']);
				$where .= ' AND title LIKE \'%' . mysql_like_quote($keyword) . '%\' ';
			}

			$sql = 'SELECT article_id, title FROM ' . $ecs->table('article') . $where . 'ORDER BY article_id DESC LIMIT 50';
			$res = $db->query($sql);
			$arr = array();

			while ($row = $db->fetchRow($res)) {
				$arr[] = array('value' => $row['article_id'], 'text' => $row['title'], 'data' => '');
			}

			make_json_result($arr);
		}
		else if ($_REQUEST['act'] == 'add_goods_article') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$articles = $json->decode($_GET['add_ids']);
			$arguments = $json->decode($_GET['JSON']);
			$goods_id = $arguments[0];

			foreach ($articles as $val) {
				$sql = 'INSERT INTO ' . $ecs->table('goods_article') . ' (goods_id, article_id, admin_id) ' . ('VALUES (\'' . $goods_id . '\', \'' . $val . '\', \'' . $_SESSION['admin_id'] . '\')');
				$db->query($sql);
			}

			$arr = get_goods_articles($goods_id);
			$opt = array();

			foreach ($arr as $val) {
				$opt[] = array('value' => $val['article_id'], 'text' => $val['title'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($opt);
		}
		else if ($_REQUEST['act'] == 'drop_goods_article') {
			include_once ROOT_PATH . 'includes/cls_json.php';
			$json = new JSON();
			check_authz_json('goods_manage');
			$articles = $json->decode($_GET['drop_ids']);
			$arguments = $json->decode($_GET['JSON']);
			$goods_id = $arguments[0];
			$sql = 'DELETE FROM ' . $ecs->table('goods_article') . ' WHERE ' . db_create_in($articles, 'article_id');
			$db->query($sql);
			$arr = get_goods_articles($goods_id);
			$opt = array();

			foreach ($arr as $val) {
				$opt[] = array('value' => $val['article_id'], 'text' => $val['title'], 'data' => '');
			}

			clear_cache_files();
			make_json_result($opt);
		}
	}
}

?>
