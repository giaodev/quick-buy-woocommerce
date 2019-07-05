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
		add_action('admin_menu', function() use ($instance){
			add_submenu_page(
				'woocommerce',
		        printf(__('Quick Buy','giaovn')), //page title
		        'Quick Buy', //menu title
		        'edit_themes', //capability,
		        'quick-buy-woocommerce',//menu slug
		        array($instance, 'quick_buy_log') //callback function
			);
		},99);
		return $instance;
	}
	public static function quick_buy_log(){
		echo 'abc';
	}
}
?>