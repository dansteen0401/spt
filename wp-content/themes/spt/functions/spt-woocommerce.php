<?php
/**
 * Spt theme functions and definitions
 *
 * Enabling support for WooCommerce
 *
 * @package Spt
 */

// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}
?>
<?php
global $woo_options;

/*-----------------------------------------------------------------------------------*/
/* This theme supports WooCommerce													 */
/*-----------------------------------------------------------------------------------*/

add_action( 'after_setup_theme', 'spt_woocommerce_support' );
function spt_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );
add_action( 'woocommerce_single_product_summary', 'wc_print_notices', 25 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'spt_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'spt_theme_wrapper_end', 10);

remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
/**
 * Load start of theme wrapper function	
*/
function spt_theme_wrapper_start() {
$spt_theme_options = spt_get_options( 'spt_theme_options' );
?>
	<div id="main" class="<?php echo $spt_theme_options['layout_settings'];?> shop">
		<div class="content-posts-wrap">
			<div class="woocommerce">
				<div id="content-box">
					<div id="post-body">
						<div class="post-single">
<?php }
 
/**
 * Load the end of theme wrapper function	
*/
function spt_theme_wrapper_end() { 
?>
						</div><!-- post-single -->
							<?php get_template_part('post','sidebar'); ?>
					</div><!-- post-body -->
				</div><!-- content-box -->
				<div class="sidebar-frame">
					<div class="sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- main -->
<?php }