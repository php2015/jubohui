<?php
//zend by 多点乐资源
namespace App\Modules\Api\Transformers;

class BrandTransformer
{
	public function transform(array $map)
	{
		return array('id' => $map['article_id'], 'title' => $map['title']);
	}
}


?>
