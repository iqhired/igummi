<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'weLaunch' ) && ! class_exists( 'Redux' ) ) {
        return;
    }

    if( class_exists( 'weLaunch' ) ) {
        $framework = new weLaunch();
    } else {
        $framework = new Redux();
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "woocommerce_gallery_images_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $args = array(
        'opt_name' => 'woocommerce_gallery_images_options',
        'use_cdn' => TRUE,
        'dev_mode' => FALSE,
        'display_name' => esc_html__('WooCommerce Product &  Gallery Images'),
        'display_version' => '1.0.8',
        'page_title' => esc_html__('WooCommerce Product &  Gallery Images'),
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => esc_html__('&copy; '.date('Y').' weLaunch'),
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => esc_html__(' Gallery Images'),
        'allow_sub_menu' => TRUE,
        'page_parent' => 'woocommerce',
        'customizer' => FALSE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    global $weLaunchLicenses;
    if( (isset($weLaunchLicenses['woocommerce-gallery-images']) && !empty($weLaunchLicenses['woocommerce-gallery-images'])) || (isset($weLaunchLicenses['woocommerce-plugin-bundle']) && !empty($weLaunchLicenses['woocommerce-plugin-bundle'])) ) {
        $args['display_name'] = '<span class="dashicons dashicons-yes-alt" style="color: #9CCC65 !important;"></span> ' . $args['display_name'];
    } else {
        $args['display_name'] = '<span class="dashicons dashicons-dismiss" style="color: #EF5350 !important;"></span> ' . $args['display_name'];
    }

    $framework::setArgs( $opt_name, $args );
    
    $framework::setSection( $opt_name, array(
        'title'  => esc_html__( ' Gallery Images', 'woocommerce-gallery-images' ),
        'id'     => 'general',
        'desc'   => esc_html__( 'Need support? Please use the comment function on codecanyon.', 'woocommerce-gallery-images' ),
        'icon'   => 'el el-home',
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => esc_html__( 'General', 'woocommerce-gallery-images' ),
        'id'         => 'general-settings',
        'desc'       => __( 'To get auto updates please <a href="' . admin_url('tools.php?page=welaunch-framework') . '">register your License here</a>.', 'woocommerce-gallery-images' ),
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'enable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Disable this to only use variation gallery images support in shop loop / category pages. This will keep your theme default gallery.', 'woocommerce-gallery-images' ),
                'default'  => 1
            ),
            array(
                'id'       => 'disableFrontend',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Disable Frontend Gallery', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'This allows you to only use backend functionality (adding varaition images) and keeps your existing theme product gallery.', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('enable','equals','1'),
            ),
            array(
                'id'       => 'overrideDefaultImageGallery',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Override default Gallery', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'By default our plugin only changes the gallery when a variation is selected. Enable this to always use our gallery features also for simple products.', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array( array('enable','equals','1'), array('disableFrontend', 'equals', '0')),
            ),
            array(
                'id'       => 'getFirstVariationImage',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Get first Variation image', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Variable products with multiple attributes will return first found image when variation form changed. Example: T-Shirt with Color & Size -> customer changes only color -> image will get first found variation', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array( array('enable','equals','1'), array('disableFrontend', 'equals', '0')),
            ),
            
            array(
                'id'       => 'imageContainer',
                'type'     => 'text',
                'title'    => esc_html__('Image Container Selector', 'woocommerce-gallery-images'),
                'subtitle' => esc_html__('The main image selector (css class or id). Example: .woocommerce-product-gallery__wrapper (flatsome) OR .woocommerce-product-gallery'),
                'default'  => '.woocommerce-product-gallery',
                'required' => array( array('enable','equals','1'), array('overrideDefaultImageGallery','equals','0')),
            ),
            array(
                'id'       => 'galleryImagesContainer',
                'type'     => 'text',
                'title'    => esc_html__('Gallery Images Container Selector', 'woocommerce-gallery-images'),
                'subtitle' => esc_html__('The gallery images selector (css class or id). Example: .product-thumbnails (flatsome) or .woocommerce-product-gallery'),
                'default'  => '.woocommerce-product-gallery',
                'required' => array( array('enable','equals','1'), array('overrideDefaultImageGallery','equals','0')),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => esc_html__( ' Single Product Image', 'woocommerce-gallery-images' ),
        'desc'       => esc_html__( 'Settings for the single product image.', 'woocommerce-gallery-images' ),
        'id'         => 'Variation-Image',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'singleImageColums',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Columns', 'woocommerce-print-products' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '12',
                'default'  => '1',
            ),
            array(
                'id'       => 'singleImageMarginRight',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Margin Right', 'woocommerce-print-products' ),
                'min'      => '0',
                'step'     => '1',
                'max'      => '100',
                'default'  => '0',
            ),
            array(
                'id'       => 'singleImageCellAlign',
                'type'     => 'select',
                'title'    => esc_html__( 'Cell Align', 'woocommerce-print-products' ),
                'subtitle' => esc_html__( 'Alignment of cells.', 'woocommerce-print-products' ),
                'options'  => array(
                    'center' => esc_html__('Center', 'woocommerce-print-products'),
                    'left' => esc_html__('Left', 'woocommerce-print-products'),
                    'right' => esc_html__('Right', 'woocommerce-print-products'),
                ),
                'default' => 'center',
            ),
            array(
                'id'       => 'singleImageZoom',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Zoom', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables zoom view of Full image.', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageFullscreen',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Fullscreen', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables fullscreen view of carousel.', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageAccessibility',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Accessibility', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enable keyboard navigation, pressing left & right keys', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageAdaptiveHeight',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Adaptive Height', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Set carousel height to the selected slide', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageAutoPlay',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Auto Play', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'advances to the next cell', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageContain',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Contain', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Will contain cells to container so no excess scroll at beginning or end has no effect if wrapAround is enabled', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageFreeScroll',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Free Scroll', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables content to be freely scrolled and flicked without aligning cells', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageLazyLoad',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Lazy Load', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enable lazy-loading images', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImagePercentPosition',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Percent Position', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'sets positioning in percent values, rather than pixels', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImagePrevNextButtons',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Prev / Next Buttons', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Creates and enables buttons to click to previous & next cells', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImagePageDots',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Page Dots', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Create and enable page dots', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageResize',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Resize', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Listens to window resize events to adjust size & positions', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageRightToLeft',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Right to Left', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables right-to-left layout', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageSetGallerySize',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Set Gallery Size', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Sets the height of gallery disable if gallery already has height set with CSS', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'singleImageWatchCSS',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Watch CSS', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Watches the content of :after of the element', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
            array(
                'id'       => 'singleImageWrapAround',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Wrap Around', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'At end of cells, wraps-around to first for infinite scrolling', 'woocommerce-gallery-images' ),
                'default'  => 0,
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => esc_html__( 'Product Gallery Images', 'woocommerce-gallery-images' ),
        'desc'       => esc_html__( 'Settings for the thumbnail gallery aimges.', 'woocommerce-gallery-images' ),
        'id'         => 'variation-thumbnails',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'galleryThumbnailsEnable',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Thumbnails', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'You can also disable thumbnails to just use slider in the main image.', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'galleryThumbnailsPosition',
                'type'     => 'select',
                'title'    => esc_html__( 'Gallery Images Position', 'woocommerce-print-products' ),
                'subtitle' => esc_html__( 'Choose if you want to have vertical or horizontal aligned gallery images.', 'woocommerce-print-products' ),
                'options'  => array(
                    'horizontal' => esc_html__('Horizontal', 'woocommerce-print-products'),
                    'left' => esc_html__('Vertical Left', 'woocommerce-print-products'),
                    'right' => esc_html__('Vertical Right', 'woocommerce-print-products'),
                ),
                'default' => 'horizontal',
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsColums',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Columns', 'woocommerce-print-products' ),
                'min'      => '1',
                'step'     => '1',
                'max'      => '12',
                'default'  => '4',
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsMarginRight',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Margin Right', 'woocommerce-print-products' ),
                'min'      => '0',
                'step'     => '1',
                'max'      => '100',
                'default'  => '20',
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsCellAlign',
                'type'     => 'select',
                'title'    => esc_html__( 'Cell Align', 'woocommerce-print-products' ),
                'subtitle' => esc_html__( 'Alignment of cells.', 'woocommerce-print-products' ),
                'options'  => array(
                    'center' => esc_html__('Center', 'woocommerce-print-products'),
                    'left' => esc_html__('Left', 'woocommerce-print-products'),
                    'right' => esc_html__('Right', 'woocommerce-print-products'),
                ),
                'default' => 'left',
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsAccessibility',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Accessibility', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enable keyboard navigation, pressing left & right keys', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsAdaptiveHeight',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Adaptive Height', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Set carousel height to the selected slide', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsAutoPlay',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Auto Play', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'advances to the next cell', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsContain',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Contain', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Will contain cells to container so no excess scroll at beginning or end has no effect if wrapAround is enabled', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsFreeScroll',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Free Scroll', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables content to be freely scrolled and flicked without aligning cells', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsLazyLoad',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Lazy Load', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enable lazy-loading images', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsPercentPosition',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Percent Position', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'sets positioning in percent values, rather than pixels', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsPrevNextButtons',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Prev / Next Buttons', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Creates and enables buttons to click to previous & next cells', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsPageDots',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Page Dots', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Create and enable page dots', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsResize',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Resize', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Listens to window resize events to adjust size & positions', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsRightToLeft',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Right to Left', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Enables right-to-left layout', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsSetGallerySize',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Set Gallery Size', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Sets the height of gallery disable if gallery already has height set with CSS', 'woocommerce-gallery-images' ),
                'default'  => 1,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsWatchCSS',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Watch CSS', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Watches the content of :after of the element', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
            array(
                'id'       => 'galleryThumbnailsWrapAround',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Wrap Around', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'At end of cells, wraps-around to first for infinite scrolling', 'woocommerce-gallery-images' ),
                'default'  => 0,
                'required' => array('galleryThumbnailsEnable','equals','1'),
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => esc_html__( 'Variation Product Images', 'woocommerce-gallery-images' ),
        'id'         => 'variable-settings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'showVariationGalleryImagesInProductGallery',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Show  Gallery images in Variable Product Gallery', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Show all variation gallery images in the default variable product image gallery. E.g. shows all varaiton color T-Shirts images in Main T-Shirt.', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'showVariationGalleryImagesInListing',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Show Variable Gallery images in Categories', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Add support for gallery images to show in listings. You will need our <a href="https://www.welaunch.io/en/product/woocommerce-single-variations/" target="_blank">Single Variations Plugin</a> and your theme must support 2nd image in listings (e.g. Flatsome).', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
            array(
                'id'       => 'showVariableGalleryImages',
                'type'     => 'checkbox',
                'title'    => esc_html__( 'Still show Variable Gallery Images', 'woocommerce-gallery-images' ),
                'subtitle' => esc_html__( 'Beside variation gallery images, still show the variable gallery images. Add variable gallery image to single variation products gallery.', 'woocommerce-gallery-images' ),
                'default'  => 1,
            ),
        )
    ) );

    $framework::setSection( $opt_name, array(
        'title'      => esc_html__( 'Stylings', 'woocommerce-gallery-images' ),
        'desc'       => esc_html__( 'Style settings.', 'woocommerce-gallery-images' ),
        'id'         => 'stylings',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'loaderColor',
                'type'     => 'color',
                'title'    => esc_html__('Loading Icon Color', 'redux-framework-demo'), 
                'default'  => '#3171ee',
                'validate' => 'color',
            ),
            array(
                'id'       => 'fullscreenColor',
                'type'     => 'color',
                'title'    => esc_html__('Fullscreen Icon Color', 'redux-framework-demo'), 
                'default'  => '#555555',
                'validate' => 'color',
            ),
            array(
                'id'       => 'thumbnailBorderColor',
                'type'     => 'color',
                'title'    => esc_html__('Thumbnail Border Color', 'redux-framework-demo'), 
                'default'  => '#333333',
                'validate' => 'color',
            ),
            array(
                'id'       => 'fakeLoadingTime',
                'type'     => 'spinner',
                'title'    => esc_html__( 'Fake Loading time (in millisconds)', 'woocommerce-print-products' ),
                'min'      => '0',
                'step'     => '100',
                'max'      => '10000',
                'default'  => '700',
            ),
        )
    ) );

    /*
     * <--- END SECTIONS
     */
