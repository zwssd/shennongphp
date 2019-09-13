<?php
/**
* Model class
*/
abstract class Model {
	protected $reg;

	public function __construct($reg) {
		$this->reg= $reg;
	}

	public function __get($key) {
		return $this->reg->get($key);
	}

	public function __set($key, $value) {
		$this->reg->set($key, $value);
	}
}