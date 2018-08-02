<?php

$render  = Flipmag::factory('admin/option-renderer');

?>

<p><a href="#" id="add-more-groups"><?php _e('Add More Toggles', 'flipmag-shortcodes'); ?></a></p>

<script type="text/html" class="template-group-options">

	<div class="divider-or"><span><?php _e('Toggle Box %number%'); ?></span></div>

	<div class="element-control">
		<label><?php _e('Title:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_text(array('name' => 'title[%number%]')); ?>
	</div>

	<div class="element-control">
		<label><?php _e('Default:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_select(array('name' => 'load[%number%]', 'options' => array('hide' => 'Hide', 'show' => 'Show'))); ?>
		<span class="help"><?php _e('Whether to show or hide the content by default.', 'flipmag-shortcodes'); ?></span>
	</div>

	<div class="element-control">
		<label><?php _e('Content:', 'flipmag-shortcodes'); ?></label>
		<?php echo $render->render_textarea(array('name' => 'content[%number%]')); ?>
	</div>

	
</script>

<script>
jQuery(function($) {
	$('#add-more-groups').click();
	Flipmag_Shortcodes_Helper.set_handler('advanced');
});
</script>