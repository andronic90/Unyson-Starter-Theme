<?php
/**
 * The template for displaying posts in the Audio post format
 */
?>
<?php
$permalink  = get_permalink();
$post_options   = fw_theme_listing_post_options( $post->ID );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( "post clearfix" ); ?>>
	<div class="fly-post-content">
		<header class="entry-header">
			<div class="entry-meta">
				<span class="post-format"><a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'audio' ) ); ?>"><?php echo get_post_format_string( 'audio' ); ?></a></span>
				<?php if( $post_options['post_date'] == 'yes') : ?>
					<a class="entry-date" href="<?php echo $permalink; ?>" rel="bookmark">
						<time datetime="<?php fw_theme_get_datetime_attribute(); ?>" class="fly-post-date"><?php echo get_the_date(); ?></time>
					</a>
				<?php endif; ?>
			</div>
			<h2 class="entry-title"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h2>
		</header>
		<div class="entry-content">
			<?php the_content( '' ); ?>
		</div>
	</div>
</article>