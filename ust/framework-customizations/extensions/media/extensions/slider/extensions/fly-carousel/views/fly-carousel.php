<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

if ( isset( $data['slides'] ) ) :
	$count    = 0;
	$interval = $data['settings']['extra']['slides_interval'];
	$play     = 'true';
	if ( $interval == '0' || $interval == '' ) {
		$play     = 'false';
		$interval = '0';
	}

	$unique_class = '';
	if ( isset( $data['settings']['extra']['unique_id'] ) ){
		$unique_class = 'Fly-Carousel-'.$data['settings']['extra']['unique_id'];
	}
	?>
	<section class="fly-wrap-slider-special-offers">
		<div class="row">
			<div class="fly-slider-special-offers">
				<ul id="<?php echo $unique_class; ?>">
					<?php foreach ( $data['slides'] as $id => $slide ): $count ++; ?>
						<?php if ( $data['settings']['population_method'] == 'posts' || $data['settings']['population_method'] == 'categories' || $data['settings']['population_method'] == 'tags' ) {
							$post_id = $slide['extra']['post_id'];
							$permalink = get_permalink($post_id);
						}
						else{
							$permalink = $slide['extra']['link'];
						}
						?>
						<li data-special-offers-slider="1" style="background-image: url('<?php echo fw_resize($slide['src'], 320, 240, true); ?>')">
							<a href="<?php echo $permalink; ?>" class="fly-wrap-offers">
								<div class="fly-content-offers-slider">
									<div class="fly-itable">
										<div class="fly-icell">
											<h2 class="fly-offers-title"><?php echo $slide['title']; ?></h2>
											<span class="fly-offers-separator"></span>
											<div class="fly-date-offers"><?php echo $slide['desc']; ?></div>
										</div>
									</div>
								</div>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
				<!--Offers Slider Control-->
				<?php if($count >= 4) :
					$slider_image = '';
					if( !empty($data['settings']['extra']['slider_image']) ){
						$slider_image = $data['settings']['extra']['slider_image']['url'];
					} ?>
					<div class="fly-offers-slider-control" style="background-image: url('<?php echo $slider_image; ?>');">
						<div class="fly-itable">
							<div class="fly-icell">
								<div class="fly-slider-control-wrap-title">
									<?php if( !empty($data['settings']['extra']['slider_before_title']) ) : ?>
										<h3 class="fly-slider-control-title-before"><?php echo $data['settings']['extra']['slider_before_title']; ?></h3>
									<?php endif; ?>
									<?php if( !empty($data['settings']['extra']['slider_title']) ) : ?>
										<h2 class="fly-slider-control-title-after"><?php echo $data['settings']['extra']['slider_title']; ?></h2>
									<?php endif; ?>
									<?php if( !empty($data['settings']['extra']['slider_button']) ) : ?>
										<a class="fly-special-offers-btn fly-btn fly-btn-1 fly-btn-md fly-btn-color-3" href="<?php echo $data['settings']['extra']['slider_link_more']; ?>">
											<span><?php echo $data['settings']['extra']['slider_button']; ?></span>
										</a>
									<?php endif; ?>
								</div>
								<div class="fly-wrap-nav-slider">
									<a id="special-offers-slider-prev" class="prev" href="#">
										<i class="fa fa-angle-left"></i>
									</a>
									<a id="special-offers-slider-next" class="next" href="#">
										<i class="fa fa-angle-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div><!--End Offers Slider Control-->
				<?php endif; ?>
			</div>
		</div>
	</section>
	<script>
		// Special Offers Slider
		jQuery('#<?php echo $unique_class; ?>').carouFredSel({
			swipe : {
				onTouch: true
			},
			next : "#special-offers-slider-next",
			prev : "#special-offers-slider-prev",
			auto: {
				play: <?php echo $play; ?>,
				timeoutDuration: <?php echo $interval; ?>
			},
			circular: true,
			infinite: true,
			width: '100%',
			scroll: {
				items : 1,
				easing: "swing"
			}
		});
	</script>
<?php endif; ?>