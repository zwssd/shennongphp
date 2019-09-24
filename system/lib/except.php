<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Except {
	private $load;
	
	public function __construct($load) {
		$this->load = $load;
	}
	
	public function show_error($heading, $message, $template = 'show_error', $status_code = 500) {
		return $this->load->view($template,$message);
	}
}