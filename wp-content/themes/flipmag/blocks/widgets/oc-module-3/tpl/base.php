<?php

$lists = $instance['lists'];

$options['id'] = $instance['widget_id'];

$menu = '<span class="dropdown">';
$menu .= '<button id="dropbtn'. esc_attr($options['id']) .'" data-id="'. esc_attr($options['id']) .'" data-dropdown="yes" class="dropbtn">'. __('All', 'flipmag').' <i id="dropbtn_i'. esc_attr($options['id']) .'"  data-id="'. esc_attr($options['id']) .'" data-dropdown="yes" class="fa fa-angle-down fa-fw"></i></button>';
$menu .= '<span id="dropdown-'. esc_attr($options['id']) .'" class="dropdown-content">';
$menu .= '<a href="javascript:void(0);" data-index="all" data-id="'. esc_attr($options['id']) .'" class="dropdown-block" >'. __('All', 'flipmag').' </a>';
foreach( $lists as $index => $row ) {
    $posts = siteorigin_widget_post_selector_process_query( $row["posts"] );
    if( $posts["posts_per_page"] > 5 ){
        $options["query"][$index] = array_merge( siteorigin_widget_post_selector_process_query( $row["posts"] ), array('posts_per_page' => 5) );
    }else{
        $options["query"][$index] = siteorigin_widget_post_selector_process_query( $row["posts"] );
    }
    
    if( array_key_exists('date_query_relative', $options["query"][$index] ) ){
        unset( $options["query"][$index][ 'date_query_relative' ]);
    }

    $options["ctitle"][$index] = $row["ctitle"];      
    if( trim($row["ctitle"]) == null ){ $row["ctitle"] = __("No Title", 'flipmag'); }
    $menu .= '<a href="javascript:void(0);" data-index="'. esc_attr($index) .'" data-id="'. esc_attr($options['id']) .'" class="dropdown-block" >'. esc_html($row["ctitle"]) .'</a>';    
}
$menu .= '</span></span>';

if( trim($instance['title']) == null ){ $instance['title'] = __("No Title", 'flipmag'); }

$options['title'] = $instance['controls']['header'] == null ? $args['before_title'] . $instance['title'] . $menu . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['controls']['header'] ).'"><span>'. $instance['title'] . $menu .'</span></h3>';

$options['feature_post'] = $instance['controls']['feature_post'];
$options['animation'] = $instance['controls']['animation'];
$options['date_format'] = $instance['controls']['date_format'];
$options['disable_date'] = $instance['controls']['disable_date'];
$options['date_link'] = $instance['controls']['date_link'];
$options['disable_cat'] = $instance['controls']['disable_cat'];
$options['disable_comment'] = $instance['controls']['disable_comment'];
$options['disable_author'] = $instance['controls']['disable_author'];
$options['disable_excerpt'] = $instance['controls']['disable_excerpt'];
$options['excerpt_length'] = $instance['controls']['excerpt_length'];
$options['thumb_size'] = "flipmag-main-block";

if( class_exists('Flipmag')){echo wp_kses_stripslashes(Flipmag::blocks()->Module_3( $options, null, true ));} ?>