<?php
//多点乐资源
namespace App\Contracts\Services;

interface CategoryServiceInterface
{
	public function create();

	public function get();

	public function update();

	public function delete();

	public function search();

	public function category();
}


?>
