<?php
//zend by 多点乐 禁止倒卖 一经发现停止任何服务
namespace App\Models;

class TouchUpgrade extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'touch_upgrade';
	public $timestamps = false;
	protected $fillable = array('upgrade', 'time');
	protected $guarded = array();

	public function getUpgrade()
	{
		return $this->upgrade;
	}

	public function getTime()
	{
		return $this->time;
	}

	public function setUpgrade($value)
	{
		$this->upgrade = $value;
		return $this;
	}

	public function setTime($value)
	{
		$this->time = $value;
		return $this;
	}
}

?>
