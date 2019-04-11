<?php
get_header();
fw_theme_header_image();
?>
<section class="fly-main-row">
	<div class="container">
		<div class="row">
			<!--Content Area-->
			<div class="col-sm-12">
				<div class="fly-col-inner">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="fly-portfolio-title">
							<?php the_title(); ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div><!-- /content area -->
		</div><!-- /.fly-row -->
	</div><!-- /.fly-container -->
</section>
<?php get_footer(); ?>