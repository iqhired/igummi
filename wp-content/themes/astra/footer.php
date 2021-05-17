<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php 
	astra_content_after();
		
	astra_footer_before();
		
	astra_footer();
		
	astra_footer_after(); 
?>
	</div><!-- #page -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php 

  
    $upload_dir = site_url() . '/wp-content/uploads/pdf';

?>

	<input type="hidden" id="ajax_url" value="<?php echo admin_url('admin-ajax.php');?>">
	<input type ="hidden" id="current_id" value="<?php echo $post->ID; ?>">
	<input type="hidden" id="upload_url" value="<?php echo $upload_dir;?>">
	<script>
	//jQuery(document).ready( function(){         
 $(window).on('load', function(){
       
//var rml_post_id = jQuery(this).data( 'id' );  
//var ajax_url = $("#ajax_url").val();	
var post_id = $("#current_id").val();	
var upload_dir = $("#upload_url").val();
var newUrl =  upload_dir + "/" + post_id + ".pdf" ;
console.log(post_id);
				            $(".download_pdf ").attr("href", newUrl); // Set herf value
          
    });     
//});
	</script>
<?php 
	astra_body_bottom();    
	wp_footer(); 
	
?>
	</body>
</html>
