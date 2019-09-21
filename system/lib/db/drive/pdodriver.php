<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class PdoDriver
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

    private $state = null;

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
        if ($this->conn) {
            return true;
        }

        $this->conn = $this->db_connect();

        if (!$this->conn) {
            return false;
        }

        return $this->conn;
    }

    public function db_connect()
    {
        if (!$this->mysql_connect = new PDO("mysql:host=" . $this->hostname . ";port=" . $this->port . ";dbname=" . $this->database, $this->username, $this->password, array(PDO::ATTR_PERSISTENT => true))) {
            return false;
        }

        $this->mysql_connect->exec("SET NAMES 'utf8'");
        $this->mysql_connect->exec("SET CHARACTER SET utf8");
        $this->mysql_connect->exec("SET CHARACTER_SET_CONNECTION=utf8");
        $this->mysql_connect->exec("SET SQL_MODE = ''");

        return $this->mysql_connect;
    }

    public function prepare($sql)
    {
        $this->state = $this->conn->prepare($sql);
    }

    public function bindParam($parameter, $variable, $data_type = PDO::PARAM_STR, $length = 0)
    {
        if ($length) {
            $this->state->bindParam($parameter, $variable, $data_type, $length);
        } else {
            $this->state->bindParam($parameter, $variable, $data_type);
        }
    }

    public function execute()
    {
        if ($this->state && $this->state->execute()) {
            $data = array();

            while ($row = $this->state->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }

            $result = new stdClass();
            $result->row = (isset($data[0])) ? $data[0] : array();
            $result->rows = $data;
            $result->num_rows = $this->state->rowCount();
        }
    }

    public function query($sql, $params = array())
    {
        $this->state = $this->conn->prepare($sql);

        $result = false;

        if ($this->state && $this->state->execute($params)) {
            $data = array();

            while ($row = $this->state->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }

            $result = new stdClass();
            $result->row = (isset($data[0]) ? $data[0] : array());
            $result->rows = $data;
            $result->num_rows = $this->state->rowCount();
        }

        if ($result) {
            return $result;
        } else {
            $result = new stdClass();
            $result->row = array();
            $result->rows = array();
            $result->num_rows = 0;
            return $result;
        }
    }

    public function escape($value)
    {
        return str_replace(array("\\", "\0", "\n", "\r", "\x1a", "'", '"'), array("\\\\", "\\0", "\\n", "\\r", "\Z", "\'", '\"'), $value);
    }

    public function countAffected()
    {
        if ($this->state) {
            return $this->state->rowCount();
        } else {
            return 0;
        }
    }

    public function getLastId()
    {
        return $this->conn->lastInsertId();
    }

    public function isConnected()
    {
        if ($this->conn) {
            return true;
        } else {
            return false;
        }
    }

    public function destruct()
    {
        $this->conn = null;
    }

    public function fetch_assoc()
	{
		return $this->result->fetch(PDO::FETCH_ASSOC);
	}

	public function fetch_object($class_name = 'stdClass')
	{
		return $this->result->fetchObject($class_name);
	}
}
