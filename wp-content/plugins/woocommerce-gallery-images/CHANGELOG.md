# Changelog
======
1.0.8
======
- NEW:	Disable fronted gallery feature completly (only use backend functionality to keep your theme gallery)
		https://imgur.com/a/ei4H5F8
- FIX:	Added support for WooCommerce Product Variations Swatches Premium by Villa theme

======
1.0.7
======
- NEW:	Added vertical left / right Gallery Images
		https://imgur.com/a/N8Soely
- NEW:	Dropped Redux Framework support and added our own framework 
		Read more here: https://www.welaunch.io/en/2021/01/switching-from-redux-to-our-own-framework
		This ensure auto updates & removes all gutenberg stuff
		You can delete Redux (if not used somewhere else) afterwards
		https://www.welaunch.io/updates/welaunch-framework.zip
		https://imgur.com/a/BIBz6kz

======
1.0.6
======
- NEW:	! Unique feature !
		Variable products with multiple attributes will return first found image
		when variation form changed.
		Example: T-Shirt with Color & Size -> customer changes only color -> image will get first found variation
		No longer need to create "any" variations
		See example: https://demos.welaunch.io/woocommerce-gallery-images/product/2-attributes-variable-t-shirt
- FIX:	removed blocking AJAX async
- FIX:	Gallery button texts missing

======
1.0.5
======
- NEW:	General enable button will now still 
		allow using category / loop gallery images
		This will keep your theme default gallery.

======
1.0.4
======
- NEW:	Disable thumbnails
		https://imgur.com/a/eb7U3BA

======
1.0.3
======
- FIX:	Lightbox not working when zoom disabled
- FIX:	Renamed certain parts in plugin settings
		Please recheck your settings afterwards

======
1.0.2
======
- FIX:	attachment_ids not defined

======
1.0.1
======
- FIX:	Admin css file not found

======
1.0.0
======
- Initial release