<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

if(!function_exists('handler_error')) {
    function handler_error($code, $message, $file, $line)
    {
        if (error_reporting() === 0) {
            return false;
        }

        switch ($code) {
            case E_NOTICE:
            case E_USER_NOTICE:
                $error = 'Notice';
                break;
            case E_WARNING:
            case E_USER_WARNING:
                $error = 'Warning';
                break;
            case E_ERROR:
            case E_USER_ERROR:
                $error = 'Fatal Error';
                break;
            default:
                $error = 'Unknown';
                break;
        }

        echo '<b>' . $error . '</b>: ' . $message . ' in <b>' . $file . '</b> on line <b>' . $line . '</b>';

        return true;
    }
}

if (!function_exists('show_error'))
{
	function show_error($message, $status_code = 500, $heading = '遇到错误')
	{
        global $reg;

		$status_code = abs($status_code);
		if ($status_code < 100)
		{
			$exit_status = $status_code + 9; // 9 is EXIT__AUTO_MIN
			$status_code = 500;
		}
		else
		{
			$exit_status = 1; // EXIT_ERROR
		}

		$except = new Except($reg->get('load'));
		echo $except->show_error($heading, $message, 'show_error', $status_code);
		exit($exit_status);
	}
}

if (!function_exists('get_config'))
{
	function get_config($item)
	{
        global $__;

		if (!empty($__))
		{
            return isset($__[$item]) ? $__[$item] : NULL; 
        }
        
        set_status_header(503);
		echo '配置文件错误！';
		exit(3); // EXIT_CONFIG
	}
}
