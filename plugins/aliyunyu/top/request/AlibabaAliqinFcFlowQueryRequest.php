<?php
//多点乐资源
class AlibabaAliqinFcFlowQueryRequest
{
	/** 
	 * 唯一流水号
	 **/
	private $outId;
	private $apiParas = array();

	public function setOutId($outId)
	{
		$this->outId = $outId;
		$this->apiParas['out_id'] = $outId;
	}

	public function getOutId()
	{
		return $this->outId;
	}

	public function getApiMethodName()
	{
		return 'alibaba.aliqin.fc.flow.query';
	}

	public function getApiParas()
	{
		return $this->apiParas;
	}

	public function check()
	{
	}

	public function putOtherTextParam($key, $value)
	{
		$this->apiParas[$key] = $value;
		$this->$key = $value;
	}
}


?>
