<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$options = array(
	'sidebar'         => array(
		'label'   => __( 'Sidebar', 'ust' ),
		'desc'    => __( '', 'ust' ),
		'type'    => 'select',
		'choices' => FW_Shortcode_Widget_Area::get_sidebars()
	),
	/*'animation_group' => array(
		'type'    => 'multi-picker',
		'label'   => false,
		'desc'    => false,
		'picker'  => array(
			'selected' => array(
				'type'         => 'switch',
				'label'        => __( 'Animation', 'ust' ),
				'help'         => __( 'Enables you to create an animation entrance or exit for this shortcode. Demo previews for the animations can be found <a target="_blank" href="http://daneden.github.io/animate.css/">here</a>.', 'ust' ),
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
				'animation' => array(
					'label' => __( 'Type & Delay', 'ust' ),
					'desc'  => __( 'The type and delay in milliseconds (previews on <a target="_blank" href="http://daneden.github.io/animate.css/">http://daneden.github.io/animate.css/</a>)', 'ust' ),
					'type'  => 'tf-animation',
					'value' => array(
						'animation' => 'fadeInUp',
						'delay'     => '200'
					)
				),
			),
		),
	),*/
	'class'           => array(
		'label' => __( 'Custom Class', 'ust' ),
		'desc'  => __( 'Enter custom CSS class', 'ust' ),
		'type'  => 'text',
		'value' => '',
		'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS in the <strong>custom.less</strong> file. This file is located on your server in the <strong>/child-theme/styles-less/</strong> folder.', 'ust' ),
	),
);