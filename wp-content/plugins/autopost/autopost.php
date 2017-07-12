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

global $lastpostid;
function autopost_add_post($linkCategory,$category,$slug)
{
    global $lastpostid;
    $html = file_get_html($linkCategory);
    $content = $html->getElementById('content');
    $id = [];
    foreach ($content->childNodes() as $div) {
        if ($div->class == 'pagenavi clear' || $div->class == "heading") continue;
        $divid = $div->id;
        $id[] = explode('-', $divid)[1];
    }
    if(isset($lastpostid[$slug]) && $lastpostid[$slug] == $id[0]){
        return;
    }
    $lastpostid[$slug] = $id[0];
    $html = file_get_html('http://dongten.net/noidung/' . $id[0]);
    $postContent = $html->getElementById('post-' . $id[0]);
    $title = $postContent->find('.entry-title')[0];
    $contentPost = $postContent->childNodes(2);
    $fuck = 0;
    if($slug == 'loichua') $fuck = 1;
    $a = $contentPost->childNodes($fuck)->find('a')[0];
    $l = $a->find('img')[0]->src;
    $l = explode('?',$l)[0];
    $contentPost->childNodes($fuck)->find('a')[0]->outertext = '';
    $post = [
        'post_title' => $title,
        'post_status' => 'publish',
        'post_content' => $contentPost,
        'post_category' => array(get_cat_ID($category))
    ];
    $post_id = wp_insert_post($post);
    Generate_Featured_Image($l, $post_id);
}

register_activation_hook(__FILE__, 'my_activation');
add_action('my_daily_event', 'do_this_daily');

function my_activation()
{
//    autopost_add_post();
    wp_schedule_event(current_time('timestamp'), 'daily', 'my_daily_event');
}

function do_this_daily()
{
    autopost_add_post('http://dongten.net/noidung/category/loi-chua-cho-ngay-song',"Lời Chúa Mỗi Ngày",'loichua');
    autopost_add_post('http://dongten.net/noidung/category/hoc-lam-nguoi',"Học Làm Người",'hoclamnguoi');
//    autopost_add_post('http://dongten.net/noidung/category/hoc-lam-nguoi/le-song',"Lẽ Sống",'lesong');
//    autopost_add_post('http://dongten.net/noidung/category/phuc-vu-duc-tin/duc-tin-va-nguoi-tre',"Đức Tin Và Người Trẻ",'ductin');

}

register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation()
{
    wp_clear_scheduled_hook('my_daily_event');
    global $lastpostid;
    $lastpostid = [];
}

function Generate_Featured_Image($image_url, $post_id)
{
    $upload_dir = wp_upload_dir();
    $image_data = file_get_contents($image_url);
    $filename = basename($image_url);
    if (wp_mkdir_p($upload_dir['path'])) $file = $upload_dir['path'] . '/' . $filename;
    else                                    $file = $upload_dir['basedir'] . '/' . $filename;
    file_put_contents($file, $image_data);
    $wp_filetype = wp_check_filetype($filename, null);
    $attachment = array(
        'post_mime_type' => $wp_filetype['type'],
        'post_title' => sanitize_file_name($filename),
        'post_content' => '',
        'post_status' => 'inherit'
    );
    $attach_id = wp_insert_attachment($attachment, $file);
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    $attach_data = wp_generate_attachment_metadata($attach_id, $file);
    wp_update_attachment_metadata($attach_id, $attach_data);
    update_post_meta( $post_id, '_thumbnail_id', $attach_id );
    set_post_thumbnail( $post_id, $attach_id );

}