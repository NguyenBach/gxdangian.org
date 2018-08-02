<?php

include_once get_template_directory().'/lib/lib.php';

/**
 * FliptMag Theme!
 * 
 * Anything theme-specific that won't go into the core framework goes here. Rest goes into lib/core.php
 */
class Flipmag_Theme
{
	public $woocommerce;
	public $registry = array();
	
	public function __construct() 
	{
		// setup plugins before init
		$this->flipmag_setup_plugins();

		// perform the after_setup_theme 
		add_action('after_setup_theme', array($this, 'flipmag_theme_init' ), 12);
		
                require_once locate_template('lib/bbpress.php');
                
                // include WooCommerce 
		if (function_exists('is_woocommerce')) {
			require_once get_template_directory() . '/woocommerce/init.php';
			$this->woocommerce = new FliptMag_WooCommerce;
		}
	}
	
	/**
	 * Setup enque data and actions
	 */
	public function flipmag_theme_init()
	{
            /**
            * Use this hook instead of after_setup_theme to keep the priority setting
            * consistent amongst all helpers and utils.
            */
            do_action('flipmag_bbpress_init');
            
		/*
		 * Enqueue assets (css, js)
		 * 
		 * Register Custom CSS at a lower priority for CSS specificity
		 */
		add_action('wp_enqueue_scripts', array($this, 'flipmag_register_assets'));
		add_action('wp_enqueue_scripts', array($this, 'flipmag_register_custom_css'), 99);
		
		/*
		 * Featured images settings
		 */
		set_post_thumbnail_size(110, 96, true); // 17:15, also used in 85x75 and more similar aspect ratios

		// 1280x612 images for no cropping of featured and slider image
		add_image_size('flipmag-main-full', 1078, 516, true); // main post image in full width
		add_image_size('flipmag-main-slider', 702, 336, true);
		
		add_image_size('flipmag-main-block', 351, 185, true); // also usable at 326x160
		add_image_size('flipmag-extra-small', 85, 45, true); // small thumb for slider
		add_image_size('flipmag-slider-small', 168, 137, true); // small thumb for slider
		add_image_size('flipmag-gallery-block', 214, 140, true); // small thumb for slider

		// i18n
		load_theme_textdomain('flipmag', get_template_directory() . '/languages');
		
		// setup navigation menu with "main" key
		register_nav_menu('main', __('Main Navigation', 'flipmag'));
		
		/*
		 * Category meta 
		 */
		add_action('category_edit_form_fields', array($this, 'flipmag_edit_category_meta'), 10, 2);
		add_action('category_add_form_fields', array($this, 'flipmag_edit_category_meta'), 10, 2);
		
		add_action('edited_category', array($this, 'flipmag_save_category_meta'), 10, 2);
		add_action('create_category', array($this, 'flipmag_save_category_meta'), 10, 2);
		
	
		// 3.5 has content_width removed, add it for oebmed
		global $content_width;
		
		if (!isset($content_width)) {
			$content_width = 702;
		}
		
		/*
		 * Register Sidebars
		 */		
        add_action( 'widgets_init', array($this , 'flipmag_register_sidebars'));

		/*
		 * Mega menu support
		 */
		add_filter('flipmag_custom_menu_fields', array($this, 'flipmag_custom_menu_fields'));
		add_filter('flipmag_mega_menu_end_lvl', array($this, 'flipmag_attach_mega_menu'));
		
		// menu sticky logo support
		add_filter('wp_nav_menu_items', array($this, 'flipmag_add_navigation_logo'), 10, 2);

		//add flipmag link
		add_action('admin_bar_menu', array($this, 'flipmag_toolbar_link'), 99);
		
		/*
		 * Posts related filter
		 */
		
		// add authorship
		add_filter('wp_head', array($this, 'flipmag_add_header_meta'));
                
        add_filter('wp_head', array($this, 'flipmag_add_ajax_url_library'));
        
        add_action( 'wp_ajax_megamenu_ajax_request', array($this, 'flipmag_megamenu_ajax_request') );                
        add_action( 'wp_ajax_nopriv_megamenu_ajax_request', array($this, 'flipmag_megamenu_ajax_request') );
                        
        add_action( 'wp_ajax_block_ajax_paginate', array($this, 'flipmag_block_ajax_paginate') );
        add_action( 'wp_ajax_nopriv_block_ajax_paginate', array($this, 'flipmag_block_ajax_paginate') );
        
        add_action( 'wp_ajax_block_ajax_news', array($this, 'flipmag_block_ajax_news') );
        add_action( 'wp_ajax_nopriv_block_ajax_news', array($this, 'flipmag_block_ajax_news') );
                
                
		// custom font icons for post formats
		add_filter('flipmag_post_formats_icon', array($this, 'flipmag_post_format_icon'));
		
		// video format auto-embed
		add_filter('flipmag_featured_video', array($this, 'flipmag_video_auto_embed'));
		
		// fix search for pages
		add_filter('pre_get_posts', array($this, 'flipmag_fix_search'));
		
		// add custom category per_page limits, if any
		add_filter('pre_get_posts', array($this, 'flipmag_add_category_limits'));
		
		// remove hentry microformat, we use schema.org/Article
		add_action('post_class', array($this, 'flipmag_fix_post_class'));
		
		// add the orig_offset for offset support in blocks
		add_filter('flipmag_block_query_args', array(Flipmag::posts(), 'add_query_offset'), 10, 1);
		
		// add post type to blocks
		add_filter('flipmag_block_query_args', array($this, 'flipmag_add_post_type'), 10, 3);
		
		// ajax post content slideshow - add wrapper
		add_filter('the_content', array($this, 'flipmag_add_post_slideshow_wrap'));

		//add sticky class
		add_filter('post_class', array($this,'flipmag_sticky_class'));
		
		/*
		 * Prevent duplicate posts
		 */
		if (Flipmag::options()->oc_no_home_duplicates) {
			
			// add to removal list on each loop
			add_filter('loop_end', array($this, 'flipmag_update_duplicate_posts'));
			
			// exclude on blocks
			add_filter('flipmag_block_query_args', array($this, 'flipmag_add_duplicate_exclude'));
			
			// exclude on widgets
			foreach (array('tabbed_recent', 'popular_posts', 'latest_posts') as $widget) {
				add_filter('flipmag_widget_' . $widget . '_query_args', array($this, 'flipmag_add_duplicate_exclude'));
			}
		}
		
		/*
		 * Widgets related hooks
		 */
		
		add_filter('flipmag_widget_tabbed_recent_options', array($this, 'flipmag_tabbed_recent_options'));
				
		// add image sizes to the editor
		add_filter('image_size_names_choose', array($this, 'flipmag_add_image_sizes_editor'));
		
		
		// sample import actions
		add_filter('flipmag_import_menu_fields', array($this, 'flipmag_import_menu_fields'));
		add_action('flipmag_import_completed', array($this, 'flipmag_import_fix_menu'));
		
		// set dynamic widget columns for footer
		add_filter('dynamic_sidebar_params', array($this, 'flipmag_set_footer_columns'));
		
		// setup the init hook
		add_action('init', array($this, 'flipmag_init'));
		

	}
	
	/**
	 * Action callback: Setup that needs to be done at init hook
	 */
	public function flipmag_init() 
	{		
		if ($this->flipmag_has_custom_css()) {			
			add_action('template_redirect', array($this, 'flipmag_global_external_custom_css'), 1);
		}
		
		/*
		 * Setup shortcodes, and page builder assets 
		 */
		
		// setup theme-specific shortcodes and blocks
		$this->flipmag_setup_shortcodes();
                
	}
		
	/**
	 * Check if the theme has any custom css
	 */
	public function flipmag_has_custom_css()
	{
		if (count(Flipmag::options()->get_all('css_'))) {
			return true;
		} 
		
		// check if a cat has custom color
		foreach ((array) Flipmag::options()->get_all('cat_meta_') as $cat) 
		{
			if (!empty($cat)) {
				return true;
			}
		}
		
		return false;
	}
	
	/**
	 * Action callback: Output Custom CSS using external CSS method
	 */
	public function flipmag_global_external_custom_css()
	{		
		// custom css requested?
		if (empty($_GET['flipmag_custom_css']) OR intval($_GET['flipmag_custom_css']) != 1) {
			return;
		}
		
		// set 200 - might be 404
		status_header(200);
		header("Content-type: text/css; charset: utf-8"); 

		include_once get_template_directory() . '/custom-css.php';
		
		/*
		 * Output the CSS customizations
		 */
		$render = new Flipmag_Custom_Css;
		$render->args = $_GET;
		echo wp_kses_stripslashes($render->render());
		exit;
	}
	
	/**
	 * Register and enqueue theme CSS and JS files
	 */
	public function flipmag_register_assets()
	{
		if (!is_admin()) {
			
			// theme js			
			wp_enqueue_script('flipmag-theme', get_template_directory_uri() . '/js/flipmag-theme.js', array('jquery'), Flipmag::options()->get_config('theme_version'), true);
 
			
			// add core
			if (is_rtl()) {
				wp_enqueue_style('flipmag-core', get_stylesheet_directory_uri() . '/css/rtl.css', array(), Flipmag::options()->get_config('theme_version'));
			}
			else {
				wp_enqueue_style('flipmag-core', get_stylesheet_uri(), array(), Flipmag::options()->get_config('theme_version'));
			}
			
			if (!Flipmag::options()->oc_no_responsive) {
				wp_enqueue_style('flipmag-responsive', get_template_directory_uri() . '/css/'. (is_rtl() ? 'rtl-' : '') . 'responsive.css', array(), Flipmag::options()->get_config('theme_version'));
			}
			
			// add prettyphoto to pages and single posts
			if (Flipmag::options()->oc_lightbox_prettyphoto && (is_single() OR is_page())) {
				wp_enqueue_script('pretty-photo-flipmag', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), Flipmag::options()->get_config('theme_version'), false);
				wp_enqueue_style('pretty-photo', get_template_directory_uri() . '/css/prettyPhoto.css', array(), Flipmag::options()->get_config('theme_version'));
			}
			
			// bbPress?
			if (class_exists('bbpress')) {
				wp_enqueue_style('flipmag-bbpress', get_template_directory_uri() . '/css/' . (is_rtl() ? 'rtl-' : '') . 'bbpress-ext.css', array(), Flipmag::options()->get_config('theme_version'));
			}			
			
			//font awesome	
			wp_enqueue_style('flipmag-font-awesome', get_template_directory_uri() . '/css/fontawesome/css/font-awesome.min.css', array(), Flipmag::options()->get_config('theme_version'));
			
			
			// flexslider to the footer
			wp_enqueue_script('flex-slider', 
				get_template_directory_uri() . '/js/' . (is_rtl() ? 'rtl-' : '') . 'jquery.flexslider-min.js', array('jquery'), 
				Flipmag::options()->get_config('theme_version'),
				true
			);
			
 			// register infinite scroll
			wp_register_script('flipmag-infinite-scroll', 
				get_template_directory_uri() . '/js/jquery.infinitescroll.min.js',
				array('jquery'), 
				Flipmag::options()->get_config('theme_version'),
				true
			);
                        
            // register jssor
			wp_register_script('flipmag-jssor', 
				get_template_directory_uri() . '/js/jssor.js',
				array('jquery'), 
				Flipmag::options()->get_config('theme_version'),
				true
			);

            // register ajax paginate
			wp_register_script('flipmag-ajax-paginate', 
				get_template_directory_uri() . '/js/jquery.bootpag.min.js',
				array('jquery'), 
				Flipmag::options()->get_config('theme_version'),
				true
			);
                        
            // register sticky sidebar
			wp_register_script('flipmag-sticky-sidebar', 
				get_template_directory_uri() . '/js/jquery.sticky-kit.js',
				array('jquery'), 
				Flipmag::options()->get_config('theme_version'),
				true
			);

			if( !Flipmag::options()->oc_sticky_sidebar ){
				wp_enqueue_script('flipmag-sticky-sidebar');	
			}
		}
	}
	
	/**
	 * Action callback: Register Custom CSS with low priority 
	 */
	public function flipmag_register_custom_css()
	{
		if (is_admin()) {
			return;
		}
		
		// pre-defined scheme / skin
		if (Flipmag::options()->oc_predefined_style) {
			wp_enqueue_style('flipmag-skin', get_template_directory_uri() . '/css/skin-' . Flipmag::options()->oc_predefined_style . '.css');
		}
		
		// add custom css
		if ($this->flipmag_has_custom_css()) {
			
			$query_args = array();
			
			/*
			 * Global color changes?
			 */ 
			if (is_category() OR is_single()) {
	
				$object = get_queried_object();
				$query_args['anchor_obj'] = '';
				
				if (is_category()) {
					$query_args['anchor_obj'] = $object->cat_ID;
				}
				else {
					// be consistent with the behavior that's like cat labels
					$categories = current((array) get_the_category($object->ID));
					
					if (is_object($categories)) {
						$query_args['anchor_obj'] = $categories->cat_ID;
					}
				}
				
				// only used for main color
				$meta = Flipmag::options()->get('cat_meta_' . $query_args['anchor_obj']);
				if (empty($meta['main_color'])) {
					unset($query_args['anchor_obj']);
				}
				
			}
			
			$query_args = array_merge($query_args, array('flipmag_custom_css' => 1));
			
			/*
			 * Custom CSS Output Method - external or on-page?
			 */
			if (Flipmag::options()->css_custom_output == 'external') 
			{
				wp_enqueue_style('custom-css', add_query_arg($query_args, get_site_url() . '/'));
						
				// add css that's supposed to be per page
				$this->flipmag_add_per_page_css();
			}
			else {

				include_once get_template_directory() . '/custom-css.php';

				// associate custom css at the end
				$source = 'flipmag-core';
				
				if (wp_style_is('flipmag-skin', 'enqueued')) {
					$source = 'flipmag-skin';
				}
				else if (wp_style_is('flipmag-woocommerce', 'enqueued')) {
					$source = 'flipmag-woocommerce';
				} 
				else if (wp_style_is('flipmag-font-awesome', 'enqueued')) {
					$source = 'flipmag-font-awesome';
				}
				
				// add to on-page custom css
				$render = new Flipmag_Custom_Css;
				$render->args = $query_args;
				Flipmag::core()->enqueue_css($source, $render->render() . $this->flipmag_add_per_page_css(true));
			}
		}
	}
	
	/**
	 * Setup the sidebars
	 */
	public function flipmag_register_sidebars()
	{	
		// register dynamic sidebar
		register_sidebar(array(
			'name' => __('Main Sidebar', 'flipmag'),
			'id'   => 'primary-sidebar',
			'description' => __('Widgets in this area will be shown in the default sidebar.', 'flipmag'),
			'before_title' => '<h3 class="widget-title '. esc_attr( Flipmag::options()->oc_header_style ) .'"><span>',
			'after_title'  => '</span></h3>',
		));
        
        register_sidebar( array(
			'name'          => __( 'Footer 1', 'flipmag' ),
			'id'            => 'footer-1',
			'description'   => __( 'footer Column 1.', 'flipmag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title '. esc_attr( Flipmag::options()->oc_header_style ) .'"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 2', 'flipmag' ),
			'id'            => 'footer-2',
			'description'   => __( 'footer Column 2.', 'flipmag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title '. esc_attr( Flipmag::options()->oc_header_style ) .'"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 3', 'flipmag' ),
			'id'            => 'footer-3',
			'description'   => __( 'footer Column 3.', 'flipmag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title '. esc_attr( Flipmag::options()->oc_header_style ) .'"><span>',
			'after_title'   => '</span></h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer 4', 'flipmag' ),
			'id'            => 'footer-4',
			'description'   => __( 'footer Column 4.', 'flipmag' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title '. esc_attr( Flipmag::options()->oc_header_style ) .'"><span>',
			'after_title'   => '</span></h3>',
		) );
                
	}
	
	/**
	 * Custom CSS for pages and posts that shouldn't be cached through custom-css.php because 
	 * the size will increase exponentially.
	 * 
	 */
	public function flipmag_add_per_page_css($return = false) 
	{
		if (!is_admin() && is_singular() && Flipmag::posts()->meta('bg_image')) {
			
			$bg_type = Flipmag::posts()->meta('bg_image_bg_type');
			$the_css = 'background: url("' . esc_attr(Flipmag::posts()->meta('bg_image')) . '");';
			
			if (!empty($bg_type)) {
				
				if ($bg_type == 'cover') {
					$the_css .= 'background-repeat: no-repeat; background-attachment: fixed; background-position: center center; '  
			 		. '-webkit-background-size: cover; -moz-background-size: cover;-o-background-size: cover; background-size: cover;';
				}
				else {
					$the_css .= 'background-repeat: ' . esc_attr($bg_type) .';';
				}
			}
			
			$the_css = 'body.boxed { ' . $the_css . ' }';
			
			// return the css?
			if ($return) {
				return $the_css;
			}
			
			// or enqueue it for inline css
			Flipmag::core()->enqueue_css(
				(wp_style_is('custom-css', 'enqueued') ? 'custom-css' : 'flipmag-core'), 
				$the_css
			);
		}
	}
	
	/**
	 * Action callback: Save custom meta for categories
	 */
	public function flipmag_save_category_meta($term_id)
	{
		// have custom meta?
		if (!empty($_POST['meta']) && is_array($_POST['meta'])) 
		{
			$meta = $_POST['meta'];
			
			// editing?
			if (($option = Flipmag::options()->get('cat_meta_' . $term_id))) {
				$meta = array_merge($option, $_POST['meta']);
			}
			
			Flipmag::options()->update('cat_meta_' . $term_id, $meta);
			
			// clear custom css cache
			delete_transient('flipmag_custom_css_cache');
		}
	}
	
	/**
	 * Setup and recommend plugins
	 */
	public function flipmag_setup_plugins()
	{
		// don't load if outside admin or if user doesn't have permission
		if (!is_admin() OR !current_user_can('install_plugins')) {
			return;
		}
		
		require_once get_template_directory() . '/lib/vendor/tgm-activation.php';

		$plugins = array(
			array(
				'name'     	=> 'Page Builder by SiteOrigin', // The plugin name
				'slug'     	=> 'siteorigin-panels', // The plugin slug (typically the folder name)
				//'source'   	=> 'http://demo.octocreation.com/flipmag_demo/plugins/siteorigin-panels.zip',
				'required' 	=> true, // If false, the plugin is only 'recommended' instead of required
				'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			),
	
			array(
				'name'     	=> 'SiteOrigin Widgets Bundle',
				'slug'     	=> 'so-widgets-bundle',
				//'source'   	=> 'http://demo.octocreation.com/flipmag_demo/plugins/so-widgets-bundle.zip',
				'required' 	=> true,
				'force_activation' => false,

			),
                    
            array(
				'name'     	=> 'Flipmag Shortcodes',
				'slug'     	=> 'flipmag-shortcodes',
				'source'   	=> 'http://demo.octocreation.com/flipmag_demo/plugins/flipmag-shortcodes.zip',
				'required' 	=> true,
				'force_activation' => false,

			),
                    			
			array(
				'name' => 'Custom sidebars',
				'slug' => 'custom-sidebars',
				'required' => false,			
			),
			
			array(
				'name' => 'WP Retina 2x',
				'slug' => 'wp-retina-2x',
				'required' => false,	
			),
			
			array(
				'name'   => 'Contact Form 7',
				'slug'   => 'contact-form-7',
				'required' => false,
			)
			
			
	
		);

		tgmpa($plugins, array('is_automatic' => true));
		
		// set revslider as packaged
		if (function_exists('set_revslider_as_theme')) {
			set_revslider_as_theme();
		}
		
	}
	
	/**
	 * Any layout blocks that are layout/page/theme-specific will be included to extend
	 * the default shortcodes supported by the Flipmag Shortcodes Plugin.
	 */
	public function flipmag_setup_shortcodes()
	{
		if (!is_object(Flipmag::options()->shortcodes)) {
			return false;
		}
		
		Flipmag::options()->shortcodes->add_blocks(array(
			// file based
			'blog' => array('render' => locate_template('blocks/blog.php'), 'attribs' => array(
				'pagination' => 0, 'heading' => '', 'heading_type' => '', 'posts' => 4, 'type' => '', 'cats' => '', 'tags' => '',
				'sort_by' => '', 'sort_order' => '', 'taxonomy' => '', 'offset' => '', 'post_type' => '', 'oc_pagination_type' => '',
			)),
			
			'highlights' => array('render' => locate_template('blocks/highlights.php'), 'attribs' => array(
				'type' => '', 'posts' => 4, 'cat' => null, 'column' => '', 'columns' => '', 'cats' => '', 'tags' => '', 
				'tax_tag' => '', 'headings' => '', 'title' => '', 'sort_by' => '', 'sort_order' => '', 'taxonomy' => '',
				'offset' => '', 'offsets' => '', 'post_type' => ''
			)),
			
			'news_focus' => array('render' => locate_template('blocks/news-focus.php'), 'attribs' => array(
				'posts' => 5, 'cat' => null, 'column' => '', 'tax_tag' => '', 'sub_cats' => '', 'sub_tags' => '',
				'sort_by' => '', 'sort_order' => '', 'highlights' => 1, 'taxonomy' => '', 'offset' => '', 'post_type' => '',
				'title' => ''
			)),
			
			// string based
			'main-color' => array('template' => '<span class="main-color">%text%</span>', 'attribs' => array('text' => '')),
		));
		
		// setup shortcode modifications
		if (is_admin()) {
			add_filter('flipmag_shortcodes_list', array($this, 'flipmag_shortcodes_list'));
			add_filter('flipmag_shortcodes_lists_options', array($this, 'flipmag_shortcodes_lists_options'));
		}
		
	}
	
	public function flipmag_shortcodes_list($list)
	{
		// de-register unsupported shortcodes
		unset(
			$list['default']['box'],
			$list['default']['social']['dialog'], 
			$list['default']['social']['label']
		);
		return $list;
	}
	
	public function flipmag_shortcodes_lists_options($options)
	{
		// remove arrow option from defaults for "Custom Lists" in gui creator
		$options['style']['options']['arrow-right'] = $options['style']['options']['arrow'];
		unset($options['style']['options']['arrow']);
		unset($options['ordered']);
		
		return $options;
	}
	
	/**
	 * Action callback: Add form fields to category editing / adding form
	 */
	public function flipmag_edit_category_meta($term = null)
	{
		// add required assets
		wp_enqueue_style('cat-options', get_template_directory_uri() . '/admin/css/cat-options.css');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		
		// add media scripts
		wp_enqueue_media(); 
		
		wp_enqueue_script('theme-options', get_template_directory_uri() . '/admin/js/options.js', array('jquery'));
		
		// get our category meta template
		include_once get_template_directory() . '/admin/category-meta.php';
	}	
	
	/**
	 * Filter callback: Custom menu fields
	 */
	public function flipmag_custom_menu_fields($fields)
	{
		$fields = array(
			'mega_menu' => array(
				'label' => __('Mega Menu', 'flipmag'), 
				'element' => array(
					'type' => 'select',
					'class' => 'widefat',
					'options' => array(
						0 => __('Disabled', 'flipmag'), 'category' => __('Category Mega Menu', 'flipmag'), 'normal' => __('Mega Menu for Links', 'flipmag')
					)
				),
				'parent_only' => true,
				'locations' => array('main'),
			)
		);
		
		return $fields;
	}
	
	/**
	 * Filter Callback: Add our custom mega-menus
	 *
	 * @param array $args
	 */
	public function flipmag_attach_mega_menu($args)
	{
		extract($args);
		
		/**
		 * @todo when not using a cache plugin, wrap in functions or cache the menu
		 */
		
		// category mega menu
		if ($item->mega_menu == 'category') {
			$template = 'blocks/mega-menu-category.php';
		} 
		else if ($item->mega_menu == 'normal') {
			$template = 'blocks/mega-menu-links.php';
		}
		
		if ($template) {
			ob_start();
			include locate_template($template);
			$output = ob_get_clean();
			
			return $output;
		}
		
		return $sub_menu;
	}
	
	/**
	 * Filter callback: Add logo to the sticky navigation
	 */
	public function flipmag_add_navigation_logo($items, $args)
	{
		if (!Flipmag::options()->sticky_nav OR !Flipmag::options()->sticky_nav_logo OR $args->theme_location != 'main') {
			return $items;
		}
		
		if (Flipmag::options()->image_logo_nav) {
			$logo = '<img src="' . esc_url(Flipmag::options()->image_logo_nav) .'" alt="'. esc_attr( get_bloginfo('name') ) .'" />'; 
		}
		else {
			$logo = do_shortcode(Flipmag::options()->text_logo);
		}
		
		$items = '<li class="sticky-logo"><a href="'. esc_url(home_url('/')) .'">' . $logo . '</a></li>' . $items;
		
		return $items;
	}

	/**
	 * Filter callback: Add flipmag link in toolbar 
	 */
	public function flipmag_toolbar_link($wp_admin_bar) {
		$args = array(
			'id' => 'FlipMagOptions',
			'title' => 'FlipMag Options', 
			'href' => admin_url('themes.php?page=flipmag-admin-options'), 
			'meta' => array(
				'class' => '', 
				'title' => 'FlipMag Options'
				)
		);
		$wp_admin_bar->add_node($args);
	}
	
    /**
    * Adds the WordPress Ajax Library to the frontend.
    */
   public function flipmag_add_ajax_url_library() {

       $html = '<script type="text/javascript">';
           $html .= 'var ajaxblock = [];';
           $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '";';
       $html .= '</script>';
       
       echo wp_kses_stripslashes($html);
   } // end add_ajax_library

    // Include the Ajax library on the front end   
    public function flipmag_megamenu_ajax_request() {

        // The $_REQUEST contains all the data sent via ajax
        if ( isset($_REQUEST) ) {

            $query = new WP_Query(apply_filters(
                    'flipmag_mega_menu_query_args', 
                    array('cat' => $_REQUEST['cat-id'], 'meta_key' => '_flipmag_featured_post', 'meta_value' => 1, 'order' => 'date', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1),
                    'category-featured'
            ));

            while ($query->have_posts()): $query->the_post(); ?>
                <div class="col-4 featured fadeInDown">
                        <div class="highlights">
                            <article>
                                    <?php if(has_post_thumbnail()): ?>
			                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="image-link">
			                                <?php the_post_thumbnail('flipmag-main-block', array('class' => 'image', 'title' => esc_attr(strip_tags(get_the_title())))); ?>
			                                
			                                <?php if (get_post_format()): ?>
			                                <span class="post-format-icon <?php echo esc_attr(get_post_format( )); ?>">
			                                    <?php echo apply_filters('flipmag_post_formats_icon', ''); ?>
			                                </span>
			                                <?php endif; ?>
			                            </a>
			                        <?php endif; ?>
			                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h2>
                            </article>
                        </div>
                </div>
            <?php endwhile; wp_reset_postdata();                
        }
        // Always die in functions echoing ajax content
       die();
    }
    
    public function flipmag_block_ajax_news(){
        
         // The $_REQUEST contains all the data sent via ajax
        if ( isset($_REQUEST) ) {
            
            $data = $_REQUEST['ajaxdata'];
            $options = $data["options"];
            
            if( $_REQUEST["ajaxindex"] == "all" ){
                $query = null;
            }else{
                $query = $options["query"][ $_REQUEST["ajaxindex"] ];
            }
            
            echo wp_kses_stripslashes(Flipmag::blocks()->Module_3( $options, $query, FALSE ));
        }
        
        // Always die in functions echoing ajax content
        die();
    }

    public function flipmag_block_ajax_paginate() {

        // The $_REQUEST contains all the data sent via ajax
        if ( isset($_REQUEST) ) {

            $data = $_REQUEST['ajaxdata'];
            
            //query
            $query = $data["query"];
            
            //options
            $options = $data["options"];
            
            //pagination                
            if( $_REQUEST['page'] > 1 ){
                $paged = $_REQUEST['page'];
            }else{
                $paged = 0;
            }
            
            $query = array_merge( $query , array( 'paged' => $paged ) );
            
            $posts = new WP_Query( $query );
            
            $block = "post_".$data["block"];
            
            echo wp_kses_stripslashes(Flipmag::blocks()->$block( $options, $posts )); 
            
            
        }
        // Always die in functions echoing ajax content
       die();
    }
         
	/**
	 * Action callback: Add meta tags such as Google Authorship
	 */
	public function flipmag_add_header_meta()
	{
		global $post; // get current post

		if (is_single()) {
			
			$gplus = get_the_author_meta('gplus', $post->post_author);
			
			if ($gplus) {
				echo '<link href="' . esc_url($gplus) .'" rel="author" />';
			}
		}
	}
	
	/**
	 * Fontawesome based post format icon
	 */
	public function flipmag_post_format_icon() 
	{
		switch (get_post_format()) {
			
			case 'image':
			case 'gallery':
				$icon = 'fa-picture-o';
				break;
			
			case 'video';
				$icon = 'fa-play';
				break;
				
			case 'audio':
				$icon = 'fa-music';
				break;
				
			default:
				return '';
		}	
		
		return '<i class="fa ' . $icon .'"></i>';
	}
	
	/**
	 * Filter callback: Auto-embed video using a link
	 * 
	 * @param string $content
	 */
	public function flipmag_video_auto_embed($content) 
	{
		global $wp_embed;
		
		if (!is_object($wp_embed)) {
			return $content;
		}
		
		return $wp_embed->autoembed($content);
	}
	
	/**
	 * Filter callback: Fix search by limiting to posts
	 * 
	 * @param object $query
	 */
	public function flipmag_fix_search($query)
	{
		global $wp_query;
                
                if (!$query->is_search OR !$query->is_main_query()) {
			return $query;
		}
		
                // ignore if on bbpress and woocommerce - is_woocommerce() cause 404 due to using get_queried_object()
		if (is_admin() OR (function_exists('is_bbpress') && is_bbpress()) OR (function_exists('is_shop') && is_shop())) {
			return $query;
		}
                
		// limit it to posts
		$query->set('post_type', 'post');
		
		return $query;
	}
	
	/**
	 * Filter callback: Add custom per page limits where set for individual category
	 * 
	 * @param object $query
	 */
	public function flipmag_add_category_limits($query)
	{
		// bail out if incorrect query
		if (is_admin() OR !$query->is_category() OR !$query->is_main_query()) {
			return $query;
		}
		
		// permalinks have id or name?
		if ($query->get('cat')) {
			$category = get_category($query->get('cat'));
		}
		else {
			$category = get_category_by_slug($query->get('category_name'));	
		}
		
		// category meta
		$cat_meta = (array) Flipmag::options()->get('cat_meta_' . $category->term_id);
		
		// set user-specified per page
		if (!empty($cat_meta['per_page'])) {
			$query->set('posts_per_page', intval($cat_meta['per_page']));
		}
		
		return $query;
	}
	
	/**
	 * Filter callback: Remove unnecessary classes
	 */
	public function flipmag_fix_post_class($classes = array())
	{
		// remove hentry, we use schema.org
		$classes = array_diff($classes, array('hentry'));
		
		return $classes;
	}
	
	/**
	 * Filter callback: Add post types to page builder blocks
	 * 
	 * @param array $args  query args
	 * @param string|null $type 
	 * @param array|null $atts  shortcode attributes for this block
	 */
	public function flipmag_add_post_type($args, $type = null, $atts = null)
	{
		if (is_array($atts) && !empty($atts['post_type'])) {
			$args['post_type'] = array_map('trim', explode(',', $atts['post_type']));
		}
	
		return $args;
	}
	
	/**
	 * Filter callback: Add a wrapper to the content slideshow wrapper
	 * 
	 * @param string $content
	 */
	public function flipmag_add_post_slideshow_wrap($content)
	{
		if (is_single() && Flipmag::posts()->meta('content_slider') == 'ajax') {
			return '<div class="content-page">' . $content . '</div>';
		}
		
		return $content;
	}

	/**
	 * Filter callback: Add sticky class in post class
	 * 
	 */
	public function flipmag_sticky_class( $classes = array() ){
		if ( is_sticky() ) :
            $classes[] = 'sticky';            
        endif;
        return $classes;
	}
	
	/**
	 * Action callback: Add to list processed posts to handle duplicates
	 * 
	 * @param object $query
	 */
	public function flipmag_update_duplicate_posts(&$query)
	{
		// the query must enable logging
		if (empty($query->query_vars['handle_duplicates']) OR !did_action('flipmag_pre_main_content')) {
			return;
		}

		// add to list
		foreach ($query->posts as $post) 
		{
			$duplicates = (array) $this->registry['page_duplicate_posts'];
			array_push($duplicates, $post->ID); 
			
			$this->registry['page_duplicate_posts'] = $duplicates;
		}
	}
	
	/**
	 * Filter callback: Enable duplicate prevention on these query args
	 * 
	 * @param array $query  query arguments
	 */
	public function flipmag_add_duplicate_exclude($query) 
	{
		if (!is_front_page()) {
			return $query;
		}
		
		if (!isset($this->registry['page_duplicate_posts'])) {
			$this->registry['page_duplicate_posts'] = array();
		}
		
		$query['post__not_in'] = $this->registry['page_duplicate_posts'];
		$query['handle_duplicates'] = true;
				
		return $query;
	}
	
	/**
	 * Modify available options for Recent Tabs widget
	 * 
	 * @param array $options
	 */
	public function flipmag_tabbed_recent_options($options)
	{
		if (!empty($options['comments'])) {
			unset($options['comments']);
		}
		
		return $options;
	}	


	/**
	 * Filter callback: Add custom image sizes to the editor image size selection
	 * 
	 * @param array $sizes
	 */
	public function flipmag_add_image_sizes_editor($sizes) 
	{
		global $_wp_additional_image_sizes;
		
		if (empty($_wp_additional_image_sizes)) {
			return $sizes;
		}

		foreach ($_wp_additional_image_sizes as $id => $data) {

			if (in_array($id, array('flipmag-main-full', 'flipmag-main-slider', 'flipmag-main-block', 'flipmag-gallery-block')) && !isset($sizes[$id])) {
				$sizes[$id] = __('Theme - ', 'flipmag') . ucwords(str_replace('-', ' ', $id));
			}
		}
		
		return $sizes;
	}

	/**
	 * Filter callback: Set column for widgets where dynamic widths are set
	 * 
	 * @param array $params
	 * @see dynamic_sidebar()
	 */
	public function flipmag_set_footer_columns($params)
	{
		static $count = 0, $columns, $last_id;
		
		if (empty($columns)) {
			$columns = array(
				'main-footer' => $this->flipmag_parse_column_setting(Flipmag::options()->footer_columns)
			);
		}
		
		/**
		 * Set correct column class for each widget in footer
		 */
		
		$id = $params[0]['id'];
		
		// reset counter if last sidebar id was different than current
		if ($last_id != $id) {
			$count = 0;
		}
		
		// skip everything but these
		if (in_array($params[0]['id'], array('main-footer'))) {
			
			if (isset($columns[$id][$count])) {
				$params[0]['before_widget'] = str_replace('column', $columns[$id][$count], $params[0]['before_widget']);
			}
			
			$count++;	
		}
		
		$last_id = $id;
	
		return $params;	
	}	
	
	/**
	 * Parse columns of format 1/2+1/4+1/4 into an array of col-X
	 * 
	 * @param   array  $cols
	 * @return  array  Example: array('col-6', 'col-3', ...)
	 */
	public function flipmag_parse_column_setting($cols)
	{
		$columns = array();
		
		foreach (explode('+', $cols) as $col) 
		{			
			$col = explode('/', trim($col));
			
			if (!empty($col[0]) && !empty($col[1])) {
				
				$width = number_format($col[0] / $col[1], 2);
				
				// pre-parsed map to save computation time
				$map = array(
					'0.08' => 'col-1', '0.17' => 'col-2', '0.25' => 'col-3', '0.33' => 'col-4', 
					'0.42' => 'col-5', '0.50' => 'col-6', '0.58' => 'col-7', '0.67' => 'col-8', 
					'0.75' => 'col-9', '0.83' => 'col-10', '0.92' => 'col-11', '1.00' => 'col-12'
				);
				
				if (array_key_exists($width, $map)) {
					array_push($columns, $map[$width]);
				}
			}	
		}
		
		return $columns;
	}
	
	
	/**
	 * Action callback: Fix menu on sample import
	 * 
	 * @param object $import
	 */
	public function flipmag_import_fix_menu($import)
	{
		// remove an item from menu
		$item = get_page_by_title('Shop With Sidebar', OBJECT, 'nav_menu_item');
		
		if (is_object($item)) {
			wp_delete_post($item->ID);
		}
	}

	/**
	 * Custom Menu fields for the sample menu
	 * 
	 * @param array $values
	 */
	public function flipmag_import_menu_fields($values = array())
	{
            return array();
	}
}