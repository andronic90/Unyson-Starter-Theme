<?php
/**
 * The Sidebar containing the main widget area
 */

$sidebar_position = null;
if ( function_exists( 'fw_ext_sidebars_get_current_position' ) ) :
	$sidebar_position = fw_ext_sidebars_get_current_position();
	if ( $sidebar_position !== 'full' && $sidebar_position !== null ) : ?>
		<div class="fly-sidebar col-md-4 col-sm-12">
			<div class="fly-col-inner">
				<?php if ( $sidebar_position === 'left' || $sidebar_position === 'right' ) : ?>
					<?php echo fw_ext_sidebars_show( 'blue' ); ?>
				<?php endif; ?>
			</div>
			<!-- /.inner -->
		</div><!-- /.sidebar -->
	<?php endif; ?>
<?php else : ?>
	<div class="fly-sidebar col-md-4 col-sm-12">
		<div class="fly-col-inner">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</div>
		<!-- /.inner -->
	</div><!-- /.sidebar -->
<?php endif; ?>