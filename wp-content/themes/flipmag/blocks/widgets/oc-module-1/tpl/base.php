<?php

$options['id'] = $instance['widget_id'];
$options['title'] = $instance['title'] != null ? $instance['header'] == null ? $args['before_title'] . esc_html($instance['title']) . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['header'] ).'"><span>'. esc_html($instance['title']) .'</span></h3>' : '' ;

$options['theme_color'] = $instance['theme_bgcolor'];

//column 1
$query = siteorigin_widget_post_selector_process_query( $instance['col_1']['posts'] );
$options['col_1']['feature_post'] = $instance['col_1']['feature_post'];
$options['col_1']['animation'] = $instance['col_1']['animation'];
$options['col_1']['date_format'] = $instance['col_1']['date_format'];
$options['col_1']['disable_date'] = $instance['col_1']['disable_date'];
$options['col_1']['date_link'] = $instance['col_1']['date_link'];
$options['col_1']['disable_cat'] = $instance['col_1']['disable_cat'];
$options['col_1']['disable_comment'] = $instance['col_1']['disable_comment'];
$options['col_1']['disable_author'] = $instance['col_1']['disable_author'];
$options['col_1']['disable_excerpt'] = $instance['col_1']['disable_excerpt'];
$options['col_1']['excerpt_length'] = $instance['col_1']['excerpt_length'];
$options['col_1']['disable_more'] = "yes";
$options['col_1']['thumb_size'] = "flipmag-main-block";

//column 2
$query2 = siteorigin_widget_post_selector_process_query( $instance['col_2']['posts'] );
$options['col_2']['feature_post'] = $instance['col_2']['feature_post'];
$options['col_2']['animation'] = $instance['col_2']['animation'];
$options['col_2']['date_format'] = $instance['col_2']['date_format'];
$options['col_2']['disable_date'] = $instance['col_2']['disable_date'];
$options['col_2']['date_link'] = $instance['col_2']['date_link'];
$options['col_2']['disable_cat'] = $instance['col_2']['disable_cat'];
$options['col_2']['disable_comment'] = $instance['col_2']['disable_comment'];
$options['col_2']['disable_author'] = $instance['col_2']['disable_author'];
$options['col_2']['disable_excerpt'] = $instance['col_2']['disable_excerpt'];
$options['col_2']['excerpt_length'] = $instance['col_2']['excerpt_length'];
$options['col_2']['disable_more'] = "yes";
$options['col_2']['thumb_size'] = "flipmag-main-block";

if( class_exists('Flipmag')){ echo wp_kses_stripslashes(Flipmag::blocks()->Module_1( $options, $query, $query2 )); } ?>