<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}


$admin_url          = admin_url();
$template_directory = get_template_directory_uri();

$options = array(
	'unique_id'           => array(
		'type' => 'unique'
	),
	'slides_interval'     => array(
		'label' => __( 'Slides Interval', 'ust' ),
		'desc'  => __( 'Enter the slides interval in milliseconds', 'ust' ),
		'type'  => 'text',
		'value' => '5000',
	),
	'slider_before_title' => array(
		'label' => __( 'Slider Before Title', 'ust' ),
		'desc'  => __( 'Enter the slider before title text', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
	'slider_title'        => array(
		'label' => __( 'Slider Title', 'ust' ),
		'desc'  => __( 'Enter the slider title text', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
	'slider_image'        => array(
		'label' => __( 'Center Image', 'ust' ),
		'desc'  => __( 'Upload the center image. ! Attention the section with center image appear if you have more than 3 images', 'ust' ),
		'type'  => 'upload',
		'value' => '',
	),
	'slider_button'       => array(
		'label' => __( 'Slider Button', 'ust' ),
		'desc'  => __( 'Enter the slider button text', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
	'slider_link_more'    => array(
		'label' => __( 'Slider Button Link', 'ust' ),
		'desc'  => __( 'Enter the button link', 'ust' ),
		'type'  => 'text',
		'value' => '#',
	),
);