<?php
//多点乐资源
namespace OSS\Tests;

class MimeTypesTest extends \PHPUnit_Framework_TestCase
{
	public function testGetMimeType()
	{
		$this->assertEquals('application/xml', \OSS\Core\MimeTypes::getMimetype('file.xml'));
	}
}

?>
