<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Template
{

    private $adaptor;

    public function __construct($adaptor) {
        $class = $adaptor;
        
        $logger = new Log();
		if (class_exists($class)) {
            $this->adaptor = new $class();
		} else {
            throw $logger->write('错误：无法加载模板适配器 ' . $adaptor . '!');
        }
    }

    public function set($key, $value) {
		$this->adaptor->set($key, $value);
	}
	
	public function render($template, $cache = false) {
		return $this->adaptor->render($template, $cache);
	}
}
