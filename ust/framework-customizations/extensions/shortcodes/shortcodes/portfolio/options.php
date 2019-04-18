<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$admin_url          = admin_url();
$template_directory = get_template_directory_uri();
$options            = array(
	'unique_id'      => array(
		'type' => 'unique'
	),
	'category'       => array(
		'label'   => __( 'Display From', 'ust' ),
		'desc'    => __( 'Select a Portfolio Category', 'ust' ),
		'type'    => 'select',
		'value'   => '',
		'choices' => fw_get_all_potfolio_taxonomy_list(),
		'help'    => __('You need to have a least one Portfolio Category', 'ust'),
	),
	'posts_per_page' => array(
		'label' => __( 'No of Projects', 'ust' ),
		'desc'  => __( 'Enter the number of project to display. Ex: 3, 6, maximum of 50', 'ust' ),
		'type'  => 'short-text',
		'value' => '6',
	),
	'class'          => array(
		'label' => __( 'Custom Class', 'ust' ),
		'desc'  => __( 'Enter custom CSS class', 'ust' ),
		'type'  => 'text',
		'value' => '',
	),
);