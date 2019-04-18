<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'is_fullwidth'       => array(
		'label' => __( 'Full Width Content', 'ust' ),
		'type'  => 'switch',
		'desc'  => 'Make the content inside this section full width?',
	),
	'height'             => array(
		'label'   => __( 'Height', 'ust' ),
		'desc'    => __( "Select the section's height in px (Ex: 300)", "ust" ),
		'type'    => 'radio-text',
		'value'   => 'auto',
		'choices' => array(
			'auto'                 => __( 'auto', 'ust' ),
			'fw-section-height-sm' => __( 'small', 'ust' ),
			'fw-section-height-md' => __( 'medium', 'ust' ),
			'fw-section-height-lg' => __( 'large', 'ust' ),
		),
		'custom'  => 'custom_width',
	),
	'background_options' => array(
		'type'         => 'multi-picker',
		'label'        => false,
		'desc'         => false,
		'picker'       => array(
			'background' => array(
				'label'   => __( 'Background', 'ust' ),
				'desc'    => __( 'Select the background for your section', 'ust' ),
				'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
				'type'    => 'radio',
				'choices' => array(
					'none'    => __( 'None', 'ust' ),
					'default' => __( 'Default', 'ust' ),
					'image'   => __( 'Image', 'ust' ),
					'video'   => __( 'Video', 'ust' ),
					'color'   => __( 'Color', 'ust' ),
				),
				'value'   => 'none'
			),
		),
		'choices'      => array(
			'none'  => array(),
			'image' => array(
				'background_image' => array(
					'label'   => __( '', 'ust' ),
					'type'    => 'background-image',
					'choices' => array(//	in future may will set predefined images
					)
				),
				'background_color' => array(
					'label'   => __( '', 'ust' ),
					'desc'    => __( 'Select the background color', 'ust' ),
					'value'   => '',
					'type'    => 'rgba-color-picker'
				),
				'repeat'           => array(
					'label'   => __( '', 'ust' ),
					'desc'    => __( 'Select how will the background repeat', 'ust' ),
					'type'    => 'short-select',
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'value'   => 'no-repeat',
					'choices' => array(
						'no-repeat' => __( 'No-Repeat', 'ust' ),
						'repeat'    => __( 'Repeat', 'ust' ),
						'repeat-x'  => __( 'Repeat-X', 'ust' ),
						'repeat-y'  => __( 'Repeat-Y', 'ust' ),
					)
				),
				'bg_position_x'    => array(
					'label'   => __( 'Position', 'ust' ),
					'desc'    => __( 'Select the horizontal background position', 'ust' ),
					'type'    => 'short-select',
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'value'   => '',
					'choices' => array(
						'left'   => __( 'Left', 'ust' ),
						'center' => __( 'Center', 'ust' ),
						'right'  => __( 'Right', 'ust' ),
					)
				),
				'bg_position_y'    => array(
					'label'   => __( '', 'ust' ),
					'desc'    => __( 'Select the vertical background position', 'ust' ),
					'type'    => 'short-select',
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'value'   => '',
					'choices' => array(
						'top'    => __( 'Top', 'ust' ),
						'center' => __( 'Center', 'ust' ),
						'bottom' => __( 'Bottom', 'ust' ),
					)
				),
				'bg_size'          => array(
					'label'   => __( 'Size', 'ust' ),
					'desc'    => __( 'Select the background size', 'ust' ),
					'help'    => __( '<strong>Auto</strong> - Default value, the background image has the original width and height.<br><br><strong>Cover</strong> - Scale the background image so that the background area is completely covered by the image.<br><br><strong>Contain</strong> - Scale the image to the largest size such that both its width and height can fit inside the content area.', 'ust' ),
					'type'    => 'short-select',
					'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
					'value'   => '',
					'choices' => array(
						'auto'    => __( 'Auto', 'ust' ),
						'cover'   => __( 'Cover', 'ust' ),
						'contain' => __( 'Contain', 'ust' ),
					)
				),
				'parallax'         => array(
					'type'         => 'switch',
					'label'        => __( 'Parallax', 'ust' ),
					'desc'         => __( 'Create a parallax effect on scroll?', 'ust' ),
					'value'        => '',
					'right-choice' => array(
						'value' => 'yes',
						'label' => __( 'Yes', 'ust' ),
					),
					'left-choice'  => array(
						'value' => 'no',
						'label' => __( 'No', 'ust' ),
					),
				),
				'overlay_options'  => array(
					'type'    => 'multi-picker',
					'label'   => false,
					'desc'    => false,
					'picker'  => array(
						'overlay' => array(
							'type'         => 'switch',
							'label'        => __( 'Overlay Color', 'ust' ),
							'desc'         => __( 'Enable image overlay color?', 'ust' ),
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
						'no'  => array(),
						'yes' => array(
							'background'            => array(
								'label'   => __( '', 'ust' ),
								'desc'    => __( 'Select the overlay color', 'ust' ),
								'value'   => '',
								'type'    => 'rgba-color-picker'
							),
							'overlay_opacity_image' => array(
								'type'       => 'slider',
								'value'      => 100,
								'properties' => array(
									'min' => 0,
									'max' => 100,
									'sep' => 1,
								),
								'label'      => __( '', 'ust' ),
								'desc'       => __( 'Select the overlay color opacity in %', 'ust' ),
							)
						),
					),
				),
			),
			'video' => array(
				'video_type'      => array(
					'type'         => 'multi-picker',
					'label'        => false,
					'desc'         => false,
					'picker'       => array(
						'selected' => array(
							'label'   => __( 'Video Type', 'ust' ),
							'desc'    => __( 'Select the video type', 'ust' ),
							'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
							'type'    => 'radio',
							'choices' => array(
								'youtube'  => __( 'Youtube', 'ust' ),
								'uploaded' => __( 'Video', 'ust' ),
							),
							'value'   => 'youtube'
						),
					),
					'choices'      => array(
						'youtube'  => array(
							'video' => array(
								'label' => __( '', 'ust' ),
								'desc'  => __( 'Insert a YouTube video URL', 'ust' ),
								'type'  => 'text',
							),
						),
						'uploaded' => array(
							'video' => array(
								'label'       => __( '', 'ust' ),
								'desc'        => __( 'Upload a video', 'ust' ),
								'images_only' => false,
								'type'        => 'upload',
							),
						),
					),
					'show_borders' => false,
				),
				'overlay_options' => array(
					'type'    => 'multi-picker',
					'label'   => false,
					'desc'    => false,
					'picker'  => array(
						'overlay' => array(
							'type'         => 'switch',
							'label'        => __( 'Overlay Color', 'ust' ),
							'desc'         => __( 'Enable video overlay color?', 'ust' ),
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
						'no'  => array(),
						'yes' => array(
							'background'            => array(
								'label'   => __( '', 'ust' ),
								'desc'    => __( 'Select the overlay color', 'ust' ),
								'value'   => '',
								'type'    => 'rgba-color-picker'
							),
							'overlay_opacity_video' => array(
								'type'       => 'slider',
								'value'      => 100,
								'properties' => array(
									'min' => 0,
									'max' => 100,
									'sep' => 1,
								),
								'label'      => __( '', 'ust' ),
								'desc'       => __( 'Select the overlay color opacity in %', 'ust' ),
							)
						),
					),
				),
			),
			'color' => array(
				'background_color' => array(
					'label'   => __( '', 'ust' ),
					'desc'    => __( 'Select the background color', 'ust' ),
					'value'   => '',
					'type'    => 'rgba-color-picker'
				),
			),
		),
		'show_borders' => false,
	),
	'link_id'            => array(
		'type'  => 'text',
		'label' => __( 'Link ID', 'ust' ),
		'desc'  => __( 'Enter a custom CSS ID for this section (Ex: example-id)', 'ust' ),
		'help'  => sprintf( "%s", __( 'Use this ID in any URL link in the page in order to anchor link to this section: (Ex: http://www.your-domain.com/page-name#example-id)<br> Another way to anchor link to this section is to copy/paste only the ID name in any link field on this page: (Ex: #example-id)', 'ust' ) ),
		'value' => '',
	),
	'class'              => array(
		'label' => __( 'Custom Class', 'ust' ),
		'desc'  => __( 'Enter custom CSS class', 'ust' ),
		'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS in the <strong>custom.less</strong> file. This file is located on your server in the <strong>/child-theme/styles-less/</strong> folder.', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
);