<?php
class quick_buy_admin{
	protected static $instance;
	protected static $option;
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
		self::$option = get_option('_quick_buy');
		add_action('admin_menu', function() use ($instance){
			add_submenu_page(
				'woocommerce',
				'Quick Buy',
				'Quick Buy',
		        'edit_themes', //capability,
		        'quick-buy-woocommerce',//menu slug
		        array($instance, 'quick_buy_setting') //callback function
		    );
		},99);
		add_action('admin_init', array($instance, 'setup_setting'));
		return $instance;
	}
	public static function quick_buy_setting(){
		require(QBW_PLUGIN_DIR . 'views/quick_buy_setting.php');
	}
	public static function setup_setting(){
		$instance = self::get_instance();
		add_settings_section( 'quick_buy_section', 'Cấu hình Quick Buy Woocommerce', array($instance, 'display_quick_buy_section'), 'setting_giaovn');
		add_settings_field( 'quick_buy_name', __('Tên nút'), array($instance,'display_quick_buy_field'), 'setting_giaovn', 'quick_buy_section');
		add_settings_field( 'quick_buy_class', 'Class CSS', array($instance, 'display_quick_buy_class_css'), 'setting_giaovn', 'quick_buy_section');
		add_settings_field( 'quick_buy_type', __('Chọn kiểu'), array($instance, 'display_quick_buy_type'), 'setting_giaovn', $section = 'quick_buy_section');
		add_settings_field( 'quick_buy_show_button', __('Hiển thị nút'), array($instance, 'display_quick_buy_show_button'), 'setting_giaovn', $section = 'quick_buy_section');
		register_setting( 'quick_buy_group', '_quick_buy', $args = array($instance, 'saveData'));
	}
	public static function display_quick_buy_section( $arg ) {
	}
	public static function display_quick_buy_type( $args ){
		echo '<p><label><input name="_quick_buy[quick_buy_type]" type="radio" value="0"';
		if (self::$option['quick_buy_type'] == 0) {
			echo "checked='checked'";
		}
		echo '> Đơn giản</label><br>';
		echo '<label><input name="_quick_buy[quick_buy_type]" type="radio" value="1"';
			if (self::$option['quick_buy_type'] == 1) {
				echo "checked='checked'";
			}
		echo '> Cơ bản</label><br>';
		echo '<label><input name="_quick_buy[quick_buy_type]" type="radio" value="2"';
		if (self::$option['quick_buy_type'] == 2) {
			echo "checked='checked'";
		}
		echo '> Nâng cao</label></p>';
	}
	public static function display_quick_buy_field( $args ){
		echo '<input name="_quick_buy[quick_buy_name]" type="text" id="_quick_buy[quick_buy_name]" value="'.self::$option['quick_buy_name'].'" class="regular-text" placerholder="Mua ngay">';
	}
	public static function display_quick_buy_class_css( $args ){
		echo '<input name="_quick_buy[quick_buy_class]" type="text" id="_quick_buy[quick_buy_class]" value="'.(isset(self::$option['quick_buy_class']) ? self::$option['quick_buy_class'] : '').'" class="regular-text" placerholder="Class CSS">';
	}
	public static function display_quick_buy_show_button($args){
		echo '<label for="rich_editing"><input name="rich_editing" type="checkbox" id="rich_editing" value="false"> Không ghi đè nút mua ngay lên nút đặt hàng bình thường</label>';
	}
	public static function saveData($input){
		return $input;
	}
}
?>