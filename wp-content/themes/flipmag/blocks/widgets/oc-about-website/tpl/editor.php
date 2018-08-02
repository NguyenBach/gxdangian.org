<div id="flipmag-bid-<?php echo esc_attr($instance['widget_id']); ?>">
	<?php echo wp_kses_stripslashes( $instance['title'] != null ? $instance['header'] == null ? $args['before_title'] . esc_html($instance['title']) . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['header'] ).'"><span>'. esc_html($instance['title']) .'</span></h3>' : '' ) ; ?>
	<div class="siteorigin-widget-tinymce textwidget">
		<?php echo ($text); ?>
	</div>
</div> 