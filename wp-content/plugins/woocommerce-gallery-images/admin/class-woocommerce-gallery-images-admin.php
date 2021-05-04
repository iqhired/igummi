<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.welaunch.io
 * @since      1.0.0
 *
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/admin
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class Welaunch_WooCommerce_Gallery_Images_Admin extends Welaunch_WooCommerce_Gallery_Images {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	protected $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of this plugin.
	 */
	protected $version;

	/**
	 * Construct the Class
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://welaunch.io
	 * @param   [type]                       $plugin_name [description]
	 * @param   [type]                       $version     [description]
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

    /**
     * Enqueue Admin Scripts
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://www.welaunch.io
     * @return  boolean
     */
    public function enqueue_scripts()
    {
    	$forJS = array(
    		'ajax_url' => admin_url( 'admin-ajax.php' ),
    	);


    	wp_enqueue_style($this->plugin_name.'-admin', plugin_dir_url(__FILE__).'css/woocommerce-gallery-images-admin.css', array(), $this->version, 'all');
        wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__).'js/woocommerce-gallery-images-admin.js', array('jquery'), $this->version, true);
        wp_localize_script($this->plugin_name . '-admin', 'woocommerce_gallery_images_options', $forJS);
    }

	/**
	 * Load Redux
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://welaunch.io
	 * @return  [type]                       [description]
	 */
	public function load_redux(){
	    if ( file_exists( plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php' ) ) {
	        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/options-init.php';
	    }
	}

	/**
	 * Init 
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https:/welaunch.io
	 * @return  [type]             [description]
	 */
	public function init()
	{
		global $woocommerce_gallery_images_options, $variations_saved_loop;

		$variations_saved_loop = 0;

		$this->options = $woocommerce_gallery_images_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		// add_action( 'woocommerce_process_product_meta', 'WC_Meta_Box_Product_Images::save', 20, 2 );
		

		add_action('woocommerce_product_after_variable_attributes', array($this, 'add_gallery_images_box'), 10, 3 ); 
		add_action('woocommerce_save_product_variation', array($this, 'save_gallery_images'), 10, 2 );
	}

	public function add_gallery_images_box($loop, $variation_data, $post)
	{

		$variation_id      = $post->ID;
		$variation = new WC_Product_Variation( $variation_id );

		?>
		<div class="variation_images_container">
			<ul class="variation_images">
				<?php
				$variation_image_gallery = $variation->get_gallery_image_ids( 'edit' );

				$attachments         = array_filter( $variation_image_gallery );
				$update_meta         = false;
				$updated_gallery_ids = array();

				if ( ! empty( $attachments ) ) {
					foreach ( $attachments as $attachment_id ) {
						$attachment = wp_get_attachment_image( $attachment_id, 'thumbnail' );

						// if attachment is empty skip.
						if ( empty( $attachment ) ) {
							$update_meta = true;
							continue;
						}
						?>
						<li class="image" data-attachment_id="<?php echo esc_attr( $attachment_id ); ?>">
							<?php echo $attachment; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<ul class="actions">
								<li><a href="#" class="delete"><?php esc_html_e( 'Delete', 'woocommerce' ); ?></a></li>
							</ul>
							<?php
							// Allow for extra info to be exposed or extra action to be executed for this attachment.
							do_action( 'woocommerce_admin_after_gallery_item', $variation_id, $attachment_id );
							?>
						</li>
						<?php

						// rebuild ids to be saved.
						$updated_gallery_ids[] = $attachment_id;
					}

					// need to update product meta to set new gallery ids
					if ( $update_meta ) {
						update_post_meta( $post->ID, '_variation_image_gallery', implode( ',', $updated_gallery_ids ) );
					}
				}
				?>
			</ul>

		</div>
		<p class="add_variation_images hide-if-no-js">

			<a href="#"><span class="wc-metabox-sortable-placeholder">+</span></a>

			<input type="hidden" class="variation_image_gallery" name="variation_image_gallery[<?php echo $variation_id ?>]" value="<?php echo esc_attr( implode( ',', $updated_gallery_ids ) ); ?>" />
		</p>
		<?php

	}

		/**
	 * Save meta box data.
	 *
	 * @param int     $post_id
	 * @param WP_Post $post
	 */
	public static function save_gallery_images( $variation_id, $i)
	{
		$product        = new WC_Product_Variation( $variation_id );
		$attachment_ids = isset( $_POST['variation_image_gallery'][$variation_id] ) ? array_filter( explode( ',', wc_clean( $_POST['variation_image_gallery'][$variation_id] ) ) ) : array();

		$product->set_gallery_image_ids( $attachment_ids );
		$product->save();
	}
}	