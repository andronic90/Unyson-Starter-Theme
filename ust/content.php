<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */

$permalink      = get_permalink();
$post_options   = fw_theme_listing_post_options( $post->ID );
$image_position = ($post_options['image_position'] != null) ? $post_options['image_position'] : 'post-thumbnail-center';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( "post clearfix $image_position" ); ?>>
	<?php if ( ! empty( $post_options['image'] ) ) : ?>
		<div class="fly-post-image">
			<a class="fly-post-thumbnail" href="<?php echo $permalink; ?>">
				<?php echo $post_options['image']; ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="fly-post-content">
		<header class="entry-header">
			<div class="entry-meta">
				<?php if( $post_options['post_date'] == 'yes') : ?>
					<a class="entry-date" href="<?php echo $permalink; ?>" rel="bookmark">
						<time datetime="<?php fw_theme_get_datetime_attribute(); ?>" class="fly-post-date"><?php echo get_the_date(); ?></time>
					</a>
				<?php endif; ?>
			</div>
			<h2 class="entry-title"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</article>