<?php

$render = Flipmag::factory('admin/option-renderer');

?>

<p><a href="#" id="add-more-groups"><?php _e('Add More Tabs', 'flipmag-shortcodes'); ?></a></p>

<script type="text/html" class="template-group-options">

	<div class="element-control">
		<label><?php _e('Tab #<span>%number%</span> Title:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_text(array('name' => 'title[%number%]')); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Tab #<span>%number%</span> Content:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_textarea(array('name' => 'content[%number%]')); ?>
	</div>

	<div style="padding-top:20px;"></div>
</script>

<script>
jQuery(function($) {
	$('#add-more-groups').click();
	Flipmag_Shortcodes_Helper.set_handler('advanced');
});
</script>