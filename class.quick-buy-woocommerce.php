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
		self::quick_buy_views();
		self::quick_buy_css();
		self::quick_buy_js();
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
	public static function quick_buy_css(){
		add_action( 'wp_enqueue_scripts', function(){
			wp_register_style( 'quick-buy', plugins_url('assets/css/quick-buy-woocommerce.css',__FILE__));
			wp_enqueue_style( 'quick-buy' );
		});
	}
	public static function quick_buy_js(){
		add_action('wp_footer', function(){
			?>
			<script>
			// Get the modal
			var modal = document.getElementById("myModal");

			// Get the button that opens the modal
			var btn = document.getElementById("myBtn");

			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal 
			btn.onclick = function() {
			  modal.style.display = "block";
			}

			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			  modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			  if (event.target == modal) {
			    modal.style.display = "none";
			  }
			}
			</script>
			<?php
		});
	}
	public static function quick_buy_views(){
		add_action('woocommerce_single_product_summary', function(){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			add_action('woocommerce_single_product_summary', function(){
				if (isset($_POST['ok'])) {
					$order = wc_create_order();
					$order->add_product( wc_get_product( get_the_id() ), 1 );
					$order->set_billing_first_name($_POST['name']);
					$order->set_billing_address_1( $_POST['address']);
					$order->set_billing_phone($_POST['phone']);
					$order->calculate_totals();
					$order->save();
				}
				require(QBW_PLUGIN_DIR . 'views/quick_buy_views.php');
			}, 30);
		});
	}
}
?>