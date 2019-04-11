<?php

/**
 * @var $instance
 * @var $before_widget
 * @var $after_widget
 * @var $title
 */

if ( ! empty( $instance ) ) :
	if ( ! is_user_logged_in() ) :
		$return_html = '';
		echo $before_widget;
		echo $title;
		$return_html .= '<form action="' . home_url() . '/wp-login.php" method="post" name="loginform" id="loginform"  class="loginform">
			<p>
				<input name="log" id="user_login2" class="input" value="" size="20" tabindex="10" type="text" placeholder="' . __( 'Username', 'ust' ) . '">
			</p>
			<p>
				<input name="pwd" id="user_pass2" class="input" value="" size="20" tabindex="20" type="password" placeholder="' . __( 'Password', 'ust' ) . '">
			</p>';
		if ( $instance['show_remember'] ) {
			$return_html .= '<div class="forgetmenot input-styled checklist">
				<input name="rememberme" type="checkbox" id="rememberme" value="forever" tabindex="90" checked="checked" />
				<label class="checked" for="rememberme">' . __( 'Remember Me', 'ust' ) . '</label>
			</div>';
		}
		if ( $instance['show_forgot'] ) {
			$return_html .= '<p class="forget_password"><a href="' . home_url() . '/wp-login.php?action=lostpassword">' . __( 'Forgot Password?', 'ust' ) . '</a></p>';
		}
		$return_html .= '<p class="submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="fw-btn-login" value="' . __( 'Login', 'ust' ) . '" tabindex="100" />
				<input type="hidden" name="redirect_to" value="' . home_url() . '/wp-admin/" />
				<input type="hidden" name="testcookie" value="1" />
			</p>
		</form>';
		echo $return_html;
		echo $after_widget;
	endif;
endif; ?>