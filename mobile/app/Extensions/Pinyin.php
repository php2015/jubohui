<?php
//多点乐资源
namespace App\Extensions;

class Pinyin
{
	public function output($str, $utf8 = true)
	{
		$pinyin = new \Overtrue\Pinyin\Pinyin();
		return $pinyin->convert($str);
	}
}


?>
