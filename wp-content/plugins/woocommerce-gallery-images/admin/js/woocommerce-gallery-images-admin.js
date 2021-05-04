jQuery( function( $ ) {

	 "use strict"; 

	// Product gallery file uploads.
	var product_gallery_frame;
	var product_images;
	var image_gallery_ids;
	var attachment_ids;

	$('#woocommerce-product-data').on('click', '.add_variation_images a', function( event ) {
		
		var $el = $( this );

		image_gallery_ids = $el.next('.variation_image_gallery');
		product_images = $el.parent().parent().find('.variation_images_container ul');
		event.preventDefault();

		// If the media frame already exists, reopen it.
		if ( product_gallery_frame ) {
			product_gallery_frame.open();
			return;
		}

		// Create the media frame.
		product_gallery_frame = wp.media.frames.product_gallery = wp.media({
			states: [
				new wp.media.controller.Library({
					title: $el.data( 'choose' ),
					filterable: 'all',
					multiple: true
				})
			]
		});

		// When an image is selected, run a callback.
		product_gallery_frame.on( 'select', function() {
			var selection = product_gallery_frame.state().get( 'selection' );
			var attachment_ids = image_gallery_ids.val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if ( attachment.id ) {
					attachment_ids   = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;
					product_images.append(
						'<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image +
						'" /><ul class="actions"><li><a href="#" class="delete" title="' + $el.data('delete') + '">' +
						$el.data('text') + '</a></li></ul></li>'
					);
				}
			});

			$('#variable_product_options_inner .wc_input_price').trigger('change');

			image_gallery_ids.val( attachment_ids );
		});

		// Finally, open the modal.
		product_gallery_frame.open();
	});

	$( '#woocommerce-product-data' ).on('woocommerce_variations_loaded', function() {

		$('.variation_images_container').each(function(i, index) {

			var $this = $(this);
			$this.find('ul.variation_images').sortable({
				items: 'li.image',
				cursor: 'move',
				scrollSensitivity: 40,
				forcePlaceholderSize: true,
				forceHelperSize: false,
				helper: 'clone',
				opacity: 0.65,
				placeholder: 'wc-metabox-sortable-placeholder',
				start: function( event, ui ) {
					ui.item.css( 'background-color', '#f6f6f6' );
				},
				stop: function( event, ui ) {
					ui.item.removeAttr( 'style' );
				},
				update: function() {
					var attachment_ids = '';

					$this.find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
						var attachment_id = $( this ).attr( 'data-attachment_id' );
						attachment_ids = attachment_ids + attachment_id + ',';
					});

					image_gallery_ids = $this.parents('.data').find('.variation_image_gallery');
					image_gallery_ids.val( attachment_ids );

	                $this.closest('.woocommerce_variation').addClass('variation-needs-update');
	                $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
	                $('#variable_product_options').trigger('woocommerce_variations_input_changed');
				}
			});
		});
	});

	// Remove images.
	$('#woocommerce-product-data').on('click', '.variation_images_container a.delete', function() {

		var $this = $(this);

		var dataContainer = $this.parents('.data');
		$this.closest( 'li.image' ).remove();

		image_gallery_ids = dataContainer.find('.variation_image_gallery');

		attachment_ids = '';

		product_images = dataContainer.find('.variation_images_container');
		product_images.find( 'ul li.image' ).css( 'cursor', 'default' ).each( function() {
			var attachment_id = $( this ).attr( 'data-attachment_id' );
			attachment_ids = attachment_ids + attachment_id + ',';
		});

		image_gallery_ids.val( attachment_ids );

        dataContainer.closest('.woocommerce_variation').addClass('variation-needs-update');
        $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
        $('#variable_product_options').trigger('woocommerce_variations_input_changed');

		return false;
	});
});
