<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

// 加载全局函数
require_once(SYSTEM_PATH . 'base/reg.php');
// 全局变量
$reg = new Reg();

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

function lib($class)
{
	$result = false;

	// 自动装载lib下的根文件和子目录下的文件
	$libsubpath = array(
		'lib' => '/',
		'template' => 'template/',
		'db' => 'db/',
		'cache' => 'cache/',
		'dbdrive' => 'db/drive/'
	);

	//正则去掉$class中的namespace
	if(strrpos($class,"\\")>0){
		$class = preg_replace('/.*\\\\/','',$class);
	}

	foreach ($libsubpath as $key => $value) {
		$file = SYSTEM_PATH . 'lib/' . $value . strtolower($class) . '.php';
		if (is_file($file)) {
			require_once($file);
			$result = true;
			break;
		}
	}
	if($result){
		return true;
	}else{
		return false;
	}
}

spl_autoload_register('lib');
spl_autoload_extensions('.php');

// 日志类初始化
$logger = new Log();
$reg->set('log', $logger);

// 控制器基类
require_once(SYSTEM_PATH . 'base/controller.php');
// 模型基类
require_once(SYSTEM_PATH . 'base/model.php');
// Load引擎
require_once(SYSTEM_PATH . 'base/load.php');
$load = new Load($reg);
$reg->set('load', $load);

// 数据库
$db = new Db($reg);
$reg->set('db',$db);

// 缓存
$cache = new Cache($__['cache_engine'], $__['cache_expire']);
$reg->set('cache', $cache);

// 页面资源
$res = new Res();
$res->addHeader('Content-Type: text/html; charset=utf-8');
$reg->set('res', $res);
// 路由
require_once(SYSTEM_PATH . 'base/router.php');
$router = new Router($_SERVER['REQUEST_URI']);
$router->execute($reg);
// 输出
$res->exp();
