<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Res
{
    private $header = array();
    private $out;

    public function addHeader($header)
    {
        $this->header[] = $header;
    }

    public function getOut()
    {
        return $this->out;
    }

    public function setOut($out)
    {
        $this->out = $out;
    }

    public function out()
    {
        if ($this->out) {
            foreach ($this->header as $header) {
                header($header, true);
            }
            echo $this->out;
        }
    }
}
