<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Except {

    public function show_error($heading, $message, $template = 'show_error', $status_code = 500)
    {
        $templates_path = TEMPLATE_PATH;
        if (empty($templates_path))
		{
			$templates_path = VIEWPATH.DIRECTORY_SEPARATOR;
        }
        ob_start();
		include($templates_path.$template.'.html');
		$buf = ob_get_contents();
		ob_end_clean();
		return $buf;
    }
}