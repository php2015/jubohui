<?php
//多点乐资源
class PHPZip
{
	public $datasec = array();
	public $ctrl_dir = array();
	public $eof_ctrl_dir = "PK\x05\x06\x00\x00\x00\x00";
	public $old_offset = 0;

	public function zip($dir, $zipfilename, $drop = false)
	{
		if (substr($dir, -1) != '/') {
			$dir = ($dir == '' ? './' : $dir . '/');
		}

		if (@function_exists('gzcompress')) {
			$curdir = getcwd();

			if (is_array($dir)) {
				$filelist = $dir;
			}
			else {
				$filelist = $this->get_filelist($dir);
			}

			if (!empty($dir) && !is_array($dir) && file_exists($dir)) {
				chdir($dir);
			}
			else {
				chdir($curdir);
			}

			if (0 < count($filelist)) {
				foreach ($filelist as $filename) {
					if (is_file($filename)) {
						$fd = fopen($filename, 'rb');
						$content = fread($fd, filesize($filename));
						fclose($fd);

						if (is_array($dir)) {
							$filename = basename($filename);
						}

						$this->add_file($content, $filename);

						if ($drop) {
							@unlink($filename);
						}
					}
				}

				$out = $this->file();
				chdir($curdir);
				$fp = fopen($zipfilename, 'wb');
				fwrite($fp, $out, strlen($out));
				fclose($fp);
			}

			return 1;
		}
		else {
			return 0;
		}
	}

	public function get_filelist($dir)
	{
		$file = array();
		$dir = rtrim($dir, '/');

		if (file_exists($dir)) {
			$args = func_get_args();
			$pref = (isset($args[1]) ? $args[1] : '');
			$dh = opendir($dir);

			while (($files = readdir($dh)) !== false) {
				if (($files != '.') && ($files != '..')) {
					if (is_dir($dir . '/' . $files)) {
						$file = array_merge($file, $this->get_filelist($dir . '/' . $files, $pref . $files . '/'));
					}
					else {
						$file[] = $pref . $files;
					}
				}
			}

			closedir($dh);
		}

		return $file;
	}

	public function unix2DosTime($unixtime = 0)
	{
		$timearray = ($unixtime == 0 ? getdate() : getdate($unixtime));

		if ($timearray['year'] < 1980) {
			$timearray['year'] = 1980;
			$timearray['mon'] = 1;
			$timearray['mday'] = 1;
			$timearray['hours'] = 0;
			$timearray['minutes'] = 0;
			$timearray['seconds'] = 0;
		}

		return (($timearray['year'] - 1980) << 25) | ($timearray['mon'] << 21) | ($timearray['mday'] << 16) | ($timearray['hours'] << 11) | ($timearray['minutes'] << 5) | ($timearray['seconds'] >> 1);
	}

	public function add_file($data, $name, $time = 0)
	{
		$name = str_replace('\\', '/', $name);
		$dtime = dechex($this->unix2DosTime($time));
		$hexdtime = '\\x' . $dtime[6] . $dtime[7] . '\\x' . $dtime[4] . $dtime[5] . '\\x' . $dtime[2] . $dtime[3] . '\\x' . $dtime[0] . $dtime[1];
		eval ('$hexdtime = "' . $hexdtime . '";');
		$fr = "PK\x03\x04";
		$fr .= "\x14\x00";
		$fr .= "\x00\x00";
		$fr .= "\x08\x00";
		$fr .= $hexdtime;
		$unc_len = strlen($data);
		$crc = crc32($data);
		$zdata = gzcompress($data);
		$c_len = strlen($zdata);
		$zdata = substr(substr($zdata, 0, strlen($zdata) - 4), 2);
		$fr .= pack('V', $crc);
		$fr .= pack('V', $c_len);
		$fr .= pack('V', $unc_len);
		$fr .= pack('v', strlen($name));
		$fr .= pack('v', 0);
		$fr .= $name;
		$fr .= $zdata;
		$fr .= pack('V', $crc);
		$fr .= pack('V', $c_len);
		$fr .= pack('V', $unc_len);
		$this->datasec[] = $fr;
		$new_offset = strlen(implode('', $this->datasec));
		$cdrec = "PK\x01\x02";
		$cdrec .= "\x00\x00";
		$cdrec .= "\x14\x00";
		$cdrec .= "\x00\x00";
		$cdrec .= "\x08\x00";
		$cdrec .= $hexdtime;
		$cdrec .= pack('V', $crc);
		$cdrec .= pack('V', $c_len);
		$cdrec .= pack('V', $unc_len);
		$cdrec .= pack('v', strlen($name));
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('v', 0);
		$cdrec .= pack('V', 32);
		$cdrec .= pack('V', $this->old_offset);
		$this->old_offset = $new_offset;
		$cdrec .= $name;
		$this->ctrl_dir[] = $cdrec;
	}

	public function file()
	{
		$data = implode('', $this->datasec);
		$ctrldir = implode('', $this->ctrl_dir);
		return $data . $ctrldir . $this->eof_ctrl_dir . pack('v', sizeof($this->ctrl_dir)) . pack('v', sizeof($this->ctrl_dir)) . pack('V', strlen($ctrldir)) . pack('V', strlen($data)) . "\x00\x00";
	}
}

if (!defined('IN_ECS')) {
	exit('Hacking attempt');
}

?>
