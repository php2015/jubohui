<?php
//多点乐资源
function get_commission_list($commission_list)
{
	if ($commission_list) {
		foreach ($commission_list as $key => $rows) {
			$commission_list[$key]['amount'] = $rows['amount'];
			$sql = 'SELECT user_id FROM ' . $GLOBALS['ecs']->table('users') . ' WHERE user_name = \'' . $rows['user_name'] . '\' LIMIT 1';
			$users = $GLOBALS['db']->getRow($sql);
			$commission_list[$key]['user_id'] = $users['user_id'];
			$commission_list[$key]['repay_term'] = $rows['repay_term'];
			$commission_list[$key]['over_repay_trem'] = $rows['over_repay_trem'];

			if (!$users['user_id']) {
				unset($commission_list[$key]);
			}
		}
	}

	return $commission_list;
}

define('IN_ECS', true);
require dirname(__FILE__) . '/includes/init.php';
$lang_list = array('UTF8' => $_LANG['charset']['utf8'], 'GB2312' => $_LANG['charset']['zh_cn'], 'BIG5' => $_LANG['charset']['zh_tw']);
$download_list = array();
$smarty->assign('lang_list', $lang_list);
$ur_here = $_LANG['14_batch_add'];
$smarty->assign('ur_here', $ur_here);

if ($_REQUEST['act'] == 'add') {
	admin_priv('commission_batch');
	$smarty->assign('full_page', 1);
	assign_query_info();
	$smarty->display('baitiao_batch_add.dwt');
}
else if ($_REQUEST['act'] == 'baitiao_add') {
	if ($_FILES['file']['name']) {
		$line_number = 0;
		$arr = array();
		$commission_list = array();
		$field_list = array_keys($_LANG['upload_baitiao']);
		$_POST['charset'] = 'GB2312';
		$data = file($_FILES['file']['tmp_name']);

		if (0 < count($data)) {
			foreach ($data as $line) {
				if ($line_number == 0) {
					$line_number++;
					continue;
				}

				if (($_POST['charset'] != 'UTF8') && (strpos(strtolower(EC_CHARSET), 'utf') === 0)) {
					$line = ecs_iconv($_POST['charset'], 'UTF8', $line);
				}

				$arr = array();
				$buff = '';
				$quote = 0;
				$len = strlen($line);

				for ($i = 0; $i < $len; $i++) {
					$char = $line[$i];

					if ('\\' == $char) {
						$i++;
						$char = $line[$i];

						switch ($char) {
						case '"':
							$buff .= '"';
							break;

						case '\'':
							$buff .= '\'';
							break;

						case ',':
							$buff .= ',';
							break;

						default:
							$buff .= '\\' . $char;
							break;
						}
					}
					else if ('"' == $char) {
						if (0 == $quote) {
							$quote++;
						}
						else {
							$quote = 0;
						}
					}
					else if (',' == $char) {
						if (0 == $quote) {
							if (!isset($field_list[count($arr)])) {
								continue;
							}

							$field_name = $field_list[count($arr)];
							$arr[$field_name] = trim($buff);
							$buff = '';
							$quote = 0;
						}
						else {
							$buff .= $char;
						}
					}
					else {
						$buff .= $char;
					}

					if ($i == ($len - 1)) {
						if (!isset($field_list[count($arr)])) {
							continue;
						}

						$field_name = $field_list[count($arr)];
						$arr[$field_name] = trim($buff);
					}
				}

				$commission_list[] = $arr;
			}
		}
	}

	$commission_list = get_commission_list($commission_list);
	$_SESSION['baitiao_list'] = $commission_list;
	$smarty->assign('full_page', 2);
	$smarty->assign('page', 1);
	assign_query_info();
	$smarty->display('baitiao_batch_add.dwt');
}
else if ($_REQUEST['act'] == 'ajax_insert') {
	admin_priv('commission_batch');
	include_once ROOT_PATH . 'includes/cls_json.php';
	$json = new JSON();
	$page = (!empty($_REQUEST['page']) ? intval($_REQUEST['page']) : 1);
	$page_size = (isset($_REQUEST['page_size']) ? intval($_REQUEST['page_size']) : 1);
	@set_time_limit(300);
	if (isset($_SESSION['baitiao_list']) && $_SESSION['baitiao_list']) {
		$commission_list = $_SESSION['baitiao_list'];
		$commission_list = $ecs->page_array($page_size, $page, $commission_list);
		$result['list'] = $commission_list['list'][0];
		$result['page'] = $commission_list['filter']['page'] + 1;
		$result['page_size'] = $commission_list['filter']['page_size'];
		$result['record_count'] = $commission_list['filter']['record_count'];
		$result['page_count'] = $commission_list['filter']['page_count'];

		if (empty($result['list']['user_name'])) {
			$result['list']['user_name'] = 0;
		}

		$result['is_stop'] = 1;

		if ($commission_list['filter']['page_count'] < $page) {
			$result['is_stop'] = 0;
		}

		$sql = 'SELECT baitiao_id FROM ' . $GLOBALS['ecs']->table('baitiao') . ' WHERE user_id = \'' . $result['list']['user_id'] . '\'';

		if ($GLOBALS['db']->getOne($sql)) {
			$result['status_lang'] = $GLOBALS['_LANG']['already_show'];
		}
		else if ($result['is_stop']) {
			$other = array('user_id' => $result['list']['user_id'], 'amount' => $result['list']['amount'], 'repay_term' => $result['list']['repay_term'], 'over_repay_trem' => $result['list']['over_repay_trem'], 'add_time' => gmtime());
			$db->autoExecute($ecs->table('baitiao'), $other, 'INSERT');

			if ($db->insert_id()) {
				$result['status_lang'] = $GLOBALS['_LANG']['status_succeed'];
			}
			else {
				$result['status_lang'] = $GLOBALS['_LANG']['status_failure'];
			}
		}
	}

	exit($json->encode($result));
}
else if ($_REQUEST['act'] == 'download') {
	admin_priv('commission_batch');
	header('Content-type: application/vnd.ms-excel; charset=utf-8');
	Header('Content-Disposition: attachment; filename=baitiao_list.csv');

	if ($_GET['charset'] != $_CFG['lang']) {
		$lang_file = '../languages/' . $_GET['charset'] . '/' . ADMIN_PATH . '/baitiao_batch.php';

		if (file_exists($lang_file)) {
			unset($_LANG['upload_baitiao']);
			require $lang_file;
		}
	}

	if (isset($_LANG['upload_baitiao'])) {
		if (($_GET['charset'] == 'zh_cn') || ($_GET['charset'] == 'zh_tw')) {
			$to_charset = ($_GET['charset'] == 'zh_cn' ? 'GB2312' : 'BIG5');
			echo ecs_iconv(EC_CHARSET, $to_charset, join(',', $_LANG['upload_baitiao']));
		}
		else {
			echo join(',', $_LANG['upload_baitiao']);
		}
	}
	else {
		echo 'error: $_LANG[upload_baitiao] not exists';
	}
}

?>
