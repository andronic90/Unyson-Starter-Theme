<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$options            = array(
	'height' => array(
		'label'   => __( 'Height', 'ust' ),
		'desc'    => __( 'Select the space height in px', 'ust' ),
		'type'    => 'radio-text',
		'choices' => array(
			'space-sm' => __( 'Small', 'ust' ),
			'space-md' => __( 'Medium', 'ust' ),
			'space-lg' => __( 'Large', 'ust' ),
		),
		'value'   => 'space-md',
		'custom'  => 'custom_height',
	),
);