<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$count           = 0;
$pagination      = '';
$slides_interval = $data['settings']['extra']['slides_interval'];
if ( $slides_interval == '' ) {
	$slides_interval = 0;
}

$unique_class = '';
if ( isset( $data['settings']['extra']['unique_id'] ) ){
	$unique_class = 'Carousel-'.$data['settings']['extra']['unique_id'];
}
?>
<?php if ( isset( $data['slides'] ) ) : ?>
	<section class="fly-slider-full">
		<div class="main-carousel default">
			<div id="<?php echo $unique_class; ?>" class="carousel slide">
				<div class="carousel-inner">
				<?php foreach ( $data['slides'] as $id => $slide ) :
					$class = '';
					if ( $count == 0 ) {
						$class = 'active';
					}
					?>
					<!-- Carousel items -->
					<div class="item parallax <?php echo $class; ?>" style="background-image:url(<?php echo $slide['src']; ?>);">
						<div class="container">
							<div class="fly-itable">
								<div class="fly-icell">
									<div class="fly-wrap-text-slider">
										<?php if ( ! empty( $slide['title'] ) ) : ?>
											<h1 class="fly-slider-title-before"><?php echo $slide['title']; ?></h1>
											<div class="fly-slider-divider"></div>
										<?php endif; ?>
										<?php if ( ! empty( $slide['desc'] ) ) : ?>
											<h2 class="fly-slider-title-after"><?php echo $slide['desc']; ?></h2>
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Carousel items -->
					<?php $pagination .= '<li data-target="#' . $unique_class . '" data-slide-to="' . $count . '" class="' . $class . '"></li>' . "\n"; ?>
					<?php $count ++; ?>
					<?php endforeach; ?>
				</div>
				<!--Carousel Indicator-->
				<ol class="carousel-indicators">
					<?php echo $pagination; ?>
				</ol>
			</div>
		</div>
	</section>
<?php endif; ?>