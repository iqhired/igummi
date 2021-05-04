<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.welaunch.io
 * @since      1.0.0
 *
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Welaunch_WooCommerce_Gallery_Images
 * @subpackage Welaunch_WooCommerce_Gallery_Images/public
 * @author     Daniel Barenkamp <support@welaunch.io>
 */
class Welaunch_WooCommerce_Gallery_Images_Public extends Welaunch_WooCommerce_Gallery_Images {

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
	 * options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $options
	 */
	protected $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version ) 
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Enqueu Styles
	 * @author Daniel Barenkamp
	 * @version 1.0.0
	 * @since   1.0.0
	 * @link    https://welaunch.io
	 * @return  [type]                       [description]
	 */
	public function enqueue_scripts() 
	{
		global $woocommerce_gallery_images_options;
		$this->options = $woocommerce_gallery_images_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('disableFrontend')) {
			return false;
		}

		wp_enqueue_style( 'flickity', plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/flickity.min.css', array(), '2.2.1', 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'public/css/woocommerce-gallery-images-public.css', array('flickity'), $this->version, 'all' );

		wp_enqueue_script( 'flickity', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/flickity.pkgd.min.js', array( 'jquery'), '2.2.1', true );
		wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/woocommerce-gallery-images-public.js', array( 'jquery', 'flickity'), $this->version, true );
		wp_enqueue_script( 'jquery-zoom', plugin_dir_url( dirname( __FILE__ ) ) . 'public/js/jquery.zoom.min.js', array( 'jquery'), '1.7.21', true );
		
		if($this->get_option('overrideDefaultImageGallery')) {
			$imageContainer = '.woocommerce-product-gallery';
			$galleryImagesContainer = '.woocommerce-product-gallery';
		} else {
			$imageContainer = $this->get_option('imageContainer');
			$galleryImagesContainer = $this->get_option('galleryImagesContainer');
		}

		$forJS = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'imageContainer' => $imageContainer,
			'galleryImagesContainer' => $galleryImagesContainer,
			'overrideDefaultImageGallery' => $this->get_option('overrideDefaultImageGallery'),

			'loaderColor' => $this->get_option('loaderColor'),
			'fullscreenColor' => $this->get_option('fullscreenColor'),
			'thumbnailBorderColor' => $this->get_option('thumbnailBorderColor'),
			'fakeLoadingTime' => $this->get_option('fakeLoadingTime'),
			
			'singleImageColums' => $this->get_option('singleImageColums'),
			'singleImageMarginRight' => $this->get_option('singleImageMarginRight'),
			'singleImagesOptions' => array(
				'cellAlign' => $this->get_option('singleImageCellAlign'),
				'zoom' => $this->get_option('singleImageZoom'),
				'accessibility' => $this->get_option('singleImageAccessibility') ? true : false,
				'adaptiveHeight' => $this->get_option('singleImageAdaptiveHeight') ? true : false,
				'autoPlay' => $this->get_option('singleImageAutoPlay') ? true : false,
				'contain' => $this->get_option('singleImageContain') ? true : false,
				'freeScroll' => $this->get_option('singleImageFreeScroll') ? true : false,
				'lazyLoad' => $this->get_option('singleImageLazyLoad') ? true : false,
				'percentPosition' => $this->get_option('singleImagePercentPosition') ? true : false,
				'prevNextButtons' => $this->get_option('singleImagePrevNextButtons') ? true : false,
				'pageDots' => $this->get_option('singleImagePageDots') ? true : false,
				'resize' => $this->get_option('singleImageResize') ? true : false,
				'rightToLeft' => $this->get_option('singleImageRightToLeft') ? true : false,
				'setGallerySize' => $this->get_option('singleImageSetGallerySize') ? true : false,
				'watchCSS' => $this->get_option('singleImageWatchCSS') ? true : false,
				'wrapAround' => $this->get_option('singleImageWrapAround') ? true : false,
	     	),

			'galleryThumbnailsEnable' => $this->get_option('galleryThumbnailsEnable'),
			'galleryThumbnailsPosition' => $this->get_option('galleryThumbnailsPosition'),
			'galleryThumbnailsColums' => $this->get_option('galleryThumbnailsColums'),
			'galleryThumbnailsMarginRight' => $this->get_option('galleryThumbnailsMarginRight'),
			'galleryThumbnailsOptions' => array(
				'cellAlign' => $this->get_option('galleryThumbnailsCellAlign'),
				'accessibility' => $this->get_option('galleryThumbnailsAccessibility') ? true : false,
				'adaptiveHeight' => $this->get_option('galleryThumbnailsAdaptiveHeight') ? true : false,
				'autoPlay' => $this->get_option('galleryThumbnailsAutoPlay') ? true : false,
				'contain' => $this->get_option('galleryThumbnailsContain') ? true : false,
				'freeScroll' => $this->get_option('galleryThumbnailsFreeScroll') ? true : false,
				'lazyLoad' => $this->get_option('galleryThumbnailsLazyLoad') ? true : false,
				'percentPosition' => $this->get_option('galleryThumbnailsPercentPosition') ? true : false,
				'prevNextButtons' => $this->get_option('galleryThumbnailsPrevNextButtons') ? true : false,
				'pageDots' => $this->get_option('galleryThumbnailsPageDots') ? true : false,
				'resize' => $this->get_option('galleryThumbnailsResize') ? true : false,
				'rightToLeft' => $this->get_option('galleryThumbnailsRightToLeft') ? true : false,
				'setGallerySize' => $this->get_option('galleryThumbnailsSetGallerySize') ? true : false,
				'watchCSS' => $this->get_option('galleryThumbnailsWatchCSS') ? true : false,
				'wrapAround' => $this->get_option('galleryThumbnailsWrapAround') ? true : false,
	     	),
 		);

    	$forJS = apply_filters('woocommerce_gallery_images_settings', $forJS);
        wp_localize_script($this->plugin_name . '-public', 'woocommerce_gallery_images_options', $forJS);
	}
	
    /**
     * Inits the  Gallery Images
     * @author Daniel Barenkamp
     * @version 1.0.0
     * @since   1.0.0
     * @link    https://plugins.welaunch.io
     * @return  [type]                       [description]
     */
    public function init()
    {
		global $woocommerce_gallery_images_options;
		$this->options = $woocommerce_gallery_images_options;

		if (!$this->get_option('enable')) {
			return false;
		}

		if($this->get_option('disableFrontend')) {
			return false;
		}

		if($this->get_option('singleImageFullscreen')) {
			add_action('wp_footer', array($this, 'add_full_screen') );
		}

		if($this->get_option('overrideDefaultImageGallery')) {
			add_filter( 'wc_get_template', array($this, 'modify_image_templates'), 10, 5 );
		}
    }

    public function get_gallery_images()
    {
		$response = array(
			'status' => false,
			'images' => array()
		);

		if(!isset($_POST['variation_id']) || empty($_POST['variation_id'])) {

			if(!isset($_POST['product_id']) || empty($_POST['product_id'])) {
				echo json_encode($response);
				die();
			}

			// Variable Product Fallback
			$product_id = (int) $_POST['product_id'];
			$product = wc_get_product($product_id);
			if(!$product) {
				echo json_encode($response);
				die();
			}

			if($this->get_option('getFirstVariationImage') && $product->is_type('variable') && ( isset($_POST['formData']) && !empty($_POST['formData']) ) ) {
				parse_str($_POST['formData'], $formData);
				
				$variable_image_id = $product->get_image_id();
				$variations = $product->get_available_variations();

				foreach ($formData as $formDataKey => $formDataValue) {
					if(substr($formDataKey, 0, 10) != "attribute_" || $formDataValue == "") {
						continue;
					}

					foreach ($variations as $variationKey => $variationData) {
						if(!isset($variationData['attributes']) || empty($variationData['attributes'])) {
							continue;
						}
						$variationAttributes = $variationData['attributes'];
						if(isset($variationAttributes[$formDataKey]) && $variationAttributes[$formDataKey] == $formDataValue) {

							$variation = wc_get_product($variationData['variation_id']);
							if(!$variation) {
								continue;
							}
							$gallery_image_ids = array();

							$variation_image_id = $variation->get_image_id();
							if(!$variation_image_id || $variable_image_id == $variation_image_id) {
								continue;
							} else {
								$gallery_image_ids[] = $variation_image_id;
							}

							// Do not return if only variation image (that is already by theme supported)
							$original_gallery_image_ids = $variation->get_gallery_image_ids();

							if(!empty($original_gallery_image_ids)) {
								$gallery_image_ids = array_merge($gallery_image_ids, $original_gallery_image_ids);
							}
							
							if(empty($gallery_image_ids)) {
								$response['status'] = true;
								$response['images'][] = array(
									'full' => wc_placeholder_img('full'),
									'thumbnail' => wc_placeholder_img('thumbnail'),
								);
								echo json_encode($response);
								die();
							}
							$gallery_image_ids = array_unique($gallery_image_ids);

							$response['status'] = true;
							foreach ($gallery_image_ids as $gallery_image_id) {

								$response['images'][] = array(
									'full' => wp_get_attachment_image( $gallery_image_id, 'full' ),
									'thumbnail' => wp_get_attachment_image( $gallery_image_id, 'thumbnail' ),
								);
							}

							echo json_encode($response);
							die();

						}
					}
				}
			}


			$product_image_id = $product->get_image_id();
			if($product_image_id) {
				$product_gallery_image_ids[] = $product_image_id;
			}


			$original_product_gallery_image_ids = $product->get_gallery_image_ids();
			if(!empty($original_product_gallery_image_ids)) {
				$product_gallery_image_ids = array_merge($product_gallery_image_ids, $original_product_gallery_image_ids);
			}

			if(empty($product_gallery_image_ids)) {
				$response['status'] = true;
				$response['images'][] = array(
					'full' => wc_placeholder_img('full'),
					'thumbnail' => wc_placeholder_img('thumbnail'),
				);
				echo json_encode($response);
				die();
			}

			$product_gallery_image_ids = array_unique($product_gallery_image_ids);

			$response['status'] = true;
			foreach ($product_gallery_image_ids as $product_gallery_image_id) {

				$response['images'][] = array(
					'full' => wp_get_attachment_image( $product_gallery_image_id, 'full' ),
					'thumbnail' => wp_get_attachment_image( $product_gallery_image_id, 'thumbnail' ),
				);
			}

			echo json_encode($response);
			die();
		}

		$variation_id = (int) $_POST['variation_id'];
		$variation = wc_get_product($variation_id);
		if(!$variation) {
			echo json_encode($response);
			die();
		}

		$gallery_image_ids = array();

		$variation_image_id = $variation->get_image_id();
		if($variation_image_id) {
			$gallery_image_ids[] = $variation_image_id;
		}

		// Do not return if only variation image (that is already by theme supported)
		$original_gallery_image_ids = $variation->get_gallery_image_ids();
		if(!empty($original_gallery_image_ids)) {
			$gallery_image_ids = array_merge($gallery_image_ids, $original_gallery_image_ids);
		}
		
		if(empty($gallery_image_ids)) {
			$response['status'] = true;
			$response['images'][] = array(
				'full' => wc_placeholder_img('full'),
				'thumbnail' => wc_placeholder_img('thumbnail'),
			);
			echo json_encode($response);
			die();
		}

		// Add variable images to variation gallery image
		if($this->get_option('showVariableGalleryImages')) {

			$parent_product = wc_get_product($variation->get_parent_id());
			if($parent_product) {

				// do not use get_gallery images, because it will take also all variation images
				if($this->get_option('showVariationGalleryImagesInProductGallery')) {
		   			$parent_product_gallery_image_ids = array_filter( explode(',', get_post_meta($parent_product->get_id(), '_product_image_gallery', true)) ); 
		   		} else {
		   			$parent_product_gallery_image_ids = $parent_product->get_gallery_image_ids();
		   		}
				
				if(!empty($parent_product_gallery_image_ids)) {
					$gallery_image_ids = array_merge($gallery_image_ids, $parent_product_gallery_image_ids);
				}
			}
		}

		$gallery_image_ids = array_unique($gallery_image_ids);

		$response['status'] = true;
		foreach ($gallery_image_ids as $gallery_image_id) {

			$response['images'][] = array(
				'full' => wp_get_attachment_image( $gallery_image_id, 'full' ),
				'thumbnail' => wp_get_attachment_image( $gallery_image_id, 'thumbnail' ),
			);
		}

		echo json_encode($response);
		die();
    }

   	public function modify_product_gallery_images( $value, $variation) 
   	{
   		if(!$this->get_option('showVariationGalleryImagesInListing')) {
   			return $value;
   		}

   		if(!is_product_category() && !is_product_tag()) {
   			return $value;
   		}

		if(!empty($value)) {
			return $value;
		}

		if(!$variation) {
			return $value;
		}

		$parent_product = wc_get_product($variation->get_parent_id());
		if(!$parent_product) {
			return $value;
		}

		// Avoid infinite loop
		if($this->get_option('showVariationGalleryImagesInProductGallery')) {
   			$parent_product_gallery_image_ids = array_filter( explode(',', get_post_meta($parent_product->get_id(), '_product_image_gallery', true)) ); 
   		} else {
   			$parent_product_gallery_image_ids = $parent_product->get_gallery_image_ids();
   		}
		
		if(!empty($parent_product_gallery_image_ids)) {
			return $parent_product_gallery_image_ids;
		}

		return $value;
	} 

   	public function modify_product_variable_gallery_images( $value, $product) 
   	{
   		if(!$this->get_option('showVariationGalleryImagesInProductGallery')) {
   			return $value;
   		}

   		if(isset($_POST['variation_id']) && !empty($_POST['variation_id'])) {
   			return $value;
   		}

   		if(!$product->is_type('variable')) {
   			return $value;
   		}

		$variation_ids = $product->get_children();
		if(empty($variation_ids)) {
			return $value;
		}

		if(!$value) {
			$value = array();
		}

		$all_gallery_image_ids = array();
		foreach ($variation_ids as $variation_id) {
			$variation = wc_get_product($variation_id);
			if(!$variation) {
				continue;
			}

			$variation_image_id = $variation->get_image_id();
			if(!empty($variation_image_id)) {
				$all_gallery_image_ids[] = $variation_image_id;
			}

			$gallery_image_ids = $variation->get_gallery_image_ids();
			if(!empty($gallery_image_ids)) {
				$all_gallery_image_ids = array_merge($all_gallery_image_ids, $gallery_image_ids);	
			}
		}

		$value = array_unique( array_merge($all_gallery_image_ids, $value) );
		return $value;
	} 

	public function add_full_screen()
	{
		?>
			<div class="woocommerce-gallery-images-fullscreen-overlay" style="display: none;"></div>
			<div class="woocommerce-gallery-images-fullscreen-container" style="display: none;">
				
			</div>
		<?php
	}

	public function modify_image_templates( $located, $template_name)
	{
		global $product;

		if(!$product) {
			return $located;
		}

		if(!is_object($product)) {
			return $located;
		}

		if( 'single-product/product-image.php' === $template_name){
			return  __DIR__  . '/partials/product-image.php';
		}

		if( 'single-product/product-thumbnails.php' === $template_name){
			return  __DIR__  . '/partials/product-thumbnails.php';
		}

		return $located;
	}
}