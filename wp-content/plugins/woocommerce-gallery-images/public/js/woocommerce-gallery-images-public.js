(function( $ ) {
	'use strict';

	// Create the defaults once
	var pluginName = "WooCommerceVariationGalleryImages",
		defaults = {
			'modalHeightAuto' : '1',
		};

	// The actual plugin constructor
	function Plugin ( element, options ) {
		this.element = element;
		
		this.settings = $.extend( {}, defaults, options );
		this._defaults = defaults;
		this.trans = this.settings.trans;
		this._name = pluginName;
		this.init();
	}

	// Avoid Plugin.prototype conflicts
	$.extend( Plugin.prototype, {
		init: function() {
			this.window = $(window);
			this.documentHeight = $( document ).height();
			this.windowHeight = this.window.height();
			this.product = {};
			this.elements = {};

			this.singleImagesSlider = false;
			this.galleryThumbnailsSlider = false;

			this.getInitialGalleryHTML();
			this.getSimpleImages();
			this.getVariationImages();
			this.thumbnailClick();
			this.fullscreen();
		},
		getInitialGalleryHTML : function() {
			this.settings.initalImageContainer = $(this.settings.imageContainer).html();
			this.settings.initalGalleryImagesContainer = $(this.settings.galleryImagesContainer).html();
		},
		getSimpleImages: function() {

			var that = this;

			if($('.woocommerce-hidden-non-variable-product').length < 1) {
				return;
			}
			that.renderImages();
		},
		getVariationImages: function() {

			var that = this;

			$(document).on('woocommerce_variation_has_changed', '.variations_form', function(e) {
				that.renderImages();
			});

			if(that.settings.overrideDefaultImageGallery == "1") {
				setTimeout( function() {
					$('.variations_form').trigger('woocommerce_variation_has_changed');
				}, 500 );
				
			}
		},
		renderImages : function() {

			var that = this;
			var $this = $('input[name="variation_id"]');
			var variation_id = $this.val();
			var product_id = $('input[name="product_id"]').val();

			if(variation_id == "" && product_id == "") {
				return;
			}

			var formData = $('.variations_form').serialize()

			$(that.settings.galleryImagesContainer).html('');
			$(that.settings.imageContainer).html('<div class="woocommerce-gallery-images-main-carousel-loader"><svg width="44" height="44" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" stroke="' + that.settings.loaderColor + '"><g fill="none" fill-rule="evenodd" stroke-width="2"><circle cx="22" cy="22" r="1"><animate attributeName="r" begin="0s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite" /><animate attributeName="stroke-opacity" begin="0s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite" /></circle><circle cx="22" cy="22" r="1"><animate attributeName="r" begin="-0.9s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite" /><animate attributeName="stroke-opacity" begin="-0.9s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite" /></circle></g> </svg></div>');
			
			setTimeout(function() { 

				jQuery.ajax({
					url: that.settings.ajax_url,
					type: 'post',
					dataType: 'JSON',
					data: {
						action: 'woocommerce_get_gallery_images',
						variation_id: variation_id,
						product_id: product_id,
						formData : formData
					},
					success : function( response ) {

						if(!response.status) {
							return;
						}

						var imageHTML = '<div class="woocommerce-gallery-images-main-carousel woocommerce-gallery-images-main-position-' + that.settings.galleryThumbnailsPosition + '">';
						var galleryHTML = '<div class="woocommerce-gallery-images-gallery-carousel woocommerce-gallery-images-gallery-position-' + that.settings.galleryThumbnailsPosition + '">';

						var singleImageColums = that.settings.singleImageColums;
						var singleImageWidth = 100 / singleImageColums;
						var singleImageMarginRight = that.settings.singleImageMarginRight;

						var galleryThumbnailsColums = that.settings.galleryThumbnailsColums;
						var galleryThumbnailsWidth = 100 / galleryThumbnailsColums;
						var galleryThumbnailsMarginRight = that.settings.galleryThumbnailsMarginRight;
						if(that.settings.galleryThumbnailsPosition != "horizontal") {
							galleryThumbnailsMarginRight = 0;
						}

						$.each(response.images, function(i, index) {
							imageHTML += '<div class="woocommerce-gallery-images-main-carousel-cell" style="width: ' + singleImageWidth + '% !important;margin-right: ' + singleImageMarginRight + 'px !important;">' + index['full'] + '</div>';
							galleryHTML += '<a href="#" class="woocommerce-gallery-images-gallery-carousel-cell" style="width: ' + galleryThumbnailsWidth + '% !important;margin-right: ' + galleryThumbnailsMarginRight + 'px !important;border-color: ' + that.settings.thumbnailBorderColor + ' !important;">' + index['thumbnail'] + '</a>';
						});

						imageHTML += '</div>';
						galleryHTML += '</div>';
						
						if(that.settings.galleryThumbnailsEnable == "0") {
							galleryHTML = "";
						}

						// Same selector
						if(that.settings.imageContainer == that.settings.galleryImagesContainer) {
							$(that.settings.imageContainer).html(imageHTML + galleryHTML);
						} else {
							$(that.settings.imageContainer).html(imageHTML);
							$(that.settings.galleryImagesContainer).html(galleryHTML);
						}

						that.singleImagesSlider = $('.woocommerce-gallery-images-main-carousel').flickity(that.settings.singleImagesOptions);
						if(that.settings.galleryThumbnailsPosition == "horizontal") {
							that.galleryThumbnailsSlider = $('.woocommerce-gallery-images-gallery-carousel').flickity(that.settings.galleryThumbnailsOptions);
						} else {
							var singleImagesSliderHeight = $('.woocommerce-gallery-images-main-carousel').height();
							
							// Adjust max height
							var galleryThumbnailsNav = $('.woocommerce-gallery-images-gallery-carousel');
							galleryThumbnailsNav.css('max-height', singleImagesSliderHeight + 'px');

							var galleryThumbnailsNavCells = galleryThumbnailsNav.find('.woocommerce-gallery-images-gallery-carousel-cell');
							var flkty = that.singleImagesSlider.data('flickity');

							var navTop  = galleryThumbnailsNav.position().top;
							var navCellHeight = galleryThumbnailsNavCells.height();
							var navHeight = galleryThumbnailsNav.height();

							that.singleImagesSlider.on( 'select.flickity', function() {
								// set selected nav cell
								galleryThumbnailsNav.find('.is-nav-selected').removeClass('is-nav-selected');
								var $selected = galleryThumbnailsNavCells.eq( flkty.selectedIndex ).addClass('is-nav-selected');
								// scroll nav
								var scrollY = $selected.position().top + galleryThumbnailsNav.scrollTop() - ( navHeight + navCellHeight ) / 3;
								galleryThumbnailsNav.animate({
								scrollTop: scrollY
								});
							});
						}


						$('.woocommerce-gallery-images-main-carousel').append('<a href="#" style="border-color: ' + that.settings.fullscreenColor + ';"class="woocommerce-gallery-images-main-carousel-fullscreen"><svg style="fill: ' + that.settings.fullscreenColor + ';" viewBox="0 0 32 32"><path d="M15,20,7,28h5v4H0V20H4v5l8-8Zm5-5,8-8v5h4V0H20V4h5l-8,8Z"></path></svg></a>');

						if(that.settings.singleImagesOptions.zoom == "1") {
							$('.woocommerce-gallery-images-main-carousel img').each(function(i, index) {

								$(this).wrap('<span style="display:inline-block"></span>').css('display', 'block').parent().zoom({
							    	duration: 20
						    	});

							});
						}

					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log('An Error Occured: ' + jqXHR.status + ' ' + errorThrown + '! Please contact System Administrator!');
					}
				});
			}, that.settings.fakeLoadingTime);
		},
		thumbnailClick : function() {

			var that = this;

			$(that.settings.galleryImagesContainer).on( 'click', '.woocommerce-gallery-images-gallery-carousel-cell', function(e) {
				e.preventDefault();
				var $this = $(this);


				$('.woocommerce-gallery-images-gallery-carousel-cell').removeClass('is-selected');

				$this.addClass('is-selected');
			  	var index = $(this).index();
			  	that.singleImagesSlider.flickity( 'select', index );
			});
		},
		fullscreen : function() {

			var overlay = $('.woocommerce-gallery-images-fullscreen-overlay');
			if(overlay.length < 1) {
				return;
			}

			var that = this;

			that.fullscreenOpen = false;

			$(document).on('click', '.woocommerce-gallery-images-main-carousel-fullscreen, .woocommerce-gallery-images-main-carousel-cell.is-selected', function(e) {
				e.preventDefault();
				that.openFullscreen();
				that.fullscreenOpen = true;
			});

			$(document).on('click', '.woocommerce-gallery-images-fullscreen-overlay, .woocommerce-gallery-images-fullscreen-container', function(e) {
				e.preventDefault();
				$('.woocommerce-gallery-images-fullscreen-container, .woocommerce-gallery-images-fullscreen-overlay').fadeOut();
				that.fullscreenOpen = false;
			});
		}, 
		openFullscreen : function() {
			var activeImg = $('.woocommerce-gallery-images-main-carousel-cell.is-selected img').attr('src');

			$('.woocommerce-gallery-images-fullscreen-container').html('<img src="' + activeImg + '" alt="">');
			$('.woocommerce-gallery-images-fullscreen-container, .woocommerce-gallery-images-fullscreen-overlay').fadeIn();
		},
	} );

	// Constructor wrapper
	$.fn[ pluginName ] = function( options ) {
		return this.each( function() {
			if ( !$.data( this, "plugin_" + pluginName ) ) {
				$.data( this, "plugin_" +
					pluginName, new Plugin( this, options ) );
			}
		} );
	};

	$(document).ready(function() {

		$( "body" ).WooCommerceVariationGalleryImages( 
			woocommerce_gallery_images_options
		);

	} );

})( jQuery );