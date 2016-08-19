<?php
/**
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
?>
<div id="header-top">
	<div class="pagetop-inner clearfix">
		<div class="top-left left">
			<span class="top-shipping"><img src="<?php echo get_stylesheet_directory_uri().'/images/header-shipping.png';?>"/><?php echo __($spt_theme_options['header_shipping']); ?></span>
			<span class="top-award"><img src="<?php echo get_stylesheet_directory_uri().'/images/header-award.png';?>"/><?php echo __($spt_theme_options['header_award']); ?></span>
		</div>
		<div class="top-right right">
			<?php if ( $spt_theme_options['header_gametraka_enable'] == '1' ) { get_template_part( 'traka','header' ); }; ?>
		</div>
	</div>
</div>