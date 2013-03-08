<?php

namespace BDB\Framework\Core;

class Session {
    
	protected static $_instance;
	
	protected static $_id;
	
	protected function __construct() {
		session_start();
		self::$_id = session_id();
	}
	
	public static function GetInstance() {
		if(!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function OffsetExists($key) {
		return (array_key_exists($key, $_SESSION));
	}
	
	public function OffsetGet($key) {
	    if(!$this->KeyExists($key)) {
	    	return FALSE;
	    }
	    $_SESSION[$key];
	}
	
	public function OffsetSet($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	
	public function GetID() {
		return self::$_id;
	}
	
	public function Clear() {
		session_start();
		session_unset();
		session_destroy();
	}
	
}

