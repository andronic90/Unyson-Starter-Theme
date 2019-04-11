<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$template_directory = get_template_directory_uri();
$admin_url          = admin_url();
$options            = array(
	'main' => array(
		'title'   => false,
		'type'    => 'box',
		'options' => array(
			'media' => array(
				'title'   => __( 'Media Settings', 'ust' ),
				'type'    => 'tab',
				'options' => array(
					'post_settings' => array(
						'type'          => 'multi',
						'label'         => false,
						'inner-options' => array(
							'header_image'   => array(
								'label' => __( 'Header Image', 'ust' ),
								'desc'  => __( 'Upload header image', 'ust' ),
								'help'  => __( 'You can set a general header image for all your posts and blog categories from the Theme Settings page under the', 'ust' ) . ' <a target="_blank" href="' . $admin_url . 'themes.php?page=fw-settings#fw-options-tab-blog-posts">.' . __( 'Posts tab', 'ust' ) . '</a>',
								'type'  => 'upload',
							),
							'image_position' => array(
								'type'    => 'short-select',
								'value'   => fw_get_db_settings_option( 'posts_settings/image_position', 'yes' ),
								'label'   => __( 'Image Position', 'ust' ),
								'desc'    => __( 'Set the image position', 'ust' ),
								'choices' => array(
									'post-thumbnail-left'   => __( 'Left', 'ust' ),
									'post-thumbnail-center' => __( 'Center', 'ust' ),
									'post-thumbnail-right'  => __( 'Right', 'ust' ),
								)
							),
						)
					)
				),
			),
		),
	),
);