<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Reg
{
    private $data = array();

    public function get($key)
    {
        return (isset($this->data[$key]) ? $this->data[$key] : null);
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function has($key)
    {
        return isset($this->data[$key]);
    }
}
