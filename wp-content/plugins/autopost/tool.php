<?php
/**
 * Created by PhpStorm.
 * User: bachnguyen
 * Date: 11/07/2017
 * Time: 08:25
 */
require_once 'simple_html_dom.php';

$html = file_get_html('http://dongten.net/noidung/category/loi-chua-cho-ngay-song');
$content = $html->find('#content');
$content = $html->getElementById('content');
$id = [];
foreach ($content->childNodes() as $div){
    if($div->class == 'pagenavi clear' || $div->class == "heading" ) continue;
    $divid = $div->id;
    $id[] = explode('-',$divid)[1];
}
$html = file_get_html('http://dongten.net/noidung/'.$id[0]);
$postContent = $html->getElementById('post-'.$id[0]);
$title = $postContent->find('.entry-title');
$contentPost = $postContent->childNodes(2);
$contentPost->childNodes(1)->find('a')[0]->outertext = '';

