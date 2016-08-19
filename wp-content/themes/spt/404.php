<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
get_header(); ?>
<div id="main" class="<?php echo esc_attr($spt_theme_options['layout_settings']);?>">
	<div class="content-posts-wrap">
		<div id="content-box">
			<div id="post-body">
				<h1><?php _e('Error 404 - Page not found!', 'spt'); ?></h1>
				<div class="sorry"><?php _e('Sorry! It seems that the page you are looking for is not here.', 'spt'); ?></div>
			</div><!--post-body-->
		</div><!--content-box-->
		<div class="sidebar-frame">
			<div class="sidebar">
				<?php get_sidebar(); ?>
			</div><!--sidebar-->
		</div><!--sidebar-frame-->
	</div><!--content-posts-wrap-->
</div><!--main-->
<?php if ($spt_theme_options['social_section_on'] == '1') {
	get_template_part( 'social', 'section' );	
}
get_footer(); ?>