<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$admin_url = admin_url();
$options   = array(
	'header_height' => array(
		'label'   => __( 'Header Height', 'ust' ),
		'desc'    => __( "Select the header height in pixels (Ex: 300)", "ust" ),
		'type'    => 'radio-text',
		'value'   => fw_get_db_settings_option('general_posts_header/posts_header_height', 'fly-section-height-md'),
		'choices' => array(
			'auto'                  => __( 'auto', 'ust' ),
			'fly-section-height-sm' => __( 'small', 'ust' ),
			'fly-section-height-md' => __( 'medium', 'ust' ),
			'fly-section-height-lg' => __( 'large', 'ust' ),
		),
		'custom'  => 'custom_width',
	),
	'custom_title'  => array(
		'label' => __( 'Custom Title', 'ust' ),
		'desc'  => __( 'Enter a custom title for display on header image', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
	'header_image'  => array(
		'label' => __( 'Header Image', 'ust' ),
		'desc'  => __( 'Upload the image for header', 'ust' ),
		'help'  => __( 'You can set a default header image for all your blog categories and post from the Theme Settings page under the', 'ust' ) . ' <a target="_blank" href="' . $admin_url . 'themes.php?page=fw-settings#fw-options-tab-posts">' . __( 'Posts tab', 'ust' ) . '</a>',
		'type'  => 'upload',
		'value' => '',
	),
);