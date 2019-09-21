<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class MysqlDriver
{

    public $hostname;
    public $port;
    public $username;
    public $password;
    public $database;
    public $dbdriver;
    public $dbprefix;
    public $pconnect;
    public $db_debug;
    public $char_set;
    public $dbcollat;
    public $swap_pre;
    public $encrypt;
    public $compress;
    public $stricton;
    public $failover;
    public $save_queries;
    public $cache_on;
    public $cachedir;
    public $socket = null;

    protected $conn;
    protected $conn_result;

    protected $mysql_connect;

    public $trim_hack = true;

    public function __construct($params)
    {
        if (is_array($params)) {
            foreach ($params as $key => $val) {
                $this->$key = $val;
            }
        }
    }

    public function initialization()
    {
        if($this->conn){
            return true;
        }

        $this->conn = $this->db_connect();

        if(!$this->conn){
            return false;
        }

        return $this->select_db($this->database);
    }

    public function db_connect()
    {
        $client_flags = ($this->compress === TRUE) ? MYSQL_CLIENT_COMPRESS : 0;

        if (!$this->mysql_connect = mysql_connect($this->hostname.':'.$this->port, $this->username, $this->password, true, $client_flags))
        {
            return false;
        }

        return $this->mysql_connect;
    }

    protected function select_db($database = '')
    {
        if($database === '')    
        {
            $database = $this->database;
        }

        if($this->conn = mysql_select_db($database,$this->conn))
        {
            $this->database = $database;
			$this->data_cache = array();
			return true;
        }

        return false;
    }

    protected function get_tables(){
        $sql = 'show tables from '.$this->database;
        return $sql;
    }

    protected function get_columns($table = ''){
        if($table !== ''){
            $sql = 'show columns from '.$table;
            return $sql;
        }else{
            return false;
        }
    }

    public function query($sql)
	{
        $this->conn = mysql_query($this->trim_query($sql));
        return $this->conn;
	}

    protected function trim_query($sql){
        if($this->trim_hack === true && preg_match('/^\s*DELETE\s+FROM\s+(\S+)\s*$/i', $sql)){
            return trim($sql).' where 1';
        }
        return $sql;
    }

    public function fetch_assoc($result){
        return mysql_fetch_assoc($result);
    }
}
