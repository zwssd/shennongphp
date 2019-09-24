<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Log {
	private $handle;
	
	public function __construct($filename='error.log') {
		$this->handle = fopen(LOG_PATH . $filename, 'a');
	}
	
	public function write($message) {
		fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
	}
	
	public function __destruct() {
		fclose($this->handle);
	}
}