<?php

/**
 * The plugin bootstrap file
 *
 *
 * @link              https://welaunch.io
 * @since             1.0.0
 * @package           Welaunch_WooCommerce_Gallery_Images
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Product &  Gallery Images (Slider, Zoom, Lighbox)
 * Plugin URI:        https://welaunch.io/plugins/woocommerce-gallery-images/
 * Description:       Add gallery images to your WooCommerce simple & variations products
 * Version:           1.0.8
 * Author:            weLaunch
 * Author URI:        https://welaunch.io
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-gallery-images
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-gallery-images-activator.php
 */
function welaunch_activate_woocommerce_gallery_images() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-gallery-images-activator.php';
	Welaunch_WooCommerce_Gallery_Images_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-gallery-images-deactivator.php
 */
function welaunch_deactivate_woocommerce_gallery_images() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-gallery-images-deactivator.php';
	Welaunch_WooCommerce_Gallery_Images_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'welaunch_activate_woocommerce_gallery_images' );
register_deactivation_hook( __FILE__, 'welaunch_deactivate_woocommerce_gallery_images' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-gallery-images.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function welaunch_run_woocommerce_gallery_images() {

	$plugin_data = get_plugin_data( __FILE__ );
	$version = $plugin_data['Version'];

	$plugin = new Welaunch_WooCommerce_Gallery_Images($version);
	$plugin->run();

	return $plugin;

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'woocommerce/woocommerce.php') && (is_plugin_active('redux-dev-master/redux-framework.php') || is_plugin_active('redux-framework/redux-framework.php') ||  is_plugin_active('welaunch-framework/welaunch-framework.php') ) ){
	$Welaunch_WooCommerce_Gallery_Images = welaunch_run_woocommerce_gallery_images();
} else {
	add_action( 'admin_notices', 'welaunch_woocommerce_gallery_images_notice' );
}

function welaunch_woocommerce_gallery_images_notice()
{
	?>
    <div class="error">
      <p><?php esc_html_e( 'WooCommerce Gallery Images requires the WooCommerce & weLaunch Framework plugin. Please install or activate them before: https://www.welaunch.io/updates/welaunch-framework.zip', 'woocommerce-gallery-images'); ?></p>
    </div>
    <?php
}