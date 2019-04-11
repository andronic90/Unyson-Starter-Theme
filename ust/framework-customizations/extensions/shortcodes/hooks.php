<?php if ( ! defined( 'ust' ) ) {
	die( 'Forbidden' );
}


if ( ! function_exists( 'fw_disable_default_shortcodes' ) ) :
	function fw_disable_default_shortcodes( $to_disabled ) {
		$to_disabled[] = 'calendar';
		$to_disabled[] = 'accordion';
		$to_disabled[] = 'button';
		$to_disabled[] = 'column';
		$to_disabled[] = 'divider';
		$to_disabled[] = 'call_to_action';
		$to_disabled[] = 'table';
		$to_disabled[] = 'icon';
		$to_disabled[] = 'icon_box';
		$to_disabled[] = 'notification';
		$to_disabled[] = 'row';
		$to_disabled[] = 'section';
		$to_disabled[] = 'special_heading';
		$to_disabled[] = 'tabs';
		$to_disabled[] = 'widget_area';
		$to_disabled[] = 'team_member';

		return $to_disabled;
	}

	add_filter( 'fw_ext_shortcodes_disable_shortcodes', 'fw_disable_default_shortcodes', 10, 2 );
endif;