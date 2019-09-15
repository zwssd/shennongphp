<?php

// 框架版本
define('VERSION','0.0.1');

/* 应用环境
 *
 *  dev
 *  test
 *  pro
 *
 */
define('ENV', 'dev');

// 根目录
define('BASE_PATH',str_replace('\\','/',realpath(dirname(__FILE__).'/'))."/");

// 系统目录
define('SYSTEM_PATH',BASE_PATH.'system'.DIRECTORY_SEPARATOR);

// 应用目录
define('APP_PATH',BASE_PATH.'app'.DIRECTORY_SEPARATOR);

// 模板目录
define('VIEW_PATH',APP_PATH.'view'.DIRECTORY_SEPARATOR);

// Log目录
define('LOG_PATH',SYSTEM_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);

// 默认操作名
define('DEFAULT_ACTION','index');

//数据库
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123123');
define('DB_DATABASE', 'test');
define('DB_PORT', '3306');
define('DB_PREFIX', '');