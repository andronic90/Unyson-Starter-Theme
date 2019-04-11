<?php
/**
 * The template for displaying Archive pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
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
						<div class="post-list">
							<?php if ( have_posts() ) :
								// Start the Loop.
								while ( have_posts() ) : the_post();
									/*
									* Include the post format-specific template for the content. If you want to
									* use this in a child theme, then include a file called called content-___.php
									* (where ___ is the post format) and that will be used instead.
									*/
									get_template_part( 'content', get_post_format() );
								endwhile;
							else :
								// If no content, include the "No posts found" template.
								get_template_part( 'content', 'none' );
							endif; ?>
						</div><!-- /.postlist-->
						<?php fw_theme_pagination(); // archive pagination ?>
					</div>
				</div><!-- /.content-area-->

				<?php get_sidebar(); ?>
			</div><!-- /.row-->
		</div><!-- /.container-->
	</section>
<?php get_footer(); ?>