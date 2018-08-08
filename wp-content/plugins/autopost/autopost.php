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



register_activation_hook(__FILE__, 'my_activation');
add_action('my_daily_event', 'do_this_daily');

function my_activation()
{
//    autopost_add_post();
    autopost_add_post('https://dongten.net/category/cau-nguyen/loi-chua-cho-ngay-song/',"Lời Chúa Mỗi Ngày");
    wp_schedule_event(current_time('timestamp'), 'daily', 'my_daily_event');
}

function do_this_daily()
{
    autopost_add_post('https://dongten.net/category/cau-nguyen/loi-chua-cho-ngay-song/',"Lời Chúa Mỗi Ngày");
//    autopost_add_post('http://dongten.net/noidung/category/hoc-lam-nguoi',"Học Làm Người");
//    autopost_add_post('http://dongten.net/noidung/category/hoc-lam-nguoi/le-song',"Lẽ Sống");
//    autopost_add_post('http://dongten.net/noidung/category/phuc-vu-duc-tin/duc-tin-va-nguoi-tre',"Đức Tin Và Người Trẻ");

}

register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation()
{
    wp_clear_scheduled_hook('my_daily_event');

}

