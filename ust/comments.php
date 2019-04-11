<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
}

$commenter     = wp_get_current_commenter();
$aria_required = get_option( 'require_name_email' ) ? " aria-required='true'" : '';
$permalink     = get_permalink();

$args = array(
	'id_form'              => 'addcomments',
	'id_submit'            => 'submit',
	'title_reply'          => __( 'LEAVE A COMMENT', 'ust' ),
	'title_reply_to'       => __( 'Leave a Reply to %s', 'ust' ),
	'cancel_reply_link'    => __( 'Cancel Reply', 'ust' ),
	'label_submit'         => __( 'Submit', 'ust' ),
	'comment_field'        => '<div class="right-side-comment">
		<p class="comment-form-comment">
			<textarea id="comment" name="comment" placeholder="' . __( 'Comment', 'ust' ) . '" class="required" required></textarea>
		</p>
	</div>',
	'must_log_in'          => '<p class="must-log-in">' . sprintf(
			__( 'You must be <a href="%s">logged in</a> to post a comment.', 'ust' ),
			wp_login_url( apply_filters( 'the_permalink', $permalink ) )
		) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'ust' ),
			admin_url( 'profile.php' ),
			$user_identity,
			wp_logout_url( apply_filters( 'the_permalink', $permalink ) )
		) . '</p>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'fields'               => apply_filters( 'comment_form_default_fields', array(
			'author' => '<div class="left-side-comment">
			<p class="comment-form-author">
				<input type="text" id="author" name="author" placeholder="' . __( 'Name', 'ust' ) . '" class="required" ' . $aria_required . ' />
			</p>',
			'email'  => '
			<p class="comment-form-email">
				<input type="email" id="email" name="email" placeholder="' . __( 'Email', 'ust' ) . '" class="required" ' . $aria_required . ' />
			</p>
		</div>',
		)
	),
);
?>
<div class="row">
	<div id="comments" class="comments-area <?php if ( is_user_logged_in() ) {
		echo 'user-is-logged';
	} ?>">
		<?php if(get_comments_number() != '0') : ?>
			<h3 class="title"><?php _e( 'Comments', 'ust' ); ?></h3>
		<?php endif; ?>

		<?php if ( have_comments() ) : ?>
			<ol class="comment-list">
				<?php
				get_template_part( 'comments', 'template' );
				wp_list_comments( array( 'callback' => 'fw_theme_comment' ) );
				?>
			</ol><!-- .comment-list -->

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
				<nav id="comment-nav-below" class="navigation paging-navigation comment-navigation" role="navigation">
					<div class="pagination loop-pagination">
						<?php paginate_comments_links( array(
							'prev_text' => '<i class="fa fa-angle-left"></i><span>' . __( 'Previous', 'ust' ) . '</span>',
							'next_text' => '<i class="fa fa-angle-right"></i><span>' . __( 'Next', 'ust' ) . '</span>'
						) ); ?>
					</div>
				</nav>
			<?php endif; // Check for comment navigation. ?>

			<?php if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php _e( 'Comments are closed.', 'ust' ); ?></p>
			<?php endif; ?>
		<?php endif; // have_comments() ?>

		<?php comment_form( $args ); ?>
	</div>
	<!-- #comments -->
</div><!-- /.row -->