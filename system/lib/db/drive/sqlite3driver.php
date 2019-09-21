<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Sqlite3Driver
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

        return $this->conn;
    }

    public function db_connect()
    {
        return ( ! $this->password) ? new SQLite3($this->database) : new SQLite3($this->database, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $this->password);
    }

    public function query($sql)
	{
        return $this->is_write_type($sql) ? $this->conn->exec($sql) : $this->conn->query($sql);
    }
    
    public function is_write_type($sql)
	{
		return (bool) preg_match('/^\s*"?(SET|INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|TRUNCATE|LOAD|COPY|ALTER|RENAME|GRANT|REVOKE|LOCK|UNLOCK|REINDEX|MERGE)\s/i', $sql);
	}


    protected function trim_query($sql){
        if($this->trim_hack === true && preg_match('/^\s*DELETE\s+FROM\s+(\S+)\s*$/i', $sql)){
            return trim($sql).' where 1';
        }
        return $sql;
    }

    public function fetch_assoc($result){
        return $result->fetchArray();
    }

    public function fetch_object($result,$class_name = 'stdClass')
	{
		// No native support for fetching rows as objects
		if (($row = $result->fetchArray(SQLITE3_ASSOC)) === FALSE)
		{
			return FALSE;
		}
		elseif ($class_name === 'stdClass')
		{
			return (object) $row;
		}

		$class_name = new $class_name();
		foreach (array_keys($row) as $key)
		{
			$class_name->$key = $row[$key];
		}

		return $class_name;
	}
}
