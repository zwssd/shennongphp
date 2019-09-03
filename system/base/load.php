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
