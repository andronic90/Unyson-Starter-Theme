<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

if ( ! class_exists( 'TGM_Plugin_Activation' ) ) {
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
}

add_action( 'tgmpa_register', 'fw_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function fw_register_required_plugins() {

	$plugins = array(
		array(
			'name'     => 'Unyson',
			'slug'     => 'unyson',
			'required' => true,
		)
	);

	$config = array(
		'domain'       => 'ust',
		'dismissable'  => false,
		'is_automatic' => true
	);
	tgmpa( $plugins, $config );

}