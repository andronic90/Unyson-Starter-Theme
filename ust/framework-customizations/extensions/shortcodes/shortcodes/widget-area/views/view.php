<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
/**
 * @var array $atts ;
 * @var string $content ;
 * @var string $tag ;
 */

/*----------------Animation option--------------*/
$data_animation = '';
if ( isset( $atts['animation_group'] ) ) {
	// get animation class and delay
	if ( $atts['animation_group']['selected'] == 'yes' ) {
		$atts['class'] .= ' fw-animated-element';
		// get animation
		if ( ! empty( $atts['animation_group']['yes']['animation']['animation'] ) ) {
			$data_animation .= ' data-animation-type="' . $atts['animation_group']['yes']['animation']['animation'] . '"';
		}

		// get delay
		if ( ! empty( $atts['animation_group']['yes']['animation']['delay'] ) ) {
			$data_animation .= ' data-animation-delay="' . (int) esc_attr( $atts['animation_group']['yes']['animation']['delay'] ) . '"';
		}
	}
}
/*----------------End Animation----------------*/
?>
<div class="shortcode-widget-area col-sm-12 fw-sidebar <?php echo esc_attr( $atts['class'] ); ?>" <?php echo $data_animation; ?>>
	<div class="fw-col-inner">
		<?php dynamic_sidebar( $atts['sidebar'] ); ?>
	</div>
</div>