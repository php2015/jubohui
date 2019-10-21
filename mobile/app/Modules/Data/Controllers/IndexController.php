<?php
//大商创网络
namespace App\Modules\Data\Controllers;

class IndexController extends \App\Modules\Base\Controllers\FrontendController
{
	protected $trueTableName = 'loupan';	
	protected $connection = array(
		'db_type'  => 'mysql',
		'db_user'  => 'root',
		'db_pwd'   => 'qweasd!@#123',
		'db_host'  => '192.168.78.198',
		'db_port'  => '3306',
		'db_name'  => 'jubohuihxsj',
		'db_charset' => 'utf8',
		'db_PREFIX'  =>  ''
	);
	public function actionIndex()
	{
		$loupan_list = D("loupan")->select();
		print_r($loupan_list);exit;
	}
}

?>
