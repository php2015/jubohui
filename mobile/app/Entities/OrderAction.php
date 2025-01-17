<?php
//zend by 多点乐  禁止倒卖 一经发现停止任何服务
namespace App\Entities;

class OrderAction extends \Illuminate\Database\Eloquent\Model
{
	protected $table = 'order_action';
	protected $primaryKey = 'action_id';
	public $timestamps = false;
	protected $fillable = array('order_id', 'action_user', 'order_status', 'shipping_status', 'pay_status', 'action_place', 'action_note', 'log_time');
	protected $guarded = array();

	public function getOrderId()
	{
		return $this->order_id;
	}

	public function getActionUser()
	{
		return $this->action_user;
	}

	public function getOrderStatus()
	{
		return $this->order_status;
	}

	public function getShippingStatus()
	{
		return $this->shipping_status;
	}

	public function getPayStatus()
	{
		return $this->pay_status;
	}

	public function getActionPlace()
	{
		return $this->action_place;
	}

	public function getActionNote()
	{
		return $this->action_note;
	}

	public function getLogTime()
	{
		return $this->log_time;
	}

	public function setOrderId($value)
	{
		$this->order_id = $value;
		return $this;
	}

	public function setActionUser($value)
	{
		$this->action_user = $value;
		return $this;
	}

	public function setOrderStatus($value)
	{
		$this->order_status = $value;
		return $this;
	}

	public function setShippingStatus($value)
	{
		$this->shipping_status = $value;
		return $this;
	}

	public function setPayStatus($value)
	{
		$this->pay_status = $value;
		return $this;
	}

	public function setActionPlace($value)
	{
		$this->action_place = $value;
		return $this;
	}

	public function setActionNote($value)
	{
		$this->action_note = $value;
		return $this;
	}

	public function setLogTime($value)
	{
		$this->log_time = $value;
		return $this;
	}
}

?>
