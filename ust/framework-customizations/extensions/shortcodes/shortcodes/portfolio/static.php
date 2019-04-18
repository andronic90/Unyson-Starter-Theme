<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$shortcodes_extension = fw_ext( 'portfolio' );
$template_directory   = get_template_directory_uri();

wp_enqueue_script(
	'start-portfolio',
	$template_directory . '/assets/js/start-portfolio.js',
	array( 'jquery' ),
	fw()->theme->manifest->get_version(),
	true
);