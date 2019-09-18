<?php
namespace Cache;
class Memcached {
	private $exp;
	private $memcached;

	const CACHEDUMP_LIMIT = 9999;

	public function __construct($exp) {
		$this->exp = $exp;
		$this->memcached = new \Memcached();

		$this->memcached->addServer(CACHE_HOSTNAME, CACHE_PORT);
	}

	public function get($key) {
		return $this->memcached->get(CACHE_PREFIX . $key);
	}

	public function set($key, $value) {
		return $this->memcached->set(CACHE_PREFIX . $key, $value, $this->exp);
	}

	public function delete($key) {
		$this->memcached->delete(CACHE_PREFIX . $key);
	}
}
