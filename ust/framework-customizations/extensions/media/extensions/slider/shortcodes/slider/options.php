<?php if (!defined('FW')) die('Forbidden');

$choices = fw()->extensions->get('slider')->get_populated_sliders_choices();

if (!empty($choices)) {
	$options = array(
		'slider_id' => array(
			'type' => 'select',
			'label' => __('Select Slider', 'ust'),
			'choices' => fw()->extensions->get('slider')->get_populated_sliders_choices()
		),
	);
} else {
	$options = array(
		'no_sliders' => array(
			'type' => 'html-full',
			'label' => false,
			'desc' => false,
			'html' => '<div style=""><h1 style="font-weight:100; text-align:center; margin-top:80px">'. __('No Sliders Available', 'ust') .'</h1>'.
   '<p style="text-align:center"><i>'. __('No Sliders created yet. Please go to the Slider page and create one slider','ust')

		)
	);
}
