<?php
class quick_buy_views{
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
		self::views();
		self::quick_buy_css();
		self::quick_buy_js();
		return $instance;
	}
	public static function views(){
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
				$option = self::$option;
				switch ($option['quick_buy_type']) {
					case '0':
						require(QBW_PLUGIN_DIR . 'views/quick_buy_views_simple.php');
						break;
					case '1':
						require(QBW_PLUGIN_DIR . 'views/quick_buy_views_basic.php');
						break;	
					case '2':
						require(QBW_PLUGIN_DIR . 'views/quick_buy_views_advanced.php');
						break;								
					default:
						require(QBW_PLUGIN_DIR . 'views/quick_buy_views_simple.php');
						break;
				}
			}, 30);
		});
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
}
?>