<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Spt
 */
$spt_theme_options = spt_get_options( 'spt_theme_options' );
if ( $spt_theme_options['post_navigation'] == 'sidebar') { get_template_part('post','nav'); } 

if ( ! dynamic_sidebar( 'main-sidebar' ) ) : ?>
	<div id="archives" class="widget wow fadeIn widget_archive" data-wow-delay="0.5s">
		<div class="widget-title clearfix">
			<h4><?php _e( 'Archives', 'spt' ); ?></h4>
		</div>
		<ul>
			<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
		</ul>
	</div>
	<div id="meta" class="widget wow fadeIn widget_meta" data-wow-delay="0.5s">
		<div class="widget-title clearfix">
			<h4><?php _e( 'Meta', 'spt' ); ?></h4>
		</div>	
		<ul>
			<?php wp_register(); ?>
			<li><?php wp_loginout(); ?></li>
			<?php wp_meta(); ?>
		</ul>
	</div>
<?php endif; ?>
