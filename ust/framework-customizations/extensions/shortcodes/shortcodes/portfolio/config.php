<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

if ( ! fw_ext( 'portfolio' ) ) {
	// if portfolio extensions is disabled return
	return;
}

$cfg = array(
	'page_builder' => array(
		'title'       => __( 'Porfolio', 'ust' ),
		'description' => __( 'Add a Portfolio', 'ust' ),
		'tab'         => __( 'Content Elements', 'ust' ),
		'popup_size'  => 'medium',
	)
);