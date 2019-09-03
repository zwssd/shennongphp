<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

abstract class Controller {
	protected $reg;

	public function __construct($reg) {
		$this->reg = $reg;
	}

	public function __get($key) {
		return $this->reg->get($key);
	}

	public function __set($key, $value) {
		$this->reg->set($key, $value);
	}
}