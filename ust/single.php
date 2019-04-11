<?php
/**
 * The Template for displaying all single posts
 */

get_header();
$sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
fw_theme_header_image();
?>
<section class="<?php fw_theme_get_content_class( 'main', $sidebar_position ); ?>">
	<div class="fly-divider-space space-sm"></div>
	<div class="container">
		<div class="row">
			<div class="fly-content-area <?php fw_theme_get_content_class( 'content', $sidebar_position ); ?>">
				<div class="fly-col-inner">
					<?php while ( have_posts() ) : the_post();
						get_template_part( 'content', 'single' );
					endwhile; ?>
				</div>
				<!-- Post Details Navigation -->
				<div class="row">
					<div class="blog-post-navigation">
						<?php previous_post_link( '%link', __( 'Previous', 'ust' ) ); ?>
						<?php next_post_link( '%link', __( 'Next', 'ust' ) ); ?>
					</div>
				</div>
				<?php if ( comments_open() ) comments_template(); ?>
			</div><!-- /.content-area -->

			<?php get_sidebar(); ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
	<div class="fly-divider-space space-lg"></div>
</section>
<?php get_footer(); ?>