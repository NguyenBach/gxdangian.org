<?php

/**
 * Category Template
 * 
 * Sets up the correct loop format to use. Additionally, meta is processed for other
 * layout preferences.
 */

global $flipmag_block;

$category = get_category(get_query_var('cat'), false);
$cat_meta = Flipmag::options()->get('cat_meta_' . $category->term_id);

// save current options so that can they can be restored later
$options = Flipmag::options()->get_all();

if (!$cat_meta OR !$cat_meta['template']) {
    $cat_meta['template'] = Flipmag::options()->oc_category_template;
}

$flipmag_block = $cat_meta['template'];

// have a sidebar preference?
if (!empty($cat_meta['sidebar'])) {
    Flipmag::core()->set_sidebar($cat_meta['sidebar']);
}else{
    Flipmag::core()->set_sidebar( Flipmag::options()->oc_category_sidebar );
}

// enable infinite scroll?
if (!empty($cat_meta['oc_pagination_type'])) {
	
    if( $cat_meta['oc_pagination_type'] != 'ajax' ){        
	// normal is default - empty in options
	Flipmag::options()->set('oc_pagination_type', ($cat_meta['oc_pagination_type'] == 'normal' ? '' : $cat_meta['oc_pagination_type']));
    }
}

get_template_part('archive');

// restore modified options
Flipmag::options()->set_all($options);
