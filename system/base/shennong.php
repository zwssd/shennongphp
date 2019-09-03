<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

// 加载公共函数
require_once(SYSTEM_PATH . 'base/global.php');

// 自定义错误处理
set_error_handler('handler_error');

// 自动装载
if (is_file(SYSTEM_PATH . 'vendor/autoload.php')) {
	require_once(SYSTEM_PATH . 'vendor/autoload.php');
}

if (!isset($_SERVER['REQUEST_URI'])) {
	$_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1);

	if (isset($_SERVER['QUERY_STRING'])) {
		$_SERVER['REQUEST_URI'] .= '?' . $_SERVER['QUERY_STRING'];
	}
}

// Log
require_once(SYSTEM_PATH . 'lib/log.php');
// Twig模板引擎
require_once(SYSTEM_PATH . 'lib/template/twig.php');
require_once(SYSTEM_PATH . 'lib/template.php');
// Load引擎
require_once(SYSTEM_PATH . 'base/load.php');
$load = new Load();
$tpl = $load->view('aaa/bbb',array('aa'=>'bb'));
echo $tpl;exit;
// 路由
require_once(SYSTEM_PATH . 'base/router.php');
$router = new Router($_SERVER['REQUEST_URI']);
$router->execute();
