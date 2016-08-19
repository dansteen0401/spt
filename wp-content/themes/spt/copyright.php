<?php
/**
 * @package Spt
 */  
$spt_theme_options = spt_get_options( 'spt_theme_options' );
?>
<div id="copyright">
	<div class="copyright-wrap">
		<span class="center"><a href="<?php echo esc_url( home_url( '/' ) ) ?>"><?php echo esc_attr($spt_theme_options['footer_copyright_text']);?></a></span>
	</div>
</div><!--copyright-->