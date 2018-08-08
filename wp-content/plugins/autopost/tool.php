<?php
/**
 * Created by PhpStorm.
 * User: bachnguyen
 * Date: 11/07/2017
 * Time: 08:25
 */
require_once 'simple_html_dom.php';


$base = 'https://dongten.net/category/cau-nguyen/loi-chua-cho-ngay-song/';
function getHtml($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function getPostUrl($output)
{
    $html = str_get_html($output);
    $main_content = $html->find('#main-content')[0];
    $item_lists = $main_content->find('.item-list');
    $item = $item_lists[0];
    $title = $item->find('.post-box-title')[0];
    $a = $title->find('a')[0];
    $url = $a->href;
    return $url;
}

function getImgUrl($output)
{
    $html = str_get_html($output);
    $main_content = $html->find('#main-content')[0];
    $item_lists = $main_content->find('.item-list');
    $item = $item_lists[0];
    $thumnail = $item->find('.post-thumbnail')[0];
    $img = $thumnail->find('img')[0];
    $img_url = $img->src;
    return $img_url;
}

function getPost($url)
{
    $output = getHtml($url);
    $html = str_get_html($output);
    $post = $html->find('#the-post')[0];
    $title = $post->find('h1.name')[0];
    $title = $title->plaintext;
    $content = $post->find('div.entry')[0];
    $content = $content->innertext;
    $post = [
        'post_title' => $title,
        'post_content' => $content,
    ];
    return $post;

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
    update_post_meta($post_id, '_thumbnail_id', $attach_id);
    set_post_thumbnail($post_id, $attach_id);

}

function checkPostExist($title, $content = '')
{
    if ($content != '') {
        $check = post_exists($title, $content);
    } else {
        $check = post_exists($title);
    }
    return $check;

}

function mailToMe($title,$url,$error){
    $to = 'bachnq214@gmail.com';
    $subject = " Get Post Error!";
    $message = "Get post" .$title . ' at '. $url. '. Error: ' .$error;
    wp_mail($to,$subject,$message);
}

function autopost_add_post($linkCategory,$category)
{
    $output = getHtml($linkCategory);
    $postUrl = getPostUrl($output);
    $postThumbnailImgUrl = getImgUrl($output);
    $postContent = getHtml($postUrl);
    $post = getPost($postContent);
    $post['post_status'] = 'publish';
    $post['post_category'] = array(get_cat_ID($category));
    $check = checkPostExist($post['post_title']);
    if(!$check){
        mailToMe($post['post_title'],$postUrl,'Post Exist');
        return;
    }
    $post_id = wp_insert_post($post);
    Generate_Featured_Image($postThumbnailImgUrl, $post_id);
}