<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://iamniloy.com
 * @package           Woo_Product_Gallery_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Twist - Product Gallery Slider
 * Plugin URI:        https://bitly.com/twist_cc
 * Description:       Too Many Product Images in your Product Gallery ? This plugin will add a carousel in your Product Gallery.
 * Version:           1.1
 * Author:            Niloy Sarker
 * Author URI:        http://iamniloy.com
 * Text Domain:       twist
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Check if WooCommerce is active
 **/
	 if ( ! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  ){
	add_action( 'admin_notices', 'twist_woocommerce_inactive_notice'  );
	return;
	}
	
	function twist_woocommerce_inactive_notice() {
		if ( current_user_can( 'activate_plugins' ) ) :
			if ( !class_exists( 'WooCommerce' ) ) :
				?>
				<div id="message" class="error">
					<p>
						<?php
						printf(
							__( '%s Twist needs WooCommerce%s %sWooCommerce%s must be active for Twist Plugin to work. Please install & activate WooCommerce.', 'twist' ),
							'<strong>',
							'</strong><br>',
							'<a href="http://wordpress.org/extend/plugins/woocommerce/" target="_blank" >',
							'</a>'
						);
						?>
					</p>
				</div>		
				<?php
			endif;
		endif;
	}

/**
	 * Register the JS & CSS for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	function twist_enqueue_files() {
		wp_enqueue_style( 'dashicons' );
		wp_enqueue_style( 'elastislide-css', plugin_dir_url( __FILE__ ) . 'assets/css/elastislide.css', array(),  'all' );	
		wp_enqueue_script( 'modernizr.custom.17475.js', plugin_dir_url( __FILE__ ) . 'assets/js/modernizr.custom.17475.js', array( 'jquery' ),'1', false );
		
		wp_enqueue_script( 'jquery.elastislide-js', plugin_dir_url( __FILE__ ) . 'assets/js/jquery.elastislide.js', array( 'jquery' ),'1', false );
		
		
	}
	
add_action( 'wp_enqueue_scripts','twist_enqueue_files' );

// Remove srcset > Wordpress Version 4.4.2
add_filter('wp_get_attachment_image_attributes', function($attr) {
    if (isset($attr['sizes'])) unset($attr['sizes']);
    if (isset($attr['srcset'])) unset($attr['srcset']);
    return $attr;
}, PHP_INT_MAX);
add_filter('wp_calculate_image_sizes', '__return_false', PHP_INT_MAX);
add_filter('wp_calculate_image_srcset', '__return_false', PHP_INT_MAX);
remove_filter('the_content', 'wp_make_content_images_responsive');



// Thumbanils Image size
/**
 ** Option Framwork inc
 */
require_once 'functions.php';



function twist_option( $name )
{
    return  vp_option( "twist_option." . $name );
}


/**
 ** Add/Remove WC actions
 */
 add_action('plugins_loaded','after_woo_hooks');

function after_woo_hooks() {
	
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );

add_action( 'woocommerce_product_thumbnails', 'twist_show_product_thumbnails', 20 );
add_action( 'woocommerce_before_single_product_summary', 'twist_show_product_image', 10 ); 


add_image_size( 'thumbnails_twist', 120, 120, true);
}
// Product Thumbnails 
function twist_show_product_thumbnails() {
		require_once 'inc/product-thumbnails.php';
	}

// Single Product Image
function twist_show_product_image() {
		require_once 'inc/product-image.php';
	}



// Twist Code Start

function twist_option_edits() {
  ?>
<style type="text/css">
.elastislide-vertical nav span ,.elastislide-horizontal nav span,.twist-main-image:hover > span{
  background: <?php echo twist_option("twist_nav_cl"); ?>;
  color: <?php echo twist_option("twist_nav_ico_cl"); ?>;

}
<?php if(twist_option("twist_lightbox")=='true'){
		echo '.elastislide-carousel ul li {
  opacity: 1;
}';
	}	
	
	?>


<?php
if(twist_option("twist_layout") == 'vertical_left'){
echo'.twist-main-image{ float: right;width:80% !important;}';
}
elseif(twist_option("twist_layout") == 'vertical_right'){
echo'.twist-main-image{ float: left; width:80% !important;}
.elastislide-wrapper {
  float: right;
  right: -3px;
}';
}
else{
	echo'.woocommerce-main-image {
width:100%;
float:none;
}';

}
 echo twist_option("twist_ce_1"); 
 ?>
</style>
	<script type="text/javascript">
	  (function( $ ) {
	'use strict';
	


	$('.images .thumbnails').attr('id', 'twist');
	$('#twist').removeClass('thumbnails');
	$('#twist a').wrapAll('<ul>');
	$('#twist ul').attr('id', 'twist-carousel');
	
	$('#twist-carousel').addClass('elastislide-list');
	$('#twist ul a').wrap('<li>');

	

 $( document ).ready(function() {
	 
	 
	

		/**
		 * This funtion for change the large image when 
		 *	visitors click on next/Previous button
		 */
		 function npChangeimg(){
		 	$( '.woocommerce .images' ).find( '.woocommerce-main-image').attr( 'href', $('.woocommerce #twist .active a').attr( 'data-main-image-link' ) );
	    	$( '.woocommerce .images' ).find( '.woocommerce-main-image img' ).attr( 'src', $('.woocommerce #twist .active a').attr( 'href' ) );
	    	
	    	var singleimgH = $('.attachment-shop_single').height();
	    	$('.twist-main-image').css({'height': singleimgH + 'px'});
	    	
			 $(".woocommerce-main-image").fadeOut();
			    $(".woocommerce-main-image img").load(function(){
			        $(this).parent().fadeIn();
			    });
		 }
		
		// Single click on thumbnails
	    $( "#twist-carousel li" ).click(function() {
		 $( '#twist-carousel li').removeClass('active');
		  $(this).addClass('active');
		   npChangeimg();

					 	if($("#twist-carousel li").last().hasClass('active')) {
			        		$('#next').fadeOut(300);
			    		};	
			    		if($("#twist-carousel li").first().hasClass('active')) {
			        		$('#prev').fadeOut(300);
			    		};		
		});
		/**
		 * Init product single thumb carousel
		 */
		
		function singleThumbCarousel() {
			

				
				$( '.woocommerce #twist' ).find( 'a' ).on( 'click', function( e ) {
					e.preventDefault();

					$('#prev,#next').fadeIn(300);
		 			 
					});
			
		}


<?php if(twist_option("twist_lightbox")=='false'){
	?>
	$('#prev,#next').show();
			  // Next Button
		    $('#next').click(function(){

		    $('#twist-carousel li.active').removeClass('active').addClass('oldActive');    
		        if ( $('.oldActive').is(':last-child')) {
		        	$('#twist-carousel li').first().addClass('active');
		        }
		        else{
		        	$('.oldActive').next().addClass('active');
		        }

		    $('.oldActive').removeClass('oldActive');
		    	
		    	// Change the large image on Click
		    	npChangeimg();

	    	if($("#twist-carousel li").last().hasClass('active')) {
        		$('#next').fadeOut(300);
    		};
		   		// Display Prev Button if that hide
		   		$('#prev').fadeIn(300);


			
		    });
		    

		    // Previous Button
		    $('#prev').click(function(){
		    $('#twist-carousel li.active').removeClass('active').addClass('oldActive');    
		           if ( $('.oldActive').is(':first-child')) {
		        $('#twist-carousel li').last().addClass('active');
		        }
		           else{
		    $('.oldActive').prev().addClass('active');
		           }
		    $('.oldActive').removeClass('oldActive');
		  	
			// Change the large image on Click
		    	npChangeimg();
				
		    if($("#twist-carousel li").first().hasClass('active')) {
        		$('#prev').fadeOut(300);
    		};
    		// Display Next Button if that hide
		   		$('#next').fadeIn(300);
			





		    });
	<?php
}
	else{
		?>
		$('#prev,#next').hide();
		<?php
	}
?>




	<?php if(twist_option("twist_lightbox")=='false'){
		echo 'singleThumbCarousel();';
	}	
	
	?>
	

	});
			
})( jQuery );

</script>
  <?php
}
 add_action( 'wp_footer', 'twist_option_edits' );
