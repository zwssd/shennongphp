<?php
namespace Cache;
class Mem {
	private $exp;
	private $memcache;
	
	const CACHEDUMP_LIMIT = 9999;

	public function __construct($exp) {
		$this->exp = $exp;

		$this->memcache = new \Memcache();
		$this->memcache->pconnect(CACHE_HOSTNAME, CACHE_PORT);
	}

	public function get($key) {
		return $this->memcache->get(CACHE_PREFIX . $key);
	}

	public function set($key, $value) {
		return $this->memcache->set(CACHE_PREFIX . $key, $value, MEMCACHE_COMPRESSED, $this->exp);
	}

	public function delete($key) {
		$this->memcache->delete(CACHE_PREFIX . $key);
	}
}
