<?php
/**
 * Spt functions and definitions
 *
 * @package Spt
*/

function spt_customize_register($wp_customize){

	class WP_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
	
		public function render_content() {
			?>
        	<label>
        	<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        	<textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        	</label>
        	<?php	
		}
	}
	
	class WP_Customize_Info_Control extends WP_Customize_Control {
		public $type = 'info';
	
		public function render_content() {
			?>
				<strong> <?php _e('If you like my work. Buy me a coffee.','spt'); ?></strong>
                <div class="donate">
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="VJP4U4NDG2P9Y">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
					</form>
				</div>
				<p class="btn">
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/faq/"><?php _e('Theme Support','spt') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/preview/spt/"><?php _e('View Theme Demo','spt') ?></a><br><br>
					<a class="button button-primary" target="_blank" href="http://vpthemes.com/spt/#theme-pricing"><?php  _e('Upgrade to Pro','spt') ?></a>
				</p>
        	<?php	
		}
	}
    
	// Google Fonts
	$google_fonts = array(
        'Roboto' => 'Roboto',
		'PT Sans' => 'PT Sans',
		'Open Sans' => 'Open Sans'
	);
						
	// Opacity
	$opacity = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);
	
	// Sidebar Position
	$theme_layout = array('col1' => __('No Sidebars','spt'), 'col2-l' => __('Right Sidebar','spt'), 'col2-r' => __('Left Sidebar','spt'));
	
	// Blog Content
	$blog_content = array('excerpt' => __('Excerpt','spt'),'full' => __('Full Content','spt'));
	
	// Post Navigation Links Location
	$post_nav_array = array(
		'disable' => __('Disable', 'spt'),
		'sidebar' => __('Main Sidebar', 'spt'),
		'below' => __('Below Content', 'spt'),

	);
	
	// Post Info Location
	$post_info_array = array(
		'disable' => __('Disable', 'spt'),
		'above' => __('Above Content', 'spt'),

	);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	//  =============================
    //  = Theme Options Panel       =
    //  =============================
	$wp_customize->add_panel( 'theme_options', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Spt Theme Options', 'spt' ),
	));
	
	//  =============================
    //  = Theme Info Section        =
    //  =============================					
	$wp_customize->add_section( 'Theme Settings', array(
    	'title'          => __( 'Theme Information', 'spt' ),
    	'priority'       => 999, 
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[theme_info]', array(
    	'default'        => '',
		'sanitize_callback' => 'spt_no_sanitize',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Info_Control($wp_customize, 'theme_info', array(
        'label'    => __('Theme Info', 'spt'),
        'section'  => 'Theme Settings',
        'settings' => 'spt_theme_options[theme_info]',
    )));

	//  =============================
    //  = General Section           =
    //  =============================					
	$wp_customize->add_section( 'General Settings', array(
    	'title'          => __( 'Theme General Settings', 'spt' ),
    	'priority'       => 1000,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[theme_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'theme_color', array(
        'label'    => __('Theme Color', 'spt'),
        'section'  => 'General Settings',
        'settings' => 'spt_theme_options[theme_color]',
    )));
	//===============================    
	$wp_customize->add_setting('spt_theme_options[breadcrumbs]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('breadcrumbs', array(
        'settings' => 'spt_theme_options[breadcrumbs]',
        'label'    => __('Display Breadcrumbs', 'spt'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[animation]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('animation', array(
        'settings' => 'spt_theme_options[animation]',
        'label'    => __('Enable Animation', 'spt'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[responsive_design]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('responsive_design', array(
        'settings' => 'spt_theme_options[responsive_design]',
        'label'    => __('Enable Resposive Design', 'spt'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[scrollup]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('scrollup', array(
        'settings' => 'spt_theme_options[scrollup]',
        'label'    => __('Enable Scrollup', 'spt'),
        'section'  => 'General Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[scrollup_color]', array(
    	'default'        => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_color', array(
        'label'    => __('ScrollUp Color', 'spt'),
        'section'  => 'General Settings',
        'settings' => 'spt_theme_options[scrollup_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[scrollup_hover_color]', array(
    	'default'        => '#3498db',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'scrollup_hover_color', array(
        'label'    => __('ScrollUp Hover Color', 'spt'),
        'section'  => 'General Settings',
        'settings' => 'spt_theme_options[scrollup_hover_color]',
    )));

	//  =============================
    //  = Logo Section              =
    //  =============================

	$wp_customize->add_section( 'Logo Settings', array(
    	'title'          => __( 'Theme Logo Settings', 'spt' ),
    	'priority'       => 1001,
		'panel' => 'theme_options',
	) );
	//===============================    
    $wp_customize->add_setting( 'spt_theme_options[logo_width]', array(
        'default'        => '300',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_width', array(
        'label'      => __('Logo Width (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_width]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_height]', array(
        'default'        => '30',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_height', array(
        'label'      => __('Logo Height (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_top_margin]', array(
        'default'        => '15',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_top_margin', array(
        'label'      => __('Logo Top Margin (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_top_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_left_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_left_margin', array(
        'label'      => __('Logo Left Margin (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_left_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_bottom_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_bottom_margin', array(
        'label'      => __('Logo Bottom Margin (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_bottom_margin]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_right_margin]', array(
        'default'        => '25',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_right_margin', array(
        'label'      => __('Logo Right Margin (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_right_margin]',
    ));
	//===============================
    $wp_customize->add_setting('spt_theme_options[logo]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Image Logo', 'spt'),
        'section'  => 'Logo Settings',
        'settings' => 'spt_theme_options[logo]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_alt_text]', array(
        'default'        => 'Logo',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_alt_text', array(
        'label'      => __('Logo ALT Text', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_alt_text]',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[logo_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('logo_uppercase', array(
        'settings' => 'spt_theme_options[logo_uppercase]',
        'label'    => __('Logo Uppercase', 'spt'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('spt_theme_options[google_font_logo]', array(
		'sanitize_callback' => 'spt_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_logo', array(
        'settings' => 'spt_theme_options[google_font_logo]',
        'label'   => __('Select logo font family','spt'),
        'section' => 'Logo Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_font_size]', array(
        'default'        => '24',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_font_size', array(
        'label'      => __('Logo Font Size (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_font_size]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[logo_font_weight]', array(
        'default'        => '700',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('logo_font_weight', array(
        'label'      => __('Logo Font Weight', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[logo_font_weight]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[text_logo_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_logo_color', array(
        'label'    => __('Logo Color', 'spt'),
        'section'  => 'Logo Settings',
        'settings' => 'spt_theme_options[text_logo_color]',
    )));
	//===============================
	$wp_customize->add_setting('spt_theme_options[enable_logo_tagline]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('enable_logo_tagline', array(
        'settings' => 'spt_theme_options[enable_logo_tagline]',
        'label'    => __('Display Tagline Underneath Logo', 'spt'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[tagline_font_size]', array(
        'default'        => '16',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('tagline_font_size', array(
        'label'      => __('Tagline Font Size (px)', 'spt'),
        'section'    => 'Logo Settings',
        'settings'   => 'spt_theme_options[tagline_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[tagline_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'tagline_color', array(
        'label'    => __('Tagline Color', 'spt'),
        'section'  => 'Logo Settings',
        'settings' => 'spt_theme_options[tagline_color]',
    )));
	//===============================
	$wp_customize->add_setting('spt_theme_options[tagline_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('tagline_uppercase', array(
        'settings' => 'spt_theme_options[tagline_uppercase]',
        'label'    => __('Tagline Uppercase', 'spt'),
        'section'  => 'Logo Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Navigation Section        =
    //  =============================

	$wp_customize->add_section( 'Navigation Settings', array(
    	'title'          => __( 'Theme Navigation Settings', 'spt' ),
    	'priority'       => 1002,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('spt_theme_options[menu_sticky]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => 'spt_theme_options[menu_sticky]',
        'label'    => __('Sticky Menu', 'spt'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[menu_top_margin]', array(
        'default'        => '0',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('menu_top_margin', array(
        'label'      => __('Menu Top Margin (px)', 'spt'),
        'section'    => 'Navigation Settings',
        'settings'   => 'spt_theme_options[menu_top_margin]',
    ));
	//===============================
     $wp_customize->add_setting('spt_theme_options[google_font_menu]', array(
		'sanitize_callback' => 'spt_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_menu', array(
        'settings' => 'spt_theme_options[google_font_menu]',
        'label'   => __('Select Menu Font Family','spt'),
        'section' => 'Navigation Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[nav_font_size]', array(
        'default'        => '13',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('nav_font_size', array(
        'label'      => __('Menu Font Size (px)', 'spt'),
        'section'    => 'Navigation Settings',
        'settings'   => 'spt_theme_options[nav_font_size]',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[menu_uppercase]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('menu_uppercase', array(
        'settings' => 'spt_theme_options[menu_uppercase]',
        'label'    => __('Menu Uppercase', 'spt'),
        'section'  => 'Navigation Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_font_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_font_color', array(
        'label'    => __('Navigation Menu Font Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_border_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_border_color', array(
        'label'    => __('Navigation Menu Border Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_bg_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_color', array(
        'label'    => __('Navigation Menu Background Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_bg_sub_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_sub_color', array(
        'label'    => __('SubMenu Background Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_bg_sub_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_hover_font_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_hover_font_color', array(
        'label'    => __('Menu Hover Font Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_hover_font_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_bg_hover_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_bg_hover_color', array(
        'label'    => __('Menu Background Hover Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_bg_hover_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[nav_cur_item_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'nav_cur_item_color', array(
        'label'    => __('Selected Menu Color', 'spt'),
        'section'  => 'Navigation Settings',
        'settings' => 'spt_theme_options[nav_cur_item_color]',
    )));
	//  =============================
    //  = Typography Section        =
    //  =============================
	$wp_customize->add_section( 'Typography Settings', array(
    	'title'          => __( 'Theme Typography Settings', 'spt' ),
    	'priority'       => 1003,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('spt_theme_options[google_font_body]', array(
		'sanitize_callback' => 'spt_sanitize_font_style',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'Open Sans',
 
    ));

    $wp_customize->add_control( 'google_font_body', array(
        'settings' => 'spt_theme_options[google_font_body]',
        'label'   => __('Select Body Font Family','spt'),
        'section' => 'Typography Settings',
        'type'    => 'select',
        'choices'    => $google_fonts,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[body_font_size]', array(
        'default'        => '15',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('body_font_size', array(
        'label'      => __('Body Font Size (px)', 'spt'),
        'section'    => 'Typography Settings',
        'settings'   => 'spt_theme_options[body_font_size]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[body_font_color]', array(
    	'default'        => '#777777',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_font_color', array(
        'label'    => __('Body Font Color', 'spt'),
        'section'  => 'Typography Settings',
        'settings' => 'spt_theme_options[body_font_color]',
    )));
	//  =============================
    //  = Header Section            =
    //  =============================
	$wp_customize->add_section( 'Header Settings', array(
    	'title'          => __( 'Theme Header Settings', 'spt' ),
    	'priority'       => 1004,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[header_bg_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label'    => __('Header Background Color', 'spt'),
        'section'  => 'Header Settings',
        'settings' => 'spt_theme_options[header_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[header_opacity]', array(
        'default'        => '1',
		'sanitize_callback' => 'spt_sanitize_opacity',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_opacity', array(
        'label'      => __('Header Background Color Opacity', 'spt'),
        'section'    => 'Header Settings',
        'settings'   => 'spt_theme_options[header_opacity]',
        'type'    => 'select',
        'choices'    => $opacity,
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[header_top_enable]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('header_top_enable', array(
        'settings' => 'spt_theme_options[header_top_enable]',
        'label'    => __('Display Top Header Section', 'spt'),
        'section'  => 'Header Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[header_shipping]', array(
        'default'        => '',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_shipping', array(
        'label'      => __('Express Shipping', 'spt'),
        'section'    => 'Header Settings',
        'settings'   => 'spt_theme_options[header_shipping]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[header_award]', array(
        'default'        => 'info@yourdomain.com',
		'sanitize_callback' => 'spt_sanitize_award',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('header_award', array(
        'label'      => __('Award', 'spt'),
        'section'    => 'Header Settings',
        'settings'   => 'spt_theme_options[header_award]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[address_color]', array(
    	'default'        => '#cccccc',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'address_color', array(
        'label'    => __('Top Section Font Color', 'spt'),
        'section'  => 'Header Settings',
        'settings' => 'spt_theme_options[address_color]',
    )));
	//===============================
	$wp_customize->add_setting('spt_theme_options[header_gametraka_enable]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('header_gametraka_enable', array(
        'settings' => 'spt_theme_options[header_gametraka_enable]',
        'label'    => __('Display GameTraka Login', 'spt'),
        'section'  => 'Header Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[top_head_color]', array(
    	'default'        => '#262c33',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'top_head_color', array(
        'label'    => __('Top Section Color', 'spt'),
        'section'  => 'Header Settings',
        'settings' => 'spt_theme_options[top_head_color]',
    )));
	//  =============================
    //  = Home Page Section         =
    //  =============================
	$wp_customize->add_section( 'Home Settings', array(
    	'title'          => __( 'Theme Home Page Settings', 'spt' ),
    	'priority'       => 1005,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting('spt_theme_options[image_slider_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('image_slider_on', array(
        'settings' => 'spt_theme_options[image_slider_on]',
        'label'    => __('Enable Image Slider', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[getstarted_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('getstarted_section_on', array(
        'settings' => 'spt_theme_options[getstarted_section_on]',
        'label'    => __('Display Get Started Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[features_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('features_section_on', array(
        'settings' => 'spt_theme_options[features_section_on]',
        'label'    => __('Display Features Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[about_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('about_section_on', array(
        'settings' => 'spt_theme_options[about_section_on]',
        'label'    => __('Display About Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[services_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('services_section_on', array(
        'settings' => 'spt_theme_options[services_section_on]',
        'label'    => __('Display Services Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[cta_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('cta_section_on', array(
        'settings' => 'spt_theme_options[cta_section_on]',
        'label'    => __('Display Call To Action Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[content_boxes_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('content_boxes_section_on', array(
        'settings' => 'spt_theme_options[content_boxes_section_on]',
        'label'    => __('Display Content Boxes Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[getin_home_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('getin_home_on', array(
        'settings' => 'spt_theme_options[getin_home_on]',
        'label'    => __('Display Get In Touch Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[blog_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('blog_section_on', array(
        'settings' => 'spt_theme_options[blog_section_on]',
        'label'    => __('Display Latest News Section', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[latest_posts_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('latest_posts_on', array(
        'settings' => 'spt_theme_options[latest_posts_on]',
        'label'    => __('Display Blog Posts', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[social_section_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('social_section_on', array(
        'settings' => 'spt_theme_options[social_section_on]',
        'label'    => __('Display Social Links', 'spt'),
        'section'  => 'Home Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Image Slider Section      =
    //  =============================
	$wp_customize->add_section( 'Slider Settings', array(
    	'title'          => __( 'Theme Image Slider Settings', 'spt' ),
    	'priority'       => 1006,
		'panel' => 'theme_options',
	) );
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[slider_height]', array(
        'default'        => '500',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slider_height', array(
        'label'      => __('Image Slider Height (px)', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[slider_height]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[image_slider_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('image_slider_cat', array(
        'label'      => __('Image Slider Category', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[image_slider_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[slideshow_speed]', array(
        'default'        => '5000',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slideshow_speed', array(
        'label'      => __('Slideshow Interval', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[slideshow_speed]',
		'description' => __('1000 = 1 second, default value: 5000', 'spt'),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[animation_speed]', array(
        'default'        => '800',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('animation_speed', array(
        'label'      => __('Animation Speed', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[animation_speed]',
		'description' => __('1000 = 1 second, default value: 800', 'spt'),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[slider_num]', array(
        'default'        => '3',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('slider_num', array(
        'label'      => __('Number of Slides', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[slider_num]',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[captions_on]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('captions_on', array(
        'settings' => 'spt_theme_options[captions_on]',
        'label'    => __('Enable Slider Captions', 'spt'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[captions_pos_left]', array(
        'default'        => '18',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_pos_left', array(
        'label'      => __('Caption Position Left %', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[captions_pos_left]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[captions_pos_top]', array(
        'default'        => '10',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_pos_top', array(
        'label'      => __('Caption Position Top %', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[captions_pos_top]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[captions_width]', array(
        'default'        => '58',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('captions_width', array(
        'label'      => __('Caption Width %', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[captions_width]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[captions_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_title_color', array(
        'label'    => __('Caption Title Color', 'spt'),
        'section'  => 'Slider Settings',
        'settings' => 'spt_theme_options[captions_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[captions_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_text_color', array(
        'label'    => __('Captions Text Color', 'spt'),
        'section'  => 'Slider Settings',
        'settings' => 'spt_theme_options[captions_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[captions_button_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'captions_button_color', array(
        'label'    => __('Captions Button Color', 'spt'),
        'section'  => 'Slider Settings',
        'settings' => 'spt_theme_options[captions_button_color]',
    )));
	//===============================
	$wp_customize->add_setting('spt_theme_options[captions_button]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('captions_button', array(
        'settings' => 'spt_theme_options[captions_button]',
        'label'    => __('Enable Captions Button', 'spt'),
        'section'  => 'Slider Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[caption_button_text]', array(
        'default'        => 'Read More',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('caption_button_text', array(
        'label'      => __('Captions Button Text', 'spt'),
        'section'    => 'Slider Settings',
        'settings'   => 'spt_theme_options[caption_button_text]',
    ));
	//  =============================
    //  = Footer Section            =
    //  =============================
	$wp_customize->add_section( 'Footer Settings', array(
    	'title'          => __( 'Theme Footer Settings', 'spt' ),
    	'priority'       => 1007,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_bg_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label'    => __('Footer Background Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[copyright_bg_color]', array(
    	'default'        => '#262c33',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'copyright_bg_color', array(
        'label'    => __('Copyright Section Background Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[copyright_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_widget_title_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_color', array(
        'label'    => __('Footer Widget Title Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_widget_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_widget_title_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_title_border_color', array(
        'label'    => __('Footer Widget Title Border Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_widget_title_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_widget_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_color', array(
        'label'    => __('Footer Widget Text Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_widget_text_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_widget_text_border_color]', array(
    	'default'        => '#444444',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_widget_text_border_color', array(
        'label'    => __('Footer Widget Text Border Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_widget_text_border_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[footer_social_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_social_color', array(
        'label'    => __('Footer Social Icons Color', 'spt'),
        'section'  => 'Footer Settings',
        'settings' => 'spt_theme_options[footer_social_color]',
    )));
	//===============================
	$wp_customize->add_setting('spt_theme_options[footer_widgets]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('footer_widgets', array(
        'settings' => 'spt_theme_options[footer_widgets]',
        'label'    => __('Enable Footer Widgets', 'spt'),
        'section'  => 'Footer Settings',
        'type'     => 'checkbox',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[footer_copyright_text]', array(
        'default'        => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('footer_copyright_text', array(
        'label'      => __('Copyright Text', 'spt'),
        'section'    => 'Footer Settings',
        'settings'   => 'spt_theme_options[footer_copyright_text]',
    ));
	//  =============================
    //  = Layout Section            =
    //  =============================
	$wp_customize->add_section( 'Layout Settings', array(
    	'title'          => __( 'Theme Layout Settings', 'spt' ),
    	'priority'       => 1008,
		'panel' => 'theme_options',
	) );
	//===============================
     $wp_customize->add_setting('spt_theme_options[layout_settings]', array(
		'sanitize_callback' => 'spt_sanitize_theme_layout',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'col2-l',
 
    ));

    $wp_customize->add_control( 'layout_settings', array(
        'settings' => 'spt_theme_options[layout_settings]',
        'label'   => __('Theme Layout','spt'),
        'section' => 'Layout Settings',
        'type'    => 'radio',
        'choices'    => $theme_layout,
    ));
	//  =============================
    //  = Blog Section              =
    //  =============================
	$wp_customize->add_section( 'Blog Settings', array(
    	'title'          => __( 'Theme Blog Settings', 'spt' ),
    	'priority'       => 1009,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_posts_home_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_home_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'Blog Settings',
        'settings' => 'spt_theme_options[blog_posts_home_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[blog_posts_home_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_home_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'Blog Settings',
        'settings' => 'spt_theme_options[blog_posts_home_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_posts_top_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_color', array(
        'label'    => __('Top Section Background Color', 'spt'),
        'section'  => 'Blog Settings',
        'settings' => 'spt_theme_options[blog_posts_top_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_posts_top_font_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_posts_top_font_color', array(
        'label'    => __('Top Section Font Color', 'spt'),
        'section'  => 'Blog Settings',
        'settings' => 'spt_theme_options[blog_posts_top_font_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[blog_posts_top_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_posts_top_image', array(
        'label'    => __('Top Section Image', 'spt'),
        'section'  => 'Blog Settings',
        'settings' => 'spt_theme_options[blog_posts_top_image]',
    )));

	//===============================
     $wp_customize->add_setting('spt_theme_options[blog_content]', array(
		'sanitize_callback' => 'spt_sanitize_blog_content',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'excerpt',
 
    ));

    $wp_customize->add_control( 'blog_content', array(
        'settings' => 'spt_theme_options[blog_content]',
        'label'   => __('Blog Content','spt'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $blog_content,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[blog_excerpt]', array(
        'default'        => '50',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_excerpt', array(
        'label'      => __('Blog Excerpt Length', 'spt'),
        'section'    => 'Blog Settings',
        'settings'   => 'spt_theme_options[blog_excerpt]',
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[simple_paginaton]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => false,
    ));
 
    $wp_customize->add_control('simple_paginaton', array(
        'settings' => 'spt_theme_options[simple_paginaton]',
        'label'    => __('Use Simple Pagination', 'spt'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//===============================
     $wp_customize->add_setting('spt_theme_options[post_navigation]', array(
		'sanitize_callback' => 'spt_sanitize_post_nav',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'sidebar',
 
    ));

    $wp_customize->add_control( 'post_navigation', array(
        'settings' => 'spt_theme_options[post_navigation]',
        'label'   => __('Post Navigation Links','spt'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_nav_array,
    ));
	//===============================
     $wp_customize->add_setting('spt_theme_options[post_info]', array(
		'sanitize_callback' => 'spt_sanitize_post_info',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
		'default'        => 'above',
 
    ));

    $wp_customize->add_control( 'post_info', array(
        'settings' => 'spt_theme_options[post_info]',
        'label'   => __('Post Info Position','spt'),
        'section' => 'Blog Settings',
        'type'    => 'radio',
        'choices'    => $post_info_array,
    ));
	//===============================
	$wp_customize->add_setting('spt_theme_options[featured_img_post]', array(
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'spt_sanitize_checkbox',
        'type'       => 'option',
		'default'        => '1',
    ));
 
    $wp_customize->add_control('featured_img_post', array(
        'settings' => 'spt_theme_options[featured_img_post]',
        'label'    => __('Featured Image Inside the Post', 'spt'),
        'section'  => 'Blog Settings',
        'type'     => 'checkbox',
    ));
	//  =============================
    //  = Get Started Section       =
    //  =============================
	$wp_customize->add_section( 'GetStarted Settings', array(
    	'title'          => __( 'Theme Get Started Section', 'spt' ),
    	'priority'       => 1010,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getst_bg_color]', array(
    	'default'        => '#323b44',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'GetStarted Settings',
        'settings' => 'spt_theme_options[getst_bg_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getst_header_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_header_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'GetStarted Settings',
        'settings' => 'spt_theme_options[getst_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getst_section_header]', array(
        'default'        => 'Awesome Design & Clean Coding',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_section_header', array(
        'label'      => __('Title Text', 'spt'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'spt_theme_options[getst_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getst_text_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_text_color', array(
        'label'    => __('Subtitle Color', 'spt'),
        'section'  => 'GetStarted Settings',
        'settings' => 'spt_theme_options[getst_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getst_section_text]', array(
        'default'        => 'Are you ready?',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_section_text', array(
        'label'      => __('Subtitle Text', 'spt'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'spt_theme_options[getst_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getst_button_text]', array(
        'default'        => 'Get Started',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_button_text', array(
        'label'      => __('Button Text', 'spt'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'spt_theme_options[getst_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getst_button_color]', array(
    	'default'        => '#dd6868',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getst_button_color', array(
        'label'    => __('Button Color', 'spt'),
        'section'  => 'GetStarted Settings',
        'settings' => 'spt_theme_options[getst_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getst_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getst_button_url', array(
        'label'      => __('Button URL', 'spt'),
        'section'    => 'GetStarted Settings',
        'settings'   => 'spt_theme_options[getst_button_url]',
    ));
	//  =============================
    //  = Features Settings         =
    //  =============================
	$wp_customize->add_section( 'Features Settings', array(
    	'title'          => __( 'Theme Features Section', 'spt' ),
    	'priority'       => 1011,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[features_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[features_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[features_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'features_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[features_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[features_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_title_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[features_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[features_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'features_text_color', array(
        'label'    => __('Text Color', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[features_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[features_section_title]', array(
        'default'        => 'Clean Design & Great Functionality',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('features_section_title', array(
        'label'      => __('Title Text', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[features_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[features_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet pellentesque',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('features_section_desc', array(
        'label'      => __('Description Text', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[features_section_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_one]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one', array(
        'label'      => __('Feature #1 Title', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_one_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_desc', array(
        'label'      => __('Feature #1 Description', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_one_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_one_icon]', array(
        'default'        => 'fa-tablet',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_icon', array(
        'label'      => __('Feature #1 Icon', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_one_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('spt_theme_options[feature_one_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_one_image', array(
        'label'    => __('Feature #1 Image', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[feature_one_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_one_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_one_url', array(
        'label'      => __('Feature #1 URL', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_one_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_two]', array(
        'default'        => 'Unlimited Colors',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two', array(
        'label'      => __('Feature #2 Title', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_two_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_desc', array(
        'label'      => __('Feature #2 Description', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_two_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_two_icon]', array(
        'default'        => 'fa-tint',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_icon', array(
        'label'      => __('Feature #2 Icon', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_two_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('spt_theme_options[feature_two_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_two_image', array(
        'label'    => __('Feature #2 Image', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[feature_two_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_two_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_two_url', array(
        'label'      => __('Feature #2 URL', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_two_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_three]', array(
        'default'        => 'Clean Code',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three', array(
        'label'      => __('Feature #3 Title', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_three_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_desc', array(
        'label'      => __('Feature #3 Description', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_three_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_three_icon]', array(
        'default'        => 'fa-html5',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_icon', array(
        'label'      => __('Feature #3 Icon', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_three_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('spt_theme_options[feature_three_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_three_image', array(
        'label'    => __('Feature #3 Image', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[feature_three_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_three_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_three_url', array(
        'label'      => __('Feature #3 URL', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_three_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_four]', array(
        'default'        => 'eCommerce Ready',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four', array(
        'label'      => __('Feature #4 Title', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_four_desc]', array(
        'default'        => 'Lorem ipsum dolor sit',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_desc', array(
        'label'      => __('Feature #4 Description', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_four_desc]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_four_icon]', array(
        'default'        => 'fa-shopping-cart',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_icon', array(
        'label'      => __('Feature #4 Icon', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_four_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting('spt_theme_options[feature_four_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'feature_four_image', array(
        'label'    => __('Feature #4 Image', 'spt'),
        'section'  => 'Features Settings',
        'settings' => 'spt_theme_options[feature_four_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[feature_four_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('feature_four_url', array(
        'label'      => __('Feature #4 URL', 'spt'),
        'section'    => 'Features Settings',
        'settings'   => 'spt_theme_options[feature_four_url]',
    ));
	//  =============================
    //  = About Us Settings         =
    //  =============================
	$wp_customize->add_section( 'About Settings', array(
    	'title'          => __( 'Theme About Us Section', 'spt' ),
    	'priority'       => 1012,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[about_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'About Settings',
        'settings' => 'spt_theme_options[about_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[about_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'about_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'About Settings',
        'settings' => 'spt_theme_options[about_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[about_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_header_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'About Settings',
        'settings' => 'spt_theme_options[about_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[about_section_header]', array(
        'default'        => 'About Us',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('about_section_header', array(
        'label'      => __('Title Text', 'spt'),
        'section'    => 'About Settings',
        'settings'   => 'spt_theme_options[about_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[about_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'about_text_color', array(
        'label'    => __('Text Color', 'spt'),
        'section'  => 'About Settings',
        'settings' => 'spt_theme_options[about_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[about_section_text]', array(
        'default'        => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize,'about_section_text', array(
        'label'      => __('Section Text', 'spt'),
        'section'    => 'About Settings',
        'settings'   => 'spt_theme_options[about_section_text]',
    )));
	//  =============================
    //  = Our Services Settings     =
    //  =============================
	$wp_customize->add_section( 'Services Settings', array(
    	'title'          => __( 'Theme Services Section', 'spt' ),
    	'priority'       => 1013,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[services_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'Services Settings',
        'settings' => 'spt_theme_options[services_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[services_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'services_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'Services Settings',
        'settings' => 'spt_theme_options[services_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[services_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_title_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'Services Settings',
        'settings' => 'spt_theme_options[services_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[services_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'services_text_color', array(
        'label'    => __('Section Text Color', 'spt'),
        'section'  => 'Services Settings',
        'settings' => 'spt_theme_options[services_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[services_section_title]', array(
        'default'        => 'Our Services',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('services_section_title', array(
        'label'      => __('Section Text', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[services_section_title]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[services_section_desc]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis. Praesent gravida dignissim felis, id sagittis mauris rutrum non. Nullam pretium id sem ut hendrerit.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Textarea_Control( $wp_customize, 'services_section_desc', array(
        'label'      => __('Description Text', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[services_section_desc]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_one]', array(
        'default'        => 'Analytics',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one', array(
        'label'      => __('Service #1 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_one]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_one_icon]', array(
        'default'        => 'fa-flash',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one_icon', array(
        'label'      => __('Service #1 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_one_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_one_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_one_url', array(
        'label'      => __('Service #1 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_one_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_two]', array(
        'default'        => 'Graphic Design',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two', array(
        'label'      => __('Service #2 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_two]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_two_icon]', array(
        'default'        => 'fa-bullseye',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two_icon', array(
        'label'      => __('Service #2 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_two_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_two_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_two_url', array(
        'label'      => __('Service #2 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_two_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_three]', array(
        'default'        => 'Photography',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three', array(
        'label'      => __('Service #3 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_three]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_three_icon]', array(
        'default'        => 'fa-camera',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three_icon', array(
        'label'      => __('Service #3 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_three_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_three_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_three_url', array(
        'label'      => __('Service #3 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_three_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_four]', array(
        'default'        => 'Social',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four', array(
        'label'      => __('Service #4 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_four]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_four_icon]', array(
        'default'        => 'fa-twitter',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four_icon', array(
        'label'      => __('Service #4 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_four_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_four_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_four_url', array(
        'label'      => __('Service #4 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_four_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_five]', array(
        'default'        => 'SEO',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_five', array(
        'label'      => __('Service #5 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_five]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_five_icon]', array(
        'default'        => 'fa-globe',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_five_icon', array(
        'label'      => __('Service #5 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_five_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_five_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_five_url', array(
        'label'      => __('Service #5 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_five_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_six]', array(
        'default'        => 'Web Design',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_six', array(
        'label'      => __('Service #6 Title', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_six]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_six_icon]', array(
        'default'        => 'fa-desktop',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_six_icon', array(
        'label'      => __('Service #6 Icon', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_six_icon]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[service_six_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('service_six_url', array(
        'label'      => __('Service #6 URL', 'spt'),
        'section'    => 'Services Settings',
        'settings'   => 'spt_theme_options[service_six_url]',
    ));
	//  =============================
    //  = Call to Action Settings   =
    //  =============================
	$wp_customize->add_section( 'CTA Settings', array(
    	'title'          => __( 'Theme Call To Action Section', 'spt' ),
    	'priority'       => 1014,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cta_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'CTA Settings',
        'settings' => 'spt_theme_options[cta_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[cta_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cta_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'CTA Settings',
        'settings' => 'spt_theme_options[cta_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[cta_section_sm_header]', array(
        'default'        => 'Why work with us',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_section_sm_header', array(
        'label'      => __('Small Header Text', 'spt'),
        'section'    => 'CTA Settings',
        'settings'   => 'spt_theme_options[cta_section_sm_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cta_sm_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_sm_color', array(
        'label'    => __('Small Header Color', 'spt'),
        'section'  => 'CTA Settings',
        'settings' => 'spt_theme_options[cta_sm_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[cta_section_big_header]', array(
        'default'        => 'Creative People That Make Awesome Things',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_section_big_header', array(
        'label'      => __('Big Header Text', 'spt'),
        'section'    => 'CTA Settings',
        'settings'   => 'spt_theme_options[cta_section_big_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cta_big_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cta_big_color', array(
        'label'    => __('Big Header Color', 'spt'),
        'section'  => 'CTA Settings',
        'settings' => 'spt_theme_options[cta_big_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[cta_button_text]', array(
        'default'        => 'Get in touch',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_button_text', array(
        'label'      => __('Button Text', 'spt'),
        'section'    => 'CTA Settings',
        'settings'   => 'spt_theme_options[cta_button_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[cta_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('cta_button_url', array(
        'label'      => __('Button URL', 'spt'),
        'section'    => 'CTA Settings',
        'settings'   => 'spt_theme_options[cta_button_url]',
    ));
	//  =============================
    //  = Content Boxes Settings    =
    //  =============================
	$wp_customize->add_section( 'CB Settings', array(
    	'title'          => __( 'Theme Content Boxes Section', 'spt' ),
    	'priority'       => 1015,
		'panel' => 'theme_options',
	) );
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cont_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'CB Settings',
        'settings' => 'spt_theme_options[cont_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[cntbx_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cntbx_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'CB Settings',
        'settings' => 'spt_theme_options[cntbx_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cntbx_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cntbx_title_color', array(
        'label'    => __('Titles Color', 'spt'),
        'section'  => 'CB Settings',
        'settings' => 'spt_theme_options[cntbx_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[cont_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'cont_text_color', array(
        'label'    => __('Text Color', 'spt'),
        'section'  => 'CB Settings',
        'settings' => 'spt_theme_options[cont_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[first_column_header]', array(
        'default'        => 'Responsive Design',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_header', array(
        'label'      => __('First Column Header', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[first_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[first_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'first_column_text', array(
        'label'      => __('First Column Text', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[first_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[first_column_image]', array(
        'default'        => 'fa-tablet',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_image', array(
        'label'      => __('First Column Image', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[first_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[first_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('first_column_url', array(
        'label'      => __('First Column URL', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[first_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[second_column_header]', array(
        'default'        => 'High Quality',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_header', array(
        'label'      => __('Second Column Header', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[second_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[second_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'second_column_text', array(
        'label'      => __('Second Column Text', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[second_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[second_column_image]', array(
        'default'        => 'fa-umbrella',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_image', array(
        'label'      => __('Second Column Image', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[second_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[second_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('second_column_url', array(
        'label'      => __('Second Column URL', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[second_column_url]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[third_column_header]', array(
        'default'        => 'Tons of Features',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_header', array(
        'label'      => __('Third Column Header', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[third_column_header]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[third_column_text]', array(
        'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'sanitize_callback' => 'esc_textarea',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control(new WP_Customize_Textarea_Control( $wp_customize, 'third_column_text', array(
        'label'      => __('Third Column Text', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[third_column_text]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[third_column_image]', array(
        'default'        => 'fa-cog',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_image', array(
        'label'      => __('Third Column Image', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[third_column_image]',
		'description' => sprintf( __( 'Enter Font Awesome icon name. For icon name refer to: <a href="%1$s" target="_blank">Font Awesome Website</a>', 'spt' ), 'http://fortawesome.github.io/Font-Awesome/icons/' ),
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[third_column_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('third_column_url', array(
        'label'      => __('Third Column URL', 'spt'),
        'section'    => 'CB Settings',
        'settings'   => 'spt_theme_options[third_column_url]',
    ));
	//  =============================
    //  = Get In Touch Settings     =
    //  =============================
	$wp_customize->add_section( 'GIT Settings', array(
    	'title'          => __( 'Theme Get In Touch Section', 'spt' ),
    	'priority'       => 1016,
		'panel' => 'theme_options',
	));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getin_bg_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'GIT Settings',
        'settings' => 'spt_theme_options[getin_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[getin_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'getin_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'GIT Settings',
        'settings' => 'spt_theme_options[getin_bg_image]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getin_header_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_header_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'GIT Settings',
        'settings' => 'spt_theme_options[getin_header_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getin_section_header]', array(
        'default'        => 'Get In Touch with Us',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_section_header', array(
        'label'      => __('Title Text', 'spt'),
        'section'    => 'GIT Settings',
        'settings'   => 'spt_theme_options[getin_section_header]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getin_text_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_text_color', array(
        'label'    => __('Subtitle Color', 'spt'),
        'section'  => 'GIT Settings',
        'settings' => 'spt_theme_options[getin_text_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getin_section_text]', array(
        'default'        => 'If you have any questions, do not hesitate to contact us',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_section_text', array(
        'label'      => __('Subtitle Text', 'spt'),
        'section'    => 'GIT Settings',
        'settings'   => 'spt_theme_options[getin_section_text]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getin_button_text]', array(
        'default'        => 'Contact us now',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_button_text', array(
        'label'      => __('Button Text', 'spt'),
        'section'    => 'GIT Settings',
        'settings'   => 'spt_theme_options[getin_button_text]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[getin_button_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'getin_button_color', array(
        'label'    => __('Button Color', 'spt'),
        'section'  => 'GIT Settings',
        'settings' => 'spt_theme_options[getin_button_color]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[getin_button_url]', array(
        'default'        => '',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('getin_button_url', array(
        'label'      => __('Button URL', 'spt'),
        'section'    => 'GIT Settings',
        'settings'   => 'spt_theme_options[getin_button_url]',
    ));
	//  =============================
    //  = Latest News Settings      =
    //  =============================
	$wp_customize->add_section( 'News Settings', array(
    	'title'          => __( 'Theme Latest News Section', 'spt' ),
    	'priority'       => 1017,
		'panel' => 'theme_options',
	));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_bg_color]', array(
    	'default'        => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_bg_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'News Settings',
        'settings' => 'spt_theme_options[blog_bg_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[blog_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'blog_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'News Settings',
        'settings' => 'spt_theme_options[blog_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[blog_cat]', array(
        'default'        => '',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_cat', array(
        'label'      => __('Latest News Category', 'spt'),
        'section'    => 'News Settings',
        'settings'   => 'spt_theme_options[blog_cat]',
        'type'    => 'select',
        'choices'    => $options_categories,
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[num_posts]', array(
        'default'        => '3',
		'sanitize_callback' => 'spt_sanitize_number',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('num_posts', array(
        'label'      => __('Number of Posts', 'spt'),
        'section'    => 'News Settings',
        'settings'   => 'spt_theme_options[num_posts]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[blog_section_title]', array(
        'default'        => 'Latest News',
		'sanitize_callback' => 'spt_sanitize_cb',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('blog_section_title', array(
        'label'      => __('Title Text', 'spt'),
        'section'    => 'News Settings',
        'settings'   => 'spt_theme_options[blog_section_title]',
    ));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_title_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_title_color', array(
        'label'    => __('Title Color', 'spt'),
        'section'  => 'News Settings',
        'settings' => 'spt_theme_options[blog_title_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_post_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_post_color', array(
        'label'    => __('Post Title Color', 'spt'),
        'section'  => 'News Settings',
        'settings' => 'spt_theme_options[blog_post_color]',
    )));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[blog_meta_color]', array(
    	'default'        => '#111111',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'blog_meta_color', array(
        'label'    => __('Post Meta Color', 'spt'),
        'section'  => 'News Settings',
        'settings' => 'spt_theme_options[blog_meta_color]',
    )));
	//  =============================
    //  = Social Settings           =
    //  =============================
	$wp_customize->add_section( 'Social Settings', array(
    	'title'          => __( 'Theme Social Links', 'spt' ),
    	'priority'       => 1018,
		'panel' => 'theme_options',
		'description' => __("Enter your profile URL. To remove it, just leave it blank","spt"),
	));
	//===============================
	$wp_customize->add_setting( 'spt_theme_options[social_color]', array(
    	'default'        => '#eeeeee',
		'sanitize_callback' => 'sanitize_hex_color',
    	'type'           => 'option',
    	'capability'     => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'social_color', array(
        'label'    => __('Background Color', 'spt'),
        'section'  => 'Social Settings',
        'settings' => 'spt_theme_options[social_color]',
    )));
	//===============================
    $wp_customize->add_setting('spt_theme_options[social_bg_image]', array(
        'default'           => '',
		'sanitize_callback' => 'esc_url',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'social_bg_image', array(
        'label'    => __('Background Image', 'spt'),
        'section'  => 'Social Settings',
        'settings' => 'spt_theme_options[social_bg_image]',
    )));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[facebook_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('facebook_link', array(
        'label'      => __('Facebook', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[facebook_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[twitter_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('twitter_link', array(
        'label'      => __('Twitter', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[twitter_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[google_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('google_link', array(
        'label'      => __('Google Plus', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[google_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[linkedin_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('linkedin_link', array(
        'label'      => __('LinkedIn', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[linkedin_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[instagram_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('instagram_link', array(
        'label'      => __('Instagram', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[instagram_link]',
    ));
	//===============================
    $wp_customize->add_setting( 'spt_theme_options[youtube_link]', array(
        'default'        => '#',
		'sanitize_callback' => 'esc_url',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('youtube_link', array(
        'label'      => __('Youtube', 'spt'),
        'section'    => 'Social Settings',
        'settings'   => 'spt_theme_options[youtube_link]',
    ));

}
 
add_action('customize_register', 'spt_customize_register');


/**
 * Sets up theme custom styling
 * 
 */
function spt_theme_custom_styling() {
	$spt_theme_options = spt_get_options( 'spt_theme_options' );
	/**
	 * General Settings 
	 */	
	$theme_color = $spt_theme_options['theme_color'];
	$scrollup_color = $spt_theme_options['scrollup_color'];
	$scrollup_hover_color = $spt_theme_options['scrollup_hover_color'];
	/**
	 * Logo Settings 
	 */		
	$logo_width = $spt_theme_options['logo_width'];
	$logo_height = $spt_theme_options['logo_height'];
	$logo_top_margin = $spt_theme_options['logo_top_margin'];
	$logo_left_margin = $spt_theme_options['logo_left_margin'];
	$logo_bottom_margin = $spt_theme_options['logo_bottom_margin'];
	$logo_right_margin = $spt_theme_options['logo_right_margin'];
	$logo_uppercase = $spt_theme_options['logo_uppercase'];
	$google_font_logo = $spt_theme_options['google_font_logo'];
	$logo_font_size = $spt_theme_options['logo_font_size'];
	$logo_font_weight = $spt_theme_options['logo_font_weight'];
	$text_logo_color = $spt_theme_options['text_logo_color'];
	$tagline_font_size = $spt_theme_options['tagline_font_size'];
	$tagline_color = $spt_theme_options['tagline_color'];
	$tagline_uppercase = $spt_theme_options['tagline_uppercase'];
	/**
	 * Navigation Settings
	 */	
	$menu_sticky = $spt_theme_options['menu_sticky'];
	$menu_top_margin = $spt_theme_options['menu_top_margin'];
	$google_font_menu = $spt_theme_options['google_font_menu'];
	$nav_font_size = $spt_theme_options['nav_font_size'];
	$menu_uppercase = $spt_theme_options['menu_uppercase'];
	$nav_font_color = $spt_theme_options['nav_font_color'];
	$nav_border_color = $spt_theme_options['nav_border_color'];
	$nav_bg_color = $spt_theme_options['nav_bg_color'];
	$nav_bg_sub_color = $spt_theme_options['nav_bg_sub_color'];
	$nav_hover_font_color = $spt_theme_options['nav_hover_font_color'];
	$nav_bg_hover_color = $spt_theme_options['nav_bg_hover_color'];
	$nav_cur_item_color = $spt_theme_options['nav_cur_item_color'];
	/**
	 * Typography Settings
	 */	
	$google_font_body = $spt_theme_options['google_font_body'];
	$body_font_size = $spt_theme_options['body_font_size'];
	$body_font_color = $spt_theme_options['body_font_color'];
	/**
	 * Header Settings
	 */	
	$header_bg_color = $spt_theme_options['header_bg_color'];
	$header_opacity = $spt_theme_options['header_opacity'];
	$address_color = $spt_theme_options['address_color'];
	$top_head_color = $spt_theme_options['top_head_color'];
	/**
	 * Image Slider 
	 */	
	$slider_height = $spt_theme_options['slider_height'];
	$captions_pos_left = $spt_theme_options['captions_pos_left'];
	$captions_pos_top = $spt_theme_options['captions_pos_top'];
	$captions_width = $spt_theme_options['captions_width'];
	$captions_title_color = $spt_theme_options['captions_title_color'];
	$captions_text_color = $spt_theme_options['captions_text_color'];
	$captions_button_color = $spt_theme_options['captions_button_color'];
	/**
	 * Footer Settings
	 */
	$footer_bg_color = $spt_theme_options['footer_bg_color'];
	$copyright_bg_color = $spt_theme_options['copyright_bg_color'];
	$footer_widget_title_color = $spt_theme_options['footer_widget_title_color'];
	$footer_widget_title_border_color = $spt_theme_options['footer_widget_title_border_color'];
	$footer_widget_text_color = $spt_theme_options['footer_widget_text_color'];
	$footer_widget_text_border_color = $spt_theme_options['footer_widget_text_border_color'];
	$footer_social_color = $spt_theme_options['footer_social_color'];
	/**
	 * Blog Settings
	 */	
	$blog_posts_home_color = $spt_theme_options['blog_posts_home_color'];
	$blog_bg_color = $spt_theme_options['blog_bg_color'];
	$blog_title_color = $spt_theme_options['blog_title_color'];
	$blog_post_color = $spt_theme_options['blog_post_color'];
	$blog_meta_color = $spt_theme_options['blog_meta_color'];
	$blog_posts_top_color = $spt_theme_options['blog_posts_top_color'];
	$blog_posts_top_font_color = $spt_theme_options['blog_posts_top_font_color'];
	/**
	* Get Started Section
	*/
	$getst_bg_color = $spt_theme_options['getst_bg_color'];
	$getst_header_color = $spt_theme_options['getst_header_color'];
	$getst_text_color = $spt_theme_options['getst_text_color'];
	$getst_button_color = $spt_theme_options['getst_button_color'];
	/**
	* Features Section
	*/
	$features_bg_color = $spt_theme_options['features_bg_color'];
	$features_text_color = $spt_theme_options['features_text_color'];
	$features_title_color = $spt_theme_options['features_title_color'];
	/**
	* About Section
	*/
	$about_text_color = $spt_theme_options['about_text_color'];
	$about_bg_color = $spt_theme_options['about_bg_color'];
	$about_header_color = $spt_theme_options['about_header_color'];
	/**
	* Our Services Section
	*/
	$services_bg_color = $spt_theme_options['services_bg_color'];
	$services_title_color = $spt_theme_options['services_title_color'];
	$services_text_color = $spt_theme_options['services_text_color'];
	/**
	* Call To Action Section
	*/
	$cta_bg_color = $spt_theme_options['cta_bg_color'];
	$cta_sm_color = $spt_theme_options['cta_sm_color'];
	$cta_big_color = $spt_theme_options['cta_big_color'];
	/**
	* Content Boxes Section
	*/
	$cont_text_color = $spt_theme_options['cont_text_color'];
	$cont_bg_color = $spt_theme_options['cont_bg_color'];
	$cntbx_title_color = $spt_theme_options['cntbx_title_color'];
	/**
	* Get in Touch Section
	*/
	$getin_header_color = $spt_theme_options['getin_header_color'];
	$getin_text_color = $spt_theme_options['getin_text_color'];
	$getin_button_color = $spt_theme_options['getin_button_color'];
	$getin_bg_color = $spt_theme_options['getin_bg_color'];
	/**
	* Social Section
	*/
	$social_color = $spt_theme_options['social_color'];
	
	$output = '';

	/**
	 * General Settings 
	 */
	if ( $theme_color )
	$output .= 'blockquote, address, .page-links a:hover, .post-format-wrap {border-color:' . $theme_color . '}' . "\n";
	$output .= '.meta span i, .more-link, .post-title h3:hover, #main .standard-posts-wrapper .posts-wrapper .post-single .text-holder-full .post-format-wrap p.link-text a:hover, .breadcrumbs .breadcrumbs-wrap ul li a:hover, #article p a, .navigation a, .link-post i.fa, .quote-post i.fa, #article .link-post p.link-text a:hover, .link-post p.link-text a:hover, .quote-post span.quote-author, .post-single ul.link-pages li a strong, .post-info span i, .footer-widget-col ul li a:hover, .sidebar ul.link-pages li.next-link a span, .sidebar ul.link-pages li.previous-link a span, .sidebar ul.link-pages li i, .row .row-item .service i.fa {color:' . $theme_color . '}' . "\n";
	$output .= 'input[type="submit"],button, .page-links a:hover {background:' . $theme_color . '}' . "\n";
	$output .= '.search-submit,.wpcf7-form-control,.main-navigation ul ul, .content-boxes .circle, .feature .circle, .section-title-right:after, .boxtitle:after, .section-title:after, .content-btn, #comments .form-submit #submit, .post-tags a, .service-box .service-icon {background-color:' . $theme_color . '}' . "\n";
	
	if ( $scrollup_color )
	$output .= '.back-to-top {color:' . $scrollup_color . '}' . "\n";
	
	if ( $scrollup_hover_color )
	$output .= '.back-to-top i.fa:hover {color:' . $scrollup_hover_color . '}' . "\n";

	/**
	 * Logo Settings 
	 */	
	if ( $logo_width )
	$output .= '#logo {width:' . $logo_width . 'px }' . "\n";
	
	if ( $logo_height )
	$output .= '#logo {height:' . $logo_height . 'px }' . "\n";
	
	if ( $logo_top_margin )
	$output .= '#logo { margin-top:' . $logo_top_margin . 'px }' . "\n";
	
	if ( $logo_left_margin )
	$output .= '#logo { margin-left:' . $logo_left_margin . 'px }' . "\n";
	
	if ( $logo_bottom_margin )
	$output .= '#logo { margin-bottom:' . $logo_bottom_margin . 'px }' . "\n";
	
	if ( $logo_right_margin )
	$output .= '#logo { margin-right:' . $logo_right_margin . 'px }' . "\n";
	
	if ( $logo_uppercase == '1' )
	$output .= '#logo {text-transform: uppercase }' . "\n";
	
	if ( $google_font_logo )
	$output .= '#logo {font-family:' . $google_font_logo . '}' . "\n";
	
	if ( $logo_font_size )
	$output .= '#logo {font-size:' . $logo_font_size . 'px }' . "\n";
	
	if ( $logo_font_weight )
	$output .= '#logo {font-weight:' . $logo_font_weight . '}' . "\n";

	if ( $text_logo_color )
	$output .= '#logo a {color:' . $text_logo_color . '}' . "\n";
	
	if ( $tagline_font_size )
	$output .= '#logo h5.site-description {font-size:' . $tagline_font_size . 'px }' . "\n";
	
	if ( $tagline_color )
	$output .= '#logo .site-description {color:' . $tagline_color . '}' . "\n";
	
	if ( $tagline_uppercase == '0' )
	$output .= '#logo .site-description {text-transform: none}' . "\n";

	if ( $tagline_uppercase == '1' )
	$output .= '#logo .site-description {text-transform: uppercase}' . "\n";

	/**
	 * Navigation Settings
	 */	
	if ( $menu_top_margin )
	$output .= '#site-navigation #menu-main-navigation {margin-top:'. $menu_top_margin .'px}' . "\n";
	
	if ( $google_font_menu )
	$output .= '#site-navigation ul li a {font-family:' . $google_font_menu . '}' . "\n";
	
	if ( $nav_font_size )
	$output .= '#site-navigation ul li a {font-size:' . $nav_font_size . 'px}' . "\n";
	
	if ( $menu_uppercase == '1' )
	$output .= '#site-navigation ul li a {text-transform: uppercase;}' . "\n";
	
	if ( $nav_font_color )
	$output .= '#site-navigation ul li a {color:' . $nav_font_color . '}' . "\n";
	
	if ( $nav_border_color )
	$output .= '#site-navigation ul li ul.sub-menu ul.sub-menu {border-bottom: 5px solid ' . $nav_border_color . '}' . "\n";
	$output .= '#site-navigation ul li ul.sub-menu {border-bottom: 5px solid ' . $nav_border_color . '}' . "\n";
	
	if ( $nav_bg_color )
	$output .= '#menu-main-navigation {background-color:' . $nav_bg_color . '}' . "\n";
	
	if ( $nav_bg_sub_color )
	$output .= '#site-navigation ul li ul.sub-menu { background:'.$nav_bg_sub_color . '}' . "\n";
	
	if ( $nav_hover_font_color )
	$output .= '#site-navigation ul li a:hover {color:' . $nav_hover_font_color . '}' . "\n";
	
	if ( $nav_bg_hover_color )
	$output .= '#site-navigation ul li a:hover, #site-navigation ul li a:focus, #site-navigation ul li a.active, #site-navigation ul li a.active-parent, #site-navigation ul li.current_page_item a { background:' . $nav_bg_hover_color . '}' . "\n";
	
	if ( $nav_cur_item_color )
	$output .= '#menu-main-navigation .current-menu-item a { color:' . $nav_cur_item_color . '}' . "\n";
	/**
	 * Typography Settings
	 */	
	if ( $google_font_body != 'None' )
	$output .= 'body {font-family:' . $google_font_body . '}' . "\n";
	
	if ( $body_font_size )
	$output .= 'body {font-size:' . $body_font_size . 'px !important}' . "\n";
	
	if ( $body_font_color )
	$output .= 'body {color:' . $body_font_color . '}' . "\n";
	/**
	 * Header Settings
	 */
	if ( $header_bg_color )
	$output .= '#header-holder { background-color: ' . $header_bg_color . '}' . "\n";
	
	if ( $header_opacity )
	$output .= '#header-holder {opacity:'. $header_opacity .'}' . "\n";
	
	if ( $address_color )
	$output .= '#header-top .top-shipping,#header-top p, #header-top a, #header-top i { color:' . $address_color . '}' . "\n";
	
	if ( $top_head_color )
	$output .= '#header-top { background-color: ' . $top_head_color . '}' . "\n";
	/**
	 * Image Slider 
	 */	
	if ( $slider_height )
	$output .= '.da-slider { height:' . $slider_height . 'px;}' . "\n";

	if ( $captions_title_color )
	$output .= '.da-slider .da-slide-wrap h2, .flexslider .post-title h2 { color:' . $captions_title_color . '}' . "\n";
	
	if ( $captions_text_color )
	$output .= '.da-slider .da-slide-wrap p, .flexslider .posts-featured-details-wrapper div p { color: ' . $captions_text_color . '}' . "\n";
	
	if ( $captions_button_color )
	$output .= '.da-slider .da-slide-wrap .da-link, .flexslider .da-link { color: ' . $captions_button_color . '}' . "\n";
	$output .= '.da-slider .da-slide-wrap .da-link, .flexslider .da-link { border-color: ' . $captions_button_color . '}' . "\n";	
	
	if ( $captions_pos_left )
	$output .= '.posts-featured-details-wrapper { left: ' . $captions_pos_left . '%}' . "\n";
	
	if ( $captions_pos_top )
	$output .= '.posts-featured-details-wrapper { top: ' . $captions_pos_top . '%}' . "\n";
	
	if ( $captions_width )
	$output .= '.posts-featured-details-wrapper { width: ' . $captions_width . '%}' . "\n";
	/**
	 * Footer Settings
	 */
	if ( $footer_bg_color )
	$output .= '#footer { background-color:' . $footer_bg_color . '}' . "\n";

	if ( $copyright_bg_color )
	$output .= '#copyright { background-color:' . $copyright_bg_color . '}' . "\n";
	
	if ( $footer_widget_title_color )
	$output .= '.footer-widget-col h4 { color:' . $footer_widget_title_color . '}' . "\n";
	
	if ( $footer_widget_title_border_color )
	$output .= '.footer-widget-col h4 { border-bottom: 4px solid ' . $footer_widget_title_border_color . '}' . "\n";
	
	if ( $footer_widget_text_color )
	$output .= '.footer-widget-col a, .footer-widget-col { color:' . $footer_widget_text_color . '}' . "\n";

	if ( $footer_widget_text_border_color )
	$output .= '.footer-widget-col ul li { border-bottom: 1px solid ' . $footer_widget_text_border_color . '}' . "\n";
	
	if ( $footer_social_color )
	$output .= '#social-bar-footer ul li a i { color:' . $footer_social_color . '}' . "\n";
	/**
	 * Blog Settings 
	 */
	if ($blog_posts_home_color)
	$output .= '.home-blog {background: none repeat scroll 0 0 ' . $blog_posts_home_color . '}' . "\n";
	
	if ($blog_meta_color)
	$output .= '.from-blog .post-info span a, .from-blog .post-info span {color:' . $blog_meta_color . ';}' . "\n";

	if ($blog_post_color)
	$output .= '.from-blog h3 {color:' . $blog_post_color . ';}' . "\n";
	
	if ($blog_title_color)
	$output .= '.from-blog h2 {color:' . $blog_title_color . ';}' . "\n";
	
	if ($blog_bg_color)
	$output .= '.from-blog {background: none repeat scroll 0 0 ' . $blog_bg_color . ';}' . "\n";
	
	if ($blog_posts_top_color)
	$output .= '.blog-top-image {background: none repeat scroll 0 0 ' . $blog_posts_top_color . ';}' . "\n";
	
	if ($blog_posts_top_font_color)
	$output .= '.blog-top-image h1.section-title, .blog-top-image h1.section-title-right {color:' . $blog_posts_top_font_color . ';}' . "\n";
	/**
	* Get Started Section
	*/

	if ($getst_button_color)
	$output .= '.get-strated-button { background-color: ' . $getst_button_color . '}' . "\n";
	
	if ($getst_header_color)
	$output .= '#get-started h2 { color: ' . $getst_header_color . '}' . "\n";
	
	if ($getst_text_color)
	$output .= '.get-strated-left span { color: ' . $getst_text_color . '}' . "\n";
	
	if ($getst_bg_color)
	$output .= '#get-started { background: none repeat scroll 0 0 ' . $getst_bg_color . '}' . "\n";
	/**
	* Features Section
	*/
	if ( $features_bg_color )
	$output .= '#features { background-color:' . $features_bg_color . ';}' . "\n";
	
	if ( $features_text_color )
	$output .= 'h4.sub-title, #features p { color:' . $features_text_color . ';}' . "\n";
	
	if ( $features_title_color )
	$output .= '#features .section-title, #features h3 { color:' . $features_title_color . ';}' . "\n";
	/**
	* About Section
	*/
	if ($about_text_color)
	$output .= '.about p {color:' . $about_text_color . ';}' . "\n";
	
	if ($about_header_color)
	$output .= '.about h2 {color:' . $about_header_color . ';}' . "\n";
	
	if ($about_bg_color)
	$output .= '.about {background: none repeat scroll 0 0 ' . $about_bg_color . ';}' . "\n";
	/**
	* Our Services Section
	*/
	if ( $services_bg_color )
	$output .= '#services { background-color:' . $services_bg_color . ';}' . "\n";
	
	if ( $services_title_color )
	$output .= '#services h2, #services h3 { color:' . $services_title_color . ';}' . "\n";
	
	if ( $services_text_color )
	$output .= '#services p { color:' . $services_text_color . ';}' . "\n";
	/**
	* Call To Action Section
	*/
	if ( $cta_big_color )
	$output .= '.cta h2 { color:' . $cta_big_color . ';}' . "\n";
	
	if ( $cta_sm_color )
	$output .= '.cta h4 { color:' . $cta_sm_color . ';}' . "\n";
	
	if ( $cta_bg_color )
	$output .= '.cta { background-color:' . $cta_bg_color . ';}' . "\n";
	/**
	* Content Boxes Section
	*/
	if ( $cntbx_title_color )
	$output .= '.content-boxes h4 { color:' . $cntbx_title_color . ';}' . "\n";

	if ($cont_text_color)
	$output .= '.content-boxes {color:' . $cont_text_color. '}' . "\n";
	
	if ($cont_bg_color)
	$output .= '.content-boxes {background: none repeat scroll 0 0 ' . $cont_bg_color . '}' . "\n";
	/**
	* Get in Touch Section
	*/
	if ($getin_bg_color)
	$output .= '.get-in-touch { background-color: ' . $getin_bg_color . '}' . "\n";
	
	if ($getin_header_color)
	$output .= '.get-in-touch h2.boxtitle {color:' . $getin_header_color . ';}' . "\n";
	
	if ($getin_text_color)
	$output .= '.get-in-touch h4.sub-title {color:' . $getin_text_color . ';}' . "\n";
	
	if ( $getin_button_color )
	$output .= '.git-link { color: ' . $getin_button_color . '}' . "\n";
	$output .= '.git-link { border-color: ' . $getin_button_color . '}' . "\n";
	/**
	* Social Section
	*/
	if ( $social_color )
	$output .= '.social { background-color: ' . $social_color . '}' . "\n";
			
	// Output styles
	if ( isset( $output ) && $output != '' ) {
		$output = strip_tags( $output );
		$output = "<!--Custom Styling-->\n<style media=\"screen\" type=\"text/css\">\n" . esc_html($output) . "</style>\n";
		echo $output;
	}
}
add_action('wp_head','spt_theme_custom_styling');

/**
 * Sanitization for checkbox input
 *
 * @param $input string (1 or empty) checkbox state
 * @return $output '1' or false
 */
function spt_sanitize_checkbox( $input ) {
	if ( $input ) {
		$output = '1';
	} else {
		$output = false;
	}
	return $output;
}

/**
 * Sanitization for font style
 */
function spt_sanitize_font_style( $value ) {
	$recognized = spt_font_styles();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_font_style', current( $recognized ) );
}

/**
 * Sanitization for opacity value
 */
function spt_sanitize_opacity( $value ) {
	$recognized = spt_opacity();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_opacity', current( $recognized ) );
}

/**
 * Sanitization for layout value
 */
function spt_sanitize_theme_layout( $value ) {
	$recognized = spt_layout();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_layout', current( $recognized ) );
}

/**
 * Sanitization for navigation position
 */
function spt_sanitize_post_nav( $value ) {
	$recognized = spt_post_nav();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_post_nav', current( $recognized ) );
}

/**
 * Sanitization for post info position
 */
function spt_sanitize_post_info( $value ) {
	$recognized = spt_post_info();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_post_info', current( $recognized ) );
}

/**
 * Sanitization for blog content value
 */
function spt_sanitize_blog_content( $value ) {
	$recognized = spt_blog_content();
	if ( array_key_exists( $value, $recognized ) ) {
		return $value;
	}
	return apply_filters( 'spt_blog_content', current( $recognized ) );
}

function spt_sanitize_cat ( $input, $option ) {
	$output = '';
	if ( array_key_exists( $input, $option ) ) {
		$output = $input;
	}
	return $output;
}

/**
 * Sanitization callback function
 */
function spt_sanitize_cb( $input ) {     
	return wp_kses_post( $input );
}

/**
 * Sanitization to validate that the input value is an integer
 */
function spt_sanitize_number( $input ) {
	return absint( $input );
}

/**
 * Sanitization for image position
*/
function spt_sanitize_image_pos( $input ) {
	$valid = array(
       'left' => 'left',
        'right' => 'right',
        'center' => 'center',
	);
	
	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function spt_sanitize_image_repeat( $input ) {
	$valid = array(
		'no-repeat' => 'no-repeat',
		'repeat' => 'repeat',
		'repeat-x' => 'repeat-x',
		'repeat-y' => 'repeat-y',
	);
	
	if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

function spt_sanitize_award( $award ) {
	return $award;
} 

/**
 * Function for options that do not require sanitization.
 */
function spt_no_sanitize( $input ) {
} 

function spt_font_styles() {
	$default = array(
        'Roboto' => 'Roboto',
		'PT Sans' => 'PT Sans',
		'Open Sans'	=> 'Open Sans'
		);
	return apply_filters( 'spt_font_styles', $default );
}

function spt_opacity() {
	$default = array(
		'1' => '1',
		'0.9'	=> '0.9',
		'0.8'	=> '0.8',
		'0.7'	=> '0.7',
		'0.6'	=> '0.6',
		'0.5'	=> '0.5',
		'0.4'	=> '0.4',
		'0.3'	=> '0.3',
		'0.2'	=> '0.2',
		'0.1'	=> '0.1',
		'0'	=> '0',
	);
	return apply_filters( 'spt_opacity', $default );
}

function spt_layout() {
	$default = array(
	'col1' => 'col1', 
	'col2-l' => 'col2-l', 
	'col2-r' =>'col2-r',
	);
	return apply_filters( 'spt_layout', $default );
}

function spt_blog_content() {
	$default = array(
	'excerpt' => 'excerpt', 
	'full' => 'full', 
	);
	return apply_filters( 'spt_blog_content', $default );
}

function spt_post_nav() {
	$default = array(
		'disable' => 'disable',
		'sidebar' => 'sidebar',
		'below' => 'below',
	);
	return apply_filters( 'spt_post_nav', $default );
}

function spt_post_info() {
	$default = array(
		'disable' => 'disable',
		'above' => 'above',
	);
	return apply_filters( 'spt_post_info', $default );
}

function spt_get_option_defaults() {
	$defaults = array(
		'theme_color' => '#dd6868',
		'breadcrumbs' => '1',
		'animation' => false,
		'responsive_design' => '1',
		'scrollup' => '1',
		'scrollup_color' => '#888888',
		'scrollup_hover_color' => '#3498db',
		'logo_width' => '300',
		'logo_height' => '30',
		'logo_top_margin' => '15',
		'logo_left_margin' => '0',
		'logo_bottom_margin' => '0',
		'logo_right_margin' => '25',
		'logo' => '',
		'logo_alt_text' => 'Logo',
		'logo_uppercase' => '1',
		'google_font_logo' => 'Open Sans',
		'logo_font_size' => '24',
		'logo_font_weight' => '700',
		'text_logo_color' => '#dd6868',
		'enable_logo_tagline' => false,
		'tagline_font_size' => '16',
		'tagline_color' => '#ffffff',
		'tagline_uppercase' => '1',
		'menu_sticky' => '1',
		'menu_top_margin' => '0',
		'google_font_menu' => 'Open Sans',
		'nav_font_size' => '13',
		'menu_uppercase' => '1',
		'nav_font_color' => '#ffffff',
		'nav_border_color' => '#dd6868',
		'nav_bg_color' => '#323b44',
		'nav_bg_sub_color' => '#323b44',
		'nav_hover_font_color' => '#dd6868',
		'nav_bg_hover_color' => '#323b44',
		'nav_cur_item_color' => '#dd6868',
		'google_font_body' => 'Open Sans',
		'body_font_size' => '15',
		'body_font_color' => '#777777',
		'header_bg_color' => '#323b44',
		'header_opacity' => '1',
		'header_top_enable' => '1',
		'header_shipping' => '',
		'header_award' => '',
		'header_gametraka_enable' => '1',
		'address_color' => '#cccccc',
		'top_head_color' => '#262c33',
		'image_slider_on' => '1',
		'getstarted_section_on' => '1',
		'features_section_on' => '1',
		'about_section_on' => '1',
		'services_section_on' => false,
		'cta_section_on' => false,
		'content_boxes_section_on' => false,
		'getin_home_on' => false,
		'blog_section_on' => '1',
		'latest_posts_on' => '1',
		'social_section_on' => '1',
		'slider_height' => '500',
		'image_slider_cat' => '',
		'slideshow_speed' => '5000',
		'animation_speed' => '800',
		'slider_num' => '3',
		'captions_on' => false,
		'captions_pos_left' => '18',
		'captions_pos_top' => '10',
		'captions_width' => '58',
		'captions_title_color' => '#111111',
		'captions_text_color' => '#111111',
		'captions_button_color' => '#111111',
		'captions_button' => '1',
		'caption_button_text' => 'Read More',
		'footer_bg_color' => '#323b44',
		'copyright_bg_color' => '#262c33',
		'footer_widget_title_color' => '#ffffff',
		'footer_widget_title_border_color' => '#444444',
		'footer_widget_text_color' => '#ffffff',
		'footer_widget_text_border_color' => '#444444',
		'footer_social_color' => '#ffffff',
		'footer_widgets' => '1',
		'footer_copyright_text' => 'Copyright '.date('Y').' '.get_bloginfo('site_title'),
		'layout_settings' => 'col2-l',
		'blog_posts_home_color' => '#ffffff',
		'blog_posts_home_image' => '',
		'blog_posts_top_color' => '#eeeeee',
		'blog_posts_top_font_color' => '#111111',
		'blog_posts_top_image' => '',
		'blog_content' => 'excerpt',
		'blog_excerpt' => '50',
		'simple_paginaton' => false,
		'post_navigation' => 'sidebar',
		'post_info' => 'above',
		'featured_img_post' => '1',
		'getst_bg_color' => '#323b44',
		'getst_header_color' => '#ffffff',
		'getst_section_header' => 'Awesome Design & Clean Coding',
		'getst_text_color' => '#ffffff',
		'getst_section_text' => 'Are you ready?',
		'getst_button_text' => 'Get Started',
		'getst_button_color' => '#dd6868',
		'getst_button_url' => '',
		'features_bg_color' => '#ffffff',
		'features_bg_image' => '',
		'features_title_color' => '#111111',
		'features_text_color' => '#111111',
		'features_section_title' => 'Clean Design & Great Functionality',
		'features_section_desc' => 'Lorem ipsum dolor sit amet pellentesque',
		'feature_one' => 'Responsive Design',
		'feature_one_desc' => 'Lorem ipsum dolor sit',
		'feature_one_icon' => 'fa-tablet',
		'feature_one_image' => '',
		'feature_one_url' => '',
		'feature_two' => 'Unlimited Colors',
		'feature_two_desc' => 'Lorem ipsum dolor sit',
		'feature_two_icon' => 'fa-tint',
		'feature_two_image' => '',
		'feature_two_url' => '',
		'feature_three' => 'Clean Code',
		'feature_three_desc' => 'Lorem ipsum dolor sit',
		'feature_three_icon' => 'fa-html5',
		'feature_three_image' => '',
		'feature_three_url' => '',
		'feature_four' => 'eCommerce Ready',
		'feature_four_desc' => 'Lorem ipsum dolor sit',
		'feature_four_icon' => 'fa-shopping-cart',
		'feature_four_image' => '',
		'feature_four_url' => '',
		'about_bg_color' => '#eeeeee',
		'about_bg_image' => '',
		'about_header_color' => '#111111',
		'about_section_header' => 'About Us',
		'about_text_color' => '#111111',
		'about_section_text' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
		'services_bg_color' => '#ffffff',
		'services_bg_image' => '',
		'services_title_color' => '#111111',
		'services_text_color' => '#111111',
		'services_section_title' => 'Our Services',
		'services_section_desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut ipsum mauris. Fusce condimentum mollis eros vitae facilisis. Praesent gravida dignissim felis, id sagittis mauris rutrum non. Nullam pretium id sem ut hendrerit.',
		'service_one' => 'Analytics',
		'service_one_icon' => 'fa-flash',
		'service_one_url' => '',
		'service_two' => 'Graphic Design',
		'service_two_icon' => 'fa-bullseye',
		'service_two_url' => '',
		'service_three' => 'Photography',
		'service_three_icon' => 'fa-camera',
		'service_three_url' => '',
		'service_four' => 'Social',
		'service_four_icon' => 'fa-twitter',
		'service_four_url' => '',
		'service_five' => 'SEO',
		'service_five_icon' => 'fa-globe',
		'service_five_url' => '',
		'service_six' => 'Web Design',
		'service_six_icon' => 'fa-desktop',
		'service_six_url' => '',
		'cta_bg_color' => '#eeeeee',
		'cta_bg_image' => '',
		'cta_section_sm_header' => 'Why work with us',
		'cta_sm_color' => '#111111',
		'cta_section_big_header' => 'Creative People That Make Awesome Things',
		'cta_big_color' => '#111111',
		'cta_button_text' => 'Get in touch',
		'cta_button_url' => '',
		'cont_bg_color' => '#ffffff',
		'cntbx_bg_image' => '',
		'cntbx_title_color' => '#111111',
		'cont_text_color' => '#111111',
		'first_column_header' => 'Responsive Design',
		'first_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'first_column_image' => 'fa-tablet',
		'first_column_url' => '',
		'second_column_header' => 'High Quality',
		'second_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'second_column_image' => 'fa-umbrella',
		'second_column_url' => '',
		'third_column_header' => 'Tons of Features',
		'third_column_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
		'third_column_image' => 'fa-cog',
		'third_column_url' => '',
		'getin_bg_color' => '#eeeeee',
		'getin_bg_image' => '',
		'getin_header_color' => '#111111',
		'getin_section_header' => 'Get In Touch with Us',
		'getin_text_color' => '#111111',
		'getin_section_text' => 'If you have any questions, do not hesitate to contact us',
		'getin_button_text' => 'Contact us now',
		'getin_button_color' => '#111111',
		'getin_button_url' => '',
		'blog_bg_color' => '#ffffff',
		'blog_bg_image' => '',
		'blog_cat' => '',
		'num_posts' => '3',
		'blog_section_title' => 'Latest News',
		'blog_title_color' => '#111111',
		'blog_post_color' => '#111111',
		'blog_meta_color' => '#111111',
		'facebook_link' => '#',
		'twitter_link' => '#',
		'google_link' => '#',
		'linkedin_link' => '#',
		'instagram_link' => '#',
		'youtube_link' => '#',
		'social_color' => '#eeeeee',
		'social_bg_image' => '',
	);
	return apply_filters( 'spt_get_option_defaults', $defaults );
}

function spt_get_options() {
    // Options API
    return wp_parse_args( 
        get_option( 'spt_theme_options', array() ), 
        spt_get_option_defaults() 
    );
}
