<?php
//多点乐资源
namespace app\models;

class Data extends \Illuminate\Database\Eloquent\Model
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
}

?>