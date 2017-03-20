<?php
/**
 * Template Name: Page Full Width
 *
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
get_header(); ?>

	<div id="main" class="col1">
	<?php
		// Start the Loop.
		while ( have_posts() ) : the_post(); ?>

<div class="container">
	<div id="content-box">
		<div <?php post_class('post-single'); ?>>
		<?php
			if ( has_post_thumbnail() ) {
				if ($spt_theme_options['featured_img_post'] == '1') {?>
					<div class="thumb-wrapper">
						<?php the_post_thumbnail('full'); ?>
					</div><!--thumb-wrapper-->
				<?php
				}
			} ?>
			<div id="article">
				<?php the_content(); 
				the_tags('<p class="post-tags"><span>'.__('Tags:','spt').'</span> ','','</p>');
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'spt' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				
				//Displays navigation to next/previous post.
				if ( $spt_theme_options['post_navigation'] == 'below') { get_template_part('post','nav'); }
			
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template( '', true );
				} ?>
		
			</div><!--article-->
		</div><!--post-single-->
				<?php get_template_part('post','sidebar'); ?>
	</div><!--content-box-->
	<div class="sidebar-frame">
		<div class="sidebar">
			<?php get_sidebar(); ?>
		</div><!--sidebar-->
	</div><!--sidebar-frame-->
</div><!--content-posts-wrap-->
	<?php	
		endwhile;
	?>
	</div><!--main-->
<?php if ($spt_theme_options['social_section_on'] == '1') {
	get_template_part( 'social', 'section' );	
}
get_footer(); ?>