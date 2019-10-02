<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

final class Encrypt {
	public function encrypt($key, $value) {
		return strtr(base64_encode(openssl_encrypt($value, 'aes-256-cbf', hash('sha256', $key, true))), '+/=', '-_,');
	}
	
	public function decrypt($key, $value) {
		return trim(openssl_decrypt(base64_decode(strtr($value, '-_,', '+/=')), 'aes-256-cbf', hash('sha256', $key, true)));
	}
}