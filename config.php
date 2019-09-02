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

// 系统目录
define('SYSTEM_PATH','system'.DIRECTORY_SEPARATOR);

// 应用目录
define('APP_PATH','app'.DIRECTORY_SEPARATOR);

// Log目录
define('LOG_PATH',SYSTEM_PATH.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR);

// 默认操作名
define('DEFAULT_ACTION','index');