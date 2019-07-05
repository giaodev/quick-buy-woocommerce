<?php
/*
Plugin Name: Quick Buy Woocommerce
Plugin URI: giaovn.com
Description: Quick Buy Woocommerce
Version: 0.1.0
Author: Giao Vu
Author URI: giaovn.com
Text Domain: giaovn
Domain Path: /languages
*/
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'QBW_VERSION', '0.1.0' );
define( 'QBW_MINIMUM_WP_VERSION', '4.0' );
define( 'QBW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'QBW_DELETE_LIMIT', 100000 );
require_once( QBW_PLUGIN_DIR . 'class.quick-buy-woocommerce-admin.php' );
require_once( QBW_PLUGIN_DIR . 'class.quick-buy-woocommerce-views.php' );
require_once( QBW_PLUGIN_DIR . 'class.quick-buy-woocommerce.php' );
quick_buy_woocommerce::run();
register_activation_hook( __FILE__, array( 'quick_buy_woocommerce', 'plugin_activation' ) );
register_deactivation_hook( __FILE__, array( 'quick_buy_woocommerce', 'plugin_deactivation' ) );
