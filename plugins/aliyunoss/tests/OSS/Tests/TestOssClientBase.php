<?php
//多点乐资源
namespace OSS\Tests;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'Common.php';
class TestOssClientBase extends \PHPUnit_Framework_TestCase
{
	/**
     * @var OssClient
     */
	protected $ossClient;
	/**
     * @var string
     */
	protected $bucket;

	public function setUp()
	{
		$this->bucket = Common::getBucketName();
		$this->ossClient = Common::getOssClient();
		$this->ossClient->createBucket($this->bucket);
	}

	public function tearDown()
	{
	}
}

?>
