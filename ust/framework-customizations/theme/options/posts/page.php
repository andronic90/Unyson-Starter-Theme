<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$admin_url          = admin_url();
$options            = array(
	'page-side' => array(
		'title'    => __( 'Header Image', 'ust' ),
		'type'     => 'box',
		'context'  => 'side',
		'priority' => 'low',
		'options'  => array(
			'header_image' => array(
				'label' => __( 'Add Image', 'ust' ),
				'desc'  => __( 'Upload header image', 'ust' ),
				'help'  => __( 'You can set a general header image for all your pages from the Theme Settings page under the', 'ust' ) . ' <a target="_blank" href="' . $admin_url . 'themes.php?page=fw-settings#fw-options-tab-pages">' . __( 'Pages tab', 'ust' ) . '</a>',
				'type'  => 'upload',
			),
		),
	),
);