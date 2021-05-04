<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.welaunch.io
 * @since      1.0.0
 *
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/includes
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class Welaunch_WooCommerce_Gallery_Images_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$loaded = load_plugin_textdomain(
			'woocommerce-gallery-images',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
