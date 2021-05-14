<?php
/**
 * Astra functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Astra
 * @since 1.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Define Constants
 */
define('ASTRA_THEME_VERSION', '3.0.2');
define('ASTRA_THEME_SETTINGS', 'astra-settings');
define('ASTRA_THEME_DIR', trailingslashit(get_template_directory()));
define('ASTRA_THEME_URI', trailingslashit(esc_url(get_template_directory_uri())));


/**
 * Minimum Version requirement of the Astra Pro addon.
 * This constant will be used to display the notice asking user to update the Astra addon to the version defined below.
 */
define('ASTRA_EXT_MIN_VER', '3.0.0');

/**
 * Setup helper functions of Astra.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-theme-options.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-theme-strings.php';
require_once ASTRA_THEME_DIR . 'inc/core/common-functions.php';

/**
 * Update theme
 */
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-update.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/astra-update-functions.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-theme-background-updater.php';
require_once ASTRA_THEME_DIR . 'inc/theme-update/class-astra-pb-compatibility.php';


/**
 * Fonts Files
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-font-families.php';
if (is_admin()) {
    require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts-data.php';
}

require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-fonts.php';

require_once ASTRA_THEME_DIR . 'inc/core/class-astra-walker-page.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-enqueue-scripts.php';
require_once ASTRA_THEME_DIR . 'inc/core/class-gutenberg-editor-css.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-dynamic-css.php';

/**
 * Custom template tags for this theme.
 */
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-attr.php';
require_once ASTRA_THEME_DIR . 'inc/template-tags.php';

require_once ASTRA_THEME_DIR . 'inc/widgets.php';
require_once ASTRA_THEME_DIR . 'inc/core/theme-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/admin-functions.php';
require_once ASTRA_THEME_DIR . 'inc/core/sidebar-manager.php';

/**
 * Markup Functions
 */
require_once ASTRA_THEME_DIR . 'inc/markup-extras.php';
require_once ASTRA_THEME_DIR . 'inc/extras.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog-config.php';
require_once ASTRA_THEME_DIR . 'inc/blog/blog.php';
require_once ASTRA_THEME_DIR . 'inc/blog/single-blog.php';
/**
 * Markup Files
 */
require_once ASTRA_THEME_DIR . 'inc/template-parts.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-loop.php';
require_once ASTRA_THEME_DIR . 'inc/class-astra-mobile-header.php';

/**
 * Functions and definitions.
 */
require_once ASTRA_THEME_DIR . 'inc/class-astra-after-setup-theme.php';

// Required files.
require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-helper.php';

require_once ASTRA_THEME_DIR . 'inc/schema/class-astra-schema.php';

if (is_admin()) {

    /**
     * Admin Menu Settings
     */
    require_once ASTRA_THEME_DIR . 'inc/core/class-astra-admin-settings.php';
    require_once ASTRA_THEME_DIR . 'inc/lib/notices/class-astra-notices.php';

    /**
     * Metabox additions.
     */
    require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-boxes.php';
}

require_once ASTRA_THEME_DIR . 'inc/metabox/class-astra-meta-box-operations.php';


/**
 * Customizer additions.
 */
require_once ASTRA_THEME_DIR . 'inc/customizer/class-astra-customizer.php';


/**
 * Compatibility
 */
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-jetpack.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/woocommerce/class-astra-woocommerce.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/edd/class-astra-edd.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/lifterlms/class-astra-lifterlms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/learndash/class-astra-learndash.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bb-ultimate-addon.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-contact-form-7.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-visual-composer.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-site-origin.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-gravity-forms.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-bne-flyout.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-ubermeu.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-divi-builder.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-amp.php';
require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-yoast-seo.php';
require_once ASTRA_THEME_DIR . 'inc/addons/transparent-header/class-astra-ext-transparent-header.php';
require_once ASTRA_THEME_DIR . 'inc/addons/breadcrumbs/class-astra-breadcrumbs.php';
require_once ASTRA_THEME_DIR . 'inc/addons/heading-colors/class-astra-heading-colors.php';
require_once ASTRA_THEME_DIR . 'inc/builder/class-astra-builder-loader.php';

// Elementor Compatibility requires PHP 5.4 for namespaces.
if (version_compare(PHP_VERSION, '5.4', '>=')) {
    require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor.php';
    require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-elementor-pro.php';
}

// Beaver Themer compatibility requires PHP 5.3 for anonymus functions.
if (version_compare(PHP_VERSION, '5.3', '>=')) {
    require_once ASTRA_THEME_DIR . 'inc/compatibility/class-astra-beaver-themer.php';
}

/**
 * Load deprecated functions
 */
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-filters.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-hooks.php';
require_once ASTRA_THEME_DIR . 'inc/core/deprecated/deprecated-functions.php';

function woocommerce_after_shop_loop_item_title_short_description() {
    global $product;

    if (!$product->post->post_excerpt)
        return;
    ?>
    <div itemprop="description">
        <?php echo apply_filters('woocommerce_short_description', $product->post->post_excerpt) ?>
    </div>
    <?php
}

// add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_after_shop_loop_item_title_short_description', 5);
// function hts_excerpt_in_product_archives() {      
//     echo wp_trim_words( get_the_excerpt(), 10 );
// }
add_action('woocommerce_after_shop_loop_item_title', 'hts_excerpt_in_product_archives', 40);

// Remove the product description Title
add_filter('woocommerce_product_description_heading', '__return_null');


// Change the product description title
// add_filter('woocommerce_product_description_heading', 'change_product_description_heading');
// function change_product_description_heading() {
//  return __('NEW TITLE HERE', 'woocommerce');
// }


add_filter('woocommerce_loop_add_to_cart_link', 'ts_replace_add_to_cart_button', 10, 2);

function ts_replace_add_to_cart_button($button, $product) {
    if (is_product_category() || is_shop()) {
        $button_text = __("Details", "woocommerce");
        $button_link = $product->get_permalink();
        $button = '<a class="button button-type-simple" href="' . $button_link . '">' . $button_text . '</a>';
        return $button;
    }
}

add_filter('woocommerce_short_description', 'limit_woocommerce_short_description', 10, 1);

function limit_woocommerce_short_description($post_excerpt) {
    if (is_product_category() || is_shop()) {
        $pieces = explode(" ", $post_excerpt);
        $post_excerpt = implode(" ", array_splice($pieces, 0, 10));
    }

    return $post_excerpt;
}

add_action('woocommerce_after_shop_loop_item_title', 'woo_show_excerpt_shop_page', 5);

function woo_show_excerpt_shop_page() {
    if (is_product_category() || is_shop()) {
        global $product;
        echo substr($product->post->post_excerpt, 0, 50);
    }
}

add_action('init', 'custom_taxonomy_Material');

// Register Custom Taxonomy
function custom_taxonomy_Material() {

    $labels = array(
        'name' => 'Materials',
        'singular_name' => 'Material',
        'menu_name' => 'Material',
        'all_items' => 'All Materials',
        'parent_item' => 'Parent Material',
        'parent_item_colon' => 'Parent Material:',
        'new_item_name' => 'New Material Name',
        'add_new_item' => 'Add New Material',
        'edit_item' => 'Edit Material',
        'update_item' => 'Update Material',
        'separate_items_with_commas' => 'Separate Material with commas',
        'search_items' => 'Search Materials',
        'add_or_remove_items' => 'Add or remove Materials',
        'choose_from_most_used' => 'Choose from the most used Materials',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('material', 'product', $args);
}

add_action('init', 'custom_taxonomy_Mounting_Type');

// Register Custom Taxonomy
function custom_taxonomy_Mounting_Type() {

    $labels = array(
        'name' => 'Mounting Types',
        'singular_name' => 'Mounting Type',
        'menu_name' => 'Mounting Type',
        'all_Mounting Types' => 'All Mounting Types',
        'parent_Mounting Type' => 'Parent Mounting Type',
        'parent_Mounting Type_colon' => 'Parent Mounting Type:',
        'new_Mounting Type_name' => 'New Mounting Type Name',
        'add_new_Mounting Type' => 'Add New Mounting Type',
        'edit_Mounting Type' => 'Edit Mounting Type',
        'update_Mounting Type' => 'Update Mounting Type',
        'separate_Mounting Types_with_commas' => 'Separate Mounting Type with commas',
        'search_Mounting Types' => 'Search Mounting Types',
        'add_or_remove_Mounting Types' => 'Add or remove Mounting Types',
        'choose_from_most_used' => 'Choose from the most used Mounting Types',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('mounting_type', 'product', $args);
}

add_action('init', 'custom_taxonomy_Classification');

// Register Custom Taxonomy
function custom_taxonomy_Classification() {

    $labels = array(
        'name' => 'Classifications',
        'singular_name' => 'Classification',
        'menu_name' => 'Classification',
        'all_items' => 'All Classifications',
        'parent_item' => 'Parent Classification',
        'parent_item_colon' => 'Parent Classification:',
        'new_item_name' => 'New Classification Name',
        'add_new_item' => 'Add New Classification',
        'edit_item' => 'Edit Classification',
        'update_item' => 'Update Classification',
        'separate_items_with_commas' => 'Separate Classification with commas',
        'search_items' => 'Search Classifications',
        'add_or_remove_items' => 'Add or remove Classifications',
        'choose_from_most_used' => 'Choose from the most used Classifications',
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('classification', 'product', $args);
}

add_action('transition_post_status', 'wpse_110037_new_posts', 10, 3);
function wpse_110037_new_posts($new_status, $old_status, $post) {
    if (
            $old_status != 'publish' && $new_status == 'publish' && !empty($post->ID) && in_array($post->post_type, array('product')
            )
    ) {
        $product_id = $post->ID ;
     $product = wc_get_product($product_id);
    session_start();
        global $product;
    if (get_post_type($post) === 'product' && !is_a($product, 'WC_Product')) {
        $product = wc_get_product(get_the_id()); // Get the WC_Product Object
    }
    $name = $product->get_name();
    $output = '';
    $output .= '<h3 align="center">
			<img src="https://naps.plantnavigator.com/wp-content/uploads/2021/05/SGG_logo.png" alt="Campus Students Communities Pvt Ltd" class="center" style="width: 150px;">
			</h3>
			<h4 align="left" >'.$name.'</h4>
 <hr>';
    $formatted_attributes = array();
    $attributes = $product->get_attributes();
    foreach ($attributes as $attr => $attr_deets) {
        $attribute_label = wc_attribute_label($attr);
        if (isset($attributes[$attr]) || isset($attributes['pa_' . $attr])) {
            $attribute = isset($attributes[$attr]) ? $attributes[$attr] : $attributes['pa_' . $attr];
            if ($attribute['is_taxonomy']) {
                $formatted_attributes[$attribute_label] = implode(', ', wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names')));
            } else {
                $formatted_attributes[$attribute_label] = $attribute['value'];
            }
        }
    }
    if (!empty($formatted_attributes)) {
        foreach ($formatted_attributes as $key => $value) {
            $output .= '<h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $key . ': ' . $value . '</h5>';
        }
    }
    
 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id()), 'single-post-thumbnail' );

      $output .= '<img src="'.$image[0].'" alt="1" style="width: 75px; height: 75px;">&nbsp;';
     $attachment_ids = $product->get_gallery_image_ids();

    foreach( $attachment_ids as $attachment_id ) {
         $image_link = wp_get_attachment_url( $attachment_id );
             
    $output .= '<img src="'.$image_link.'" alt="1" style="width: 75px; height: 75px;">&nbsp;';
    }
    

    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Online Payment Receipt");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $content = '';
    $content .= $output;
    $obj_pdf->writeHTML($content);
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/pdf';
    $obj_pdf->Output($upload_dir . '/'.$product_id.'.pdf', 'F');


    }
	
}



add_action('woocommerce_update_product', 'mp_sync_on_product_update', 10, 1);
function mp_sync_on_product_update($product_id) {
    $product = wc_get_product($product_id);
    session_start();
        global $product;
    if (get_post_type($post) === 'product' && !is_a($product, 'WC_Product')) {
        $product = wc_get_product(get_the_id()); // Get the WC_Product Object
    }
    $name = $product->get_name();
    $output = '';
    $output .= '<h3 align="center">
			<img src="https://naps.plantnavigator.com/wp-content/uploads/2021/05/SGG_logo.png" alt="Campus Students Communities Pvt Ltd" class="center" style="width: 150px;">
			</h3>
			<h4 align="left" >'.$name.'</h4>
 <hr>';
    $formatted_attributes = array();
    $attributes = $product->get_attributes();
    foreach ($attributes as $attr => $attr_deets) {
        $attribute_label = wc_attribute_label($attr);
        if (isset($attributes[$attr]) || isset($attributes['pa_' . $attr])) {
            $attribute = isset($attributes[$attr]) ? $attributes[$attr] : $attributes['pa_' . $attr];
            if ($attribute['is_taxonomy']) {
                $formatted_attributes[$attribute_label] = implode(', ', wc_get_product_terms($product->id, $attribute['name'], array('fields' => 'names')));
            } else {
                $formatted_attributes[$attribute_label] = $attribute['value'];
            }
        }
    }
    if (!empty($formatted_attributes)) {
        foreach ($formatted_attributes as $key => $value) {
            $output .= '<h5 align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $key . ': ' . $value . '</h5>';
        }
    }
    
 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $product->get_id()), 'single-post-thumbnail' );

      $output .= '<img src="'.$image[0].'" alt="1" style="width: 75px; height: 75px;">&nbsp;';
     $attachment_ids = $product->get_gallery_image_ids();

    foreach( $attachment_ids as $attachment_id ) {
         $image_link = wp_get_attachment_url( $attachment_id );
             
    $output .= '<img src="'.$image_link.'" alt="1" style="width: 75px; height: 75px;">&nbsp;';
    }
    

    require_once('tcpdf/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Online Payment Receipt");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $content = '';
    $content .= $output;
    $obj_pdf->writeHTML($content);
    $upload = wp_upload_dir();
    $upload_dir = $upload['basedir'];
    $upload_dir = $upload_dir . '/pdf';
    $obj_pdf->Output($upload_dir . '/'.$product_id.'.pdf', 'F');
  
}