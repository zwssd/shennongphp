<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Utf8 {

	private $logger;

	public function __construct($reg)
	{
		$this->logger = $reg;

		if (defined('PREG_BAD_UTF8_ERROR') && (ICONV_ENABLED === TRUE OR MB_ENABLED === TRUE) && str_replace('-','',strtoupper(config_item('charset'))) === 'UTF8')
		{
			define('UTF8_ENABLED', TRUE);
			$this->logger->write('UTF-8 可用');
		}
		else
		{
			define('UTF8_ENABLED', FALSE);
			$this->logger->write('UTF-8 被禁用');
		}

		$this->logger->write('Utf8 类已经初始化');
	}

	public function clean_string($str)
	{
		if ($this->is_ascii($str) === FALSE)
		{
			if (MB_ENABLED)
			{
				$str = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
			}
			elseif (ICONV_ENABLED)
			{
				$str = @iconv('UTF-8', 'UTF-8//IGNORE', $str);
			}
		}

		return $str;
	}

	public function safe_ascii_for_xml($str)
	{
		return remove_invisible_characters($str, FALSE);
	}

	public function convert_to_utf8($str, $encoding)
	{
		if (MB_ENABLED)
		{
			return mb_convert_encoding($str, 'UTF-8', $encoding);
		}
		elseif (ICONV_ENABLED)
		{
			return @iconv($encoding, 'UTF-8', $str);
		}

		return FALSE;
	}

	public function is_ascii($str)
	{
		return (preg_match('/[^\x00-\x7F]/S', $str) === 0);
	}
}
