<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );

	/**
	 * @var array $atts
	 */
}

if ( ! fw_ext( 'portfolio' ) ) {
	// if portfolio extensions is disabled return
	return;
}

$term_id                = $atts['category'];
$uniqid                 = uniqid();
$portfolio_style        = isset ( $atts['portfolio_style']['selected'] ) ? $atts['portfolio_style']['selected'] : 'style1';
$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );

$loop_data = array(
	'settings'         => $ext_portfolio_instance->get_settings(),
	'image_sizes'      => $ext_portfolio_instance->get_image_sizes(),
	'listing_classes'  => '',
	'term_id'          => $term_id,
);

$posts_per_page = (int) $atts['posts_per_page'];
if ( $posts_per_page == 0 ) {
	$posts_per_page = - 1;
}

$tax_query = array();
if ( $term_id != '0' ) {
	$tax_query = array(
		array(
			'taxonomy' => $loop_data['settings']['taxonomy_name'],
			'field'    => 'id',
			'terms'    => $term_id
		)
	);
}
$args  = array(
	'posts_per_page' => $posts_per_page,
	'post_type'      => $loop_data['settings']['post_type'],
	'tax_query'      => $tax_query
);
$query = new WP_Query( $args );

$term = get_term( $term_id, $loop_data['settings']['taxonomy_name'] );
// set special query for loop data
set_query_var( 'fw_portfolio_loop_data', $loop_data );
set_query_var( 'term', @$term->slug );
set_query_var( 'taxonomy', $loop_data['settings']['taxonomy_name'] );

$filter_enabled = fw_get_db_settings_option( 'enable_portfolio_filter', 'yes' );
?>
<section class="fly-wrap-photo-gallery <?php echo $atts['class']; ?>">
	<div class="container">
		<div class="row">
			<div class="fly-photo-gallery">
				<?php fw_theme_portfolio_filter( $filter_enabled, false ); ?>
				<?php if ( $query->have_posts() ) : ?>
					<div class="fly-photo-list-item">
						<?php while ( $query->have_posts() ) : $query->the_post();
							get_template_part( 'framework-customizations/extensions' . $ext_portfolio_instance->get_rel_path() . '/views/loop', 'projects' );
						endwhile; ?>
					</div><!-- /.fly-photo-list-item-->
				<?php else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				endif;
				?>
				<div class="fly-portfolio-navigation">
					<?php fw_theme_pagination(); // for number pagination ?>
				</div>
			</div>
			<!-- /.fly-photo-gallery-->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>