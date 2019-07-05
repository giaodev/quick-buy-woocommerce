<?php  
class quick_buy_woocommerce{
	protected static $instance;
	public function __construct(){

	}
	public static function get_instance(){
		if (self::$instance === null) {
			self::$instance = new quick_buy_woocommerce;
		}
		return self::$instance;
	}
	public static function run(){
		$instance = self::get_instance();
		quick_buy_views::run();
		return $instance;
	}
	public static function plugin_activation(){
		if (version_compare($GLOBALS['wp_version'], QBW_MINIMUM_WP_VERSION, '<')) {
		    die('Error version WP !!');
		}
		$version = get_option('quick_buy_woocommerce');
		if (!$version) {
		    add_option('quick_buy_woocommerce', QBW_VERSION);
		} else {
		    update_option('quick_buy_woocommerce', QBW_VERSION);
		}
	}
	public static function plugin_deactivation(){
        delete_option('quick_buy_woocommerce');
	}
}
?>