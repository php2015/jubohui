<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
namespace App\Modules\Manage\Controllers;

class IndexController extends \App\Modules\Base\Controllers\FrontendController
{
	public function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

	}

	public function actionIndex()
	{
		// print_r(session());exit;
		if(!empty(session('manager_id'))){
			$user_id = session('manager_id');
			// print_r($user_id);exit;
			$users = dao('users')->where(array('user_id' => $user_id))->find();
			// print_r($users);exit;
			// 计调端
			if($users['user_rank'] == '15'){
				$this->redirect('Manage');
			}else{
				$this->error("您没有权限操作");
			}		
		}else{
			$this->display();
		}		
	}
	
	public function actionLogin()
	{
		// print_r($_POST);exit;
		if(!empty($_POST)){
			// $users = dao('users')->where(array('user_name' => $_POST['user_name'],'password' => $_POST['user_name']))->find();
			$users = dao('users')->where(array('user_name' => $_POST['user_name']))->find();
			// print_r($users['password']);
			// print_r(md5($_POST['password']));exit;
			// print_r(md5(md5($_POST['password']) . $users['ec_salt']));exit;
			// print_r($users);exit;
			if(!empty($users)){
				if($_POST['user_name'] == $users['user_name'] && md5($_POST['password']) == $users['password'] || md5(md5($_POST['password']) . $users['ec_salt']) == $users['password']){
					session('manage_name',$users['user_name']);
					session('manager_id',$users['user_id']);
					session('user_rank',$users['user_rank']);
					// 外部设计师管理
					if($users['user_rank'] == '15'){
						$results['url'] = __APP__.'?m=manage&a=manage';
						$results['code'] = '1';
						$results['msg'] = '登录成功';
						$this->ajaxReturn($results);
					}else{
						$results['code'] = '0';
						$results['msg'] = '您没有权限操作';
						$this->ajaxReturn($results);
					}					
				}else{
					$results['code'] = '2';
					$results['msg'] = '密码错误，请重新输入';
					$this->ajaxReturn($results);
				}
			}else{
				$results['code'] = '0';
				$results['msg'] = '没有该账号';
				$this->ajaxReturn($results);
			}
		}
	}

	// 外部设计师管理——首页
	public function actionManage()
	{
		if(!empty(session('manager_id'))){
			$users = dao('users')->where(array('user_id' => session('manager_id')))->find();
			
			if($users['user_rank'] == '15'){
				
				$this->display();
			}else{
				$this->error("您没有权限操作");
			}
			
		}else{
			$this->redirect("Index");
		}

	}
	
	// 设计师审核
	public function actionExamine()
	{
		// 待审核
		$sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
			   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
			   (" WHERE u.user_rank = 0 and d.user_id != '' and d.is_pass = 0 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
		$nodesignList = $GLOBALS['db']->getAll($sql);
		// print_r($nodesignList);exit;
		
		// 已审核
		// $alldesignList = dao('users')->where('user_rank = 14')->select();
		$sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
			   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
			   (" WHERE u.user_rank = 14 and d.is_pass = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
		$alldesignList = $GLOBALS['db']->getAll($sql);
		// print_r($alldesignList);exit;
		
		$this->assign('nodesignList', $nodesignList);
		$this->assign('alldesignList', $alldesignList);
		$this->display();
	}
	
	// 未审核详情
	public function actionNoexamine(){
		if(!empty($_GET['id'])){
			$user_id = $_GET['id'];
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_id = ".$user_id." and d.is_pass = 0 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
			$user = $GLOBALS['db']->getRow($sql);
			// print_r($user);exit;
			$this->assign('user', $user);
			$this->display();
		}else{
			$this->error("没有ID值");
		}
	}
	
	// 审核结果提交
	public function actionForm(){
		if(!empty($_POST)){
			// 审核申请已查看
			$Design = D("design");
			$Design->create();
			$Design->is_pass = 1;
			$result = $Design->where('design_id='.$_POST['design_id'])->save();	
			
			if($result){
				// 审核通过
				if($_POST['decision'] == 1){							
					$User = D("users");
					$User->create();
					$User->user_rank = 14;
					$result_ = $User->where('user_id='.$_POST['user_id'])->save();
					if($result_){
						$this->redirect("Examine");
					}else{
						$this->error("修改审核结果失败");
					}
				}
				// 审核未通过
				elseif($_POST['decision'] == 2){
					$this->redirect("Examine");
				}
				
			}else{
				$this->error("修改审核申请失败");
			}
		}else{
			$this->error("审核结果提交失败");
		}
	}
	
	// 已审核详情
	public function actionCheckexamine(){
		if(!empty($_GET['id'])){
			$user_id = $_GET['id'];
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_id = ".$user_id." and d.is_pass = 0 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
			$user = $GLOBALS['db']->getRow($sql);
			$this->assign('user', $user);
			$this->display();
		}else{
			$this->error("没有ID值");
		}
	}
	
	// 设计师管理
	public function actionDesingmanage(){
		if(!empty($_POST)){
			$where = '';
			if(!empty($_POST['user_name'])){
				$where .= " and d.design_name like '%".$_POST['user_name']."%'";
				$this->assign('design_name', $_POST['user_name']);
			}
			$sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_rank = 14 and d.is_pass = 1 ".$where." ORDER BY d.design_id desc, d.add_time asc ");
			$designList = $GLOBALS['db']->getAll($sql);
			// print_r($designList);exit;
		}else{
			$sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_rank = 14 and d.is_pass = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
			$designList = $GLOBALS['db']->getAll($sql);
			// print_r($designList);exit;			
		}

		$this->assign('designList', $designList);
		$this->display();
	}
	
	// 设计师详情
	public function actionDesingdetails(){
		if(!empty($_GET['id'])){
			$user_id = $_GET['id'];
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_id = ".$user_id." and d.is_pass = 0 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
			$user = $GLOBALS['db']->getRow($sql);
			$this->assign('user', $user);
			$this->display();
		}else{
			$this->error("没有ID值");
		}
	}
	
	// 任务管理
	public function actionTask(){
		/* $sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('task') . ' AS u' . 
			   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
			   (" WHERE u.user_rank = 14 and d.is_pass = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
		$designList = $GLOBALS['db']->getAll($sql); */
		// 用户列表
		$userList = dao('users')->where()->select();
		// print_r($userList);exit;
		// 未接单
		$notaskList = dao('task')->where('is_receive = 0')->select();
		$notasCount = dao('task')->where('is_receive = 0')->count();
		
		// 进行中
		$ingtaskList = dao('task')->where('is_receive = 1')->select();
		$ingtaskCount = dao('task')->where('is_receive = 1')->count();
		
		// 已完成
		$finishtaskList = dao('task')->where('is_receive = 3')->select();
		$finishtaskCount = dao('task')->where('is_receive = 3')->count();

		// print_r($notaskList);exit;
		$this->assign('notaskList', $notaskList);
		$this->assign('notasCount', $notasCount);
		$this->assign('ingtaskList', $ingtaskList);
		$this->assign('ingtaskCount', $ingtaskCount);
		$this->assign('finishtaskList', $finishtaskList);
		$this->assign('finishtaskCount', $finishtaskCount);
		$this->assign('userList', $userList);
		$this->display();
	}
	
	// 未接单信息
	public function actionNotask(){
		if(!empty($_GET['id'])){
			$task = dao('task')->where('task_id = '.$_GET['id'])->find();
			// print_r($task);exit;
			$this->assign('task', $task);
			$this->display();
		}else{
			$this->error("未获取到ID值");
		}
		
	}
	
	// 工作台
	public function actionWork(){
		// 查找城市
		$url = _ASHIN_.'/getAllCityList.do?method=getAllCityList_sc';
		// 发送请求
		$ret = doCurl($url,$data='');
		// 返回數據
		// print_r($ret);
		// 转码
		$city = json_decode($ret, true);
		// print_r($city[apartment]);exit;
		$cityList = $city['apartment'];
		if(!empty($cityList)){
			// 转译城市名
			foreach($cityList as $k => $v){
				$cityList[$k]['cityName'] = unicodeDecode($v['cityName']);
			}			
		}
		// print_r($cityList);exit;
		if(!empty($_POST)){
			// print_r($_POST);exit;
			// 获取楼盘数据
			$url2 = _ASHIN_.'/getLouPanByNameCity.do?method=getLouPanByNameCity_sc';
			$data = array(
				'current_city' => $_POST['city_id'],
				'loupan_name' => $_POST['loupan_name']
			);
			// print_r($data);exit;
			// 发送请求
			$loupan = doCurl($url2,$data); 
			// 转码
			$loupan = json_decode($loupan, true);
			// print_r($loupan);exit;
			// print_r($loupanList[0]['loupan_id']);exit;
			$loupanList = $loupan['apartment'];
			if(!empty($loupanList)){
				// 转译楼盘名
				foreach($loupanList as $k => $v){
					$loupanList[$k]['loupan_name'] = unicodeDecode($v['loupan_name']);
				}			
			}
			// print_r($loupanList);exit;
			if(count($loupanList) == 1){
				$url3 = _ASHIN_.'/getHuXingByLouPanId.do?method=getHuXingByLouPanId_sc';
				$data3 = array(
					'loupanId' => $loupanList[0]['loupan_id']
				);
				// 发送请求
				$huxing = doCurl($url3,$data3);
				// 转码
				$huxing = json_decode($huxing, true);
				// print_r($huxing);exit;
				if($huxing['code'] == 1){
					$huxingList = $huxing['apartment'];
					foreach($huxingList as $k => $v){
						$huxingList[$k]['huxingName'] = unicodeDecode($v['huxingName']);
					}
					$this->assign('cityId', $huxing[0]['cityId']);	
					$this->assign('huxingList', $huxingList);					
				}else{
					$this->error('未获取到户型信息');
				}			
				
				$this->assign('loupan_name', $_POST['loupan_name']);
				$this->assign('loupan_id', $loupanList[0]['loupan_id']);
				
			}
			// print_r($loupanList['cityId']);exit;
			$this->assign('cityId', $loupan['cityId']);
			$this->assign('loupanList', $loupanList);
		}
		$this->assign('cityList', $cityList);
		$this->display();
	}
	
	// 查找楼盘下的户型
	public function actionFindLoupan(){
		if(!empty($_POST['loupan_id'])){
			$url = _ASHIN_.'/getHuXingByLouPanId.do?method=getHuXingByLouPanId_sc';
			$data = array(
				'loupanId' => $_POST['loupan_id']
			);
			// 发送请求
			$huxing = doCurl($url,$data);
			// 转码
			$huxing = json_decode($huxing, true);
			// print_r($huxing);exit;
			if($huxing['code'] == 1){
				$huxingList = $huxing['apartment'];
				foreach($huxingList as $k => $v){
					$huxingList[$k]['huxingName'] = unicodeDecode($v['huxingName']);
				}
				if($huxingList){
					$results['code'] = '1';
					$results['msg'] = '查找户型成功';
					$results['data'] = $huxingList;
					$this->ajaxReturn($results);	
				}else{
					$results['code'] = '0';
					$results['msg'] = '查找户型失败';
					$this->ajaxReturn($results);
				}
			}else{
				$results['code'] = '0';
				$results['msg'] = '获取户型接口失败';
				$this->ajaxReturn($results);
			}			
		}else{
			$results['code'] = '2';
			$results['msg'] = '没有id值';
			$this->ajaxReturn($results);
		}
	}
	
	// 查找指定户型
	public function actionFindHuxing(){
		if(!empty($_POST['huxing_id'])){
			$url = _ASHIN_.'/getHuXingByLouPanId.do?method=getHuXingByHuxingId_sc';
			$data = array(
				'huxing_id' => $_POST['huxing_id']
			);
			// 发送请求
			$huxing = doCurl($url,$data);
			// 转码
			$huxing = json_decode($huxing, true);
			// print_r($huxing);exit;
			if($huxing['code'] == 1){
				$huxing['huxingName'] = unicodeDecode($huxing['apartment']['huxingName']);
				$huxing['huxingMsg'] = $huxing['apartment']['huxingMsg'];
				$huxing['huxingId'] = $huxing['apartment']['huxingId'];
				$huxing['huxingPic'] = $huxing['apartment']['huxingPic'];
				// print_r($huxing);exit;
				$results['code'] = '1';
				$results['msg'] = '查找户型成功';
				$results['data'] = $huxing;
				$this->ajaxReturn($results);
			}else{
				$results['code'] = '0';
				$results['msg'] = '查找户型失败';
				$this->ajaxReturn($results);
			}
			
		}else{
			$results['code'] = '0';
			$results['msg'] = '没有id值';
			$this->ajaxReturn($results);
		}
	}
	
	// 选择设计师
	public function actionChoose(){
		// print_r($_POST);exit;
		if(!empty($_POST)){
			$where = '';
			if(!empty($_POST['user_name'])){
				$where .= " and user_name like '%".$_POST['user_name']."%'";
				$this->assign('design_name', $_POST['user_name']);
			}
			
			$userList = dao('users')->where('user_rank = 14'.$where)->select();
			// print_r($userList);exit;
			// print_r($users);exit;
			$this->assign('userList', $userList);
			$this->assign('huxingId', $_POST['huxingId']);
			$this->assign('loupan_id', $_POST['loupan_id']);
			$this->assign('price', $_POST['price']);
			$this->assign('user_id', $_POST['user_id']);
			$this->display();
		}
		if(!empty($_GET)){
			$userList = dao('users')->where('user_rank = 14'.$where)->select();
			// print_r($userList);exit;
			$this->assign('userList', $userList);
			$this->assign('huxingId', $_GET['huxingId']);
			$this->assign('loupan_id', $_GET['loupan_id']);
			$this->assign('price', $_GET['price']);
			$this->display();
		}
	}
	
	// 查看设计师
	public function actionDesign(){
		// print_r($_GET);exit;
		if(!empty($_GET)){
			// 设计师信息
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_rank = 14 and d.is_pass = 1 and u.user_id = ".$_GET['id']);
			$design = $GLOBALS['db']->getRow($sql);	
			// print_r($design);exit;
			
			// 任务信息
			/* $sql = 'SELECT u.*, d.design_name, d.add_time FROM ' . $GLOBALS['ecs']->table('task') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE u.user_rank = 14 and d.is_pass = 1 and u.user_id = ".$_GET['id']);
			$design = $GLOBALS['db']->getRow($sql); */
			$taskList = dao('task')->where('design_id = '.$_GET['id'])->select();
			// print_r($taskList);exit;
			$this->assign('design', $design);
			$this->assign('huxingId', $_GET['huxingId']);
			$this->assign('price', $_GET['price']);
			$this->display();
		}else{
			$this->error('未提交设计师ID');
		}
	}
	
	// 选择指定设计师
	public function actionChooseDesign(){
		// print_r($_POST);exit;
		// print_r(session());exit;
		if(!empty($_POST)){
			$Task = D("task");
			$Task->create();
			$Task->huxing_id = $_POST['huxingId'];
			$Task->loupan_id = $_POST['loupan_id'];
			$Task->total_price = $_POST['price'];
			$Task->design_id = $_POST['user_id'];
			$Task->manage_id = session('manager_id');
			$Task->add_time = time();
			$result = $Task->add();
			if($result){
				$results['code'] = '1';
				$results['url'] = __APP__.'?m=manage&a=Task';
				$results['msg'] = '提交成功';
				$this->ajaxReturn($results);
			}else{
				$results['code'] = '0';
				$results['msg'] = '保存进task表失败';
				$this->ajaxReturn($results);
			}
		}else{
			$results['code'] = '0';
			$results['msg'] = '没有post值';
			$this->ajaxReturn($results);
		}
	}
	
	// 退出登录
	public function actionSignOut()
	{
		// print_r(session());exit;
		session('manage_name',null);
		session('manager_id',null);
		$this->redirect("Index");
	}
}

?>
