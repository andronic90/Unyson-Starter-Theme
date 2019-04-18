<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$id              = ( isset($atts['link_id']) && !empty($atts['link_id']) ) ? $atts['link_id'] : uniqid( 'section-' );
$bg_color        = $bg_image = $bg_video_data_attr = $extra_classes = $data_height = $overlay_style = '';
$container_class = ( isset( $atts['is_fullwidth'] ) && $atts['is_fullwidth'] ) ? 'fly-container-fluid' : 'fly-container';

if ( isset( $atts['background_options']['background'] ) && $atts['background_options']['background'] == 'default' ) {
	$extra_classes .= ' fly-main-row';
} elseif ( isset( $atts['is_fullwidth'] ) && isset( $atts['auto_generated'] ) && $atts['auto_generated'] == '' ) {
	$extra_classes .= ' fly-main-row-custom';
} else {
	$extra_classes .= ' fly-main-row';
}

if ( isset( $atts['first_in_builder'] ) && $atts['first_in_builder'] ) {
	$extra_classes .= ' fly-main-row-top';
}

if ( isset( $atts['default_spacing'] ) && $atts['default_spacing'] != '' ) {
	$extra_classes .= ' ' . $atts['default_spacing'];
}

if ( $atts['background_options']['background'] == 'image' && ! empty( $atts['background_options']['image']['background_image']['data'] ) ) {
	$bg_image = 'background-image:url(' . $atts['background_options']['image']['background_image']['data']['icon'] . ');';
	$bg_image .= ' background-repeat: ' . $atts['background_options']['image']['repeat'] . ';';
	$bg_image .= ' background-position: ' . $atts['background_options']['image']['bg_position_x'] . ' ' . $atts['background_options']['image']['bg_position_y'] . ';';
	$bg_image .= ' background-size: ' . $atts['background_options']['image']['bg_size'] . ';';

	if ( isset( $atts['background_options']['image']['background_color']['id'] ) && $atts['background_options']['image']['background_color']['id'] == 'fly-custom' && ! empty( $atts['background_options']['image']['background_color']['color'] ) ) {
		$bg_color = 'background-color:' . $atts['background_options']['image']['background_color']['color'] . ';';
	} elseif ( isset( $atts['background_options']['image']['background_color']['id'] ) ) {
		$extra_classes .= ' fw_theme_bg_' . $atts['background_options']['image']['background_color']['id'];
	}
	$extra_classes .= ' fly-section-image';
} elseif ( $atts['background_options']['background'] == 'video' ) {
	if($atts['background_options']['video']['video_type']['selected'] == 'uploaded' ){
		$video_url = $atts['background_options']['video']['video_type']['uploaded']['video']['url'];
	}
	else{
		$video_url = $atts['background_options']['video']['video_type']['youtube']['video'];
	}
	$filetype  = wp_check_filetype( $video_url );
	$filetypes = array( 'mp4' => 'mp4', 'ogv' => 'ogg', 'webm' => 'webm', 'jpg' => 'poster' );
	$filetype  = array_key_exists( (string) $filetype['ext'], $filetypes ) ? $filetypes[ $filetype['ext'] ] : 'video';
	$bg_video_data_attr = 'data-wallpaper-options="' . fw_htmlspecialchars( json_encode( array( 'source' => array( $filetype => $video_url ) ) ) ) . '"';
	$extra_classes .= ' background-video';
} elseif ( $atts['background_options']['background'] == 'default' ) {
	$extra_classes .= ' background-default';
} elseif ( $atts['background_options']['background'] == 'color' ) {
	if ( isset( $atts['background_options']['color']['background_color']['id'] ) && $atts['background_options']['color']['background_color']['id'] == 'fly-custom' ) {
		if ( ! empty( $atts['background_options']['color']['background_color']['color'] ) ) {
			$bg_color = 'background-color:' . $atts['background_options']['color']['background_color']['color'] . ';';
		}
	} elseif ( isset( $atts['background_options']['color']['background_color']['id'] ) ) {
		$extra_classes .= ' fw_theme_bg_' . $atts['background_options']['color']['background_color']['id'];
	}
}

if ( $atts['background_options']['background'] == 'image' || $atts['background_options']['background'] == 'video' ) {
	$type    = $atts['background_options']['background'];
	$overlay = $atts['background_options'][ $type ]['overlay_options']['overlay'];
	if ( $overlay == 'yes' ) {
		$overlay_bg    = $atts['background_options'][ $type ]['overlay_options']['yes']['background']['id'];
		$opacity_param = 'overlay_opacity_' . $atts['background_options']['background'];
		$opacity       = $atts['background_options'][ $type ]['overlay_options']['yes'][ $opacity_param ] / 100;
		if ( $overlay_bg == 'fly-custom' ) {
			$overlay_style = '<div class="fly-main-row-overlay" style="background-color: ' . $atts['background_options'][ $type ]['overlay_options']['yes']['background']['color'] . '; opacity: ' . $opacity . ';"></div>';
		} else {
			$overlay_style = '<div class="fly-main-row-overlay fw_theme_bg_' . $overlay_bg . '" style="opacity: ' . $opacity . ';"></div>';
		}
	}
}

if ( $atts['height'] != 'auto' && $atts['height'] != 'fly-section-height-sm' && $atts['height'] != 'fly-section-height-md' && $atts['height'] != 'fly-section-height-lg' ) {
	$height      = (int) $atts['height'];
	$data_height = 'height: ' . $height . 'px;';
	$extra_classes .= ' fly-section-height-custom';
} else {
	$extra_classes .= ' ' . $atts['height'];
}

if ( $atts['background_options']['background'] == 'image' && isset($atts['background_options']['image']['parallax']) && $atts['background_options']['image']['parallax'] == 'yes' ) :
	$extra_classes .= ' parallax-section';
	?>
<?php endif; ?>
<section id="<?php echo $id; ?>" class="<?php echo esc_attr( $extra_classes ); ?> <?php echo esc_attr( $atts['class'] ); ?>" style="<?php echo $bg_color; ?> <?php echo $bg_image; ?> <?php echo $data_height; ?>" <?php echo $bg_video_data_attr; ?> >
	<?php echo $overlay_style; ?>
	<div class="<?php echo esc_attr( $container_class ); ?>">
		<?php echo do_shortcode( $content ); ?>
	</div>
</section>