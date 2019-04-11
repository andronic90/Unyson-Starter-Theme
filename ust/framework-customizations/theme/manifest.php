<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Forbidden' );
}

$manifest = array();

$manifest['id']           = 'ust';
$manifest['requirements'] = array(
	'wordpress'  => array(
		'min_version' => '4.0',
		/*'max_version' => '1000.0.0'*/
	),
	'framework'  => array(
		/*'min_version' => '0.0.0',
        'max_version' => '1000.0.0'*/
	),
	'extensions' => array(
		/*'extension_name' => array(
			'min_version' => '0.0.0',
			'max_version' => '1000.0.0'
		)*/
	)
);

$manifest['supported_extensions'] = array(
	'sidebars'     => array(),
	'portfolio'    => array(),
	'page-builder' => array(),
	'backup'       => array(),
	'seo'          => array(),
	'slider'       => array(),
	/*'analytics'    => array(),
	'events'       => array(),
	'megamenu'     => array(),
	'social'       => array(),
	'feedback'     => array(),
	'breadcrumbs'  => array(),
	'learning'     => array(),*/
);