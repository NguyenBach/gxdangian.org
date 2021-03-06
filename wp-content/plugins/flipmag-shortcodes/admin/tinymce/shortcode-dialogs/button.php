<?php
$render  = Flipmag::factory('admin/option-renderer');

$button_colors = (array) Flipmag_ShortCodes::getInstance()->get_config('button_colors');
if (count($button_colors)) {
	$button_colors = array_combine($button_colors, array_map('ucfirst', $button_colors));
}
else {
	$button_colors = array();
}

// all the attributes
$options = apply_filters('flipmag_shortcodes_button_options', array(
	'link' => array(
		'label' => __('Link To', 'flipmag-shortcodes'),
		'type'  => 'text',
		'name'  => 'link',
		'html_post_output' => '<span class="help">' . __('Example: http://google.com.', 'flipmag-shortcodes') . '</span>'
	),
	
	'text' => array(
		'label' => __('Button Text', 'flipmag-shortcodes'),
		'type'  => 'text',
		'name'  => 'enclose'
	),
	
	'size' => array(
		'label' => __('Button Size', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'size',
		'options' => array('' => __('Small', 'flipmag-shortcodes'), 'medium' => __('Medium', 'flipmag-shortcodes'), 'large' => __('Large', 'flipmag-shortcodes')),
	),
	
	'preset' => array(
		'label' => __('Preset Styles', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'preset',
		'options' => $button_colors,
		'html_post_output' => '<span class="help">'. __('Either choose a pre-defined style or customize below.', 'flipmag-shortcodes') .'</span>'
	),
	
	'target' => array(
		'label' => __('Open In', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'target',
		'options' => array('' => __('Same Tab', 'flipmag-shortcodes'), 'new' => __('New Tab', 'flipmag-shortcodes')),
	),
	
	'sep' => array(
		'type' => 'html',
		'html' => '<div class="divider-or"><span>' .  __('Or Customize (Optional)', 'flipmag-shortcodes') . '</span></div>'
	),
	
	'text_color' => array(
		'label' => __('Text Color', 'flipmag-shortcodes'),
		'type'  => 'color',
		'name'  => 'text_color'
	),
	
	'bg_color' => array(
		'label' => __('Background Color', 'flipmag-shortcodes'),
		'type'  => 'color',
		'name'  => 'color',
		''
	),
));


if (empty($button_colors)) {
	unset($options['preset']);
}

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

	$('form.flipmag-sc-visual').unbind('submit');
	$('form.flipmag-sc-visual').submit(button_handler);
	$('form.flipmag-sc-visual').submit(Flipmag_Shortcodes_Helper.simple_shortcodes);
});
</script>
