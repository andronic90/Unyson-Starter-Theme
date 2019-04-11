<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
?>
<?php get_header(); ?>
<?php $sidebar_position = function_exists( 'fw_ext_sidebars_get_current_position' ) ? fw_ext_sidebars_get_current_position() : 'right'; ?>
<div class="fly-no-header-image"></div>
<section class="fly-default-page fly-404-page fly-main-row <?php fw_theme_get_content_class( 'main', $sidebar_position ); ?>">
	<div class="container">
		<div class="row">

			<div class="content-area <?php fw_theme_get_content_class( 'content', $sidebar_position ); ?>">
				<h2 class="entry-title fly-title-404"><?php _e( '404 - Page Not Found', 'ust' ); ?></h2>
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'ust' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</div><!-- /.content-area-->

			<?php get_sidebar(); ?>
		</div><!-- /.row-->
	</div><!-- /.container-->
</section>
<?php get_footer(); ?>