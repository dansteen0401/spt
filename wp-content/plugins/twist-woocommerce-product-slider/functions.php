<?php

/**
 * Load Languages
 */


/**
 * Include Vafpress Framework
 */
require_once 'vafpress-framework/bootstrap.php';



/**
 * Load options, metaboxes, and shortcode generator array templates.
 */

// options
$tmpl_opt  = plugin_dir_path( __FILE__ ) . '/admin/option/option.php';

/**
 * Create instance of Options
 */
$theme_options = new VP_Option(array(
	'is_dev_mode'           => false,                                  // dev mode, default to false
	'option_key'            => 'twist_option',                           // options key in db, required
	'page_slug'             => 'twist_settings',                           // options page slug, required
	'template'              => $tmpl_opt,                              // template file path or array, required
	'menu_page'             =>  array(
       // 'icon_url' => get_plugin_directory_uri() . '/img/icon.png',
       // 'position' => 6,
    ),                          // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
	'use_auto_group_naming' => false,                                   // default to true
	'use_util_menu'         => false,                                   // default to true, shows utility menu
	'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'
	'layout'                => 'fixed',                                // fluid or fixed, default to fixed
	'page_title'            => __( 'Twist Gallery Slider Options', 'twist' ), // page title
	'menu_label'            => __( 'Twist Options', 'twist' ), // menu label
));





		
/*
 * EOF
 */