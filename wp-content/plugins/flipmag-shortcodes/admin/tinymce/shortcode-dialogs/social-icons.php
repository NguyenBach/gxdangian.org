<?php

$render = Flipmag::factory('admin/option-renderer');

// all the attributes
$options = array(
	array(
		'label' => __('Icons Size', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'type',
		'options' => array(
			'' => __('Small', 'flipmag-shortcodes'),
			'medium' => __('Medium', 'flipmag-shortcodes'),
			'large' => __('Large', 'flipmag-shortcodes'),
			'x-large' => __('Extra Large', 'flipmag-shortcodes'),
		),
	),
	
	array(
		'label' => __('Backgrounds', 'flipmag-shortcodes'),
		'type'  => 'select',
		'name'  => 'backgrounds',
		'options' => array(
			'' => __('Transparent', 'flipmag-shortcodes'),
			'1' => __('Colored', 'flipmag-shortcodes'),
		),
	),

);

foreach ($options as $option) {
	echo $render->render($option);
}

?>

<p><hr /></p>

<p><a href="#" id="add-more-groups"><?php _e('Add Icon', 'flipmag-shortcodes'); ?></a></p>

<script type="text/html" class="template-group-options">

	<div class="container">
	<div class="element-control">
		<label><?php _e('Icon Type:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_select(array('name' => 'icon_type[]', 'options' => array(
			'' => __('- Select -', 'flipmag-shortcodes'),
			'facebook' => __('Facebook', 'flipmag-shortcodes'),
			'twitter' => __('Twitter', 'flipmag-shortcodes'),
			'linkedin' => __('LinkedIn', 'flipmag-shortcodes'),
			'google-plus' => __('Google+', 'flipmag-shortcodes'),
			'pinterest' => __('Pinterest', 'flipmag-shortcodes'),
			'dribbble' => __('Dribbble', 'flipmag-shortcodes'),
			'youtube' => __('YouTube', 'flipmag-shortcodes'),
			'instagram' => __('Instagram', 'flipmag-shortcodes'),
			
		))); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Icon Name:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_text(array('name' => 'type[%number%]')); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Link:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_text(array('name' => 'link[%number%]')); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Custom Text Color:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_color_picker(array('name'  => 'color[%number%]')); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Custom Background Color:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_color_picker(array('name'  => 'bg[%number%]')); ?>
	</div>

	<span><input type="hidden" name="sc-group[%number%]" /></span>

	<div style="padding-top:20px;"></div>
	</div>

</script>

<script>
jQuery(function($) {
	$('#add-more-groups').click();
	Flipmag_Shortcodes_Helper.set_handler('advanced');

	$(document).on('change', '[name^=icon_type]', function() {
		if (!$(this).val()) {
			return;
		}
		$(this).closest('.container').find('[name*=type]').val( $(this).val() );
	});
});
</script>