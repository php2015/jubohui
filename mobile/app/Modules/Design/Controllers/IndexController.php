<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
namespace App\Modules\Design\Controllers;

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
		if(!empty($_GET)){
			// $users = dao('users')->where('user_name = "'.$_GET['username'].'"')->find();
			$sql = 'SELECT d.*, u.*  FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
				   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
				   (' WHERE u.user_name = "'.$_GET['username'].'" order by d.add_time desc');
			$users = $GLOBALS['db']->getRow($sql);			
			// print_r($users);exit;
			// print_r(is_numeric($users['is_pass']));exit;
			if(!empty($users)){
				// 是否是设计师身份
				if($users['user_rank'] == 14){
					session('user_name',$users['user_name']);
					session('user_id',$users['user_id']);
					$this->redirect("Homepage");
				}elseif($users['is_check'] == 1){
					$this->redirect('Apply');
				}else{
					session('user_name',$users['user_name']);
					session('user_id',$users['user_id']);
					$this->display();	
				}				
			}else{
				$this->error('没有该账号');
			}
		}else{
			$this->error('请登录');
		}	
	}
	
	// 申请成为设计师
	public function actionLogin()
	{
		// print_r($_FILES);exit;
		if(!empty($_POST)){
			$Design = D("design");
			$Design->create();
			$Design->user_id = $_SESSION['user_id'];
			$Design->design_name = $_POST['user_name'];
			$Design->id_card = $_POST['id_card'];
			$Design->phone = $_POST['phone'];
			$Design->add_time = time();
			if(!empty($_FILES)){
				$upload = new \Think\Upload();// 实例化上传类
				$upload->maxSize   =     0 ;// 设置附件上传大小
				$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
				$upload->rootPath  =     './Public/Upload/design/'; // 设置附件上传根目录
				
				$info   =   $upload->upload();
				// print_r($info);exit;
				if(!$info) {// 上传错误提示错误信息
					$this->error($upload->getError());
				}else{// 上传成功
					// print_r($info);exit;
					if(!empty($info['certificate'])){
						$Design->certificate = './Public/Upload/design/'.$info['certificate']['savepath'].$info['certificate']['savename'];
					}
					if(!empty($info['id_a'])){
						$Design->id_a = './Public/Upload/design/'.$info['id_a']['savepath'].$info['id_a']['savename'];
					}
					if(!empty($info['id_b'])){
						$Design->id_b = './Public/Upload/design/'.$info['id_b']['savepath'].$info['id_b']['savename'];
					}
					// print_r($Design);exit;
					$result = $Design->add();
					if($result){
						$this->redirect('apply');
					}else{
						$this->error('上传失败');
					}					
				}
			}else{
				$result = $Design->add();
				if($result){
					$this->redirect('apply');
				}else{
					$this->error('上传失败');
				}
			}
		}
	}
	
	// 申请提示
	public function actionApply()
	{
		// 是否被驳回
		$sql = 'SELECT u.*, d.* FROM ' . $GLOBALS['ecs']->table('users') . ' AS u' . 
			   ' LEFT JOIN ' . $GLOBALS['ecs']->table('design') . ' AS d ' . 'ON u.user_id = d.user_id' . 
			   (" WHERE u.user_id = ".session('user_id')." ORDER BY d.design_id desc");
		$design = $GLOBALS['db']->getRow($sql);
		// print_r($design);exit;
		if($design['is_pass'] == 2){
			$this->redirect('index',array("username"=>session('user_name')));
		}elseif($design['user_rank'] == 14){
			$this->redirect("Homepage");
		}else{
			$this->display();
		}		
	}
	
	// 设计师主页
	public function actionHomepage()
	{
		// print_r(session());exit;
		// 根据楼盘显示全部任务
		$alltaskList = dao('task')->where('design_id = '.session('user_id').' and is_receive != 2')->group('loupan_id')->select();
		// print_r($alltaskList);exit;
		
		// 根据楼盘显示未接单
		$untaskList = dao('task')->where('design_id = '.session('user_id').' and is_receive = 0')->group('loupan_id')->select();
		$untaskCount = dao('task')->where('design_id = '.session('user_id').' and is_receive = 0')->count();
		// print_r($untaskList);exit;
		
		// 根据楼盘显示设计中
		$ingtaskList = dao('task')->where('design_id = '.session('user_id').' and is_receive = 1')->group('loupan_id')->select();
		$ingtaskCount = dao('task')->where('design_id = '.session('user_id').' and is_receive = 1')->count();
		
		// 根据楼盘显示已完成
		$finishtaskList = dao('task')->where('design_id = '.session('user_id').' and is_receive = 3')->group('loupan_id')->select();
		$finishtaskCount = dao('task')->where('design_id = '.session('user_id').' and is_receive = 3')->count();
		
		$this->assign('user_name', $_SESSION['user_name']);
		$this->assign('alltaskList', $alltaskList);
		$this->assign('untaskList', $untaskList);
		$this->assign('untaskCount', $untaskCount);
		$this->assign('ingtaskList', $ingtaskList);
		$this->assign('ingtaskCount', $ingtaskCount);
		$this->assign('finishtaskList', $finishtaskList);
		$this->assign('finishtaskCount', $finishtaskCount);
		$this->display();
	}
	
	// 根据楼盘显示户型信息
	public function actionBuilding(){
		// print_r($_GET);exit;
		if(!empty($_GET)){
			$where = '';
			if(!empty($_GET['is_receive']) or is_numeric($_GET['is_receive'])){
				$where .= ' and is_receive = '.$_GET['is_receive'];
				$this->assign('is_receive', $_GET['is_receive']);
			}
			// print_r($where);exit;
			if(!empty($_GET['huxing_class'])){
				// 根据户型类型显示全部任务,拒单不显示
				$apartmentList = dao('task')->where('design_id = '.session('user_id').' and loupan_id = '.$_GET['id'].' and huxing_class = '.$_GET['huxing_class'].' and is_receive != 2'.$where)->select();			
				// print_r($apartmentList);exit;
			}else{
				// 全部任务,拒单不显示
				$apartmentList = dao('task')->where('design_id = '.session('user_id').' and loupan_id = '.$_GET['id'].' and is_receive != 2'.$where)->select();
			}
			// print_r($apartmentList);exit;
			// 户型分类
			$apartment_cate = dao('task')->where('design_id = '.session('user_id').' and loupan_id = '.$_GET['id'].$where)->group('huxing_class')->select();			
			// print_r($apartment_cate);exit;
			
			$this->assign('apartmentList', $apartmentList);
			$this->assign('apartment_cate', $apartment_cate);
			$this->assign('loupan_id', $_GET['id']);
			$this->display();		
		}else{
			$this->error("没有传输值");
		}
	}
	
	// 显示户型信息
	public function actionApartment(){
		if(!empty($_GET)){
			$apartment = dao('task')->where('design_id = '.session('user_id').' and task_id = '.$_GET['id'])->find();
			// print_r($apartment);exit;
			if(!empty($apartment)){
				$this->assign('apartment', $apartment);
			}else{
				$this->error("您没有权限操作");
			}
		}
		$this->display();
	}
	
	// 接单|拒单操作
	public function actionChoose(){
		if(!empty($_POST)){
			$Task = D("task");
			$Task->create();
			$Task->is_receive = $_POST['new_id'];
			$Task->design_time = time();
			$result = $Task->where('task_id='.$_POST['task_id'].' and design_id = '.session('user_id'))->save();
			if($result){
				$results['code'] = $_POST['new_id'];
				$this->ajaxReturn($results);
			}else{
				$results['code'] = '0';
				$results['msg'] = '您没有权限操作';
				$this->ajaxReturn($results);
			}
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
