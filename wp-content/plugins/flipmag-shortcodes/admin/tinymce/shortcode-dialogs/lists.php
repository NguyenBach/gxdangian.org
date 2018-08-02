<?php

$render  = Flipmag::factory('admin/option-renderer');

?>

<?php


$options = apply_filters('flipmag_shortcodes_lists_options', array(
	'style' => array(
		'name'  => 'style',
		'label' => __('List Style', 'flipmag-shortcodes'),
		'type'  => 'select',
		'options' => array(
			'arrow'   => __('Arrow', 'flipmag-shortcodes'),	
			'check'   => __('Check', 'flipmag-shortcodes'),
			'edit'   => __('Edit', 'flipmag-shortcodes'),	
			'folder' => __('Folder', 'flipmag-shortcodes'),
			'file'   => __('File', 'flipmag-shortcodes'),
			'heart'  => __('Heart', 'flipmag-shortcodes'),
	)),
	
	'ordered' => array(
		'name'  => 'ordered',
		'label' => __('Ordered List?', 'flipmag-shortcodes'),
		'type'  => 'select',
		'options' => array('' => __('No', 'flipmag-shortcodes'), 1 => __('Yes', 'flipmag-shortcodes'))
	),
));

foreach ($options as $option) {
	echo $render->render($option);
}

?>
	
</p>

<p><a href="#" id="add-more-groups"><?php _e('Add More Items', 'flipmag-shortcodes'); ?></a></p>

<script type="text/html" class="template-group-options">

	<?php echo $render->render(array('name' => 'content[%number%]', 'type' => 'text', 'label' => __('Item <span>%number%</span>:', 'flipmag-shortcodes'))); ?>
	
</script>

<script>
jQuery(function($) {
	$('#add-more-groups').click();
	Flipmag_Shortcodes_Helper.set_handler('advanced');
});
</script>