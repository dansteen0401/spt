<?php
/**
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
$social_bg_image = $spt_theme_options['social_bg_image'];

if ($social_bg_image != '') { ?>
	<div class="social" style="background: url(<?php echo esc_url($social_bg_image); ?>) 50% 0 no-repeat fixed; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;"> 
<?php } else { ?>
	<div class="social">
<?php } ?>
	<div id="social-wrap">
		<div id="social-bar">
			<?php if($spt_theme_options['facebook_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['facebook_link']); ?>" target="_blank" title="<?php _e('Facebook','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/facebook.png';?>" /></a>
			<?php endif; ?>	
			<?php if($spt_theme_options['twitter_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['twitter_link']); ?>" target="_blank" title="<?php _e('Twitter','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/twitter.png';?>" /></a>
			<?php endif; ?>	
			<?php if($spt_theme_options['google_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['google_link']); ?>" target="_blank" title="<?php _e('Google+','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/google.png';?>" /></a>
			<?php endif; ?>	
			<?php if($spt_theme_options['instagram_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['instagram_link']); ?>" target="_blank" title="<?php _e('Instagram','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/instagram.png';?>" /></a>
			<?php endif; ?>
			<?php if($spt_theme_options['linkedin_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['linkedin_link']); ?>" target="_blank" title="<?php _e('LinkedIn','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/linkedin.png';?>" /></a>
			<?php endif; ?>
			<?php if($spt_theme_options['youtube_link']): ?>
				<a href="<?php echo esc_url($spt_theme_options['youtube_link']); ?>" target="_blank" title="<?php _e('Youtube','spt'); ?>"><img src="<?php echo get_stylesheet_directory_uri().'/images/youtube.png';?>" /></a>
			<?php endif; ?>			
		</div>
	</div>
</div>