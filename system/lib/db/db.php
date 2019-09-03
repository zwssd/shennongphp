<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Db
{
    protected $reg;

    public function __construct($reg)
    {
        $this->reg = $reg;
    }

    public function db($params = '', $sql_assembly = NULL)
    {
        if (
            !file_exists($dbfile = APP_PATH . 'config/' . ENV . '/dbconfig.php')
            && !file_exists($dbfile = APP_PATH . 'config/dbconfig.php')
        ) {
            $this->reg->write('没有找到数据库配置文件：dbconfig.php');
            return false;
        }

        include($dbfile);

        $DB = new Mysqli($params);

        var_dump($db);exit;
    }
}
