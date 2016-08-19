<?php

return array(
	
	'title' => __(' ', 'twist'),
	'logo' => 'logo-80x80.png',
	'menus' => array(
		array(
			'title' => __('Twist Settings', 'twist'),
			'name' => 'twist_menu',
			'icon' => 'font-awesome:fa-magic',
			'controls' => array(
				
				array(
					'type' => 'section',
					'title' => __('', 'twist'),
					'fields' => array(
				
				array(
					'type' => 'notebox',
					'name' => 'twist_nb_2',
					'label' => __('Don\'t FORGET To give us a Feedback', 'twist'),
					'description' => __('<i>Please take 10 seconds from your time to write us a  <a href="http://codecanyon.net/downloads">review</a></i> ', 'twist'),
					'status' => 'success',
				),
					array(
						'type' => 'select',
						'name' => 'twist_layout',
						'label' => __('Gallery Layout', 'twist'),
						'items' => array(
							array(
								'value' => 'vertical_left',
								'label' => __('Vertical Left', 'twist'),
							),
							array(
								'value' => 'vertical_right',
								'label' => __('Vertical Right', 'twist'),
							),
							array(
								'value' => 'horizontal',
								'label' => __('Horizontal', 'twist'),
							),
						),
						'default' => array(
							'horizontal',
						),
					),		
					array(
						'type' => 'radiobutton',
						'name' => 'twist_lightbox',
						'label' => __('Enable Lightbox for Gallery ', 'twist'),
						'description' => __('<i>Defalut : No</i>', 'twist'),
						
						'items' => array(								
							array(
								'value' => 'true',
								'label' => __('Yes', 'twist'),
							),
							array(
								'value' => 'false',
								'label' => __('No', 'twist'),
							),
						),
						'default' => array(
							'false',
						),
					),		
					
					
					array(
						'type' => 'color',
						'name' => 'twist_nav_cl',
						'label' => __('Navigation Button Background Color', 'twist'),
						'description' => __(' ', 'twist'),
						'default' => '#000000',
						'format' => 'rgba'
					),
					array(
						'type' => 'color',
						'name' => 'twist_nav_ico_cl',
						'label' => __('Navigation Icon Color', 'twist'),
						'description' => __(' ', 'twist'),
						'default' => '#fff',
					),

					array(
						'type' => 'textbox',
						'name' => 'twist_thumbanils',
						'label' => __('Thumbnails To Show', 'twist'),
						'description' => __('', 'twist'),
						'default' => '3',
						'validation' => 'numeric',
						
					),
					array(
						'type' => 'radiobutton',
						'name' => 'twist_autoplay',
						'label' => __('AutoPlay ', 'twist'),
						'description' => __('<i>Defalut : No</i>', 'twist'),
						
						'items' => array(								
							array(
								'value' => 'true',
								'label' => __('Yes', 'twist'),
							),
							array(
								'value' => 'false',
								'label' => __('No', 'twist'),
							),
						),
						'default' => array(
							'false',
						),
					),
					array(
						'type' => 'slider',
						'name' => 'twist_autoplayTimeout',
						'label' => __('Auto Play Timeout', 'twist'),
						'description' => __('<i>1000 = 1 Sec</i>'),
						'default' => '3000',
						'min' => '1000',
						'max' => '10000'
						
					),
					
					 array(
						'type' => 'codeeditor',
						'name' => 'twist_ce_1',
						'label' => __('Custom CSS', 'vp_textdomain'),
						'description' => __('<i>Write your custom css here.</i>', 'vp_textdomain'),
						'theme' => 'dreamweaver',
						'mode' => 'css',
					),
				array(
					'type' => 'notebox',
					'name' => 'twist_nb_1',
					'label' => __('Thank you for Purchasing  Twist', 'twist'),
					'description' => __('<i><a href="http://codecanyon.net/user/niloysarker#contact">Click Here</a> If you need Plugin support</i> ', 'twist'),
					'status' => 'normal ',
				),
						
						
					),
				),
			),
		)

	)
);

/**
 *EOF
 */