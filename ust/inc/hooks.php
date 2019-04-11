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


if ( ! function_exists( '_action_fw_theme_count_post_visits' ) ) :
	/**
	 * Count post visits
	 */
	function _action_fw_theme_count_post_visits() {
		if ( ! is_single() ) {
			return;
		}
		global $post;
		$views = get_post_meta( $post->ID, 'fw_post_views', true );
		$views = intval( $views );
		update_post_meta( $post->ID, 'fw_post_views', ++ $views );
	}
endif;
add_action( 'wp_head', '_action_fw_theme_count_post_visits' );


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


if (!function_exists('_action_fw_theme_ajax_post_love_it')) :
	function _action_fw_theme_ajax_post_love_it(){
		/**
		 * Set post love it
		 */
		$id = intval($_POST['id']);
		$count = get_post_meta($id, 'fly_theme_love_it', true);
		$count = intval($count);

		$loves = array();
		if ( isset($_COOKIE['fw_theme_loves']) ){
			$loves = explode(";", $_COOKIE['fw_theme_loves']);
			if ( !in_array($id, $loves) ){
				$loves[] = $id;
				$count++;
				$success = update_post_meta($id, 'fly_theme_love_it', $count);
			}
			else{
				$success = 'post-is-loved';
			}
		}
		else{
			$loves[] = $id;
			$count++;
			$success = update_post_meta($id, 'fly_theme_love_it', $count);
		}
		setcookie('fw_theme_loves',implode(";", $loves),time()+3600*24*60,'/');

		$response = array('success' => $success, 'count' => $count);
		echo json_encode( $response );
		die();
	}
	add_action('wp_ajax_fw_ajax_post_love_it','_action_fw_theme_ajax_post_love_it');
	add_action('wp_ajax_nopriv_fw_ajax_post_love_it','_action_fw_theme_ajax_post_love_it');
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
h2 a,
h3 a,
h4 a,
h5 a,
h6 a,
.fly-btn-1.fly-btn-color-1,
.fly-btn-2:hover.fly-btn-color-1,
.fly-wrap-slider-special-offers .fly-slider-special-offers .fly-offers-slider-control .fly-wrap-nav-slider .prev:hover,
.fly-wrap-slider-special-offers .fly-slider-special-offers .fly-offers-slider-control .fly-wrap-nav-slider .next:hover,
.fly-wrap-testimonials-slider .fly-testimonials-slider li .fly-testimonials-slider-author .fly-testimonials-slider-author-name:hover,
.fly-home-gallery .fly-home-gallery-col .fly-home-gallery-block .fly-home-gallery-overlay,
.fly-photo-gallery .fly-photo-list-item .photo .fly-photo-list-overlay,
.fly-home-gallery .fly-home-gallery-col .fly-home-gallery-block-title .fly-home-gallery-before-title,
.fly-home-gallery .fly-home-gallery-col .fly-home-gallery-block-title .fly-home-gallery-title,
.pp_pic_holder.dark_square .pp_nav .currentTextHolder,
.fly-special-offers .fly-offers-list .fly-offer .fly-offers-content .fly-offers-title a:hover,
.fly-other-offers .fly-offers-list .fly-offer .fly-offers-content .fly-offers-title a:hover,
.post .fly-post-content .entry-header .entry-title a:hover,
.post .entry-header .entry-title a:hover,
.fly-post-categories .category:hover,
.fly-post-tag .tagcloud a:hover,
.blog-post-navigation a:hover,
.widget_categories ul li a:hover,
.widget_recent_post ul li a:hover,
.widget_recent_comments ul li a:hover,
.widget_archive ul li a:hover,
.widget_meta ul li a:hover,
.widget_meta ul li a abbr,
.widget_calendar #calendar_wrap #wp-calendar caption,
.widget_calendar #calendar_wrap #wp-calendar tbody td#today a:hover,
.fly-site-footer .fly-footer-content .fly-footer-info a:hover,
.fly-site-footer .fly-footer-content .fly-social .fly-social-link:hover,
.fly-site-footer .fly-footer-copyright .fly-copyright-text a:hover,
.widget_recent_entries li a:hover,
.fly-side-posts-list li a:hover,
.widget_pages ul li a:hover,
.widget_nav_menu ul li a:hover,
.fly-post-categories a:hover,
.fly-post-tag a:hover
{color: '.$theme_color.';}'."\n";

				// border color
				$styling .= '.fly-btn-1.fly-btn-color-1,
.fly-btn-2.fly-btn-color-1,
.fly-btn-2:hover.fly-btn-color-1,
.fly-header-site.sticky-menu,
.fly-wrap-testimonials-slider .fly-testimonials-slider li .fly-testimonials-slider-author .fly-testimonials-slider-author-image,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .fly-btn:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .fly-btn:hover,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .field-submit input[type="submit"]:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .field-submit input[type="submit"]:hover,
.fly-post-details-meta .fly-post-details-back-to-list-btn .fly-btn:hover,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .comment-respond .comment-form p.form-submit input:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .comment-respond .comment-form p.form-submit input:hover,
.widget_tag_cloud .tagcloud a:hover,
.widget_meta ul li a abbr
{border-color:'.$theme_color.';}'."\n";

				// background-color
				$styling .= '.fly-btn-1:hover.fly-btn-color-1,
.field-submit input[type="submit"]:hover.fly-btn-color-1,
.field-submit input[type="submit"]:hover,
.comment-respond .comment-form p.form-submit input:hover.fly-btn-color-1,
.fly-btn-2.fly-btn-color-1,
.fly-wrap-slider-special-offers .fly-slider-special-offers li .fly-wrap-offers .fly-content-offers-slider,
.fly-theme-color-4,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .fly-btn:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .fly-btn:hover,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .field-submit input[type="submit"]:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .field-submit input[type="submit"]:hover,
.fly-post-details-meta .fly-post-details-back-to-list-btn .fly-btn:hover,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .comment-respond .comment-form p.form-submit input:hover,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-back-to-list-btn .comment-respond .comment-form p.form-submit input:hover,
.widget_tag_cloud .tagcloud a:hover,
.fly-go-to-top:hover,
.spinner .line1,
.spinner .line2,
.spinner .line3,
.spinner .line4
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
			$styling .= 'body,
.fly-header-site .fly-site-navigation,
.widget.widget_login .loginform p input,
.fly-slider-full .item .fly-wrap-text-slider .fly-slider-title-after,
.fly-wrap-slider-special-offers .fly-slider-special-offers .fly-offers-slider-control .fly-slider-control-wrap-title .fly-slider-control-title-before,
.fly-info-box .fly-info-box-header .fly-info-box-before-title,
.fly-wrap-testimonials-slider .fly-testimonials-slider .fly-testimonials-slider-before-title,
.fly-story-box .fly-info-box-header .fly-info-box-before-title,
.fly-home-gallery .fly-home-gallery-col .fly-home-gallery-block-title .fly-home-gallery-before-title,
.fly-section-image .fly-section-image-title-before,
.fly-dish-menu .fly-dish-menu-content li .fly-dish-menu-description span,
.fly-wrap-contact-form .fly-contact-form .fly-contact-title,
.fly-wrap-contact-form .fly-reservation-form .fly-contact-title,
.fly-wrap-contact-form .fly-contact-form .fly-reservation-title,
.fly-wrap-contact-form .fly-reservation-form .fly-reservation-title,
.widget_categories ul li a,
.widget_recent_post ul li a,
.widget_tag_cloud .tagcloud a,
.widget_recent_comments ul li a,
.widget_archive ul li a,
.widget_meta ul li a,
.widget_calendar #calendar_wrap #wp-calendar
{font-family: '.$general_styling['font_1']['family'].'; font-style: '.$font_style_1.'; '.$font_weight_1.'}'."\n";

			// font 2
			if( isset($google_fonts[ $general_styling['font_2']['family'] ]) ){
				$google_fonts_list[ $general_styling['font_2']['family'] ] = $google_fonts[ $general_styling['font_2']['family'] ];
			}
			$font_style_2  = ( strpos( $general_styling['font_2']['style'], 'italic' ) ) ? 'italic' : 'normal';
			$font_weight_2 = intval( $general_styling['font_2']['style'] );
			if($font_weight_2 != 0) $font_weight_2 = 'font-weight: '.$font_weight_2;
			else $font_weight_2 = '';
			$styling .= 'h1,
h2,
h3,
h4,
h5,
h6,
a,
.fly-btn,
.field-submit input[type="submit"],
.comment-respond .comment-form p.form-submit input,
input[type="text"],
input[type="password"],
input[type="search"],
input[type="url"],
input[type="email"],
textarea,
.fly-slider-full .item .fly-wrap-text-slider .fly-slider-title-before,
.fly-wrap-slider-special-offers .fly-slider-special-offers li .fly-wrap-offers .fly-content-offers-slider,
.fly-restaurant-menu .fly-menu-category .fly-menu-content,
.fly-info-box .fly-info-box-header .fly-info-box-title,
.fly-wrap-testimonials-slider .fly-testimonials-slider .fly-testimonials-slider-title,
.fly-story-box .fly-info-box-header .fly-info-box-title,
.fly-story-box .fly-story-box-header .fly-story-box-title,
.fly-home-gallery .fly-home-gallery-col .fly-home-gallery-block-title .fly-home-gallery-title,
.fly-section-image .fly-section-image-title-after,
.fly-dish-menu .fly-dish-menu-content li .fly-dish-menu-description h5,
.fly-dish-menu .fly-dish-menu-content li .fly-dish-menu-price,
.fly-wrap-contact-form .fly-contact-form-info-title,
.fly-wrap-contact-form .fly-reservation-form-info-title,
.fly-photo-gallery .fly-photo-gallery-nav li a,
.pp_pic_holder.dark_square .pp_nav,
.fly-special-offers .fly-offers-list .fly-offer .fly-offers-content,
.fly-other-offers .fly-offers-list .fly-offer .fly-offers-content,
.fly-special-offers.fly-special-offers-details .fly-offers-details-header .fly-offers-details-date,
.fly-other-offers.fly-special-offers-details .fly-offers-details-header .fly-offers-details-date,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fw-offers-details-loveit span,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fw-offers-details-loveit span,
.fly-post-details-meta .fw-post-details-loveit span,
.fly-special-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-share-btn .fly-offers-details-share-title,
.fly-other-offers.fly-special-offers-details .fly-offers-details-meta .fly-offers-details-share-btn .fly-offers-details-share-title,
.fly-post-details-meta .fly-post-details-share-btn .fly-offers-details-share-title,
.fly-post-details-meta .fly-post-details-share-btn .fly-post-details-share-title,
.navigation.paging-navigation,
.fly-post-categories .categories-title,
.fly-post-tag .fly-post-tag-title,
.blog-post-navigation a,
.comments-area .title,
.comments-area .comment-list .comment-body .comment-meta .comment-author a,
.comments-area .comment-list .comment-body .comment-meta .comment-date,
.comment-respond .comment-reply-title,
.widget .widget-title,
.widget-newsletter.widget-newsletter-footer .widget-title-before span,
.widget_calendar #calendar_wrap #wp-calendar caption,
.fly-site-footer .fly-footer-content .fly-footer-info,
.fly-site-footer .fly-footer-copyright .fly-copyright-text,
.widget_fw_login input[type="submit"],
.fly-footer-content .widget_mc4wp_widget .widget-title-before span
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


