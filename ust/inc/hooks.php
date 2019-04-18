<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}

/**
 * Filters and Actions
 */

if ( ! function_exists( '_action_fw_theme_setup' ) ) :
	/**
	 * Theme setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 * @internal
	 */
	function _action_fw_theme_setup() {
		// Make Theme available for translation.
		load_theme_textdomain( 'ust', get_template_directory() . '/languages' );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support('automatic-feed-links');

		// title tag
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails, and declare two sizes.
		add_theme_support( 'post-thumbnails', array( 'post', 'fw-portfolio', 'fw-event', 'product' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'audio',
			'quote',
			'link',
			'gallery',
		) );

		// Add favicon
		add_theme_support('favicon');

		// Theme support woocommerce plugin
		//add_theme_support( 'woocommerce' );
	}
endif;
add_action( 'after_setup_theme', '_action_fw_theme_setup' );


if ( ! function_exists( '_action_fw_theme_widgets_init' ) ) :
	/**
	 * Register widget areas
	 * @internal
	 */
	function _action_fw_theme_widgets_init() {
		$beforeWidget = '<aside id="%1$s" class="widget %2$s">';
		$afterWidget  = '</aside>';
		$beforeTitle  = '<h2 class="widget-title"><span>';
		$afterTitle   = '</span></h2>';
		register_sidebar( array(
			'name'          => __( 'General Widget', 'ust' ),
			'id'            => 'sidebar-1',
			'description'   => '',
			'before_widget' => $beforeWidget,
			'after_widget'  => $afterWidget,
			'before_title'  => $beforeTitle,
			'after_title'   => $afterTitle,
		) );
		register_sidebar( array(
			'name'          => __( 'Footer Widget', 'ust' ),
			'id'            => 'footer-1',
			'before_widget' => $beforeWidget,
			'after_widget'  => $afterWidget,
			'before_title'  => $beforeTitle,
			'after_title'   => $afterTitle,
			'description'   => ''
		) );
	}
endif;
add_action( 'widgets_init', '_action_fw_theme_widgets_init' );


if ( ! function_exists( '_filter_fw_theme_active_slider' ) ) :
	/**
	 * Filter for disable framework sliders
	 *
	 * @param array $sliders
	 */
	function _filter_fw_theme_active_slider( $sliders ) {
		$sliders = array_diff( $sliders, array( 'bx-slider', 'nivo-slider', 'owl-carousel' ) );

		return $sliders;
	}

	add_filter( 'fw_ext_slider_activated', '_filter_fw_theme_active_slider' );
endif;


if ( ! function_exists( '_action_fw_theme_print_styling' ) ) :
	/**
	 * print theme general styling
	 */
	function _action_fw_theme_print_styling() {
		if( defined( 'ust' ) ){
			$styling = '<style type="text/css">';
			$general_styling = fw_get_db_settings_option('general_styling');

			if( isset($general_styling['theme_color']) && !empty($general_styling['theme_color']) ){
				$theme_color = $general_styling['theme_color'];
				$styling .= 'a,
h1 a,
{color: '.$theme_color.';}'."\n";

				// border color
				$styling .= '.fly-btn-1.fly-btn-color-1
{border-color:'.$theme_color.';}'."\n";

				// background-color
				$styling .= '.fly-btn-1:hover.fly-btn-color-1
{background-color:'.$theme_color.';}'."\n";
			}

			// font 1
			global $google_fonts_list;
			$google_fonts_list = array();
			$google_fonts = fw_get_google_fonts();
			if( isset($google_fonts[ $general_styling['font_1']['family'] ]) ){
				$google_fonts_list[ $general_styling['font_1']['family'] ] = $google_fonts[ $general_styling['font_1']['family'] ];
			}
			$font_style_1  = ( strpos( $general_styling['font_1']['style'], 'italic' ) ) ? 'italic' : 'normal';
			$font_weight_1 = intval( $general_styling['font_1']['style'] );
			if($font_weight_1 != 0) $font_weight_1 = 'font-weight: '.$font_weight_1;
			else $font_weight_1 = '';
			$styling .= 'body
{font-family: '.$general_styling['font_1']['family'].'; font-style: '.$font_style_1.'; '.$font_weight_1.'}'."\n";

			// font 2
			if( isset($google_fonts[ $general_styling['font_2']['family'] ]) ){
				$google_fonts_list[ $general_styling['font_2']['family'] ] = $google_fonts[ $general_styling['font_2']['family'] ];
			}
			$font_style_2  = ( strpos( $general_styling['font_2']['style'], 'italic' ) ) ? 'italic' : 'normal';
			$font_weight_2 = intval( $general_styling['font_2']['style'] );
			if($font_weight_2 != 0) $font_weight_2 = 'font-weight: '.$font_weight_2;
			else $font_weight_2 = '';
			$styling .= 'h1
{font-family: '.$general_styling['font_2']['family'].'; font-style: '.$font_style_2.'; '.$font_weight_2.'}'."\n";

			// custom CSS
			if( !empty($general_styling['quick_css']) ){
				$styling .= $general_styling['quick_css'];
			}

			$styling .= '</style>';

			if( $styling != '<style type="text/css"></style>') {
				echo $styling;
			}
		}
	}
endif;
add_action( 'wp_head', '_action_fw_theme_print_styling' );


if (!function_exists('_action_fw_theme_print_google_fonts_link')) :
	function _action_fw_theme_print_google_fonts_link() {
		/**
		 * Print google fonts link
		 */
		global $google_fonts_list;
		if( !empty($google_fonts_list) ){
			$html = "<link href='http://fonts.googleapis.com/css?family=";

			foreach ( $google_fonts_list as $font => $styles ) {
				$html .= str_replace( ' ', '+', $font ) . ':' . implode( ',', $styles['variants'] ) . '|';
			}

			$html = substr( $html, 0, - 1 );
			$html .= "' rel='stylesheet' type='text/css'>";

			echo $html;
		}
	}
endif;
add_action('wp_head', '_action_fw_theme_print_google_fonts_link');


