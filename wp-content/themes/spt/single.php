<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
get_header(); ?>
	<div id="main" class="<?php echo esc_attr($spt_theme_options['layout_settings']);?>">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', 'single');
		
		endwhile;
	?>
	</div><!--main-->
<?php if ($spt_theme_options['social_section_on'] == '1') {
	get_template_part( 'social', 'section' );	
}
get_footer(); ?>