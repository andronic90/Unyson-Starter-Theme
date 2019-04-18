<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$template_directory = get_template_directory_uri();
$admin_url          = admin_url();

$options = array(
	'portfolio-posts' => array(
		'title'   => __( 'Portfolio', 'ust' ),
		'type'    => 'tab',
		'options' => array(
			'portfolio-options'    => array(
				'title'   => __( 'Portfolio', 'ust' ),
				'type'    => 'box',
				'options' => array(
					'enable_portfolio_filter'  => array(
						'label'        => __( 'Portfolio Filter', 'ust' ),
						'desc'         => __( 'Enable portfolio filter?', 'ust' ),
						'help'         => sprintf( "%s", __( 'This filter appears only on the Portfolio category page.', 'ust' ) ),
						'type'         => 'switch',
						'right-choice' => array(
							'value' => 'yes',
							'label' => __( 'Yes', 'ust' )
						),
						'left-choice'  => array(
							'value' => 'no',
							'label' => __( 'No', 'ust' )
						),
						'value'        => 'yes',
					),
					'portfolio_posts_per_page' => array(
						'label' => __( 'No. of Projects per Page', 'ust' ),
						'desc'  => __( 'Enter how many projects will be displayed on a page', 'ust' ),
						'value' => get_option( 'posts_per_page' ),
						'type'  => 'short-text',
					)
				)
			),
		)
	),
);