<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
namespace App\Modules\Internal\Controllers;

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
		// 计调端
		if(checkPower(12)){
			$this->redirect('adjusting');
		}
		// 项目经理
		elseif(checkPower(11)){
			$this->redirect('project');
		}
		// 质检
		elseif(checkPower(13)){
			$this->redirect('qualityTest');
		}else{
			$this->display();
		}	
	}
	
	public function actionLogin()
	{
		// print_r($_POST);exit;
		if(!empty($_POST)){
			$users = dao('users')->where(array('user_name' => $_POST['user_name']))->find();
			// print_r($users['password']);
			// print_r(md5($_POST['password']));exit;
			// print_r(md5(md5($_POST['password']) . $users['ec_salt']));exit;
			if(!empty($users)){
				if($_POST['user_name'] == $users['user_name'] && md5($_POST['password']) == $users['password'] || md5(md5($_POST['password']) . $users['ec_salt']) == $users['password']){
					session('manage_name',$users['user_name']);
					session('manager_id',$users['user_id']);
					// 计调端
					if($users['user_rank'] == '12'){
						$results['url'] = __APP__.'?m=internal&a=adjusting';
					}
					// 项目经理
					elseif($users['user_rank'] == '11'){
						$results['url'] = __APP__.'?m=internal&a=project';
					}
					// 质检
					elseif($users['user_rank'] == '13'){
						$results['url'] = __APP__.'?m=internal&a=qualityTest';
					}else{
						$results['code'] = '0';
						$results['msg'] = '您没有该权限';
						$this->ajaxReturn($results);
					}
					$results['code'] = '1';
					$results['msg'] = '登录成功';
					$this->ajaxReturn($results);
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

	// 内控端——计调端
	public function actionAdjusting()
	{
		if(checkPower(12)){
			// 待办事项，已付款的订单总数
			$orderCount = dao('order_info')->where(array('order_status' => '1','shipping_status' => '0','pay_status' => '2','is_real' => '1'))->count();
			// print_r($userList);exit;
			
			// 上月订单
			$lastmonth_start = mktime(0, 0 , 0,date("m")-1,1,date("Y")); 
			$lastmonth_end = mktime(23,59,59,date("m") ,0,date("Y"));
			// print_r($lastmonth_start);exit;
			$lastOrder = dao('order_info')->where('add_time > '.$lastmonth_start.' and add_time < '.$lastmonth_end.' and is_real = 1')->count();
			// print_r($order);exit;
			
			//php获取今日开始时间戳和结束时间戳
			$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
			$todayOrder = dao('order_info')->where('add_time > '.$beginToday.' and add_time < '.$endToday.' and is_real = 1 ')->count();
			
			//php获取本月起始时间戳和结束时间戳
			$beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));
			$endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
			$monthOrder = dao('order_info')->where('add_time > '.$beginThismonth.' and add_time < '.$endThismonth.' and is_real = 1 ')->count();
			
			$this->assign('orderCount', $orderCount);
			$this->assign('lastOrder', $lastOrder);
			$this->assign('todayOrder', $todayOrder);
			$this->assign('monthOrder', $monthOrder);
			$this->display();	
		}else{
			$this->redirect('Index');
		}
	}
	
	// 订单管理
	public function actionOrder()
	{
		if(checkPower(12)){
			// print_r(timediff(strtotime('2016-09-12 12:00:00'),strtotime('2016-09-15 21:50:21')));exit;
			// 筛选条件
			if(!empty($_POST)){
				// print_r($_POST['state']);exit;
				$where = '';
				if(!empty($_POST['stage'])){
					$where .= ' and o.current_stage = '.$_POST['stage'];
					$this->assign('stage', $_POST['stage']);
				}
				if(!empty($_POST['state']) or $_POST['state'] == 0 and $_POST['state'] != ''){
					// print_r('555');exit;
					$where .= ' and o.state = '.$_POST['state'];
					$this->assign('state', $_POST['state']);
				}
				$sql = 'SELECT o.*, u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id ' . 
					   (' WHERE o.order_status = 1 and o.shipping_status = 0 and o.pay_status = 2 and o.is_real = 1 '.$where.' ORDER BY o.add_time DESC ');
				$orderList = $GLOBALS['db']->getAll($sql);
				
				foreach($orderList as $k => $v){
					// print_r($v);
					$orderList[$k]['msg'] = stateFlowOne($v['state']);
					// 计算时间区间
					$time = timediff($v['add_time'],time());
					$orderList[$k]['day'] = $time['day'];
				}
				
			}else{
				// 待分配已付款订单
				// $orderList = dao('order_info')->where(array('order_status' => '1','shipping_status' => '0','pay_status' => '2'))->select();
				$sql = 'SELECT o.*, u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id ' . 
					   (' WHERE o.order_status = 1 and o.shipping_status = 0 and o.pay_status = 2 and o.is_real = 1 ORDER BY o.add_time DESC ');
				$orderList = $GLOBALS['db']->getAll($sql);
				// print_r($orderList);exit;
				foreach($orderList as $k => $v){
					// print_r($v);
					// 获取当前进度
					$orderList[$k]['msg'] = stateFlowOne($v['state']);
					// 计算时间区间
					$time = timediff($v['add_time'],time());
					$orderList[$k]['day'] = $time['day'];
				}			
			}
			
			// print_r($orderList);exit;
			$this->assign('orderList', $orderList);
			$this->display();		
		}else{
			$this->redirect('Index');
		}
	}
	
	// 冒泡点击事件
	public function actionBubbling(){
		if(checkPower(12)){
			if(!empty($_POST)){
				$Order = M("order_info"); // 实例化User对象			
				$Order->create();			
				$Order->is_ooo = '1';
				$result = $Order->where('order_id='.$_POST['id'])->save();
				if($result){
					$results['code'] = '1';
					$this->ajaxReturn($results);
				}else{
					$results['code'] = '0';
					$results['msg'] = '点击失败';
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
		}

	}
	
	// 订单状态查看
	public function actionStage()
	{
		if(checkPower(12)){
			if(!empty($_GET['id'])){
				$sql = 'SELECT o.*,u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id '.
					   (' WHERE o.order_id = '.$_GET['id']);
				$orderOne = $GLOBALS['db']->getRow($sql);
				// print_r($orderOne);exit;
				
				$orderOne['region'] = get_user_region_address($orderOne['order_id']);
				// print_r($orderOne);exit;
				
				$stageLast = stateFlow($orderOne['state']);
				// print_r($stageLast);exit;
				
				$stageList = M("stage")->where('order_id='.$_GET['id'].' and current_stage = '.$orderOne['current_stage'])->select();
				// print_r($stageList);exit;
				
				foreach($stageList as $k => $v){
					// print_r($v);
					if($v['state'] == 1){
						$stageLast['t1'] = $v['add_time'];
					}
					if($v['state'] == 2){
						$stageLast['t2'] = $v['add_time'];
					}
					if($v['state'] == 3){
						$stageLast['t3'] = $v['add_time'];
					}
					if($v['state'] == 4){
						$stageLast['t4'] = $v['add_time'];
					}
				}
				// exit;
				// print_r($stageLast);exit;
				$this->assign('orderOne', $orderOne);
				$this->assign('stageLast', $stageLast);
				$this->display();
			}else{
				$this->error("没有ID号");
			}		
		}else{
			$this->redirect('Index');
		}
	
	}
	
	// 计调端——基装详情
	public function actionBase()
	{
		if(checkPower(12) || checkPower(11) || checkPower(13)){
			if(!empty($_GET['id'])){
				$url = _ASHIN_.'/getHuXingByLouPanId.do?method=getJzxxByYbjid_sc';
				$data = array(
					'ybj_id' => '214'
					// 'ybj_id' => $_GET['id']
				);
				// print_r($data);exit;
				// 发送请求
				$base = doCurl($url,$data); 
				// 转码
				$base = json_decode($base, true);
				// print_r($base['apartment']);exit;
				$sgtImg = $base['apartment']['sgtImg'];
				$sgtImgList = explode("&", $sgtImg);
				
				$sjtImg = $base['apartment']['sjtImg'];
				$sjtImgList = explode("&", $sjtImg);
				
				// print_r($pieces);exit;
				$orderOne = M("order_info")->where('order_id='.$_GET['id'])->find();
				// print_r($orderOne);exit;
				$this->assign('orderOne', $orderOne);
				$this->assign('sgtImgList', $sgtImgList);
				$this->assign('sjtImgList', $sjtImgList);
				$this->assign('base', $base['apartment']);
				$this->display();	
			}else{
				$this->error("没有ID号");
			}			
		}else{
			$this->redirect('Index');
		}		
	}
	
	// 计调端——工作台
	public function actionWork()
	{
		if(checkPower(12)){
			// 未安排订单
			$sql = 'SELECT o.*,u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id '.
				   (" WHERE o.order_status = 1 and o.shipping_status = 0 and o.is_real = 1 and o.pay_status = 2  and (o.manager_id = '' or o.quality_id = '') ORDER BY o.add_time DESC");
			$orderList = $GLOBALS['db']->getAll($sql);
			// print_r($orderList);exit;
			
			// 已安排订单
			$sql = 'SELECT o.*,u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id '.
				   (" WHERE o.order_status = 1 and o.shipping_status = 0 and o.is_real = 1 and o.pay_status = 2  and (o.manager_id != '' and o.quality_id != '') ORDER BY o.add_time DESC");
			$orderList2 = $GLOBALS['db']->getAll($sql);
			// print_r($orderList2);exit;
			$this->assign('orderList', $orderList);
			$this->assign('orderList2', $orderList2);
			$this->display();		
		}else{
			$this->redirect('Index');
		}
	}
	
	// 选择项目经理
	public function actionManager()
	{	
		if(checkPower(12)){
			if(!empty($_GET['id'])){
				if(!empty($_POST['user_name'])){
					$user = M("users")->where("user_name like '%".$_POST['user_name']."%' and user_rank = 11")->select();
					// print_r($user);exit;
					if(empty($user)){
						$this->error("没有该账号名或者该账号不是质检");
					}else{
						$this->assign('userList', $user);
						$this->assign('order_id', $_POST['order_id']);
						$this->display();
					}
				}else{
					$orderOne = M("order_info")->where('order_id='.$_GET['id'])->find();
					if(!empty($orderOne['manager_id'])){
						$this->redirect("Quality",array('order_id'=>$_GET['id']));
					}else{
						$userList = dao('users')->where(array('user_rank' => '11'))->select();
						
						$this->assign('userList', $userList);
						$this->assign('order_id', $_GET['id']);
						$this->display();	
					}				
				}			
			}else{
				$this->error("没有ID号");
			}			
		}else{
			$this->redirect('Index');
		}
	}
	
	// 保存项目经理
	public function actionkeep()
	{
		if(checkPower(12)){
			if(!empty($_GET['order_id'])){
				$id = I('get.order_id');
				$orderOne = M("order_info")->where('order_id='.$id)->find();
				if(!empty($orderOne['manager_id'])){
					$this->error("已存在项目经理","index.php?m=internal&a=Quality&order_id=".$id);
				}else{
					$Order = M("order_info"); // 实例化User对象			
					$Order->create();			
					// $Order->add_time = time();
					$Order->manager_id = $_GET['user_id'];
					$Order->state = '1';
					$result = $Order->where('order_id='.$id)->save();
					if($result){
						$this->redirect("Quality",array('order_id'=>$id));
					}else{
						$this->error("储存项目经理ID失败");
					}				
				}
			}			
		}else{
			$this->redirect('Index');
		}
	}
	
	// 选择质检
	public function actionQuality()
	{
		if(checkPower(12)){
			if(!empty($_GET['order_id'])){
				if(!empty($_POST['user_name'])){		
					$user = M("users")->where("user_name like '%".$_POST['user_name']."%' and user_rank = 13")->select();
					// print_r($user);exit;
					if(empty($user)){
						$this->error("没有该账号名或者该账号不是质检");
					}else{
						$this->assign('userList', $user);
						$this->assign('order_id', $_POST['order_id']);
						$this->display();
					}
				}else{
					$orderOne = M("order_info")->where('order_id='.$_GET['order_id'])->find();
					if(!empty($orderOne['quality_id'])){
						$this->redirect("work");
					}else{
						$userList = dao('users')->where('user_rank = 13')->select();
						// print_r($userList);exit;
						$this->assign('userList', $userList);
						$this->assign('order_id', $_GET['order_id']);
						$this->display();				
					}	
				}			
			}else{
				$this->error("没有ID号");
			}			
		}else{
			$this->redirect('Index');
		}
	}
	
	// 项目入驻详情
	public function actionForm()
	{
		if(checkPower(12)){
			if(!empty($_GET['user_id']) || !empty($_GET['order_id'])){
				// 用户信息
				$sql = 'SELECT o.*,u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
					   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id '.
					   (' WHERE o.order_id = '.$_GET['order_id']);
				$orderOne = $GLOBALS['db']->getRow($sql);
				$orderOne['region'] = get_user_region_address($orderOne['order_id']);
				// print_r($orderOne);exit;
				$this->assign('orderOne', $orderOne);
				// 分配的质检ID
				$this->assign('user_id', $_GET['user_id']);
				$this->display();
			}
			
			if(!empty($_POST)){
				$id = I('post.order_id');
				$orderOne = M("order_info")->where('order_id='.$id)->find();
				// print_r($orderOne['manager_id']);exit;
				if(!empty($orderOne['quality_id'])){
					$this->error("已存在质检","index.php?m=internal&a=Quality&order_id=".$id);
				}else{
					$Order = M("order_info"); // 实例化User对象			
					$Order->create();			
					// $Order->add_time = time();
					$Order->quality_id = $_POST['quality_id'];
					$result = $Order->where('order_id='.$id)->save();
					if($result){
						$this->redirect("work");
					}else{
						$this->error("储存项目经理ID失败");
					}				
				}
			}		
		}else{
			$this->redirect('Index');
		}
	}
	
	// 项目经理——首页
	public function actionProject()
	{
		if(checkPower(11)){
			$manager_id = session('manager_id');
			// 待办事项，已派单到当前ID的订单
			$orderCount = dao('order_info')->where('manager_id = '.$manager_id.' and state = 1')->count();		
			
			// 项目经理账号信息
			$user = dao('users')->where(array('user_id' => $manager_id))->find();
			
			// 上月订单
			//上月
			$lastmonth_start = mktime(0, 0 , 0,date("m")-1,1,date("Y")); 
			$lastmonth_end = mktime(23,59,59,date("m") ,0,date("Y"));
			// print_r($lastmonth_start);exit;
			$lastOrder = dao('order_info')->where('add_time > '.$lastmonth_start.' and add_time < '.$lastmonth_end.' and is_real = 1')->count();
			// print_r($order);exit;
			
			//php获取今日开始时间戳和结束时间戳
			$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
			$todayOrder = dao('order_info')->where('add_time > '.$beginToday.' and add_time < '.$endToday.' and is_real = 1')->count();
			
			//php获取本月起始时间戳和结束时间戳
			$beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));
			$endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
			$monthOrder = dao('order_info')->where('add_time > '.$beginThismonth.' and add_time < '.$endThismonth.' and is_real = 1')->count();
			
			$this->assign('orderCount', $orderCount);
			$this->assign('user', $user);
			$this->assign('lastOrder', $lastOrder);
			$this->assign('todayOrder', $todayOrder);
			$this->assign('monthOrder', $monthOrder);
			$this->display();		
		}else{
			$this->redirect("Index");
		}
	}
	
	// 项目经理——工作台
	public function actionProjectWork()
	{
		if(checkPower(11)){
			$manager_id = session('manager_id');
			// print_r($manager_id);
			// 待验收
			// $PendingOrder = dao('order_info')->where('manager_id = '.$manager_id.' and state = 1')->select();
			$sql = 'SELECT o.*, u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id ' . 
				   (' WHERE o.manager_id = '.$manager_id.' and o.total_stage != o.current_stage and o.is_real = 1 and o.state = 1 ORDER BY o.add_time DESC ');
			$PendingOrder = $GLOBALS['db']->getAll($sql);
			
			// 已验收
			// $sql = 'SELECT o.*, u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
				   // ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id ' . 
				   // ' LEFT JOIN ' . $GLOBALS['ecs']->table('stage') . ' AS s ' . 'ON o.order_id = s.order_id ' . 
				   // (' WHERE o.quality_id = '.$manager_id.' and s.state = 2 group by order_id ORDER BY o.add_time DESC ');
			// $AcceptedOrder = $GLOBALS['db']->getAll($sql);
			
			// $AcceptedOrder = dao('order_info')->where('manager_id = '.$manager_id.' and state >= 2')->select();
			$sql = 'SELECT o.*, s.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' .  
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('stage') . ' AS s ' . 'ON o.order_id = s.order_id ' . 
				   (' WHERE o.manager_id = '.$manager_id.' and s.state = 2 and o.state != 0  and o.is_real = 1 and o.state >= 2 group by s.order_id');
			$AcceptedOrder = $GLOBALS['db']->getAll($sql);
			
			// print_r($AcceptedOrder);exit;
			$this->assign('PendingOrder', $PendingOrder);
			$this->assign('AcceptedOrder', $AcceptedOrder);
			$this->display();		
		}else{
			$this->redirect("Index");
		}
	}

	// 项目经理——确认验收
	public function actionProjectaSure()
	{
		if(checkPower(11)){
			$manager_id = session('manager_id');
			if(!empty($_POST['id'])){
				$order_id = $_POST['id'];
				$order = dao('order_info')->where('order_id = '.$order_id)->find();
				
				if($order['manager_id'] != $manager_id){
					$results['msg'] = '您没有权限操作';
					$this->ajaxReturn($results);
				}else{
					$Stage = D("stage");
					$Stage->create();
					$Stage->order_id = $order['order_id'];
					$Stage->current_stage = $order['current_stage'];
					$Stage->state = 2;
					$Stage->user_id = $manager_id;
					$Stage->add_time = time();
					$result = $Stage->add();
					if($result){
						$Order = D("order_info");
						$Order->create();
						$Order->state = 2;
						$result_ = $Order->where('order_id='.$order_id)->save();
						if($result_){
							$results['code'] = '1';
							$results['msg'] = '已验收';
							$this->ajaxReturn($results);
						}else{
							$results['code'] = '0';
							$results['msg'] = '验收失败';
							$this->ajaxReturn($results);
						}
					}
				}
			}else{
				$results['code'] = '0';
				$results['msg'] = '没有ID值';
				$this->ajaxReturn($results);
			}		
		}else{
			$results['code'] = '0';
			$results['msg'] = '未登录或没有权限';
			$this->ajaxReturn($results);
		}
	}
	
	// 质检员——首页
	public function actionQualityTest()
	{
		if(checkPower(13)){
			$manager_id = session('manager_id');
			// 待办事项，已派单到当前ID的订单
			$orderCount = dao('order_info')->where('manager_id = '.$manager_id.' and state = 2')->count();		
			
			// 项目经理账号信息
			$user = dao('users')->where(array('user_id' => $manager_id))->find();
			
			// 上月订单
			//上月
			$lastmonth_start = mktime(0, 0 , 0,date("m")-1,1,date("Y")); 
			$lastmonth_end = mktime(23,59,59,date("m") ,0,date("Y"));
			// print_r($lastmonth_start);exit;
			$lastOrder = dao('order_info')->where('add_time > '.$lastmonth_start.' and add_time < '.$lastmonth_end.' and is_real = 1')->count();
			// print_r($order);exit;
			
			//php获取今日开始时间戳和结束时间戳
			$beginToday = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$endToday = mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
			$todayOrder = dao('order_info')->where('add_time > '.$beginToday.' and add_time < '.$endToday.' and is_real = 1')->count();
			
			//php获取本月起始时间戳和结束时间戳
			$beginThismonth = mktime(0,0,0,date('m'),1,date('Y'));
			$endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
			$monthOrder = dao('order_info')->where('add_time > '.$beginThismonth.' and add_time < '.$endThismonth.' and is_real = 1')->count();
			
			$this->assign('orderCount', $orderCount);
			$this->assign('user', $user);
			$this->assign('lastOrder', $lastOrder);
			$this->assign('todayOrder', $todayOrder);
			$this->assign('monthOrder', $monthOrder);
			$this->display();
		}else{
			$this->redirect("Index");
		}
	}
	
	// 质检员——工作台
	public function actionQualityWork()
	{
		if(checkPower(13)){
			$manager_id = session('manager_id');
			// print_r($manager_id);
			// 待确认
			// $PendingOrder = dao('order_info')->where('quality_id = '.$manager_id.' and total_stage != current_stage')->select();
			$sql = 'SELECT o.*, u.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('users') . ' AS u ' . 'ON o.user_id = u.user_id ' . 
				   (' WHERE o.quality_id = '.$manager_id.' and o.total_stage != o.current_stage and o.is_real = 1 and o.state = 2 ORDER BY o.add_time DESC ');
			$PendingOrder = $GLOBALS['db']->getAll($sql);
			
			// 已确认
			// $AcceptedOrder = dao('order_info')->where('quality_id = '.$manager_id.' and state != 0 and (state >= 3 or state < 2)')->select();
			$sql = 'SELECT o.*, s.* FROM ' . $GLOBALS['ecs']->table('order_info') . ' AS o' .  
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('stage') . ' AS s ' . 'ON o.order_id = s.order_id ' . 
				   (' WHERE o.quality_id = '.$manager_id.' and s.state = 3 and o.state != 0 and o.is_real = 1 and (o.state >= 3 or o.state < 2) group by s.order_id');
			$AcceptedOrder = $GLOBALS['db']->getAll($sql);
			// print_r($AcceptedOrder);exit;
			$this->assign('PendingOrder', $PendingOrder);
			$this->assign('AcceptedOrder', $AcceptedOrder);
			$this->display();		
		}else{
			$this->redirect("Index");
		}
	}
	
	// 质检员——质检确认
	public function actionQualitySure()
	{
		if(checkPower(13)){
			$quality_id = session('manager_id');
			if(!empty($_POST['id'])){
				$order_id = $_POST['id'];
				$order = dao('order_info')->where('order_id = '.$order_id)->find();
				// print_r($quality_id);
				// print_r(',');
				// print_r($order['quality_id']);
				// exit;
				if($order['quality_id'] != $quality_id){
					$results['code'] = '0';
					$results['msg'] = '您没有权限操作';
					$this->ajaxReturn($results);
				}else{
					$Stage = D("stage");
					$Stage->create();
					$Stage->order_id = $order['order_id'];
					$Stage->current_stage = $order['current_stage'];
					$Stage->state = 3;
					$Stage->user_id = $quality_id;
					$Stage->add_time = time();
					$result = $Stage->add();
					if($result){
						$Order = D("order_info");
						$Order->create();
						$Order->state = 3;
						$result_ = $Order->where('order_id='.$order_id)->save();
						if($result_){
							$results['code'] = '1';
							$results['msg'] = '质检确认';
							$this->ajaxReturn($results);
						}else{
							$results['code'] = '0';
							$results['msg'] = '质检确认失败';
							$this->ajaxReturn($results);
						}
					}
				}
			}else{
				$results['code'] = '0';
				$results['msg'] = '没有ID值';
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
