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
define('BASE_PATH',realpath(dirname(__FILE__).'/../').DIRECTORY_SEPARATOR);

// 系统目录
define('SYSTEM_PATH',BASE_PATH.'system'.DIRECTORY_SEPARATOR);

// 应用目录
define('APP_PATH',BASE_PATH.'admin'.DIRECTORY_SEPARATOR);

// 模板目录
define('VIEW_PATH',APP_PATH.'view'.DIRECTORY_SEPARATOR);

// Log目录
define('LOG_PATH',SYSTEM_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);

// 缓存配置
define('CACHE_PATH',BASE_PATH.'cache'.DIRECTORY_SEPARATOR);
define('CACHE_PREFIX','sncache');
// Apc, File, Mem, Memcached or Redis
$__['cache_engine']         = 'File';
$__['cache_expire']         = 3600;

// 默认操作名
define('DEFAULT_ACTION','index');

//数据库
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'test1');
define('DB_PORT', '3306');
define('DB_PREFIX', '');