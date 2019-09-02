
<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Router
{
    private $route;
    private $method = DEFAULT_ACTION;

    public function __construct($route)
    {
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
}
