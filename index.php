<?php

// 配置文件
if (!file_exists($config = 'config.php')) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '没有正确的配置文件。';
	exit(1); // EXIT
}
require_once($config);

/* 
 * 错误报告
 */
switch (ENV) {
	case 'dev':
	case 'test':
		error_reporting(E_ALL);
		ini_set('display_errors', 'On');
		break;

	case 'pro':
		ini_set('display_errors', 'Off');
		error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
		break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo '应用程序环境未正确设置。';
		exit(1); // EXIT_ERROR
}

// 系统路径是否正确?
if (!is_dir(SYSTEM_PATH)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '您的系统文件夹路径似乎未正确设置。 请打开以下文件并更正此问题: config.php';
	exit(3); // EXIT
}

// 应用路径是否正确?
if (!is_dir(APP_PATH)) {
	header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
	echo '您的应用文件夹路径似乎未正确设置。 请打开以下文件并更正此问题: config.php';
	exit(3); // EXIT
}

// 加载框架文件
require_once(SYSTEM_PATH . 'base/shennong.php');