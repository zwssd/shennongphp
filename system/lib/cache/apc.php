<?php
namespace Cache;
class Apc {
	private $exp;
	private $active = false;

	public function __construct($exp) {
		$this->exp = $exp;
		$this->active = function_exists('apc_cache_info') && ini_get('apc.enabled');
	}

	public function get($key) {
		return $this->active ? apc_fetch(CACHE_PREFIX . $key) : false;
	}

	public function set($key, $value) {
		return $this->active ? apc_store(CACHE_PREFIX . $key, $value, $this->exp) : false;
	}

	public function delete($key) {
		if (!$this->active) {
			return false;
		}
		
		$cache_info = apc_cache_info('user');
		$cache_list = $cache_info['cache_list'];
		foreach ($cache_list as $entry) {
			if (strpos($entry['info'], CACHE_PREFIX . $key) === 0) {
				apcu_delete($entry['info']);
			}
		}
	}
}
