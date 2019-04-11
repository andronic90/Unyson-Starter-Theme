<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Include static files: javascript and css
 */

$template_directory = get_template_directory_uri();
if ( defined( 'ust' ) ) {
	$version = fw()->theme->manifest->get_version();
} else {
	$version = '1.0';
}

// load css files
wp_enqueue_style(
	'frontend',
	$template_directory . '/assets/css/frontend.css',
	array(),
	$version
);

// load js files
if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

wp_enqueue_script(
	'general',
	$template_directory . '/assets/js/frontend.js',
	array( 'jquery' ),
	$version,
	true
);

wp_localize_script( 'frontend', 'USTphpVars', array(
	'ajax_url'           => admin_url( 'admin-ajax.php' ),
	'template_directory' => $template_directory,
) );
