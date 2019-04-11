<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Include static files: javascript and css
 */

$template_directory = get_template_directory_uri();

wp_enqueue_style(
	'css-theme-admin',
	$template_directory . '/assets/css/theme-admin.css',
	array(),
	'1.0'
);

wp_enqueue_script(
	'js-theme-admin',
	$template_directory . '/assets/js/theme-admin.js',
	array( 'jquery', ),
	'1.0',
	true
);