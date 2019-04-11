<?php
get_header();
global $wp_query;
$ext_portfolio_instance = fw()->extensions->get( 'portfolio' );
$ext_portfolio_settings = $ext_portfolio_instance->get_settings();

$taxonomy   = $ext_portfolio_settings['taxonomy_name'];
$term       = get_term_by( 'slug', get_query_var( 'term' ), $taxonomy );
$term_id    = ( ! empty( $term->term_id ) ) ? $term->term_id : 0;
$categories = fw_ext_portfolio_get_listing_categories( $term_id, $taxonomy );

$loop_data = array(
	'settings'        => $ext_portfolio_settings,
	'categories'      => $categories,
	'image_sizes'     => $ext_portfolio_instance->get_image_sizes(),
	'listing_classes' => 'fw-portfolio-item',
);
set_query_var( 'fw_portfolio_loop_data', $loop_data );

$uniqid         = uniqid();
$filter_enabled = fw_get_db_settings_option( 'enable_portfolio_filter', 'yes' );

$colums_number    = 'fw-portfolio-cols-3';
$sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
if ( $sidebar_position == 'left' || $sidebar_position == 'right' ) {
	$colums_number = 'fw-portfolio-cols-2';
}

fw_theme_header_image();
?>
<div class="fly-divider-space space-sm"></div>
<section class="fly-wrap-photo-gallery <?php fw_theme_get_content_class( 'main', $sidebar_position ); ?>">
	<div class="container">
		<div class="row">
			<div class="fly-photo-gallery <?php fw_theme_get_content_class( 'content', $sidebar_position ); ?>">
				<?php fw_theme_portfolio_filter( $filter_enabled, $uniqid ); ?>
				<?php if ( have_posts() ) : ?>
					<div class="fly-photo-list-item">
						<?php while ( have_posts() ) : the_post();
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

			<?php get_sidebar(); ?>
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container -->
</section>
<div class="fly-divider-space space-lg"></div>
<input id="current_portfolio_category" type="hidden" value="<?php echo $term_id; ?>" name="current_category"/>
<?php
//free memory
unset( $ext_portfolio_instance );
unset( $ext_portfolio_settings );
set_query_var( 'fw_portfolio_loop_data', '' );
get_footer();