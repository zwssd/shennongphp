<?php

// 框架根
defined('SYSTEM_PATH') or exit('没有有效的根路径！');

class Email {
	protected $to;
	protected $from;
	protected $sender;
	protected $reply_to;
	protected $subject;
	protected $text;
	protected $html;
	protected $attachments = array();
	public $parameter;

	public function __construct($adaptor = 'mail') {
		$class = 'Email\\' . $adaptor;
		
		if (class_exists($class)) {
			$this->adaptor = new $class();
		} else {
			trigger_error('错误：无法加载邮件适配器' . $adaptor . '！');
			exit();
		}	
	}
	
	public function setTo($to) {
		$this->to = $to;
	}
	
	public function setFrom($from) {
		$this->from = $from;
	}
	
	public function setSender($sender) {
		$this->sender = $sender;
	}
	
	public function setReplyTo($reply_to) {
		$this->reply_to = $reply_to;
	}
	
	public function setSubject($subject) {
		$this->subject = $subject;
	}
	
	public function setText($text) {
		$this->text = $text;
	}
	
	public function setHtml($html) {
		$this->html = $html;
	}
	
	public function addAttachment($filename) {
		$this->attachments[] = $filename;
	}
	
	public function send() {
		if (!$this->to) {
			throw new Exception('错误：E-Mail接收地址必填！');
		}

		if (!$this->from) {
			throw new Exception('错误：E-Mail发送地址必填！');
		}

		if (!$this->sender) {
			throw new Exception('错误：E-Mail发件人必填！');
		}

		if (!$this->subject) {
			throw new Exception('错误：E-Mail主题必填！');
		}

		if ((!$this->text) && (!$this->html)) {
			throw new Exception('错误：E-Mail内容必填！');
		}
		
		foreach (get_object_vars($this) as $key => $value) {
			$this->adaptor->$key = $value;
		}
		
		$this->adaptor->send();
	}
}