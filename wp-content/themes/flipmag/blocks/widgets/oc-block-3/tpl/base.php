<?php
$query = siteorigin_widget_post_selector_process_query( $instance['posts'] );

$options['id'] = $instance['widget_id'];
$options['title'] = $instance['title'] != null ? $instance['controls']['header'] == null ? $args['before_title'] . esc_html($instance['title']) . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['controls']['header'] ).'"><span>'. esc_html($instance['title']) .'</span></h3>' : '' ;
$options['pagination'] = $instance['controls']['pagination'];
$options['animation'] = $instance['controls']['animation'];
$options['date_format'] = $instance['controls']['date_format'];
$options['disable_date'] = $instance['controls']['disable_date'];
$options['date_link'] = $instance['controls']['date_link'];
$options['disable_comment'] = $instance['controls']['disable_comment'];
$options['disable_author'] = $instance['controls']['disable_author'];
$options['thumb_size'] = "flipmag-extra-small";

if( class_exists('Flipmag')){ echo wp_kses_stripslashes(Flipmag::blocks()->blocks( $options, 'block_3', $query )); } ?>