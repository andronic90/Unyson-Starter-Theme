<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}


if ( ! function_exists( 'fw_ext_portfolio_get_gallery_images' ) ):
	/**
	 * Get gallery images
	 *
	 * @param integer $post_id
	 */
	function fw_ext_portfolio_get_gallery_images( $post_id = 0 ) {
		if ( 0 === $post_id && null === ( $post_id = get_the_ID() ) ) {
			return array();
		}

		$options = get_post_meta( $post_id, 'fw_options', true );

		return isset( $options['project-gallery'] ) ? $options['project-gallery'] : array();
	}
endif;


if ( ! function_exists( 'fw_theme_portfolio_post_taxonomies' ) ) :
	/**
	 * Return portfolio post taxonomies
	 *
	 * @param integer $post_id
	 * @param boolean $return
	 */
	function fw_theme_portfolio_post_taxonomies( $post_id, $return = false ) {

		$taxonomy = 'fw-portfolio-category';
		$terms    = wp_get_post_terms( $post_id, $taxonomy );
		$list     = '';
		$checked  = false;
		foreach ( $terms as $term ) {
			if ( $term->parent == 0 ) {
				// if is checked parent category
				$list .= $term->slug . ', ';
				$checked = true;
			} else {
				$list .= $term->slug . ', ';
				$parent_id = $term->parent;
			}
		}

		if ( ! $checked ) {
			// if is not checked parent category extract this parent
			if ( isset( $parent_id ) ) {
				$term = get_term_by( 'id', $parent_id, $taxonomy );
				$list .= $term->slug . ', ';
			}
		}

		if ( $return ) {
			return $list;
		} else {
			echo $list;
		}
	}
endif;


if ( ! function_exists( 'fw_theme_portfolio_name_taxonomies' ) ) :
	/**
	 * return portfolio post taxonomies names
	 */
	function fw_theme_portfolio_name_taxonomies( $post_id, $return = false ) {
		$taxonomy  = 'fw-portfolio-category';
		$terms     = wp_get_post_terms( $post_id, $taxonomy );
		$separator = '<span class="portfolio-categories-sep">/</span>';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );
			$array[]   = '<a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
		}
		$list = implode( $separator, $array );

		if ( $return ) {
			return $list;
		} else {
			echo $list;
		}
	}
endif;


if ( ! function_exists( 'fw_split_text_egal_lines' ) ) :
	function fw_split_text_egal_lines( $text = '', $lines = 2 ) {
		$text        = html_entity_decode( $text );
		$text_length = mb_strlen( $text );
		$chrwidth    = round( $text_length / $lines );
		$text        = wordwrap( $text, $chrwidth, "\n" );
		$text        = htmlentities( $text );

		return nl2br( $text );
	}
endif;


if ( ! function_exists( 'fw_theme_portfolio_filter' ) ) :
	function fw_theme_portfolio_filter( $filter_enabled, $_permalink = true ) {
		/**
		 * Display portfolio filter
		 *
		 * @param boolean $filter_enabled
		 */

		if ( $filter_enabled == 'yes' ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			if ( ! $term ) {
				return; // if term is false
			}
			$taxonomy = $term->taxonomy;
			$term_id  = $term->term_id;
			$children = get_term_children( $term_id, $taxonomy );
			if ( empty( $children ) ) {
				return; // if current term hasn't children - don't show filter
			}
			$template_slug   = $term->slug;
			$template_parent = $term->parent;
			$args            = array( 'taxonomy' => $taxonomy );
			$terms           = get_terms( $taxonomy, $args );
			$count           = count( $terms );
			$i               = 0;
			if ( $template_parent == 0 ) {
				$template_parent = $term_id;
			}
			$permalink = '#';

			echo '<ul class="fly-photo-gallery-nav">';
			if ( $count > 0 ) {
				$term_list = $term_view_all = '';
				foreach ( $terms as $term ) {
					$i ++;
					if ( $template_parent != $term->parent ) {
						if ( $term->slug == $template_slug ) {
							if($_permalink) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_view_all .= '<li class="categories-item active" data-category="' . $template_slug . '"><a href="' . $permalink . '">' . __( 'All', 'ust' ) . '</a></li>'."\n";
						} elseif ( $template_parent == $term->term_id ) {
							if($_permalink) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_view_all .= '<li class="categories-item" data-category="' . $term->slug . '"><a href="' . $permalink . '">' . __( 'All', 'ust' ) . '</a></li>'."\n";
						}
					} elseif ( $template_parent == $term->parent ) {
						if ( $term->slug == $template_slug ) {
							if($_permalink) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_list .= '<li class="categories-item active" data-category="' . $template_slug . '"><a href="' . $permalink . '">' . $term->name . '</a></li>'."\n";
						} else {
							if($_permalink) {
								$permalink = get_term_link( $term->slug, $taxonomy );
							}
							$term_list .= '<li class="categories-item" data-category="' . $term->slug . '"><a href="' . $permalink . '">' .$term->name . '</a></li>'."\n";
						}
					}
				}
				echo $term_view_all . $term_list;
			}
			echo '</ul>';
		}
	}
endif;