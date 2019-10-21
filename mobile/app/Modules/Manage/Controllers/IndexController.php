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
		if(checkPower()){
			$this->redirect('Manage');
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
		// print_r(checkPower());exit;
		if(checkPower()){
			$this->display();
		}else{
			$this->redirect("Index");
		}
	}
	
	// 设计师审核
	public function actionExamine()
	{
		if(checkPower()){
			// 待审核
			$sql = 'SELECT u.*, d.design_id, d.design_name, d.phone, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE d.is_check = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
			$nodesignList = $GLOBALS['db']->getAll($sql);
			// print_r($nodesignList);exit;
			
			// 已审核
			// $alldesignList = dao('users')->where('user_rank = 14')->select();
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE d.is_check = 2 ORDER BY d.design_id desc, d.add_time desc ");
			$alldesignList = $GLOBALS['db']->getAll($sql);
			// print_r($alldesignList);exit;
			
			$this->assign('nodesignList', $nodesignList);
			$this->assign('alldesignList', $alldesignList);
			$this->display();			
		}else{
			$this->redirect("Index");
		}

	}
	
	// 未审核详情
	public function actionNoexamine(){
		if(checkPower()){
			if(!empty($_GET['id'])){
				$design_id = $_GET['id'];
				$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE d.design_id = ".$design_id." and d.is_pass = 0 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
				$user = $GLOBALS['db']->getRow($sql);
				// print_r($user);exit;
				$this->assign('user', $user);
				$this->display();
			}else{
				$this->error("没有ID值");
			}		
		}else{
			$this->redirect("Index");
		}

	}
	
	// 审核结果提交
	public function actionForm(){		
		if(checkPower()){
			// print_r($_POST);
			if(!empty($_POST)){
				// 审核申请已查看
				$Design = D("design");
				$Design->create();
				$Design->is_check = 2;
				$Design->is_pass = $_POST['decision'];
				$result = $Design->where('design_id='.$_POST['design_id'])->save();	
				// print_r($result);exit;
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
		}else{
			$this->redirect("Index");
		}
	}
	
	// 已审核详情
	public function actionCheckexamine(){
		if(checkPower()){
			if(!empty($_GET['id'])){
				$design_id = $_GET['id'];
				$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE d.design_id = ".$design_id);
				$user = $GLOBALS['db']->getRow($sql);
				// print_r($user);exit;
				$this->assign('user', $user);
				$this->display();
			}else{
				$this->error("没有ID值");
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 设计师管理
	public function actionDesingmanage(){
		if(checkPower()){
			if(!empty($_POST)){
				$where = '';
				if(!empty($_POST['user_name'])){
					$where .= " and d.design_name like '%".$_POST['user_name']."%'";
					$this->assign('design_name', $_POST['user_name']);
				}
				$sql = 'SELECT u.*, d.design_name, d.phone, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE u.user_rank = 14 and d.is_pass = 1 ".$where." ORDER BY d.design_id desc, d.add_time asc ");
				$designList = $GLOBALS['db']->getAll($sql);
				// print_r($designList);exit;
			}else{
				$sql = 'SELECT u.*, d.design_name, d.phone, d.add_time FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE u.user_rank = 14 and d.is_pass = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
				$designList = $GLOBALS['db']->getAll($sql);
				// print_r($designList);exit;			
			}

			$this->assign('designList', $designList);
			$this->display();
		}else{
			$this->redirect("Index");
		}
	}
	
	// 设计师详情
	public function actionDesingdetails(){
		if(checkPower()){
			if(!empty($_GET['id'])){
				// 设计师信息
				$user_id = $_GET['id'];
				$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE u.user_id = ".$user_id." and d.is_pass = 1 group by d.user_id ORDER BY d.design_id desc, d.add_time asc ");
				$user = $GLOBALS['db']->getRow($sql);
				// print_r($user);exit;
				// 任务信息
				// 已完成
				$finish = dao('task')->where("design_id = ".$user_id." and is_receive = 3")->count();
				
				// 未接单
				$unknown = dao('task')->where("design_id = ".$user_id." and is_receive = 0")->count();
				
				// 设计中
				$designing = dao('task')->where("design_id = ".$user_id." and is_receive = 1")->count();
				
				$this->assign('user', $user);
				$this->assign('finish', $finish);
				$this->assign('unknown', $unknown);
				$this->assign('designing', $designing);
				$this->display();
			}else{
				$this->error("没有ID值");
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 任务管理
	public function actionTask(){
		if(checkPower()){
			// 用户列表
			$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (" WHERE d.is_pass = 1 and u.user_rank = 14 group by d.user_id");
			$designList = $GLOBALS['db']->getAll($sql);
			// print_r($user);exit;
			// $designList = dao('design')->where('is_pass = 1 ')->select();
			// print_r($designList);exit;
			
			// 未接单
			$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
				   (" WHERE d.is_pass = 1 and t.is_receive = 0");
			$notaskList = $GLOBALS['db']->getAll($sql);
			
			// $notaskList = dao('task')->where('is_receive = 0')->select();
			$notasCount = dao('task')->where('is_receive = 0')->count();
			
			// 进行中
			$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
				   (" WHERE d.is_pass = 1 and t.is_receive = 1");
			$ingtaskList = $GLOBALS['db']->getAll($sql);
			// $ingtaskList = dao('task')->where('is_receive = 1')->select();
			$ingtaskCount = dao('task')->where('is_receive = 1')->count();
			
			// 已完成
			$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
				   (" WHERE d.is_pass = 1 and t.is_receive = 3");
			$finishtaskList = $GLOBALS['db']->getAll($sql);
			// $finishtaskList = dao('task')->where('is_receive = 3')->select();
			$finishtaskCount = dao('task')->where('is_receive = 3')->count();
			
			// print_r($finishtaskList);exit;
			$this->assign('notaskList', $notaskList);
			$this->assign('notasCount', $notasCount);
			$this->assign('ingtaskList', $ingtaskList);
			$this->assign('ingtaskCount', $ingtaskCount);
			$this->assign('finishtaskList', $finishtaskList);
			$this->assign('finishtaskCount', $finishtaskCount);
			$this->assign('designList', $designList);
			$this->display();
		}else{
			$this->redirect("Index");
		}
	}
	
	// 未接单信息
	public function actionNotask(){
		if(checkPower()){
			if(!empty($_GET['id'])){				
				$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
					   (" WHERE d.is_pass = 1 and t.task_id = ".$_GET['id']);
				$task = $GLOBALS['db']->getRow($sql);
				// print_r($task);exit;
				
				$this->assign('task', $task);
				$this->display();
			}else{
				$this->error("未获取到ID值");
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 进行中信息
	public function actionIngtask(){
		if(checkPower()){
			if(!empty($_GET['id'])){
				$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
					   (" WHERE d.is_pass = 1 and t.task_id = ".$_GET['id']);
				$task = $GLOBALS['db']->getRow($sql);
				// print_r($task);exit;
				
				$this->assign('task', $task);
				$this->display();
			}else{
				$this->error("未获取到ID值");
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 完成任务操作
	public function actionComplete(){
		if(checkPower()){
			if(!empty($_POST)){
				$Task = M("task"); // 实例化User对象			
				$Task->create();			
				$Task->is_receive = 3;
				$Task->finish_time = time();
				$result = $Task->where('task_id = '.$_POST['task_id'])->save();
				if($result){
					$results['url'] = __APP__.'?m=manage&a=task';
					$results['code'] = '1';
					$results['msg'] = '改变状态成功！';
					$this->ajaxReturn($results);
				}else{
					$results['code'] = '0';
					$results['msg'] = '改变状态失败！';
					$this->ajaxReturn($results);
				}
			}else{
				$results['code'] = '0';
				$results['msg'] = '没有id值';
				$this->ajaxReturn($results);
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 已完成信息
	public function actionFinishtask(){
		if(checkPower()){
			if(!empty($_GET['id'])){
				$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id' . 
					   (" WHERE d.is_pass = 1 and t.task_id = ".$_GET['id']);
				$task = $GLOBALS['db']->getRow($sql);
				
				// print_r($task);exit;
				$this->assign('task', $task);
				$this->display();
			}else{
				$this->error("未获取到ID值");
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 工作台
	public function actionWork(){
		if(checkPower()){
			// 查找城市
			$url = _ASHIN_.'/getAllCityList.do?method=getAllCityList_sc';
			// 发送请求
			$ret = doCurl($url,$data='');
			// 返回數據
			// print_r($ret);
			// 转码
			$city = json_decode($ret, true);
			// print_r($city);exit;
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
				// print_r($loupanList);exit;
				$this->assign('cityId', $loupan['cityId']);
				$this->assign('loupanList', $loupanList);
			}
			$this->assign('cityList', $cityList);
			$this->display();
		}else{
			$this->redirect("Index");
		}
	}
	
	// 查找楼盘下的户型
	public function actionFindLoupan(){
		if(checkPower()){
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
					// print_r($huxingList);exit;
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
		}else{
			$results['code'] = '2';
			$results['msg'] = '未登录或没有权限';
			$this->ajaxReturn($results);
			// $this->redirect("Index");
		}
	}
	
	// 查找指定户型
	public function actionFindHuxing(){
		if(checkPower()){
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
					
					$huxing['huxing_class'] = $huxing['apartment']['hxStypeid'];
					$huxing['huxing_classname'] = $huxing['apartment']['typeName'];
					$huxing['loupan_introduce'] = $huxing['loupanMsg'];
					$huxing['loupan_img'] = $huxing['loupanPic'];
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
		}else{
			$results['code'] = '0';
			$results['msg'] = '未登录或没有权限';
			$this->ajaxReturn($results);
			// $this->redirect("Index");
		}
	}
	
	// 选择设计师
	public function actionChoose(){
		if(checkPower()){
			if(!empty($_POST)){
				$where = '';
				if(!empty($_POST['design_name'])){
					$where .= " and d.design_name like '%".$_POST['design_name']."%'";
					$this->assign('design_name', $_POST['design_name']);
				}
				
				$sql = 'SELECT d.*, u.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
					   (' WHERE d.is_pass = 1 and u.user_rank = 14 '.$where.' order by d.add_time asc');
				$userList = $GLOBALS['db']->getAll($sql);
				// print_r($userList);exit;
				
				// print_r($_POST['huxingId']);
				$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id '.
					   (' WHERE d.is_pass = 1 and u.user_rank = 14'.$where);
				$taskList = $GLOBALS['db']->getAll($sql);
				// print_r($taskList);exit;
				
				foreach($taskList as $k => $v){
					// print_r($v);
					// 如果设计师已经处于该任务的待接单或进行中 则不在该列表显示该设计师
					if(($v['huxing_id'] == $_POST['huxingId'] && $v['is_receive'] == 0) or ($v['huxing_id'] == $_POST['huxingId'] && $v['is_receive'] == 1)){
						foreach($userList as $i => $j){
							// print_r($j);
							if($v['user_id'] == $j['user_id']){
								unset($userList[$i]);
							}						
						}
					}
					
					// 派发任务后如果该设计师拒单,则该设计师依然显示在该界面,并显示已拒单
					if($v['huxing_id'] == $_POST['huxingId'] && $v['is_receive'] == 2){
						foreach($userList as $i => $j){
							if($v['user_id'] == $j['user_id']){
								$userList[$i]['msg'] = '已拒单';
							}
						}
					}	
				}
				// print_r($userList);exit;
				// 优先显示未拒单设计师,并按已完成设计数量倒序显示,如果已完成数量相同则按注册时间前的显示在前
				foreach($userList as $k => $v){
					// print_r($v);
					$sql = 'SELECT d.*, t.*, t.design_id,count(*) as nums FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
						   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
						   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id '.
						   (' WHERE d.is_pass = 1 and u.user_rank = 14 and u.user_id = '.$v['user_id'].' and t.is_receive = 3 group by t.design_id');
					$ddd = $GLOBALS['db']->getRow($sql);
					if($ddd){
						$newList[] = $ddd;	
					}else{
						$userList[$k][nums] = 0;
						$newList[] = $userList[$k];
					}
					
					if($v['msg']){
						$ddd['msg'] = $v['msg'];
					}
					// $newList[] = $ddd;				
					// print_r($ddd);
				}
				// exit;
				// print_r($newList);exit;
				
				$arrSort = array();
				foreach($newList AS $key => $value){
					foreach($value AS $k=>$v){
						$arrSort[$k][$key] = $v;
					}
				}
				array_multisort($arrSort['nums'], SORT_DESC, $newList);
				// print_r($newList);exit;
				// var_dump($_POST['design_data']);exit;
				
				if(!empty($_POST['design_data'])){
					$designList = explode(",", $_POST['design_data']);					
					array_push($designList,$_POST['user_id']);
					// print_r($design_data);exit;					
				}else{
					$designList[] = $_POST['user_id'];
					// print_r($design_data);exit;
				}
				// print_r($designList);exit;
				// 数组转字符串
				$design_data = implode(",", $designList);
				// print_r($design_data);exit;
				$this->assign('userList', $newList);
				$this->assign('huxingId', $_POST['huxingId']);
				$this->assign('huxing_name', $_POST['huxing_name']);
				$this->assign('price', $_POST['price']);
				$this->assign('loupan_id', $_POST['loupan_id']);
				$this->assign('loupan_name', $_POST['loupan_name']);
				$this->assign('loupan_img', $_POST['loupan_img']);
				$this->assign('loupan_introduce', $_POST['loupan_introduce']);
				$this->assign('huxing_class', $_POST['huxing_class']);
				$this->assign('huxing_classname', $_POST['huxing_classname']);
				$this->assign('introduce', $_POST['introduce']);
				$this->assign('huxing_img', $_POST['huxing_img']);
				$this->assign('user_id', $_POST['user_id']);
				$this->assign('designList', $designList);
				$this->assign('design_data', $design_data);
				$this->display();
			}
			if(!empty($_GET)){
				// $userList = dao('users')->where('user_rank = 14'.$where)->select();
				// print_r($userList);exit;
				// print_r($_GET['design_name']);exit;
				$where = '';
				if(!empty($_GET['design_name'])){
					$where .= " and d.design_name like '%".$_GET['design_name']."%'";
					$this->assign('design_name', $_GET['design_name']);
				}
				
				$sql = 'SELECT d.*, u.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
					   (' WHERE d.is_pass = 1 and u.user_rank = 14 '.$where.' order by d.add_time asc');
				$userList = $GLOBALS['db']->getAll($sql);
				
				$sql = 'SELECT d.*, t.* FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id '.
					   (' WHERE d.is_pass = 1 and u.user_rank = 14'.$where);
				$taskList = $GLOBALS['db']->getAll($sql);
				
				foreach($taskList as $k => $v){
					// print_r($v);
					// 如果设计师已经处于该任务的待接单或进行中 则不在该列表显示该设计师
					if(($v['huxing_id'] == $_GET['huxingId'] && $v['is_receive'] == 0) or ($v['huxing_id'] == $_GET['huxingId'] && $v['is_receive'] == 1)){
						foreach($userList as $i => $j){
							// print_r($j);
							if($v['user_id'] == $j['user_id']){
								unset($userList[$i]);
							}						
						}
					}
					
					// 派发任务后如果该设计师拒单,则该设计师依然显示在该界面,并显示已拒单
					if($v['huxing_id'] == $_GET['huxingId'] && $v['is_receive'] == 2){
						foreach($userList as $i => $j){
							if($v['user_id'] == $j['user_id']){
								$userList[$i]['msg'] = '已拒单';
							}
						}
					}	
				}
				
				foreach($userList as $k => $v){
					// print_r($v);
					$sql = 'SELECT d.*, t.*, t.design_id,count(*) as nums FROM ' . $GLOBALS['ecs']->table('design') . ' AS d' . 
						   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON u.user_id = d.user_id '.
						   ' LEFT JOIN ' . $GLOBALS['ecs']->table('task') . ' AS t ' . 'ON d.user_id = t.design_id '.
						   (' WHERE d.is_pass = 1 and u.user_rank = 14 and u.user_id = '.$v['user_id'].' and t.is_receive = 3 group by t.design_id');
					$ddd = $GLOBALS['db']->getRow($sql);
					if($ddd){
						$newList[] = $ddd;	
					}else{
						$userList[$k][nums] = 0;
						$newList[] = $userList[$k];
					}
					
					if($v['msg']){
						$ddd['msg'] = $v['msg'];
					}				
					// print_r($ddd);
				}
				
				$arrSort = array();
				foreach($newList AS $key => $value){
					foreach($value AS $k=>$v){
						$arrSort[$k][$key] = $v;
					}
				}
				array_multisort($arrSort['nums'], SORT_DESC, $newList);
				// print_r($newList);exit;
				// print_r($_GET);exit;
				if(!empty($_GET['design_data'])){
					$designList = explode(",", $_GET['design_data']);
					// print_r($design_data);exit;
				}
				
				// 数组转字符串
				$design_data = implode(",", $designList);
				
				$this->assign('userList', $newList);
				$this->assign('huxingId', $_GET['huxingId']);
				$this->assign('huxing_name', $_GET['huxing_name']);
				$this->assign('price', $_GET['price']);
				$this->assign('loupan_id', $_GET['loupan_id']);
				$this->assign('loupan_name', $_GET['loupan_name']);
				$this->assign('loupan_img', $_GET['loupan_img']);
				$this->assign('loupan_introduce', $_GET['loupan_introduce']);
				$this->assign('huxing_class', $_GET['huxing_class']);
				$this->assign('huxing_classname', $_GET['huxing_classname']);
				$this->assign('introduce', $_GET['introduce']);
				$this->assign('huxing_img', $_GET['huxing_img']);
				$this->assign('designList', $designList);
				$this->assign('design_data', $design_data);
				$this->display();
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 查看设计师
	public function actionDesign(){
		if(checkPower()){
			if(!empty($_GET)){
				// 设计师信息
				$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
					   (" WHERE u.user_rank = 14 and d.is_pass = 1 and u.user_id = ".$_GET['id']);
				$design = $GLOBALS['db']->getRow($sql);	
				// print_r($design);exit;
				
				// 已完成
				$finishCount = dao('task')->where('design_id = '.$_GET['id'].' and is_receive = 3')->count();
				
				// 未接单
				$unCount = dao('task')->where('design_id = '.$_GET['id'].' and is_receive = 0')->count();
				
				// 设计中
				$ingCount = dao('task')->where('design_id = '.$_GET['id'].' and is_receive = 1')->count();
				
				if($_GET['design_name']){
					$this->assign('design_name', $_GET['design_name']);
				}
				// print_r($_GET['design_data']);exit;
				$this->assign('design', $design);
				$this->assign('finishCount', $finishCount);
				$this->assign('unCount', $unCount);
				$this->assign('ingCount', $ingCount);
				$this->assign('huxingId', $_GET['huxingId']);
				$this->assign('huxing_name', $_GET['huxing_name']);
				$this->assign('price', $_GET['price']);
				$this->assign('loupan_id', $_GET['loupan_id']);
				$this->assign('loupan_name', $_GET['loupan_name']);
				$this->assign('loupan_img', $_GET['loupan_img']);
				$this->assign('loupan_introduce', $_GET['loupan_introduce']);
				$this->assign('huxing_class', $_GET['huxing_class']);
				$this->assign('huxing_classname', $_GET['huxing_classname']);
				$this->assign('introduce', $_GET['introduce']);
				$this->assign('huxing_img', $_GET['huxing_img']);
				$this->assign('design_data', $_GET['design_data']);
				$this->display();
			}else{
				$this->error('未提交设计师ID');
			}
		}else{
			$this->redirect("Index");
		}
	}
	
	// 选择指定设计师
	public function actionChooseDesign(){
		if(checkPower()){
			// print_r($_POST);exit;
			if(!empty($_POST)){
				$designList = explode(",", $_POST['designData']);
				foreach($designList as $k => $v){
					// print_r($v);
					$Task = D("task");
					$Task->create();
					$Task->huxing_id = $_POST['huxingId'];
					$Task->huxing_name = $_POST['huxing_name'];
					$Task->total_price = $_POST['price'];
					$Task->design_id = $v;
					$Task->loupan_id = $_POST['loupan_id'];
					$Task->loupan_name = $_POST['loupan_name'];
					$Task->loupan_img = $_POST['loupan_img'];
					$Task->loupan_introduce = $_POST['loupan_introduce'];
					$Task->huxing_class = $_POST['huxing_class'];
					$Task->huxing_classname = $_POST['huxing_classname'];
					$Task->introduce = $_POST['introduce'];
					$Task->huxing_img = $_POST['huxing_img'];
					$Task->manage_id = session('manager_id');
					$Task->add_time = time();
					$result = $Task->add();	
				}
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
		}else{
			$results['code'] = '0';
			$results['msg'] = '未登录或没有权限';
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
