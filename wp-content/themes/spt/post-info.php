<?php 
/**
 * @package Spt
 */
?>
<div class="post-info">
	<?php if(has_post_format('image')) {?>
		<span><i class="fa fa-camera"></i><a href="<?php printf(esc_url( get_post_format_link( 'image' ))); ?>"><?php printf( __('Image','spt')); ?></a></span>
	<?php } elseif(has_post_format('gallery')) {?>
		<span><i class="fa fa-picture-o"></i><a href="<?php printf(esc_url( get_post_format_link( 'gallery' ))); ?>"><?php printf( __('Gallery','spt')); ?></a></span>
	<?php } elseif(has_post_format('video')) {?>
		<span><i class="fa fa-video-camera"></i><a href="<?php printf(esc_url( get_post_format_link( 'video' ))); ?>"><?php printf( __('Video','spt')); ?></a></span>
	<?php } elseif(has_post_format('aside')) {?>
		<span><i class="fa fa-file-text"></i><a href="<?php printf(esc_url( get_post_format_link( 'aside' ))); ?>"><?php printf( __('Aside','spt')); ?></a></span>
	<?php } elseif(has_post_format('audio')) {?>
		<span><i class="fa fa-music"></i><a href="<?php printf(esc_url( get_post_format_link( 'audio' ))); ?>"><?php printf( __('Audio','spt')); ?></a></span>
	<?php } else {?>
		<span><i class="fa fa-thumb-tack"></i><?php printf( __('Standard','spt')); ?></span>
	<?php } ?>
	<span class="separator"> / </span>
	<span><i class="fa fa-user"></i><?php _e('by ','spt'); printf(esc_url(the_author_posts_link())); ?> </span>
	<span class="separator"> / </span>
	<span><i class="fa fa-calendar"></i><?php printf(esc_attr( get_the_date())); ?> </span>
	<span class="separator"> / </span>
	<span><i class="fa fa-comment-o"></i><a href="<?php esc_url(comments_link()); ?>"><?php comments_number( __('No Comments','spt'), __('1 Comment','spt'), __('% Comments','spt')); ?></a></span>
</div>