<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

if ( ! is_admin() ) {
	$ext_instance       = fw()->extensions->get( 'portfolio' );
	$settings           = $ext_instance->get_settings();
	$ext_name           = $ext_instance->get_name();
	$ext_version        = $ext_instance->manifest->get_version();
	$template_directory = get_template_directory_uri();

	/*if ( is_tax( $settings['taxonomy_name'] ) || is_post_type_archive( $settings['post_type'] ) ) {
		wp_enqueue_script(
			'masonry',
			$template_directory . '/js/masonry.pkgd.js',
			array( 'jquery' ),
			$ext_version,
			true
		);
	}*/
}