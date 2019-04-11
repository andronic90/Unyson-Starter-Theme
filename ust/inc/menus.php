<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Register menus
 */

$menu_locations = array(
	'primary'   => __( 'Top Primary Menu', 'ust' ),
	'secondary' => __( 'Top Secondary Menu', 'ust' ),
);

/**
 * This theme uses wp_nav_menu() in 3 locations.
 */
register_nav_menus( $menu_locations );

global $menus;
$menus = array(
	'primary'   => array(
		'depth'           => 4,
		'container'       => 'nav',
		'container_id'    => 'fly-menu-primary',
		'container_class' => 'fly-site-navigation primary-navigation',
		'menu_class'      => 'fly-nav-menu',
		'theme_location'  => 'primary',
		'fallback_cb'     => 'fw_theme_select_menu_message',
		'link_before'     => '<span>',
		'link_after'      => '</span>'
	),
	'secondary' => array(
		'depth'           => 4,
		'container'       => 'nav',
		'container_id'    => 'fly-menu-secondary',
		'container_class' => 'fly-site-navigation',
		'menu_class'      => 'fly-nav-menu',
		'theme_location'  => 'secondary',
		'fallback_cb'     => 'fw_theme_select_menu_message_secondary',
		'link_before'     => '<span>',
		'link_after'      => '</span>'
	),
);


if ( ! function_exists( 'fw_theme_nav_menu' ) ) :
	/**
	 * Display the nav menu
	 */
	function fw_theme_nav_menu( $menu_type ) {
		global $menus;
		if ( isset( $menus[ $menu_type ] ) ) {
			wp_nav_menu( $menus[ $menu_type ] );
		}
	}
endif;


if ( ! function_exists( 'fw_theme_select_menu_message' ) ) :
	/**
	 * Display the select menu message
	 */
	function fw_theme_select_menu_message() {
		echo '<div class="topmenu"><p class="fw-primary-menu-message">' . __( 'Please go to the', 'ust' ) . ' <a href="' . admin_url( 'nav-menus.php' ) . '" target="_blanck">' . __( 'Menu', 'ust' ) . '</a> ' . __( 'section, create a  menu and then select the newly created menu from the Theme Locations box from the left.', 'ust' ) . '</p></div>';
	}
endif;


if ( ! function_exists( 'fw_theme_select_menu_message_secondary' ) ) :
	/**
	 * Display the select menu message for secondary menu
	 */
	function fw_theme_select_menu_message_secondary() {
		echo '<div class="topmenu"><p class="fw-secondary-menu-message">' . __( 'Please select a Top Secondary Menu from the', 'ust' ) . ' ' . ' <a href="' . admin_url( 'nav-menus.php?action=locations' ) . '" target="_blanck">' . __( 'Menu Locations', 'ust' ) . '</a>' . ' ' . __( 'tab in order to make your header display as intended.', 'ust' ) . '</p></div>';
	}
endif;