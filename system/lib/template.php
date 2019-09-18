<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Template
{

    private $adap;

    public function __construct($adap) {
        $class = $adap;
        
        $logger = new Log();
		if (class_exists($class)) {
            $this->adap = new $class();
		} else {
            throw $logger->write('错误：无法加载模板适配器 ' . $adap . '!');
        }
    }

    public function set($key, $value) {
		$this->adap->set($key, $value);
	}
	
	public function render($template, $cache = false) {
		return $this->adap->render($template, $cache);
	}
}
