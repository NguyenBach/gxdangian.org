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
require_once "tool.php";

if(!function_exists('check_post_exist')){
    function check_post_exist(WP_REST_Request $request){
        if ( ! is_admin() ) {
            require_once( ABSPATH . 'wp-admin/includes/post.php' );
        }
        $title = $request->get_param('title');
        $exist = post_exists($title);
        return $exist;
    }
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'dangian/v1', '/checkexist', array(
        'methods' => 'POST',
        'callback' => 'check_post_exist',
    ) );
} );

if(!function_exists('get_cat_id_by_name')){
    function get_cat_id_by_name(WP_REST_Request $request){
        if ( ! is_admin() ) {
            require_once( ABSPATH . 'wp-admin/includes/post.php' );
        }
        $cat = $request->get_param('cat');
        $catId = get_cat_ID($cat);
        return $catId;
    }
}

add_action( 'rest_api_init', function () {
    register_rest_route( 'dangian/v1', '/getcat', array(
        'methods' => 'POST',
        'callback' => 'get_cat_id_by_name',
    ) );
} );


//register_activation_hook(__FILE__, 'my_activation');
//add_action('my_daily_event', 'do_this_daily');

function my_activation()
{
    autopost_add_post('https://dongten.net/category/cau-nguyen/loi-chua-cho-ngay-song/',"Lời Chúa Mỗi Ngày");
    autopost_add_post('https://dongten.net/category/hoc-lam-nguoi/',"Học Làm Người");
    autopost_add_post('https://dongten.net/category/hoc-lam-nguoi/le-song/',"Lẽ Sống");
    autopost_add_post('https://dongten.net/category/phuc-vu-duc-tin/duc-tin-va-nguoi-tre/',"Đức Tin Và Người Trẻ");
    cg_autopost_add_post('http://conggiao.info/viet-nam-n-1488','Tin Giáo Hội Việt Nam');
    cg_autopost_add_post('http://conggiao.info/vatican-n-809','Tin Giáo Hội Thế Giới');
    cg_autopost_add_post('http://conggiao.info/hoan-vu-n-810','Tin Giáo Hội Thế Giới');
    tgp_autopost_add_post('https://tonggiaophanhanoi.org/tin-tuc/tin-giao-phan/228-tin-tong-hop','Tin Giáo Hội Việt Nam');
    wp_schedule_event(current_time('timestamp'), 'daily', 'my_daily_event');
}

function do_this_daily()
{
    autopost_add_post('https://dongten.net/category/cau-nguyen/loi-chua-cho-ngay-song/',"Lời Chúa Mỗi Ngày");
    autopost_add_post('https://dongten.net/category/hoc-lam-nguoi/',"Học Làm Người");
    autopost_add_post('https://dongten.net/category/hoc-lam-nguoi/le-song/',"Lẽ Sống");
    autopost_add_post('https://dongten.net/category/phuc-vu-duc-tin/duc-tin-va-nguoi-tre/',"Đức Tin Và Người Trẻ");
    cg_autopost_add_post('http://conggiao.info/viet-nam-n-1488','Tin Giáo Hội Việt Nam ');
    cg_autopost_add_post('http://conggiao.info/vatican-n-809','Tin Giáo Hội Thế Giới');
    cg_autopost_add_post('http://conggiao.info/hoan-vu-n-810','Tin Giáo Hội Thế Giới');
    tgp_autopost_add_post('https://tonggiaophanhanoi.org/tin-tuc/tin-giao-phan/228-tin-tong-hop','Tin Giáo Hội Việt Nam');

}

//register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation()
{
    wp_clear_scheduled_hook('my_daily_event');

}

