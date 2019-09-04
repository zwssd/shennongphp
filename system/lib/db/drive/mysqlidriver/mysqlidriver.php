<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class MysqliDriver
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

    protected $mysqli_connect;

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

        $this->select_db($this->database);

        return $this->set_charset($this->char_set);
    }

    public function db_connect()
    {
        $client_flags = ($this->compress === TRUE) ? MYSQLI_CLIENT_COMPRESS : 0;

        $this->mysqli_connect = mysqli_init();

        $this->mysqli_connect->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);

        if ($this->mysqli_connect->real_connect($this->hostname, $this->username, $this->password, $this->database, $this->port, $this->socket, $client_flags))
        {
            return $this->mysqli_connect;
        }

        return false;
    }

    protected function set_charset($charset)
	{
		return $this->conn->set_charset($charset);
    }
    
    protected function select_db($database = '')
    {
        if($database === '')    
        {
            $database = $this->database;
        }

        if($this->conn->select_db($database))
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
        return $this->conn->query($this->trim_query($sql));
	}

    protected function trim_query($sql){
        if($this->trim_hack === true && preg_match('/^\s*DELETE\s+FROM\s+(\S+)\s*$/i', $sql)){
            return trim($sql).' where 1';
        }
        return $sql;
    }

    public function fetch_assoc($result){
        return $result->fetch_assoc();
    }
}
