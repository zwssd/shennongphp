<?php

// 配置文件
if(is_file('config.php')){
    require_once('config.php');
}else{
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '没有正确的配置文件。';
	exit(1); // EXIT
}

/* 错误报告
 *
 *
 *
 */
switch (ENV)
{
	case 'dev':
	case 'test':
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
	break;

	case 'pro':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo '应用程序环境未正确设置。';
		exit(1); // EXIT_ERROR
}

// 系统路径是否正确?
if (!is_dir(SYSTEM_PATH))
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '您的系统文件夹路径似乎未正确设置。 请打开以下文件并更正此问题: config.php';
	exit(3); // EXIT
}

// 应用路径是否正确?
if (!is_dir(APP_PATH))
{
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '您的应用文件夹路径似乎未正确设置。 请打开以下文件并更正此问题: config.php';
	exit(3); // EXIT
}

// 加载框架文件
require_once(SYSTEM_PATH . 'ShenNong.php');

// 实例化框架类
$start = new ShenNong;
$start->start();