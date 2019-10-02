<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Encryption {
	private $method = 'aes-256-cbc';
	private $ivlen;
	private $iv;
	
	public function __construct(){
		// 处理iv向量的两行代码
        $this->ivlen = openssl_cipher_iv_length($this->method);
        $this->iv = openssl_random_pseudo_bytes($this->ivlen);
    }

	public function encrypt($key, $value) {
		return strtr(base64_encode(openssl_encrypt($value, $this->method, hash('sha256', $key, true),0,$this->iv)), '+/=', '-_,');
	}
	
	public function decrypt($key, $value) {
		return trim(openssl_decrypt(base64_decode(strtr($value, '-_,', '+/=')), $this->method, hash('sha256', $key, true),0,$this->iv));
	}
}