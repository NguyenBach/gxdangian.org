<?php
$render  = Flipmag::factory('admin/option-renderer');

// all the attributes
$options = array(
	array(
		'label' => __('Content', 'flipmag-shortcodes'),
		'type'  => 'text',
		'name'  => 'enclose'
	),
	
	array(
		'label' => __('Alert Type', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'style',
		'options' => array(
			'info' => __('Info', 'flipmag-shortcodes'),
			'warning' => __('Warning', 'flipmag-shortcodes'),
			'success' => __('Success', 'flipmag-shortcodes'),
			'error'   => __('Error', 'flipmag-shortcodes'),
			'download' => __('Download Arrow', 'flipmag-shortcodes'),
		),
	),

);

foreach ($options as $option) {
	echo $render->render($option);
}

?>

<script>
jQuery(function($) {

	// replace customized color - this will be hooked before main handler
	var button_handler = function() {
		
		var bg_color = $(this).find('input[name=color]'),
			preset = $(this).find('select[name=preset]');
		
		if (bg_color.val() == '') {
			bg_color.val(preset.val());
		}

		preset.remove();

		// don't return false or it will stop propagation
	};
	
	$('form.flipmag-sc-visual').submit(button_handler);
});
</script>
