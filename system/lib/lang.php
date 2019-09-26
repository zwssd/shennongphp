<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Lang {
	private $directory;
	public $data = array();
	
	public function __construct($directory = '') {
        $this->directory = $directory;
	}
	
	public function get_key($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : $key);
	}
	
	public function set_key($key, $value) {
		$this->data[$key] = $value;
	}
	
	public function get_all() {
		return $this->data;
	}
	
	public function load_lang($filename, $key = '') {
		if (!$key) {
			$___ = array();
	
			$file = LANG_PATH . $this->directory . '/' . $filename . '.php';
			
			if (is_file($file)) {
				require($file);
			} 
	
			$this->data = array_merge($this->data, $___);
		} else {
			// 将语言存到key
			$this->data[$key] = new Lang($this->directory);
			$this->data[$key]->load_lang($filename);
		}
		
		return $this->data;
	}
}