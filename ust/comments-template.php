<?php
if ( ! function_exists( 'fw_theme_comment' ) ) :
	/**
	 * Template for comments and pingbacks.
	 *
	 * To override this walker in a child theme without modifying the comments template
	 * simply create your own fw_theme_comment(), and that function will be used instead.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 */

	function fw_theme_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">

					<article id="li-comment-<?php comment_ID() ?>" class="comment-body">
						<p><?php _e( 'Pingback:', 'ust' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'ust' ), '<span class="edit-link">', '</span>' ); ?></p>
						<div class="comment-entry">
							<?php comment_text(); ?>
							<?php comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ); ?>
						</div>
					</article>

				<?php
				break;
			default : ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<a name="comment-<?php comment_ID() ?>"></a>

				<article id="li-comment-<?php comment_ID() ?>" class="comment-body">
					<div class="comment-avatar">
						<div class="avatar"><?php echo get_avatar( $comment, 50 ); ?></div>
					</div>

					<div class="comment-aside">
						<div class="comment-meta">
							<span class="comment-author">
								<a href="#" class="link-author"><?php comment_author_link(); ?></a>
							</span>
							<span class="comment-date"><?php comment_date(); ?></span>
							<?php comment_reply_link( array_merge( $args, array(
								'depth'     => $depth,
								'max_depth' => $args['max_depth']
							) ) ); ?>
						</div>
						<div class="comment-content">
							<p><?php echo $comment->comment_content; ?></p>
						</div>
						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'ust' ); ?></em>
							<br/>
						<?php endif; ?>
					</div><!-- /.comment-aside -->

					<div class="clearfix"></div>
					<div id="comment-<?php comment_ID(); ?>"></div>
					<div class="clearfix"></div>
				</article><!-- /.comment-container -->
				<?php
				break;
		endswitch;
	}
endif; // ends check for fw_theme_comment()