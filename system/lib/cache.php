<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Cache {
	private $adap;
	
	public function __construct($adap, $exp = 3600) {
		$class = 'Cache\\' . $adap;


		if (class_exists($class)) {
			$this->adap = new $class($exp);
		} else {
			throw new \Exception('错误：不能取出缓存适配器 ' . $adap . ' 缓存！');
		}
	}
	
	public function get($key) {
		return $this->adap->get($key);
	}
	
	public function set($key, $value) {
		return $this->adap->set($key, $value);
	}
   
	public function del($key) {
		return $this->adap->del($key);
	}
}
