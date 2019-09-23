<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

if (MB_ENABLED === TRUE)
{
	return;
}

if (!function_exists('mb_strlen'))
{
	function mb_strlen($str, $encoding = null)
	{
		global $logger;
		if (ICONV_ENABLED === TRUE)
		{
			return iconv_strlen($str, isset($encoding) ? $encoding : null);
		}

        $logger->write('函数iconv_strlen()没有找到！');
		return strlen($str);
	}
}

if (!function_exists('mb_strpos'))
{
	function mb_strpos($haystack, $needle, $offset = 0, $encoding = null)
	{
		global $logger;
		if (ICONV_ENABLED === TRUE)
		{
			return iconv_strpos($haystack, $needle, $offset, isset($encoding) ? $encoding : null);
        }
        
        $logger->write('函数iconv_strpos()没有找到！');

		return strpos($haystack, $needle, $offset);
	}
}

if (!function_exists('mb_substr'))
{
	function mb_substr($str, $start, $length = null, $encoding = null)
	{
		global $logger;
		if (ICONV_ENABLED === TRUE)
		{
			isset($encoding) OR $encoding = null;
			return iconv_substr($str,$start,isset($length) ? $length : iconv_strlen($str, $encoding), $encoding);
		}

        $logger->write('函数iconv_substr()没有找到！');
		return isset($length)
			? substr($str, $start, $length)
			: substr($str, $start);
	}
}