<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}


if ( ! function_exists( '_fw_ext_portfolio_theme_action_set_posts_per_page' ) ) :
	function _fw_ext_portfolio_theme_action_set_posts_per_page( $query ) {
		/**
		 * Display existing portfolio with specific posts per page (is seted in theme settings)
		 * If your theme displays portfolio posts in a different way, feel free to change or remove this function
		 * @internal
		 *
		 * @param WP_Query $query
		 */
		if ( ! $query->is_main_query() || is_admin() ) {
			return;
		}

		$portfolio             = fw()->extensions->get( 'portfolio' );
		$posts_per_page        = fw_get_db_settings_option( 'portfolio_posts_per_page', get_option( 'posts_per_page' ) );
		$is_portfolio_taxonomy = $query->is_tax( $portfolio->get_taxonomy_name() );
		$is_portfolio_archive  = $query->is_archive()
		                         && isset( $query->query['post_type'] )
		                         && $query->query['post_type'] == $portfolio->get_post_type_name();

		if ( $is_portfolio_taxonomy || $is_portfolio_archive ) {
			$query->set( 'posts_per_page', $posts_per_page );
		}
	}

	add_action( 'pre_get_posts', '_fw_ext_portfolio_theme_action_set_posts_per_page' );
endif;