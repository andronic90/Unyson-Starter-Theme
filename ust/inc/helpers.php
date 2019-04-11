<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct access forbidden.' );
}
/**
 * Helper functions and classes with static methods for usage in theme
 */


if ( ! defined( 'ust' ) ) {
	if ( ! function_exists( 'fw_render_view' ) ) :
		function fw_render_view( $file_path, $view_variables = array(), $return = true ) {
			extract( $view_variables, EXTR_REFS );

			unset( $view_variables );

			if ( $return ) {
				ob_start();

				require $file_path;

				return ob_get_clean();
			} else {
				require $file_path;
			}
		}
	endif;
}


if ( ! function_exists( 'fw_theme_get_posts' ) ):
	/**
	 *  Generate array with: recent/popular/commented posts
	 *
	 * @param string $sort Sort type (recent/popular/most commented)
	 * @param integer $items Number of items to be extracted
	 * @param boolean $image_post Extract or no post image
	 * @param boolean $return_image_tag Return with tag <img
	 * @param boolean $return_for_fw_image Return for fw_image function
	 * @param integer $image_width Set width of post image
	 * @param integer $image_height Set height of post image
	 * @param string $image_class Set class of post image
	 * @param boolean $date_post Extract or no post date
	 * @param string $date_format Set date format
	 * @param string $post_type Set post type
	 * @param string $category Set category from where posts would be extracted
	 */
	function fw_theme_get_posts( $args = null ) {
		$defaults = array(
			'sort'                => 'recent',
			'items'               => 5,
			'image_post'          => true,
			'return_image_tag'    => true,
			'return_for_fw_image' => false,
			'image_width'         => 54,
			'image_height'        => 54,
			'image_class'         => 'thumbnail',
			'date_post'           => true,
			'date_format'         => 'F jS, Y',
			'date_query'          => array(),
			'post_type'           => 'post',
			'category'            => '',
			'excerpt_length'      => 40
		);

		extract( wp_parse_args( $args, $defaults ) );
		global $post;
		$fw_cat_ID = ( ! empty( $category ) ) ? $category : '';

		if ( $sort == 'recent' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'post_date',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'popular' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'meta_value',
				'meta_key'       => 'fw_post_views',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query
			) );
			$posts = $query->get_posts();
		} elseif ( $sort == 'commented' ) {
			$query = new WP_Query( array(
				'post_type'      => $post_type,
				'orderby'        => 'comment_count',
				'order '         => 'DESC',
				'cat'            => $fw_cat_ID,
				'posts_per_page' => $items,
				'date_query'     => $date_query
			) );
			$posts = $query->get_posts();
		} else {
			return false;
		}

		$fw_post_option = array();
		$count          = 0;
		if ( ! empty( $posts ) ) {
			foreach ( $posts as $post_elm ) {
				setup_postdata( $post_elm );
				$img = '';

				if ( $image_post == true ) {
					$post_thumbnail_id = get_post_thumbnail_id( $post_elm->ID );
					$post_thumbnail    = wp_get_attachment_image_src( $post_thumbnail_id, 'large' );

					if ( ! empty( $post_thumbnail ) ) {
						$image = function_exists( 'fw_resize' ) ? fw_resize( $post_thumbnail[0], $image_width, $image_height, true ) : $post_thumbnail[0];
						if ( $return_for_fw_image ) {
							$img = array(
								'attachment_id' => $post_thumbnail_id,
								'url'           => $post_thumbnail[0],
							);
						} elseif ( $return_image_tag ) {
							$img = '<img src="' . $image . '" class="' . $image_class . '" alt="' . get_the_title( $post_thumbnail_id ) . '" width="' . $image_width . '" height="' . $image_height . '" />';
						}
					}
				}

				if ( ! empty( $img ) ) {
					$fw_post_option[ $count ]['post_img'] = $img;
				} else {
					$fw_post_option[ $count ]['post_img'] = '';
				}

				if ( $date_post ) {
					$time_format                                = apply_filters( '_filter_widget_time_format', $date_format );
					$fw_post_option[ $count ]['post_date_post'] = get_the_time( $time_format, $post_elm->ID );
				} else {
					$fw_post_option[ $count ]['post_date_post'] = '';
				}

				$fw_post_option[ $count ]['post_class']        = ( is_singular() && $post->ID == $post_elm->ID ) ? 'current-menu-item post_' . $sort : 'post_' . $sort;
				$fw_post_option[ $count ]['post_title']        = get_the_title( $post_elm->ID );
				$fw_post_option[ $count ]['post_link']         = get_permalink( $post_elm->ID );
				$fw_post_option[ $count ]['post_author_link']  = get_author_posts_url( get_the_author_meta( 'ID' ) );
				$fw_post_option[ $count ]['post_author_name']  = get_the_author();
				$fw_post_option[ $count ]['post_comment_numb'] = get_comments_number( $post_elm->ID );
				$fw_post_option[ $count ]['post_excerpt']      = ( isset( $post ) ) ? get_the_excerpt() : '';
				$count ++;
			}
			wp_reset_postdata();
		}

		return $fw_post_option;
	}
endif;


if ( ! function_exists( 'fw_theme_pagination' ) ) :
	/**
	 * Display archive/category pagination
	 *
	 * @param object $wp_query
	 */
	function fw_theme_pagination( $wp_query = null ) {
		if ( ! $wp_query ) {
			$wp_query = $GLOBALS['wp_query'];
		}

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'      => $pagenum_link,
			'format'    => $format,
			'total'     => $wp_query->max_num_pages,
			'current'   => $paged,
			'mid_size'  => 1,
			'add_args'  => array_map( 'urlencode', $query_args ),
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		) );

		if ( $links ) : ?>
			<nav class="navigation paging-navigation" role="navigation">
				<div class="pagination loop-pagination">
					<?php
					$next = get_next_posts_link();
					$prev = get_previous_posts_link();
					if ( empty( $prev ) ) {
						echo '<a href="javascript:void(0)" class="prev page-numbers disabled"><i class="fa fa-angle-left"></i></a>';
					}
					echo $links;
					if ( empty( $next ) ) {
						echo '<a href="javascript:void(0)" class="next page-numbers disabled"><i class="fa fa-angle-right"></i></a>';
					}
					?>
				</div>
				<!-- .pagination -->
			</nav><!-- .navigation -->
		<?php endif;
	}
endif;


if ( ! function_exists( 'fw_theme_translate' ) ) :
	/**
	 * Return the content for translations plugins
	 *
	 * @param string $content
	 */
	function fw_theme_translate( $content ) {
		$content = html_entity_decode( $content, ENT_QUOTES, 'UTF-8' );

		if ( function_exists( 'icl_object_id' ) && strpos( $content, 'wpml_translate' ) == true ) {
			$content = do_shortcode( $content );
		} elseif ( function_exists( 'qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
			$content = qtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
		} elseif ( function_exists( 'ppqtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage' ) ) {
			$content = ppqtrans_useCurrentLanguageIfNotFoundUseDefaultLanguage( $content );
		}

		return $content;
	}
endif;


if ( ! function_exists( 'fw_theme_twitter_formating' ) ) :
	/**
	 * Return the text
	 *
	 * @param string $text
	 */
	function fw_theme_twitter_formating( $text, $user ) {
		$pattern = array(
			'/[^(:\/\/)](www\.[^ \n\r]+)/',
			'/(https?:\/\/[^ \n\r]+)/',
			'/@(\w+)/',
			'/^' . $user . ':\s*/i'
		);
		$replace = array(
			'<a href="http://$1" rel="nofollow"  target="_blank">$1</a>',
			'<a href="$1" rel="nofollow" target="_blank">$1</a>',
			'<a href="http://twitter.com/$1" rel="nofollow"  target="_blank">@$1</a>' .
			''
		);

		return preg_replace( $pattern, $replace, $text );
	}
endif;


if ( ! function_exists( 'fw_theme_post_meta' ) ) :
	/**
	 * Display post meta (date, category, author)
	 *
	 * @param string $post_id
	 * @param string $post_type
	 */
	function fw_theme_post_meta( $post_id, $post_type = 'post' ) {
		$permalink              = get_permalink( $post_id );
		$posts_general_settings = defined( 'ust' ) ? fw_get_db_settings_option( 'posts_settings', '' ) : array();
		$post_date              = isset( $posts_general_settings['post_date'] ) ? $posts_general_settings['post_date'] : '';
		$post_author            = isset( $posts_general_settings['post_author'] ) ? $posts_general_settings['post_author'] : '';
		$post_categories        = isset( $posts_general_settings['post_categories'] ) ? $posts_general_settings['post_categories'] : '';
		?>
		<div class="wrap-entry-meta">
			<?php if ( $post_date != 'no' ) : ?>
				<span class="entry-date">
					<a rel="bookmark" href="<?php echo $permalink; ?>">
						<time
							datetime="<?php fw_theme_get_datetime_attribute(); ?>"><?php echo get_the_date(); ?></time>
					</a>
				</span>
			<?php endif; ?>
			<?php if ( $post_author != 'no' ) : ?>
				<?php if ( $post_date != 'no' ) : ?>
					<span class="separator">/</span>
				<?php endif; ?>
				<span class="author"> <?php _e( 'Posted by', 'ust' ); ?> <?php the_author_posts_link(); ?></span>
			<?php endif; ?>
			<?php if ( $post_categories != 'no' && $post_type != 'fw-learning-articles' ) : ?>
				<span
					class="cat-links"> <?php _e( 'Added in', 'ust' ); ?> <?php echo fw_theme_cat_links( $post_type, $post_id ); ?></span>
			<?php endif; ?>
		</div>
	<?php }
endif;


if ( ! function_exists( 'fw_theme_get_content_class' ) ) :
	/**
	 * Get content class when is full width or width sidebar
	 *
	 * @param string $parameter
	 * @param string $sidebar_position
	 */
	function fw_theme_get_content_class( $parameter, $sidebar_position ) {
		$class = '';
		if ( $parameter == 'content' ) {
			if ( $sidebar_position == 'left' || $sidebar_position == 'right' ) {
				$class = 'col-md-8 col-sm-12';
			} else {
				$class = 'col-md-12';
			}
		} elseif ( $parameter == 'main' ) {
			if ( $sidebar_position == 'left' ) {
				$class = 'fly-sidebar-left';
			} elseif ( $sidebar_position == 'right' ) {
				$class = 'fly-sidebar-right';
			}
			else{
				$class = 'fly-sidebar-none';
			}
		}
		echo $class;
	}
endif;


if ( ! function_exists( 'fw_theme_get_datetime_attribute' ) ) :
	/**
	 * Display specific date format for datetime attribute
	 *
	 * @param boolean $return
	 */
	function fw_theme_get_datetime_attribute( $return = false ) {
		$date      = get_the_date( 'Y-m-d---G:i:sP' );
		$date_time = str_replace( '---', 'T', $date );
		if ( $return ) {
			return $date_time;
		} else {
			echo $date_time;
		}
	}
endif;


if ( ! function_exists( 'fw_theme_cat_links' ) ):
	/**
	 * Return list of categories
	 */
	function fw_theme_cat_links( $post_type, $id ) {
		if ( $post_type == 'fw-event' ) {
			return get_the_term_list( $id, 'fw-event-taxonomy-name', '', ' / ' );
		} else {
			return get_the_term_list( $id, 'category', '', ' / ', '' );
		}
	}
endif;


if ( ! function_exists( 'fw_get_category_term_list' ) ) :
	/**
	 * Return array of categories
	 */
	function fw_get_category_term_list() {
		$taxonomy = 'category';
		$args     = array(
			'hide_empty' => true,
		);

		$terms     = get_terms( $taxonomy, $args );
		$result    = array();
		$result[0] = __( 'All Categories', 'ust' );

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		}

		return $result;
	}
endif;


if ( ! function_exists( 'fw_theme_header' ) ) :
	/**
	 * Display theme header
	 */
	function fw_theme_header() {
		$logo_settings['logo']['selected']      = 'text';
		$logo_settings['logo']['text']['title'] = get_bloginfo( 'name' );
		$logo_settings['logo_position'] = 'left';
		if ( defined( 'ust' ) ) {
			$logo_settings = fw_get_db_settings_option( 'logo_settings' );
		}

		if( $logo_settings['logo_position'] == 'left') : ?>
			<header class="fly-header-site fly-header-type-2 fly-sticky-header-on">
				<div class="container">
					<div class="fly-wrap-logo">
						<a class="fly-logo" href="<?php echo esc_url( home_url() ); ?>">
							<?php fw_theme_logo( $logo_settings ); ?>
						</a>
					</div>
					<div class="fly-nav-wrap">
						<div class="fly-nav-wrap">
							<?php fw_theme_nav_menu( 'primary' ); ?>
						</div>
					</div>
				</div>
			</header>
		<?php else : ?>
			<header class="fly-header-site fly-header-type-1 fly-sticky-header-on">
				<div class="fly-nav-wrap fly-nav-left">
					<?php fw_theme_nav_menu( 'primary' ); ?>
				</div>
				<!--Logo-->
				<div class="fly-wrap-logo">
					<a class="fly-logo" href="<?php echo esc_url( home_url() ); ?>">
						<?php fw_theme_logo( $logo_settings ); ?>
					</a>
				</div>
				<div class="fly-nav-wrap fly-nav-right">
					<?php fw_theme_nav_menu( 'secondary' ); ?>
				</div>
			</header>
		<?php endif; ?>

	<?php }
endif;


if ( ! function_exists( 'fw_theme_logo' ) ) :
	/**
	 * Display theme logo
	 */
	function fw_theme_logo( $logo_settings ) {
		if ( $logo_settings['logo']['selected'] == 'image' ) :
			if ( ! empty( $logo_settings['logo']['image']['image_logo'] ) ) {
				$image_logo = $logo_settings['logo']['image']['image_logo']['url'];
			} else {
				$image_logo = get_template_directory_uri() . '/images/logo.png';
			} ?>

			<img src="<?php echo $image_logo; ?>" alt="Logo"/>
		<?php else: ?>
			<div class="logo-text">
				<?php echo $logo_settings['logo']['text']['title']; ?>
			</div>
		<?php endif;
	}
endif;


if ( ! function_exists( 'fw_theme_single_post_options' ) ) :
	/**
	 * return single post options
	 *
	 * @param integer $post_id
	 */
	function fw_theme_single_post_options( $post_id ) {
		$post_love_it = $share_buttons = $post_tags = $post_categories = $image = $post_date = '';

		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail();
		}

		if ( defined( 'ust' ) ) {
			// get general options
			$posts_settings  = fw_get_db_settings_option( 'posts_settings' );
			$post_date       = $posts_settings['post_date'];
			$share_buttons   = $posts_settings['share_buttons'];
			$post_categories = $posts_settings['post_categories'];
			$post_tags       = $posts_settings['post_tags'];
			$post_love_it    = $posts_settings['post_love_it'];
		}

		return array(
			'image'           => $image,
			'post_date'       => $post_date,
			'post_categories' => $post_categories,
			'post_tags'       => $post_tags,
			'share_buttons'   => $share_buttons,
			'post_love_it'    => $post_love_it,
		);
	}
endif;


if ( ! function_exists( 'fw_theme_listing_post_options' ) ) :
	/**
	 * return listing post options
	 *
	 * @param integer $post_id
	 */
	function fw_theme_listing_post_options( $post_id ) {
		$image = $image_position = $post_date = '';

		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail();
		}

		if ( defined( 'ust' ) ) {
			// get post options
			$post_settings  = fw_get_db_post_option( $post_id, 'post_settings' );
			$image_position = $post_settings['image_position'];
			if($image_position == 'post-thumbnail-left' || $image_position == 'post-thumbnail-right'){
				$width  = 360;
				$height = 320;
			}
			else{
				$width  = 740;
				$height = 420;
			}
			$post_thumbnail_id = get_post_thumbnail_id( $post_id );
			$image = '<img src="'.fw_resize($post_thumbnail_id, $width, $height).'" alt="" />';
			// get general options
			$posts_settings = fw_get_db_settings_option( 'posts_settings' );
			$post_date      = $posts_settings['post_date'];
		}

		return array(
			'image'          => $image,
			'image_position' => $image_position,
			'post_date'      => $post_date,
		);
	}
endif;


if ( ! function_exists( 'fw_theme_header_image' ) ) :
	/**
	 * Display header image for taxonomies and posts
	 *
	 * @param integer $term_id
	 */
	function fw_theme_header_image() {
		if ( ! defined( 'ust' ) ) {
			echo '<div class="fly-no-header-image"></div>';
			return;
		}

		global $post;
		$post_type = get_post_type( $post );
		// get general header options
		if ( $post_type == 'page' ) {
			$general_header_options = fw_get_db_settings_option( 'general_page_header', '' );
		} elseif ( $post_type == 'fw-portfolio' ) {
			$general_header_options = fw_get_db_settings_option( 'general_portfolio_header', '' );
		} elseif ( $post_type == 'fly-offer' ) {
			$general_header_options = fw_get_db_settings_option( 'general_offers_header', '' );
		} else {
			$general_header_options = fw_get_db_settings_option( 'general_posts_header', '' );
		}

		$header_height = $description = $title = $taxonomy = $term_id = '';
		if ( is_page() ) {
			// for page (default template)
			$post_id = $post->ID;
			$image   = fw_get_db_post_option( $post_id, 'header_image', '' );
			$title   = get_the_title( $post_id );

			if ( $image == '' ) {
				// if image from post or category is empty - get image from general theme settings
				$image = isset( $general_header_options['posts_header_image'] ) ? $general_header_options['posts_header_image'] : array();
			}
		} elseif ( ! is_single() ) {
			if ( is_category() ) {
				$term = get_category( get_query_var( 'cat' ), false );
			} else {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			}

			if ( is_post_type_archive( 'product' ) ) {
				$title = __( 'Products', 'ust' );
			} elseif ( is_search() ) {
				$title = __( 'Search results', 'ust' );
			} else {
				$title = get_the_archive_title();
			}

			if ( isset( $term->taxonomy ) ) {
				$taxonomy    = $term->taxonomy;
				$term_id     = $term->term_id;
				$title       = $term->name;
				$description = $term->description;
			}

			// category options
			$category_options = fw_get_db_term_option( $term_id, $taxonomy, '', '' );
			if ( isset( $category_options['header_height'] ) ) {
				$header_height = $category_options['header_height'];
			}

			if( isset($category_options['custom_title']) && !empty($category_options['custom_title']) ){
				$title = $category_options['custom_title'];
			}

			// header_image from category
			$image = '';
			if ( isset( $category_options['header_image'] ) && !empty($category_options['header_image']) ) {
				$image = $category_options['header_image'];
			}
		} else {
			// for single post
			$post_id       = $post->ID;
			$image         = fw_get_db_post_option( $post_id, 'post_settings/header_image', '' );
			$taxonomy_list = get_object_taxonomies( $post_type );
			if ( isset( $taxonomy_list['0'] ) ) {
				$taxonomy = $taxonomy_list['0'];
				if ( $taxonomy == 'product_type' ) {
					$taxonomy = 'product_cat';
				}
			}
			$terms = wp_get_post_terms( $post_id, $taxonomy );
			if ( $image == '' ) {
				// if image from post or category is empty - get image from general theme settings
				$image = isset( $general_header_options['posts_header_image'] ) ? $general_header_options['posts_header_image'] : array();
			}

			// category header title (for current post)
			if ( isset( $terms[0]->name ) ) {
				$title       = $terms[0]->name;
				$description = $terms[0]->description;
			}

			if ( $post_type == 'fw-learning-articles' || $post_type == 'fw-learning-quiz' ) {
				// for learning article (don't have category)
				$title = get_the_title( $post_id );
			}
		}

		// general header height
		if( isset($general_header_options['posts_header_height']) && $header_height == '') {
			$header_height = $general_header_options['posts_header_height'];
		}
		else{
			$header_height = 'fly-section-height-md';
		}

		$header_height_style = '';
		if($header_height != 'auto' && $header_height != 'fly-section-height-sm' && $header_height != 'fly-section-height-md' && $header_height != 'fly-section-height-lg'){
			$header_height_style = 'height:'.(int)$header_height.'px;';
			$header_height = '';
		}

		if ( ! empty( $image ) ) { ?>
			<section class="fly-section-image fly-header-image fly-section-overlay <?php echo $header_height; ?> parallax" style="<?php echo $header_height_style; ?> background-image: url('<?php echo $image['url']; ?>');">
				<div class="container">
					<div class="row">
						<?php if ( ! empty( $description ) ) : ?>
							<h3 class="fly-section-image-title-before"><?php echo fw_theme_translate( $description ); ?></h3>
						<?php endif; ?>
						<h2 class="fly-section-image-title-after"><?php echo fw_theme_translate( $title ); ?></h2>
					</div>
				</div>
			</section>
		<?php
		} else { ?>
			<div class="fly-no-header-image"></div>
		<?php }
	}
endif;


if ( ! function_exists( 'fw_get_all_potfolio_taxonomy_list' ) ) :
	/**
	 * Get list of portfolio taxonomies
	 *
	 * @param string $param
	 */
	function fw_get_all_potfolio_taxonomy_list( $param = 'All Categories' ) {
		$taxonomy = 'fw-portfolio-category';
		$args     = array(
			'hide_empty' => true,
		);

		$terms     = get_terms( $taxonomy, $args );
		$result    = array();
		$result[0] = $param;

		if ( ! empty( $terms ) ) {
			foreach ( $terms as $term ) {
				$result[ $term->term_id ] = $term->name;
			}
		}

		return $result;
	}
endif;


if ( ! function_exists( 'fw_theme_include_file_from_child' ) ) :
	/**
	 * Include a file first from child if exist else from parent
	 */
	function fw_theme_include_file_from_child( $file ) {
		if ( file_exists( get_stylesheet_directory() . $file ) ) {
			return get_stylesheet_directory_uri() . $file;
		} else {
			return get_template_directory_uri() . $file;
		}
	}
endif;


if ( ! function_exists( 'fw_theme_single_post_title' ) ) :
	/**
	 * Display single post/page title
	 *
	 * @param integer $post_id
	 * @param string $post_type
	 */
	function fw_theme_single_post_title( $post_id, $post_type = 'post' ) {
		if ( ! defined( 'ust' ) ) {
			echo '<h2 class="entry-title">' . get_the_title() . '</h2>';
			return;
		}
		elseif( fw_ext_page_builder_is_builder_post($post_id) && $post_type == 'fw-portfolio' ){
			return;
		}

		$image = fw_get_db_post_option( $post_id, 'header_image', array() );

		// get general header options
		if ( $post_type == 'page' ) {
			$general_header_options = fw_get_db_settings_option( 'general_page_header', '' );
		} elseif ( $post_type == 'fw-portfolio' ) {
			$general_header_options = fw_get_db_settings_option( 'general_portfolio_header', '' );
		} else {
			$general_header_options = fw_get_db_settings_option( 'general_posts_header', '' );
		}

		if ( $image == '' ) {
			// if image from post or category is empty - get image from general theme settings
			$image = isset( $general_header_options['posts_header_image'] ) ? $general_header_options['posts_header_image'] : array();
		}

		if ( empty( $image ) ) { ?>
			<h2 class="entry-title"><?php the_title(); ?></h2>
		<?php }
	}
endif;


