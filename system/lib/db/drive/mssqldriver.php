<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class MssqlDriver
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

    protected $mssql_connect;

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
        if ($this->mssql_connect = mssql_connect($this->hostname. ':' . $this->port, $this->username, $this->password)) {

            if (!mssql_select_db($this->database, $this->link)) {
                return false;
            }

            mssql_query("SET NAMES 'utf8'", $this->mssql_connect);
		    mssql_query("SET CHARACTER SET utf8", $this->mssql_connect);
            return $this->mssql_connect;
        }

        return false;
    }

    public function escape($value) {
		$unpacked = unpack('H*hex', $value);

		return '0x' . $unpacked['hex'];
	}

	public function countAffected() {
		return mssql_rows_affected($this->connection);
	}

	public function getLastId() {
		$last_id = false;

		$resource = mssql_query("SELECT @@identity AS id", $this->connection);

		if ($row = mssql_fetch_row($resource)) {
			$last_id = trim($row[0]);
		}

		mssql_free_result($resource);

		return $last_id;
	}

	public function destruct() {
		mssql_close($this->connection);
	}
}
