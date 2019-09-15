<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Db
{
    protected $mysqlidriver;

    protected $reg;

    public $result;

    public $result_array = array();

    public function __construct($reg)
    {
        $this->reg = $reg;

        $db_config = array(
            'hostname' => DB_HOSTNAME,
	        'port' => DB_PORT,
	        'username' => DB_USERNAME,
	        'password' => DB_PASSWORD,
	        'database' => DB_DATABASE,
	        'dbdriver' => DB_DRIVER,
	        'dbprefix' => ''
        );

        $this->mysqlidriver = new MysqliDriver($db_config);

        $this->mysqlidriver->initialization();
    }

    public function result_array(){
        if (count($this->result_array) > 0)
		{
			return $this->result_array;
        }
        
        if(!$this->result){
            return array();
        }

        while ($row = $this->mysqlidriver->fetch_assoc($this->result))
		{
			$this->result_array[] = $row;
		}

		return $this->result_array;
    }

    public function query($query)
    {
        $results = new stdClass();
        $this->result = $this->mysqlidriver->query($query);
        $results->query = $this->result_array();
        return $results;
    }
}
