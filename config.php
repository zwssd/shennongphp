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

// 系统配置
define('SYSTEM_PATH',BASE_PATH.'system'.DIRECTORY_SEPARATOR);

// 应用配置
define('APP_PATH',BASE_PATH.'app'.DIRECTORY_SEPARATOR);

// 模板配置
define('VIEW_PATH',APP_PATH.'view'.DIRECTORY_SEPARATOR);

// Log配置
define('LOG_PATH',SYSTEM_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);

// 缓存配置
define('CACHE_PATH',BASE_PATH.'cache'.DIRECTORY_SEPARATOR);
define('CACHE_PREFIX','sncache');

// Apc, File, Mem, Memcached or Redis
define('CACHE_HOSTNAME','127.0.0.1');//Mem Memcached Redis 主机
define('CACHE_PORT','1234');//Mem Memcached Redis 端口
$__['cache_engine']         = 'File';
$__['cache_expire']         = 3600;

// 默认操作名
define('DEFAULT_ROUTE','blog/default/index');

//数据库配置
define('DB_DRIVER', 'Pdo'); // Mysqli Mysql Pdo Sqlite3
define('DB_DATABASE', 'sn_blog'); // Sqlite3为文件地址:BASE_PATH.'sn_blog.db'
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '123123');
define('DB_PORT', '3306');
define('DB_PREFIX', '');