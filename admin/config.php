<?php

// 框架版本
define('VERSION','1.0.0');

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

// 系统配置
define('SYSTEM_PATH',BASE_PATH.'system'.DIRECTORY_SEPARATOR);

// 图片目录
define('PIC_PATH',BASE_PATH.'image'.DIRECTORY_SEPARATOR);

// 上传文件目录
define('UPLOAD_PATH',BASE_PATH.'upload'.DIRECTORY_SEPARATOR);

// 应用配置
define('APP_PATH',BASE_PATH.'app'.DIRECTORY_SEPARATOR);

// 模板配置
define('VIEW_PATH',APP_PATH.'view'.DIRECTORY_SEPARATOR);

// Log配置
define('LOG_PATH',SYSTEM_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);

// Lang配置
define('LANG_PATH',APP_PATH.DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR);

// 缓存配置
define('CACHE_PATH',BASE_PATH.'cache'.DIRECTORY_SEPARATOR);
define('CACHE_PREFIX','sncache');

// Apc, File, Mem, Memcached or Redis
define('CACHE_HOSTNAME','');//Mem Memcached Redis 主机
define('CACHE_PORT','');//Mem Memcached Redis 端口
$__['cache_engine']         = 'File';
$__['cache_expire']         = 3600;

// 默认操作名
define('DEFAULT_ROUTE','blog/default');
define('DEFAULT_METHOD','index');

// 字符串操作
if (extension_loaded('mbstring')) {
	define('MB_ENABLED', TRUE);
	@ini_set('mbstring.internal_encoding', $charset);
	mb_substitute_character('none');
} else {
	define('MB_ENABLED', FALSE);
}

if (extension_loaded('iconv')) {
	define('ICONV_ENABLED', TRUE);
	@ini_set('iconv.internal_encoding', $charset);
} else {
	define('ICONV_ENABLED', FALSE);
}

//数据库配置
define('DB_DRIVER', ''); // Mysqli Mysql Pdo Sqlite3
define('DB_DATABASE', ''); // Sqlite3为文件地址:BASE_PATH.'sn_blog.db'
define('DB_HOSTNAME', '');
define('DB_USERNAME', '');
define('DB_PASSWORD', '');
define('DB_PORT', '');
define('DB_PREFIX', '');

$__['charset'] = 'utf8';
$__['lang'] = 'zh-cn';