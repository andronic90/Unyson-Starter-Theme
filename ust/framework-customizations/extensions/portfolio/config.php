<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$cfg = array();

$cfg['image_sizes'] = array(
	'mini'   => array(
		'width'  => 380,
		'height' => 250,
		'crop'   => true
	),
	'medium' => array(
		'width'  => 380,
		'height' => 500,
		'crop'   => true
	),
	'big'    => array(
		'width'  => 760,
		'height' => 500,
		'crop'   => true
	)
);

$cfg['has-gallery'] = false;