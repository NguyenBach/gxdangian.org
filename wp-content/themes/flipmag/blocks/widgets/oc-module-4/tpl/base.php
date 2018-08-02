<?php

$lists = $instance['lists'];

$options['id'] = $instance['widget_id'];

$tabs = "";
$tabs .= '<ul class="tab-links">';
foreach( $lists as $index => $row ) {

    $posts = siteorigin_widget_post_selector_process_query( $row["posts"] );
    if( $posts["posts_per_page"] > 5 ){
        $options["query"][$index] = array_merge( siteorigin_widget_post_selector_process_query( $row["posts"] ), array('posts_per_page' => 5) );
    }else{
        $options["query"][$index] = siteorigin_widget_post_selector_process_query( $row["posts"] );
    }

    if($index == 0){ $tabs .= '<li class="active">'; }else{ $tabs .= '<li>'; }
    
    if( trim($row["ctitle"]) == null ){ $row["ctitle"] = __("No Title", 'flipmag'); }    
    $tabs .= '<a href="#tab_'.esc_attr($options['id'].'_'.$index).'">'.esc_html($row["ctitle"]).'</a></li>';    
}
$tabs .= '</ul>';

$options['title'] =  $tabs;
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

if( class_exists('Flipmag')){echo wp_kses_stripslashes(Flipmag::blocks()->Module_4( $options ));} ?>