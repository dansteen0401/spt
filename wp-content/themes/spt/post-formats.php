<?php 
/**
 * @package Spt
 *
 *
 * Check for featured images 
 */ 
$spt_theme_options = spt_get_options( 'spt_theme_options' );
if ( $spt_theme_options['blog_content'] == 'excerpt') {
	if (has_post_format( 'gallery' )) {
	
		spt_gallery_post();
	
	} else {
		if ( has_post_thumbnail() ) { ?>
			<div class="image-holder">
				<div class="thumb-wrapper imgLiquidFill imgLiquid">
					<?php the_post_thumbnail('full'); ?>
				</div>
			</div>
		<?php 
		}
	} 
}

if ( $spt_theme_options['blog_content'] == 'excerpt') { ?>
	<div class = "text-holder">
		<a class="post-title" href="<?php esc_url(the_permalink()); ?>"><h3 <?php post_class('entry-title'); ?>><?php the_title(); ?></h3></a>
		<?php get_template_part( 'post', 'meta');
		the_excerpt(__( 'Continue Reading...', 'spt' ) ); 
		the_tags('<p class="post-tags"><span>'.__('Tags:','spt').'</span> ','','</p>'); ?>
	</div>
<?php } else { ?>
	<div class = "text-holder-full">
		<a class="post-title" href="<?php esc_url(the_permalink()); ?>"><h3 <?php post_class('entry-title'); ?>><?php the_title(); ?></h3></a>
		
		<?php if ($spt_theme_options['post_info'] == 'above') { get_template_part('post','info');}
			
			if (has_post_format( 'gallery' )) {
				spt_gallery_post();
			} else { 
				if (has_post_format( 'video' )) {
				} else {
					if ( has_post_thumbnail() ) { ?>
						<div class="thumb-wrapper">
							<?php the_post_thumbnail('full'); ?>
						</div><!--thumb-wrapper-->
					<?php 
					} 		
				}	
			}
			
			the_content( __( 'Continue Reading...', 'spt' ) ); ?> 
	</div>	
<?php } ?>
