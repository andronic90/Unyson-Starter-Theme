<?php
/**
 * The default template for displaying post details
 */

$permalink      = get_permalink();
$post_options   = fw_theme_single_post_options( $post->ID );
?>
<article class="post post-details clearfix" xmlns="http://www.w3.org/1999/html">
	<header class="entry-header">
		<div class="entry-meta">
			<?php if( $post_options['post_date'] == 'yes') : ?>
				<a class="entry-date" href="<?php echo $permalink; ?>" rel="bookmark">
					<time datetime="<?php fw_theme_get_datetime_attribute(); ?>" class="fly-post-date"><?php echo get_the_date(); ?></time>
				</a>
			<?php endif; ?>
		</div>
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header>
	<?php if ( ! empty( $post_options['image'] ) ) : ?>
		<div class="fly-post-image">
			<?php echo $post_options['image']; ?>
		</div>
	<?php endif; ?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ust' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) ); ?>
	</div>
</article>

<?php if( $post_options['post_categories'] != 'no') : ?>
	<div class="fly-post-categories">
		<h3 class="categories-title"><?php _e('Categories', 'ust'); ?></h3>
		<?php echo fw_theme_cat_links('post', $post->ID); ?>
	</div>
<?php endif; ?>

<?php if( $post_options['post_tags'] != 'no') :
	$tags = get_the_tags();
	if ( ! empty( $tags ) ) : ?>
	<div class="fly-post-tag">
		<h3 class="fly-post-tag-title"><?php _e('Tags', 'ust'); ?></h3>
		<?php the_tags( '', ' ', '' ); ?>
	</div>
	<?php endif;
endif; ?>

<div class="fly-post-details-meta">
	<div class="fly-post-details-back-to-list-btn"><a class="fly-btn fly-btn-1 fly-btn-md fly-btn-color-2" href="javascript:history.go(-1)"><span><?php _e('BACK TO LIST', 'ust'); ?></span></a></div>
</div>