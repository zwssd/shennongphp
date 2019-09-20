<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Db
{
    protected $driver;

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

        $class = DB_DRIVER.'Driver';

        $this->driver = new $class($db_config);

        $this->driver->initialization();
    }

    public function result_array(){
        if (count($this->result_array) > 0)
		{
			return $this->result_array;
        }
        
        if(!$this->result){
            return array();
        }

        while ($row = $this->driver->fetch_assoc($this->result))
		{
			$this->result_array[] = $row;
		}

		return $this->result_array;
    }

    public function query($query)
    {
        $results = new stdClass();
        $this->result = $this->driver->query($query);
        $results->query = $this->result_array();
        return $results;
    }
}
