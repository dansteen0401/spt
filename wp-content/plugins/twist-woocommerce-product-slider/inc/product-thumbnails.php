<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

//
$count_gallery = count($attachment_ids);

/**
*	Get Total gallary images
*	This codes of below use for fixing thumbnails if they are 
*	Less then total gallery count number
*/
class FixThumbnails{
	public $total;

	function GetTotal()
	{

		$exsit_gallery = $this->total;
		$set_option = twist_option("twist_thumbanils");
		
		if ($set_option <= $exsit_gallery) {
			$echoTotal = $set_option;
		
		}
		elseif ($set_option > $exsit_gallery) {
			$echoTotal = $exsit_gallery;
		
		}
		
		/**
		*Jquery Start
		*/	
			?>
			<script type="text/javascript">
	  (function( $ ) {
	'use strict';
	
	/**
	*	Fix Mobile Screen Thumbnails Items
	*/
		
	function callElastic(){

	    if ($(window).width() < 500) {

	    	 $( '#twist-carousel' ).elastislide( {
		 
	// orientation 'horizontal' || 'vertical'
	<?php 
	if(twist_option("twist_layout") == 'horizontal'){echo 'orientation : \'horizontal\',';}
	else{echo'orientation : \'vertical\',';}
	?>
			

			// sliding speed
			speed : 600,

			// sliding easing
			easing : 'ease-in-out',
			
			// the minimum number of items to show. 
			// when we resize the window, this will make sure minItems are always shown 
			// (unless of course minItems is higher than the total number of elements)
			minItems : 4,
			
			autoplay : <?php echo twist_option("twist_autoplay"); ?>,
			autoplayTimeOut : '<?php echo twist_option("twist_autoplayTimeout"); ?>',
			// index of the current item (left most item of the carousel)
			start : 0,
			
			
					} );
	         

	    }
	    else
	    {

	          $( '#twist-carousel' ).elastislide( {
		 
	// orientation 'horizontal' || 'vertical'
	<?php 
	if(twist_option("twist_layout") == 'horizontal'){echo 'orientation : \'horizontal\',';}
	else{echo'orientation : \'vertical\',';}
	?>
	

	// sliding speed
	speed : 600,

	// sliding easing
	easing : 'ease-in-out',
	
	// the minimum number of items to show. 
	// when we resize the window, this will make sure minItems are always shown 
	// (unless of course minItems is higher than the total number of elements)
	minItems :  <?php 
			echo $echoTotal;
			?>,
	
	autoplay : <?php echo twist_option("twist_autoplay"); ?>,
	autoplayTimeOut : '<?php echo twist_option("twist_autoplayTimeout"); ?>',
	// index of the current item (left most item of the carousel)
	start : 0,
	
	 
	
			} );

	    }

	}

 $( window ).load(function() {
	 
	 

	callElastic();
	
	$('#twist-carousel li').first().addClass('active');
	   
	$('#twist-carousel li.active').show();
	
	


	});
			
})( jQuery );

</script>
		<?php
		/*
		* 	End jQuery
		*/
	}

	
}

$FixThumbnails = new FixThumbnails; 
$FixThumbnails->total=$count_gallery;


 $FixThumbnails->GetTotal();

if ( $attachment_ids ) {
	$loop 		= 0;
	$columns 	= apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
	?>
	<div class="thumbnails"><?php

		foreach ( $attachment_ids as $attachment_id ) {
			
		if(twist_option("twist_lightbox")=='true'){
			$classes = array( 'zoom' );
			}	
			else{$classes = array( ' ' );}
	

			//

			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';

			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';



			$image_class = esc_attr( implode( ' ', $classes ) );


			if(twist_option("twist_lightbox")=='true'){
			$twist_pp = 'prettyPhoto[product-gallery]';
			$image_link = wp_get_attachment_url( $attachment_id );
			$main_image_link = $image_link;
			}
			else{
				$twist_pp = '0';
			//  Get twist single product image src
				$twist_single_image  = wp_get_attachment_image_src( $attachment_id, 'shop_single', true );
	            $image_link      = $twist_single_image[0];
	            $main_image_link = wp_get_attachment_url( $attachment_id );

			}

			if ( ! $image_link )
				continue;

			$image_title 	= esc_attr( get_the_title( $attachment_id ) );
			$image_caption 	= esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'thumbnails_twist' ), 0, $attr = array(
				'title'	=> $image_title,
				'alt'	=> $image_title
				) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" data-main-image-link="%s" class="%s" title="%s" data-rel="'.$twist_pp.'">%s</a>', $image_link,$main_image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?>

</div>
	<?php
}



