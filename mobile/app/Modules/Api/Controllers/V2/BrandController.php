<?php
//多点乐资源
namespace App\Modules\Api\Controllers\V2;

class BrandController extends \App\Modules\Api\Foundation\Controller
{
	/** @var  $brand */
	protected $brand;
	/** @var $brandTransformer */
	protected $brandTransformer;

	public function __construct(\App\Repositories\Brand\BrandRepository $brand, \App\Modules\Api\Transformers\BrandTransformer $brandTransformer)
	{
		parent::__construct();
		$this->brand = $brand;
		$this->brandTransformer = $brandTransformer;
	}

	public function actionList()
	{
		$data = $this->brand->getAllBrands();
		$this->apiReturn($data);
	}

	public function actionGet($id)
	{
		$data = $this->brand->getBrandDetail($id);
		$this->apiReturn($data);
	}
}

?>
