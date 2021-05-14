<?php
if ( ! defined('ABSPATH')) exit; // if direct access 

class class_wishlist_admin_notices{

    public function __construct(){

        add_action('admin_notices', array( $this, 'default_wishlist_missing' ));

    }

    public function default_wishlist_missing(){

        $wishlist_settings = get_option('wishlist_settings');
        $my_wishlist_page_id = isset($wishlist_settings['my_wishlist']['page_id']) ? $wishlist_settings['my_wishlist']['page_id'] : '';


        ob_start();

        if(empty($my_wishlist_page_id)):
            ?>
            <div class="notice notice-error">
                <p>
                    <?php
                    echo sprintf(__('Default wishlist id is missing <a href="%s">click here</a> to go import page', 'wishlist'), admin_url().'edit.php?post_type=wishlist&page=settings&tab=general')
                    ?>
                </p>

            </div>
        <?php
        endif;


        echo ob_get_clean();
    }




}

new class_wishlist_admin_notices();