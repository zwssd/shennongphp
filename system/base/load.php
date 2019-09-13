<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Load
{
    protected $reg;

    public function __construct($reg)
    {
        $this->reg = $reg;
    }

    public function model($route) {
		$route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route);
		
		if (!$this->reg->has(str_replace('/', '_', $route) . '_model')) {
			$file  = APP_PATH . 'model/' . $route . '.php';
            $class = trim(strrchr($route, '/'),'/') . 'Model';
            $class = preg_replace('/[^a-zA-Z0-9]/', '', $route) . 'Model';

			if (is_file($file)) {
                include_once($file);
                
                $proxy = new $class($this->reg);
				
				$this->reg->set(str_replace('/', '_', (string)$route) . '_model', $proxy);
			} else {
				throw trigger_error('错误：不能取出模型 ' . $route . '!');
			}
		}
	}

    public function controller($route, $data = array())
    {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string) $route);

        $action = new Action($route);
        $output = $action->execute($this->reg, array(&$data));

        return $output;
    }

    public function view($route, $data = array())
    {
        $route = preg_replace('/[^a-zA-Z0-9_\/]/', '', (string) $route);

        $template = '';

        $template = new Template('Twig');

        foreach ($data as $key => $value) {
            $template->set($key, $value);
        }

        $output = $template->render($route, false);

        return $output;
    }

    public function db($params = '',$sql_assembly = NULL)
    {
        $database = '';

        $database = new Db($this->reg);

        return $database->db($params,$sql_assembly);     
    }
}
