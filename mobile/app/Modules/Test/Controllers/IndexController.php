<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
namespace App\Modules\Test\Controllers;

class IndexController extends \App\Modules\Base\Controllers\FrontendController
{	
	public function actionIndex()
	{
		print_r($_POST);exit;
		if(!empty($_POST)){
			$json = array('state' => '1', 'openurl' => 'www.baidu.com');
			print_r(json_decode($_POST['Jsdate']));exit;
		}else{
			print_r('没有获取到值');exit;
		}
					
	}
}

?>
