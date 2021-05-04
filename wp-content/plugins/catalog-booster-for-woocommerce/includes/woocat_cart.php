<?php
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/*
 *
 *  @version       1.0.0
 *  @package
 *  @author        impleCode
 *
 */
if ( !function_exists( 'ic_woocat_cart_hooks' ) ) {
	//add_action( 'init', 'ic_woocat_cart_hooks' );
	add_action( 'wp', 'ic_woocat_cart_hooks' );

	function ic_woocat_cart_hooks() {
		if ( !function_exists( 'wc_get_cart_url' ) || !function_exists( 'wc_get_checkout_url' ) ) {
			return;
		}
		$ic_woocat = ic_woocat_settings();
		if ( !empty( $ic_woocat[ 'general' ][ 'disable_cart' ] ) ) {
			return;
		}
		if ( is_product() ) {
			add_action( 'after_price_table', 'ic_woocat_add_cart_button' );
			add_action( 'before_product_entry', 'ic_woocat_add_cart_messages' );
		} else if ( is_shop() || is_product_category() ) {
			add_filter( 'table_product_listing_other_entry', 'ic_woocat_table_button', 10, 5 );
		}
	}

}

if ( !function_exists( 'ic_woocat_add_cart_button' ) ) {

	function ic_woocat_add_cart_button() {
		?>
		<div style="margin-top: 10px">
			<?php
			woocommerce_template_single_add_to_cart();
			?>
		</div>
		<?php
	}

}

if ( !function_exists( 'ic_woocat_add_cart_messages' ) ) {

	function ic_woocat_add_cart_messages() {
		do_action( 'woocommerce_before_single_product' );
	}

}
