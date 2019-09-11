<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Twig {
	private $twig;
	private $data = array();
	
	public function __construct() {
		include_once(SYSTEM_PATH . 'lib/template/Twig/Autoloader.php');
        \Twig_Autoloader::register();
	}
	
	public function set($key, $value) {
		$this->data[$key] = $value;
	}
	
	public function render($template, $cache = false) {
        $logger = new Log();
		$loader = new \Twig_Loader_Filesystem(TEMPLATE_PATH);

		$config = array('autoescape' => false);

        $this->twig = new \Twig_Environment($loader, $config);
		
		try {
            $template = $this->twig->loadTemplate($template.'.html');
			return $template->render($this->data);
		} catch (Exception $e) {
			$logger->write('错误:不能加载模板 ' . $template . '!');
			exit();	
		}	
	}	
}
