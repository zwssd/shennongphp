<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Db
{
    protected $DB;

    protected $reg;

    public $result;

    public $result_array = array();

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

        require_once($dbfile);

        $this->DB = new Mysqli($db);

        $this->DB->init();

        $this->result = $this->DB->query('select * from test');
    }

    public function result_array(){
        if (count($this->result_array) > 0)
		{
			return $this->result_array;
        }
        
        if(!$this->result){
            return array();
        }

        while ($row = $this->DB->mysqli_fetch_assoc())
		{
			$this->result_array[] = $row;
		}

		return $this->result_array;
    }
}
