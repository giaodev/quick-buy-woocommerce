<?php
class quick_buy_admin{
	protected static $instance;
	public function __construct(){

	}
	public static function get_instance(){
		if (self::$instance === null) {
			self::$instance = new quick_buy_admin();
		}
		return self::$instance;
	}
	public static function run(){
		$instance = self::get_instance();
		return $instance;
	}
	public function setting(){
		
	}
}
?>