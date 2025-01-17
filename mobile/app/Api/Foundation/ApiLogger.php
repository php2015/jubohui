<?php
//多点乐资源
namespace App\Api\Foundation;

class ApiLogger
{
	const DEBUG = \Monolog\Logger::DEBUG;
	const INFO = \Monolog\Logger::INFO;
	const NOTICE = \Monolog\Logger::NOTICE;
	const WARNING = \Monolog\Logger::WARNING;
	const ERROR = \Monolog\Logger::ERROR;

	static private $logger;
	static private $filePath;
	static private $level = array('debug' => self::DEBUG, 'info' => self::INFO, 'notice' => self::NOTICE, 'warning' => self::WARNING, 'error' => self::ERROR);

	static public function init($name = 'api', $level = 'error')
	{
		$logFile = self::getLogFile();
		self::$logger = new \Monolog\Logger($name);
		$l = self::$level[$level];

		if (empty($l)) {
			exit('错误等级不在范围内');
		}

		self::$logger->pushHandler(new \Monolog\Handler\StreamHandler($logFile, $l));
		return self::$logger;
	}

	static public function setLogFile($path)
	{
		if (empty($path)) {
			return NULL;
		}

		self::$filePath = $path;
	}

	static public function getLogFile()
	{
		$path = self::$filePath;

		if (empty($path)) {
			$path = ROOT_PATH . 'storage/monologs/' . date('y_m_d') . '.log';
		}

		return $path;
	}
}


?>
