<?php

// already initialized? some buggy plugin call?
if (class_exists('Flipmag_Core')) {
	return;
}

//Define in theme admin
define( 'SMOF_VERSION', '1.5.2' );

if( !defined('ADMIN_PATH') )
	define( 'ADMIN_PATH', get_template_directory() . '/admin/' );
if( !defined('ADMIN_DIR') )
	define( 'ADMIN_DIR', get_template_directory_uri() . '/admin/' );

define( 'ADMIN_IMAGES', ADMIN_DIR . 'assets/images/' );

define( 'LAYOUT_PATH', ADMIN_PATH . 'layouts/' );

$theme_version = '';
$smof_output = '';
	    
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}

	$theme_version = $theme_obj->get('Version');
	$theme_name = $theme_obj->get('Name');
	$theme_uri = $theme_obj->get('ThemeURI');
	$author_uri = $theme_obj->get('AuthorURI');
} else {
	$theme_data = wp_get_theme( get_template_directory().'/style.css' );
	$theme_version = $theme_data['Version'];
	$theme_name = $theme_data['Name'];
	$theme_uri = $theme_data['ThemeURI'];
	$author_uri = $theme_data['AuthorURI'];
}

define( 'THEMENAME', $theme_name );

/* Theme version, uri, and the author uri are not completely necessary, but may be helpful in adding functionality */
define( 'THEMEVERSION', $theme_version );
define( 'THEMEURI', $theme_uri );
define( 'THEMEAUTHORURI', $author_uri );

define( 'BACKUPS','backups' );


// Initialize Framework
require_once get_template_directory() . '/lib/flipmag.php';

// fire up the theme-specific extra functionality
$flip_mag = new Flipmag_Theme;

/**
 * Main Framework Configuration
 */
$flipmag = Flipmag::core()->init(apply_filters('flipmag_init_config', array(

    'meta_prefix' => '_flipmag',
    
    'theme_name' => strtolower( THEMENAME ),
    
    'theme_version' => THEMEVERSION,
    
    'post_formats' => array('gallery', 'image', 'video', 'audio'),
	
    // enabled metaboxes and prefs
    'meta_boxes' => array(
            array('id' => 'post-options', 'title' => __('Post Options', 'flipmag'), 'priority' => 'high', 'page' => array('post')),		
            array('id' => 'page-options', 'title' => __('Page Options', 'flipmag'), 'priority' => 'high', 'page' => array('page')),
    ),
	
)));

//adding flipmag group
if (class_exists('SiteOrigin_Widgets_Bundle')) {
	add_filter('siteorigin_widgets_widget_folders', 'flipmag_widgets_collection');
	add_filter('siteorigin_panels_widget_dialog_tabs', 'flipmag_add_widget_tabs', 20);
    add_filter( 'siteorigin_widgets_widget_banner', 'flipmag_widget_banner_img_src', 10, 2);
}

/**
 * siteorigin flipmag widgets folder
 */	
function flipmag_widgets_collection($folders){    
    $folders[] = get_template_directory() . '/blocks/widgets/';
    return $folders;
}

/**
 * siteorigin flipmag group
 */
function flipmag_add_widget_tabs($tabs) {
    $tabs[] = array(
        'title' => __('FlipMag', 'flipmag'),
        'filter' => array(
            'groups' => array('oc-widgets-bundle')
        )
    );
    return $tabs;
}

function flipmag_widget_banner_img_src( $banner_url, $widget_meta ) {

    if( strpos( $widget_meta['ID'] , 'oc-' ) !== false ) {
        $banner_url = get_template_directory_uri() . '/blocks/widgets/'. $widget_meta['ID'] . '/assets/banner.svg';        
    }
    return $banner_url;
}

?>