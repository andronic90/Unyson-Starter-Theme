<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 */

get_header();
fw_theme_header_image();
$sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right';
?>
<section class="fly-default-page fly-main-row <?php fw_theme_get_content_class( 'main', $sidebar_position ); ?>">
	<div class="container">
		<div class="row">
			<div class="fly-content-area <?php fw_theme_get_content_class( 'content', $sidebar_position ); ?>">
				<div class="fly-inner">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="page-<?php the_ID(); ?>" class="post post-details">
							<div class="inner">
								<header class="entry-header">
									<?php fw_theme_single_post_title( $post->ID, 'page' ); ?>
								</header>

								<div class="entry-content">
									<?php
									the_content();
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ust' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
									) );
									?>
								</div><!-- /.entry-content -->
							</div><!-- /.inner -->
						</article><!-- /#page-## -->
						<?php if ( comments_open() ) comments_template(); ?>
					<?php endwhile; ?>
				</div><!-- /.inner -->
			</div><!-- /.content-area -->

			<?php get_sidebar(); ?>
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>
<?php get_footer(); ?>