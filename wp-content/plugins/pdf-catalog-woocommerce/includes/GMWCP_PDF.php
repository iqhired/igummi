<?php
/**
 * This class is loaded on the back-end since its main job is 
 * to display the Admin to box.
 */
use Dompdf\Dompdf as Dompdf;

class GMWCP_PDF {
	
	public function __construct () {
		add_action( 'init', array( $this, 'woo_comman_single_button' )); 
	}

	function woo_comman_single_button(){
		if (isset($_REQUEST['action']) && $_REQUEST['action']=='catelog_single') {
			include_once(GMWCP_PLUGINDIR.'dompdf-master/autoload.inc.php');
			$dompdf = new Dompdf(array('enable_remote' => true));
			ob_start(); 
			$style_path = GMWCP_PLUGINDIR.'css/print-style.css';
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<style type="text/css">
					<?php
					ob_start();
					if (file_exists($style_path)) {
						include($style_path);
					}
					echo $style_path = ob_get_clean();
					?>
				</style>
				<?php
				echo $this->gmwcp_css();
				?>
			</head>
			<body >
				<?php $this->gmwcp_signle_pdf($_REQUEST['id']); ?>
			</body>
			</html>
			<?php
			$output = ob_get_clean();
			$dompdf->loadHtml($output);
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream("relatorio.pdf", array("Attachment" => false));
			exit;
		}
		if (isset($_REQUEST['action']) && $_REQUEST['action']=='catelog_shop') {
			include_once(GMWCP_PLUGINDIR.'dompdf-master/autoload.inc.php');
			$dompdf = new Dompdf(array('enable_remote' => true));
			ob_start(); 
			$style_path = GMWCP_PLUGINDIR.'css/print-style.css';
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
				<style type="text/css">
					<?php
					ob_start();
					if (file_exists($style_path)) {
						include($style_path);
					}
					echo $style_path = ob_get_clean();
					?>
				</style>
				<?php
				echo $this->gmwcp_css();
				?>
			</head>
			<body >
				<?php 
				if($_REQUEST['id']=='full'){
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => -1
					);
				}else{
					$args = array(
						'post_type' => 'product',
						'posts_per_page' => -1,
						'tax_query' => array(
										        array(
										            'taxonomy' => 'product_cat',
										            'field'    => 'term_id',
										            'terms'    => array( $_REQUEST['id'] ),
										            'operator' => 'IN',
										        ),
										    ),
					);
				}

				$query1 = new WP_Query( $args );
				while ( $query1->have_posts() ) {
				   $query1->the_post();
				   global $post;
				   $this->gmwcp_signle_pdf($post->ID);
				}
				 ?>
			</body>
			</html>
			<?php
			$output = ob_get_clean();

			
			$dompdf->set_option('defaultFont', 'Helvetica');
			$dompdf->loadHtml($output);
			$dompdf->render();

			// Output the generated PDF to Browser
			$dompdf->stream("relatorio.pdf", array("Attachment" => false));
			exit;
		}
	}

	function gmwcp_signle_pdf($product_id){
		
		$product = wc_get_product( $product_id );
		$attachment_id = $product->get_image_id();
		$url = wp_get_attachment_image_url( $attachment_id,'mediaum' );
		if($url!=''){
			$fullsize_path = $url;
		}else{
			$fullsize_path = GMWCP_PLUGINURL.'img/woocommerce-placeholder-600x600.png';
		}
		
		?>
		<div class="main">
			<div class="spacear"></div>
			<div class="upperdivs">
				<div class="leftimage">
					<img src="<?php echo $fullsize_path;?>" class="leftimage_img">
				</div>
				<div class="rightimage">
					<div class="innerrightimage">
						<h2><?php echo $product->get_name();?></h2>
						<div class="short_descop">
							<?php
							echo $product->get_short_description(); 
							?>
						</div>
						<a href="<?php echo get_permalink( $product->get_id() );?>" target="_blank">Read More</a>
						<div class="metacustl">
							<p><strong>SKU:</strong> <?php echo $product->get_sku();?></p>
							<p><strong>Price:</strong> <?php echo $product->get_price_html();?></p>
							<p><strong>Categories:</strong> <?php echo $product->get_categories();?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="spacea"></div>
			<div class="fullwdithimag">
				<h3>Product Description</h3>
				<?php echo $product->get_description();?>
			</div>
		</div>
		
		<?php 
		
		
	}
	function gmwcp_css(){
		$gmpcp_background_color = get_option( 'gmpcp_background_color' );
		$gmpcp_item_background_color = get_option( 'gmpcp_item_background_color' );
		?>
		<style type="text/css" media="screen">
			body{
				background-color: <?php echo $gmpcp_background_color;?>;
				color: <?php echo $gmpcp_item_background_color;?>;
			}
		</style>

		<?php
	}
	

	
	
}


