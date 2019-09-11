<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Res
{
    private $header = array();
    private $exp;

    public function addHeader($header)
    {
        $this->header[] = $header;
    }

    public function getExp()
    {
        return $this->exp;
    }

    public function setExp($exp)
    {
        $this->exp = $exp;
    }

    public function exp()
    {
        if ($this->exp) {
            foreach ($this->header as $header) {
                header($header, true);
            }
            echo $this->exp;
        }
    }
}
