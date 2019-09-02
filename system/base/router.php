
<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Router
{
    private $route;
    private $method = DEFAULT_ACTION;

    public function __construct($route)
    {
        $routepos = strpos($route,'?route='); 
        if(strpos($route,'?route=')>0){
            $route = substr($route,$routepos+7);
        }else{
            $routepos = strpos($route,'index.php/'); 
            $route = substr($route,$routepos+10);
        }
        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

        while ($parts) {
            $file = APP_PATH . 'controller/' . implode('/', $parts) . '.php';

            if (is_file($file)) {
                $this->route = implode('/', $parts);
                break;
            } else {
                $this->method = array_pop($parts);
            }
        }
    }

    public function execute($args = array()){
        $logger = new Log();
        if (substr($this->method, 0, 2) == '__') {
            return $logger->write('错误：不允许调用魔术方法！');
        }

        $file  = APP_PATH . 'controller/' . $this->route . '.php';	
        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$this->route));
        $class = $parts[1].'Controller';
        
		// 初始化类
		if (is_file($file)) {
			include_once($file);
			$controller = new $class();
		} else {
            return $logger->write('错误：不能调用 ' . $this->route . '/' . $this->method . '！');
        }
        
        $reflection = new ReflectionClass($class);
		
		if ($reflection->hasMethod($this->method) && $reflection->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args)) {
			return call_user_func_array(array($controller, $this->method), $args);
		} else {
			return $logger->write('错误：不能调用 ' . $this->route . '/' . $this->method . '!');
		}
    }
}
