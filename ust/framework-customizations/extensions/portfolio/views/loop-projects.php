<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}

$loop_data  = get_query_var( 'fw_portfolio_loop_data' );
$permalink  = get_permalink();
$image_size = fw_get_db_post_option( $post->ID, 'image_size', 'mini' );
if ( $image_size == 'medium' ) {
	$image_class = 'photo-width1 photo-height2';
} elseif ( $image_size == 'big' ) {
	$image_class = 'photo-width2';
} else {
	$image_class = 'photo-width1';
}

$original_image    = $image = '';
$thumbnails_params = $loop_data['image_sizes'][ $image_size ];
$thumbnail_id      = get_post_thumbnail_id();
if ( ! empty( $thumbnail_id ) ) {
	$thumbnail       = get_post( $thumbnail_id );
	$image           = fw_resize( $thumbnail->ID, $thumbnails_params['width'], $thumbnails_params['height'], $thumbnails_params['crop'] );
	$thumbnail_title = $thumbnail->post_title;
	$original_image  = wp_get_attachment_image_src( $thumbnail_id, 'full' );
	if ( isset( $original_image[0] ) ) {
		$original_image = $original_image[0];
	}
} else {
	$image           = fw()->extensions->get( 'portfolio' )->locate_URI( '/static/img/no-photo.jpg' );
	$thumbnail_title = $image;
}
?>
<a href="<?php echo $original_image; ?>" data-category="<?php fw_theme_portfolio_post_taxonomies( $post->ID ); ?>" data-rel="prettyPhoto[1]" rel="prettyPhoto[1]" class="photo <?php echo $image_class; ?> active">
	<img src="<?php echo $image; ?>" alt="<?php echo $thumbnail_title; ?>" />
	<div class="fly-photo-list-overlay">
		<div class="fly-itable">
			<div class="fly-icell"><i class="flyicon-expand"></i></div>
		</div>
	</div>
</a>