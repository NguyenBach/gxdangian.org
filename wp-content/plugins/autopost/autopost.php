<?php
/**
 * Created by PhpStorm.
 * User: bachnguyen
 * Date: 11/07/2017
 * Time: 09:25
 */
/*
Plugin Name: Auto Post
Plugin URI: https://gxdangian.org/
Description: auto get post from dongten.net
Version: 3.3.2
Author: Automattic
Author URI: https://automattic.com/wordpress-plugins/
License: GPLv2 or later
Text Domain: akismet
*/
require_once 'simple_html_dom.php';

function autopost_add_post()
{
    $html = file_get_html('http://dongten.net/noidung/category/loi-chua-cho-ngay-song');
    $content = $html->getElementById('content');
    $id = [];
    foreach ($content->childNodes() as $div) {
        if ($div->class == 'pagenavi clear' || $div->class == "heading") continue;
        $divid = $div->id;
        $id[] = explode('-', $divid)[1];
    }
//    for($i = 0; $i < $id ; $i++){
        $html = file_get_html('http://dongten.net/noidung/' . $id[0]);
        $postContent = $html->getElementById('post-' . $id[0]);
        $title = $postContent->find('.entry-title');
        $contentPost = $postContent->childNodes(2);
        $contentPost->childNodes(1)->find('a')[0]->outertext = '';
        $post = [
            'post_title' => $title,
            'post_status'   => 'publish',
            'post_content' => $contentPost,
        ];
        wp_insert_post($post,true);
//    }
}
register_activation_hook(__FILE__, 'my_activation');
add_action('my_daily_event', 'do_this_daily');

function my_activation() {
//    autopost_add_post();
    wp_schedule_event( current_time( 'timestamp' ), 'daily', 'my_daily_event');
}

function do_this_daily() {
   autopost_add_post();
}
register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation() {
    wp_clear_scheduled_hook('my_daily_event');
}