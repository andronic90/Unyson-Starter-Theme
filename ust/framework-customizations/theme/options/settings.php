<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * Framework options
 *
 * @var array $options Fill this array with options to generate framework settings form in backend
 */

$portfolio_tab = array();
if ( fw_ext( 'portfolio' ) ) {
	$portfolio_tab = fw()->theme->get_options( 'portfolio-tab' );
}

$admin_url          = admin_url();
$template_directory = get_template_directory_uri();

$options = array(
	'general'        => array(
		'title'   => __( 'General', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'general-options' => array(
				'title'   => __( 'General', 'ust' ),
				'type'    => 'tab',
				'options' => array(
					'general-box' => array(
						'title'   => __( 'General Settings', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'logo_settings' => array(
								'type'          => 'multi',
								'label'         => false,
								'attr'          => array(
									'class' => 'fw-option-type-multi-show-borders',
								),
								'inner-options' => array(
									'logo' => array(
										'type'         => 'multi-picker',
										'label'        => false,
										'desc'         => false,
										'picker'       => array(
											'selected' => array(
												'label'   => __( 'Logo Type', 'ust' ),
												'desc'    => __( 'Select the logo type', 'ust' ),
												'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
												'value'   => 'text',
												'type'    => 'radio',
												'choices' => array(
													'text'  => __( 'Text', 'ust' ),
													'image' => __( 'Image', 'ust' ),
												),
											)
										),
										'choices'      => array(
											'text'  => array(
												'title' => array(
													'label' => __( 'Text', 'ust' ),
													'desc'  => __( 'Enter logo text', 'ust' ),
													'type'  => 'short-text',
													'value' => get_bloginfo( 'name' )
												),
											),
											'image' => array(
												'image_logo' => array(
													'label' => __( '', 'ust' ),
													'desc'  => __( 'Upload logo image', 'ust' ),
													'type'  => 'upload'
												),
											),
										),
										'show_borders' => false,
									),
									'logo_position' => array(
										'label'   => __( 'Logo Position', 'ust' ),
										'desc'    => __( 'Select the logo position', 'ust' ),
										'help'    => __( 'For center position you must set 2 menu primary and secondary', 'ust' ),
										'value'   => 'center',
										'type'    => 'short-select',
										'choices' => array(
											'left'   => __( 'Left', 'ust' ),
											'center' => __( 'Center', 'ust' ),
										),
									)
								),
							),
							'favicon'       => array(
								'label' => __( 'Favicon', 'ust' ),
								'desc'  => __( 'Upload favicon image', 'ust' ),
								'type'  => 'upload'
							),
						)
					),
				)
			),
			'social-options'  => array(
				'title'   => __( 'Social Profiles', 'ust' ),
				'type'    => 'tab',
				'options' => array(
					'social-box' => array(
						'title'   => __( 'Social', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'socials' => array(
								'type'          => 'addable-popup',
								'label'         => __( 'Social Links', 'ust' ),
								'desc'          => __( 'Add your social profiles', 'ust' ),
								'template'      => '{{=social_name}}',
								'popup-options' => array(
									'social_name' => array(
										'label' => __( 'Name', 'ust' ),
										'desc'  => __( 'Enter a name (it is for internal use and will not appear on the front end)', 'ust' ),
										'type'  => 'text',
									),
									'social_type' => array(
										'type'    => 'multi-picker',
										'label'   => false,
										'desc'    => false,
										'picker'  => array(
											'social-type' => array(
												'label'   => __( 'Icon', 'ust' ),
												'desc'    => __( 'Select social icon type', 'ust' ),
												'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
												'type'    => 'radio',
												'value'   => 'icon-social',
												'choices' => array(
													'icon-social' => __( 'Font Awesome', 'ust' ),
													'upload-icon' => __( 'Custom Upload', 'ust' ),
												),
											),
										),
										'choices' => array(
											'icon-social' => array(
												'icon_class' => array(
													'type'  => 'icon',
													'value' => 'fa fa-adn',
													'label' => '',
												),
											),
											'upload-icon' => array(
												'upload-social-icon' => array(
													'label' => '',
													'type'  => 'upload',
												)
											),
										)
									),
									'social-link' => array(
										'label' => __( 'Link', 'ust' ),
										'desc'  => __( 'Enter your social URL link', 'ust' ),
										'type'  => 'text',
									)
								),
							),
						)
					),
				)
			),
		),
	),
	'posts'          => array(
		'title'   => __( 'Posts', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'blog-posts' => array(
				'title'   => __( 'Blog', 'ust' ),
				'type'    => 'tab',
				'options' => array(
					'posts-box'        => array(
						'title'   => __( 'Posts', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'posts_settings' => array(
								'type'          => 'multi',
								'label'         => false,
								'attr'          => array(
									'class' => 'fw-option-type-multi-show-borders',
								),
								'inner-options' => array(
									'image_position'  => array(
										'type'    => 'short-select',
										'value'   => 'post-thumbnail-center',
										'label'   => __( 'Image Position', 'ust' ),
										'desc'    => __( 'Set the default image position for new posts', 'ust' ),
										'choices' => array(
											'post-thumbnail-left'   => __( 'Left', 'ust' ),
											'post-thumbnail-center' => __( 'Center', 'ust' ),
											'post-thumbnail-right'  => __( 'Right', 'ust' ),
										)
									),
									'post_date'       => array(
										'label'        => __( 'Post Date', 'ust' ),
										'desc'         => __( 'Show post date?', 'ust' ),
										'type'         => 'switch',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' )
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' )
										),
										'value'        => 'yes',
									),
									'share_buttons'   => array(
										'label'        => __( 'Share buttons', 'ust' ),
										'desc'         => __( 'Enable share buttons?', 'ust' ),
										'type'         => 'switch',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' )
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' )
										),
										'value'        => 'yes',
									),
									'post_categories' => array(
										'label'        => __( 'Post Categories', 'ust' ),
										'desc'         => __( 'Show post categories?', 'ust' ),
										'type'         => 'switch',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' )
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' )
										),
										'value'        => 'yes',
									),
									'post_tags'       => array(
										'label'        => __( 'Post Tags', 'ust' ),
										'desc'         => __( 'Show post tags?', 'ust' ),
										'type'         => 'switch',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' )
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' )
										),
										'value'        => 'yes',
									),
									'post_love_it'    => array(
										'label'        => __( 'Post Love It', 'ust' ),
										'desc'         => __( 'Show post love it number?', 'ust' ),
										'type'         => 'switch',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' )
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' )
										),
										'value'        => 'yes',
									),
								)
							),
						)
					),
					'header-posts-box' => array(
						'title'   => __( 'Posts Header', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'general_posts_header' => array(
								'type'          => 'multi',
								'label'         => false,
								'attr'          => array(
									'class' => 'border-bottom-none',
								),
								'inner-options' => array(
									'posts_header_group' => array(
										'type'    => 'group',
										'attr'    => array(
											'class' => 'border-bottom-none',
										),
										'options' => array(
											'posts_header_height' => array(
												'label'   => __( 'Header Height', 'ust' ),
												'desc'    => __( "Select the header height in pixels (Ex: 300)", "ust" ),
												'type'    => 'radio-text',
												'value'   => 'fly-section-height-md',
												'choices' => array(
													'auto'                  => __( 'auto', 'ust' ),
													'fly-section-height-sm' => __( 'small', 'ust' ),
													'fly-section-height-md' => __( 'medium', 'ust' ),
													'fly-section-height-lg' => __( 'large', 'ust' ),
												),
												'custom'  => 'custom_width',
											),
											'posts_header_image'       => array(
												'label' => __( 'Header Image', 'ust' ),
												'desc'  => __( 'Upload a header image', 'ust' ),
												'help'  => __( "This default header image will be used for all your posts and categories if you didn't set one for a specific category or post.", "ust" ),
												'type'  => 'upload'
											),
										)
									)
								)
							)
						)
					),
				)
			),
			$portfolio_tab,
		)
	),
	'pages'          => array(
		'title'   => __( 'Pages', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'header-page-box' => array(
				'title'   => __( 'Pages Header', 'ust' ),
				'type'    => 'box',
				'options' => array(
					'general_page_header' => array(
						'type'          => 'multi',
						'label'         => false,
						'attr'          => array(
							'class' => 'fw-option-type-multi-show-borders',
						),
						'inner-options' => array(
							'posts_header_height'           => array(
								'label'   => __( 'Header Height', 'ust' ),
								'desc'    => __( "Select the header height in pixels (Ex: 300)", "ust" ),
								'type'    => 'radio-text',
								'value'   => 'fly-section-height-md',
								'choices' => array(
									'auto'                 => __( 'auto', 'ust' ),
									'fly-section-height-sm' => __( 'small', 'ust' ),
									'fly-section-height-md' => __( 'medium', 'ust' ),
									'fly-section-height-lg' => __( 'large', 'ust' ),
								),
								'custom'  => 'custom_width',
							),
							'posts_header_image'            => array(
								'label' => __( 'Header Image', 'ust' ),
								'desc'  => __( 'Upload a header image', 'ust' ),
								'help'  => __( "This default header image will be used for all your pages if you didn't set one for a specific page (works only for pages that use Default Template).", "ust" ),
								'type'  => 'upload'
							),
						)
					)
				)
			),
		)
	),
	'footer_tab'     => array(
		'title'   => __( 'Footer', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'footer-box' => array(
				'title'   => __( 'Footer Options', 'ust' ),
				'type'    => 'box',
				'options' => array(
					'footer_options' => array(
						'type'          => 'multi',
						'label'         => false,
						'attr'          => array( 'class' => 'fw-option-type-multi-show-borders', ),
						'inner-options' => array(
							'go_to_top'        => array(
								'type'         => 'switch',
								'label'        => __( 'Go To Top', 'ust' ),
								'desc'         => __( 'Enable go to top section?', 'ust' ),
								'value'        => 'yes',
								'right-choice' => array(
									'value' => 'yes',
									'label' => __( 'Yes', 'ust' ),
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => __( 'No', 'ust' ),
								),
							),
							'footer_logo'      => array(
								'type'    => 'multi-picker',
								'label'   => false,
								'desc'    => false,
								'picker'  => array(
									'selected' => array(
										'type'         => 'switch',
										'label'        => __( 'Footer Logo', 'ust' ),
										'desc'         => __( 'Enable footer logo?', 'ust' ),
										'value'        => 'no',
										'right-choice' => array(
											'value' => 'yes',
											'label' => __( 'Yes', 'ust' ),
										),
										'left-choice'  => array(
											'value' => 'no',
											'label' => __( 'No', 'ust' ),
										),
									),
								),
								'choices' => array(
									'yes' => array(
										'footer_logo_settings' => array(
											'type'          => 'multi',
											'label'         => false,
											'attr'          => array(
												'class' => 'fw-option-type-multi-show-borders',
											),
											'inner-options' => array(
												'logo' => array(
													'type'         => 'multi-picker',
													'label'        => false,
													'desc'         => false,
													'picker'       => array(
														'selected' => array(
															'label'   => __( 'Logo Type', 'ust' ),
															'desc'    => __( 'Select the logo type', 'ust' ),
															'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
															'value'   => 'text',
															'type'    => 'radio',
															'choices' => array(
																'text'  => __( 'Text', 'ust' ),
																'image' => __( 'Image', 'ust' ),
															),
														)
													),
													'choices'      => array(
														'text'  => array(
															'title' => array(
																'label' => __( 'Text', 'ust' ),
																'desc'  => __( 'Enter logo text', 'ust' ),
																'type'  => 'short-text',
																'value' => get_bloginfo( 'name' )
															),
														),
														'image' => array(
															'image_logo' => array(
																'label' => __( '', 'ust' ),
																'desc'  => __( 'Upload logo image', 'ust' ),
																'type'  => 'upload'
															),
														),
													),
													'show_borders' => false,
												),
											),
										),
									),
								),
							),
							'footer_info'      => array(
								'label' => __( 'Footer Info Text', 'ust' ),
								'desc'  => __( 'Enter the footer info text', 'ust' ),
								'type'  => 'textarea',
								'value' => 'bar, bistro & restaurant <br> 41126 Oxford Road - england - phone <a href="callto:44 023 642 124">+44 023 642 124</a>',
							),
							'footer_socials'   => array(
								'type'         => 'switch',
								'label'        => __( 'Footer Socials', 'ust' ),
								'desc'         => __( 'Enable footer socials?', 'ust' ),
								'value'        => 'yes',
								'right-choice' => array(
									'value' => 'yes',
									'label' => __( 'Yes', 'ust' ),
								),
								'left-choice'  => array(
									'value' => 'no',
									'label' => __( 'No', 'ust' ),
								),
							),
							'footer_copyright' => array(
								'label' => __( 'Copyright', 'ust' ),
								'desc'  => __( 'Enter the copyright text', 'ust' ),
								'type'  => 'text',
								'value' => 'Created by FlyTemplates',
							),
						)
					),
				)
			),
		)
	),
	'styling' => array(
		'title'   => __( 'Styling', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'general_styling' => array(
				'type'          => 'multi',
				'label'         => false,
				'attr'          => array(
					'class' => 'fw-option-type-multi-show-borders',
				),
				'inner-options' => array(
					'typography' => array(
						'title'   => __( 'Typography', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'font_1'=> array(
								'label' => __( 'Font 1','ust' ),
								'desc'  => __( 'Choose font 1. This font is used for body and other website elements','ust' ),
								'type'  => 'typography',
								'value' => array(
									'family' => 'Playfair Display',
									'style'  => 'regular',
								),
								'components' => array(
									'size' => false,
									'color' => false
								),
							),
							'font_2'=> array(
								'label' => __( 'Font 2','ust' ),
								'desc'  => __( 'Choose font 2. This font is used for heading, buttons and other website elements','ust' ),
								'type'  => 'typography',
								'value' => array(
									'family' => 'Lato',
									'style'  => 'regular',
								),
								'components' => array(
									'size' => false,
									'color' => false
								),
							),
							'theme_color'=> array(
								'label' => __( 'Theme Color','ust' ),
								'desc'  => __( 'Choose the theme color','ust' ),
								'type'  => 'color-picker',
								'value' => '#e8e6bd'
							),
						)
					),
					'styling' => array(
						'title'   => __( 'CSS', 'ust' ),
						'type'    => 'box',
						'options' => array(
							'quick_css' => array(
								'label' => __( 'Custom CSS', 'ust' ),
								'desc'  => __( 'Enter your custom CSS styles', 'ust' ),
								'type'  => 'textarea',
								'value' => '',
							),
						)
					),
				)
			),
		)
	),
);