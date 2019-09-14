<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

$sql_assembly = TRUE;

$db_config = array(
	'hostname' => 'localhost',
	'port' => '3306',
	'username' => 'root',
	'password' => '123123',
	'database' => 'test',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENV !== 'pro'),
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE,
	'cache_on' => FALSE,
	'cachedir' => ''
);