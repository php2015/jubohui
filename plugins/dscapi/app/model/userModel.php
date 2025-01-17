<?php
//大商创网络
namespace app\model;

abstract class userModel extends \app\func\common
{
	private $alias_config;

	public function __construct()
	{
		$this->userModel();
	}

	public function userModel($table = '')
	{
		$this->alias_config = array('users' => 'u', 'user_rank' => 'ur', 'user_address' => 'ua');

		if ($table) {
			return $this->alias_config[$table];
		}
		else {
			return $this->alias_config;
		}
	}

	public function get_where($val = array(), $alias = '')
	{
		$where = 1;
		$where .= \app\func\base::get_where($val['user_id'], $alias . 'user_id');
		$where .= \app\func\base::get_where($val['user_name'], $alias . 'user_name');
		$where .= \app\func\base::get_where($val['mobile'], $alias . 'mobile_phone');
		$where .= \app\func\base::get_where($val['rank_id'], $alias . 'rank_id');
		$where .= \app\func\base::get_where($val['rank_name'], $alias . 'rank_name');
		$where .= \app\func\base::get_where($val['address_id'], $alias . 'address_id');
		return $where;
	}

	public function get_select_list($table, $select, $where, $page_size, $page, $sort_by, $sort_order)
	{
		$sql = 'SELECT COUNT(*) FROM ' . $GLOBALS['ecs']->table($table) . ' WHERE ' . $where;
		$result['record_count'] = $GLOBALS['db']->getOne($sql);

		if ($sort_by) {
			$where .= ' ORDER BY ' . $sort_by . ' ' . $sort_order . ' ';
		}

		$where .= ' LIMIT ' . ($page - 1) * $page_size . (',' . $page_size);
		$sql = 'SELECT ' . $select . ' FROM ' . $GLOBALS['ecs']->table($table) . ' WHERE ' . $where;
		$result['list'] = $GLOBALS['db']->getAll($sql);
		return $result;
	}

	public function get_select_info($table, $select, $where)
	{
		$sql = 'SELECT ' . $select . ' FROM ' . $GLOBALS['ecs']->table($table) . ' WHERE ' . $where . ' LIMIT 1';
		$result = $GLOBALS['db']->getRow($sql);
		return $result;
	}

	public function get_insert($table, $select, $format)
	{
		$config = array_flip($this->userModel());
		$userLang = \languages\userLang::lang_user_insert();
		$GLOBALS['db']->autoExecute($GLOBALS['ecs']->table($table), $select, 'INSERT');
		$id = $GLOBALS['db']->insert_id();
		$info = $select;

		if ($id) {
			if ($table == $config['u']) {
				$info['user_id'] = $id;
			}
			else if ($table == $config['ur']) {
				$info['rank_id'] = $id;
			}
			else if ($table == $config['ua']) {
				$info['address_id'] = $id;
			}
		}

		$common_data = array('result' => 'success', 'msg' => $userLang['msg_success']['success'], 'error' => $userLang['msg_success']['error'], 'format' => $format, 'info' => $info);
		\app\func\common::common($common_data);
		return \app\func\common::data_back();
	}

	public function get_update($table, $select, $where, $format, $info = array())
	{
		$userLang = \languages\userLang::lang_user_update();
		$GLOBALS['db']->autoExecute($GLOBALS['ecs']->table($table), $select, 'UPDATE', $where);

		if ($info) {
			foreach ($info as $key => $row) {
				if (isset($select[$key])) {
					$info[$key] = $select[$key];
				}
			}
		}
		else {
			$info = $select;
		}

		$common_data = array('result' => 'success', 'msg' => $userLang['msg_success']['success'], 'error' => $userLang['msg_success']['error'], 'format' => $format, 'info' => $info);
		\app\func\common::common($common_data);
		return \app\func\common::data_back();
	}

	public function get_delete($table, $where, $format)
	{
		$userLang = \languages\userLang::lang_user_delete();
		$return = false;

		if (strlen($where) != 1) {
			$sql = 'DELETE FROM ' . $GLOBALS['ecs']->table($table) . ' WHERE ' . $where;
			$GLOBALS['db']->query($sql);
			$return = true;
		}
		else {
			$error = \languages\userLang::DEL_NULL_PARAM_FAILURE;
		}

		$common_data = array('result' => $return ? 'success' : 'failure', 'msg' => $return ? $userLang['msg_success']['success'] : $userLang['msg_failure'][$error]['failure'], 'error' => $return ? $userLang['msg_success']['error'] : $userLang['msg_failure'][$error]['error'], 'format' => $format);
		\app\func\common::common($common_data);
		return \app\func\common::data_back();
	}

	public function get_list_common_data($result, $page_size, $page, $userLang, $format)
	{
		$common_data = array('page_size' => $page_size, 'page' => $page, 'result' => empty($result) ? 'failure' : 'success', 'msg' => empty($result) ? $userLang['msg_failure']['failure'] : $userLang['msg_success']['success'], 'error' => empty($result) ? $userLang['msg_failure']['error'] : $userLang['msg_success']['error'], 'format' => $format);
		\app\func\common::common($common_data);
		$result = \app\func\common::data_back($result, 1);
		return $result;
	}

	public function get_info_common_data_fs($result, $userLang, $format)
	{
		$common_data = array('result' => empty($result) ? 'failure' : 'success', 'msg' => empty($result) ? $userLang['msg_failure']['failure'] : $userLang['msg_success']['success'], 'error' => empty($result) ? $userLang['msg_failure']['error'] : $userLang['msg_success']['error'], 'format' => $format);
		\app\func\common::common($common_data);
		$result = \app\func\common::data_back($result);
		return $result;
	}

	public function get_info_common_data_f($userLang, $format)
	{
		$result = array();
		$common_data = array('result' => 'failure', 'msg' => $userLang['where_failure']['failure'], 'error' => $userLang['where_failure']['error'], 'format' => $format);
		\app\func\common::common($common_data);
		$result = \app\func\common::data_back($result);
		return $result;
	}
}

?>
