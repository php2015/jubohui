<?php
//多点乐资源
namespace OSS\Tests;

class HeaderResultTest extends \PHPUnit_Framework_TestCase
{
	public function testGetHeader()
	{
/* [31m * TODO SEPARATE[0m */
		$response = new \OSS\Http\ResponseCore(array('key' => 'value'), '', 200);
		$result = new \OSS\Result\HeaderResult($response);
		$this->assertTrue($result->isOK());
		$this->assertTrue(is_array($result->getData()));
		$this->assertEquals($result->getData()['key'], 'value');
	}
}

?>
