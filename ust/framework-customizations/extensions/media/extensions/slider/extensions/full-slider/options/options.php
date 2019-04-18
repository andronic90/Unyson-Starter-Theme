<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_url           = admin_url();
$template_directory  = get_template_directory_uri();

$options = array(
	'unique_id'       => array(
		'type' => 'unique'
	),
	'slides_interval' => array(
		'label' => __( 'Slides Interval', 'ust' ),
		'desc'  => __( 'Enter the slides interval in milliseconds', 'ust' ),
		'type'  => 'text',
		'value' => '7500',
	),
);