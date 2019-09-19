
<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Router
{
    private $route = DEFAULT_ROUTE;
    private $method;
    private $error = array(
        'error_title'=>'',
        'error_message'=>''
    );

    public function __construct($route)
    {
        $routepos = strpos($route,'?route=');
        if($routepos>0){
            $this->route = substr($route,$routepos+7);
        }

        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$this->route));

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

    public function execute($reg,$args = array()){
        $logger = new Log();
        if (substr($this->method, 0, 2) == '__') {
            $logger->write('错误：不允许调用魔术方法！');
        }

        $file  = APP_PATH . 'controller/' . $this->route . '.php';	
        $parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$this->route));
        $class = $parts[1].'Controller';
        
		// 初始化类
		if (is_file($file)) {
			include_once($file);
			$controller = new $class($reg);
		} else {
            $error['error_title'] = '路由报错';
            $error['error_message'] = '错误：不能调用 ' . $this->route . '/' . $this->method . '！';
            $logger->write($error['error_message']);
            $reg->get('res')->setExp($reg->get('load')->view('show_error',$error));
        }
        
        $reflection = new ReflectionClass($class);
		
		if ($reflection->hasMethod($this->method) && $reflection->getMethod($this->method)->getNumberOfRequiredParameters() <= count($args)) {
			call_user_func_array(array($controller, $this->method), $args);
		} else {
            $error['error_title'] = '路由报错';
            $error['error_message'] = '错误：不能回调 ' . $this->route . '/' . $this->method . '！';
            $logger->write($error['error_message']);
            $reg->get('res')->setExp($reg->get('load')->view('show_error',$error));
		}
    }
}
