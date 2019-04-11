<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$shortcodes_extension = fw_ext( 'portfolio' );
$template_directory   = get_template_directory_uri();

wp_enqueue_script(
	'masonry',
	$template_directory . '/js/masonry.pkgd.js',
	array( 'jquery' ),
	fw()->theme->manifest->get_version(),
	true
);