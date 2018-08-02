<?php

/**
 * Deals with the basic initialization and core methods for theme
 * 
 * @package Flipmag
 */
class Flipmag_Core
{
	private $cache = array(
		'body_classes' => array()
	);
	
	public function init($options = array())
	{	
		$this->cache['options'] = $options;
		
		/*
		 * Setup framework internal functionality
		 */
		add_filter('flipmag-active-widgets', array($this, 'filter_widgets'));
		
		// initialize options and add to cache
		Flipmag::options()->set_config(array_merge(
			array(
				'meta_prefix'  => '_flipmag', 
				'theme_prefix' => strtolower($options['theme_name'])
			),
			$options
		))->init();
		
		if (isset($options['options']) && is_array($options['options'])) {
			Flipmag::options()->set($options['options']);
		}
		
		// initialize admin
		if (is_admin()) {
			$this->init_admin($options);
		}
		
		// init menu helper classes
		Flipmag::menus();
		
        $this->set_sidebar(Flipmag::options()->oc_default_sidebar);
                
                
		// set default style
		$this->add_body_class(Flipmag::options()->oc_layout_style);

		/*
		 * Add theme related functionality using the after_setup_theme hook
		 */
		add_action('after_setup_theme', array($this, 'setup'), 11);
		
		return $this;
	}
	
	/**
	 * Action callback: Setup theme related functionality at after_setup_theme hook
	 */
	public function setup()
	{
		$options = $this->cache['options'];
		
		// theme options
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('html5');
        add_theme_support( 'title-tag' );
        add_theme_support( 'custom-header' );
        add_theme_support( 'custom-background' );
		
		add_theme_support('post-formats', $options['post_formats']);
		
		// add body class filter
		add_filter('body_class', array($this, '_add_body_classes'));
		
		// add filter for excerpt 
		add_filter('excerpt_more', array(Flipmag::posts(), 'excerpt_read_more'));
		add_filter('the_content_more_link', array(Flipmag::posts(), 'excerpt_read_more'));
				
		// fix title on home page - with SEO plugins compatibilty
		add_filter('wp_title', array($this, '_fix_home_title'));
		
		// fix header sidebar
		add_action('get_header', array($this, '_set_header_options'));
		
		add_action('wp_head', array($this, '_add_header_code'), 100);
		add_action('wp_footer', array($this, '_add_footer_code'), 100);
		
		// add inline css
		add_action('wp_enqueue_scripts', array($this, '_add_inline_css'), 200);

		add_filter( 'style_loader_src', array($this,'remove_cssjs_ver'), 10, 2 );
		add_filter( 'script_loader_src', array($this,'remove_cssjs_ver'), 10, 2 );
	}
	
	/**
	 * Filter: Active widgets when Flipmag Widgets is enabled
	 * 
	 * @param array $widgets
	 */
	public function filter_widgets($widgets)
	{
		return $this->cache['options']['widgets'];
	}
	
	/**
	 * Initialize admin related classes
	 */
	private function init_admin($options)
	{		
		add_action('admin_enqueue_scripts', array($this, '_admin_assets'));

		Flipmag::factory('admin/options');
		Flipmag::factory('admin/meta-boxes');
		Flipmag::factory('admin/importer');
	}

	// Remove query string from static files
	function remove_cssjs_ver( $src ) {
		 if( strpos( $src, '?ver=' ) )
		 $src = remove_query_arg( 'ver', $src );

		 if( strpos( $src, '?v=' ) )
		 $src = remove_query_arg( 'v', $src );
		 return $src;
	}

	// callback function for assets
	public function _admin_assets()
	{
		wp_enqueue_style('flipmag-base', get_template_directory_uri() . '/admin/css/base.css');
	}

	/**
	 * Set current layout sidebar
	 * 
	 * @param string $type none or right
	 */
	public function set_sidebar($type)
	{
		$this->cache['sidebar'] = $type;                
		if ($type == 'right') {
			$this->add_body_class('right-sidebar');
			$this->remove_body_class('left-sidebar');
            $this->remove_body_class('no-sidebar');
		}
		else if ($type == 'left') {
			$this->add_body_class('left-sidebar');
            $this->remove_body_class('right-sidebar');
			$this->remove_body_class('no-sidebar');
		}
		else {
            $this->remove_body_class('left-sidebar');
			$this->remove_body_class('right-sidebar');
			$this->add_body_class('no-sidebar');
		}
		
		return $this;
	}
	
	/**
	 * Get current active sidebar value outside
	 */
	public function get_sidebar()
	{
		if (!array_key_exists('sidebar', $this->cache)) {
			return (string) Flipmag::options()->oc_default_sidebar;
		}
		
		return $this->cache['sidebar'];
	}
	
	/**
	 * Include main sidebar
	 * 
	 * @see get_sidebar()
	 */
	public function theme_sidebar()
	{
		if ($this->get_sidebar() !== 'none' && $this->get_sidebar() !== 'left' ) {
			get_sidebar();
		}            

		return $this;
	}
	
        
        public function theme_left_sidebar( $val )
	{
		if ( $val == 'left' || $this->get_sidebar() == 'left' ) {                        
			get_sidebar();                        
		}
		return $this;
	}
        
	/**
	 * Callback: Set the relevant header options for the theme such as sidebar
	 */
	public function _set_header_options()
	{
		// posts, pages, attachments etc.
		if (is_singular()) {
			
			wp_enqueue_script('comment-reply', null, null, null, true);
		
			// set layout
			$layout = Flipmag::posts()->meta('layout_style');

			if ($layout) {
				$this->set_sidebar(($layout == 'full' ? 'none' : $layout));
			}
		}
	}
	
	/**
	 * Add a custom class to body - MUST be called before get_header() in theme
	 * 
	 * @param string $class
	 */
	public function add_body_class($class)
	{
		$this->cache['body_classes'][] = esc_attr($class);
		return $this;
	}
	
	/**
	 * Remove body class - MUST be called before get_header() in theme
	 */
	public function remove_body_class($class)
	{
		foreach ($this->cache['body_classes'] as $key => $value) {
			if ($value === $class) {
				unset($this->cache['body_classes'][$key]);
			}
		}
		
		return $this;
	}
	
	/**
	 * Filter callback: Add stored classes to the body 
	 */
	public function _add_body_classes($classes)
	{
		return array_merge($classes, $this->cache['body_classes']);
	}
	
	/**
	 * Filter callback: Fix home title - stay compatible with SEO plugins
	 */
	public function _fix_home_title($title = '')
	{
		if (!is_front_page() && !is_home()) {
			return $title;
		}

		// modify only if empty
		if (empty($title)) {
			$title = get_bloginfo('name');
			$description = get_bloginfo('description');
			
			if ($description) {
				$title .= ' &mdash; ' . $description;
			} 
		}
		
		return $title;
	}
	
	/**
	 * Queue inline CSS to be added to the header 
	 * 
	 * @param string $script
	 * @param mixed $data
	 * @see wp_add_inline_style
	 */
	public function enqueue_css($script, $data)
	{
		$this->cache['inline_css'][$script] = $data;
	}
	
	/**
	 * Action callback: Add header from theme settings 
	 */
	public function _add_header_code()
	{
		if (Flipmag::options()->oc_header_custom_code) {
			echo '<script type="text/javascript">'.Flipmag::options()->oc_header_custom_code.'</script>';
		}
	}
	
	/**
	 * Action callback: Add footer from theme settings
	 */
	public function _add_footer_code()
	{
		if (Flipmag::options()->oc_footer_custom_code) {
			echo wp_kses_stripslashes(Flipmag::options()->oc_footer_custom_code);
		}
	}	
	
	/**
	 * Add any inline CSS that was enqueued properly using wp_add_inline_style()
	 */
	public function _add_inline_css()
	{		
		if (!array_key_exists('inline_css', $this->cache)) {
			return;
		}
		
		foreach ($this->cache['inline_css'] as $script => $data) {
			wp_add_inline_style($script, $data);
		}
	}
	
	/**
	 * Breadcrumbs
	 * 
	 * Adapted from http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
	 */
	public function breadcrumbs($options = array()) 
	{	
		global $post;
		
		// preliminary checks
		if (Flipmag::options()->oc_disable_breadcrumbs) {
			return;
		}
	
		$text['home']     = _x('Home', 'breadcrumbs', 'flipmag'); // text for the 'Home' link
		$text['category'] = __('Category: "%s"', 'flipmag'); // text for a category page
		$text['tax'] 	  = __('Archive for "%s"', 'flipmag'); // text for a taxonomy page
		$text['search']   = __('Search Results for "%s" Query', 'flipmag'); // text for a search results page
		$text['tag']      = __('Posts Tagged "%s"', 'flipmag'); // text for a tag page
		$text['author']   = __('Author: %s', 'flipmag'); // text for an author page
		$text['404']      = __('Error 404', 'flipmag'); // text for the 404 page
	
		$defaults = array(
			'show_current' => 1, // 1 - show current post/page title in breadcrumbs, 0 - don't show
			'show_on_home' => 0, // 1 - show breadcrumbs on the homepage, 0 - don't show
			'delimiter' => '<span class="delim"><i class="fa fa-angle-right"></i></span>',
			'before' => '<span class="current">',
			'after' => '</span>',
			
			'home_before' => '',
			'home_after' => '',
			'home_link' => home_url('/'),

			'link_before' => '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">',
			'link_after'  => '</span>',
			'link_attr'   => ' itemprop="url" ',
			'link_in_before' => '<span itemprop="title">',
			'link_in_after'  => '</span>',
			
			'text' => $text,
		);
		
		extract(apply_filters('flipmag_breadcrumbs_defaults', $defaults));
		
		$link = '<a itemprop="url" href="%1$s">' . $link_in_before . '%2$s' . $link_in_after . '</a>';
				
		// form whole link option
		$link = $link_before . $link . $link_after;

		if (isset($options['text'])) {
			$options['text'] = array_merge($text, (array) $options['text']);
		}

		// override defaults
		extract($options);

		// regex replacement
		$replace = $link_before . '<a' . $link_attr . '\\1>' . $link_in_before . '\\2' . $link_in_after . '</a>' . $link_after;
		
		/*
		 * Use bbPress's breadcrumbs when available
		 */
		if (function_exists('bbp_breadcrumb') && is_bbpress()) {
						
			$bbp_crumbs = 
				bbp_get_breadcrumb(array(
					'home_text' => $text['home'],
					'sep' => $delimiter,
					'sep_before' => '',
					'sep_after'  => '',
					'pad_sep' => 0,
					'before' => '<div class="breadcrumbs"><div class="wrap">' . $home_before,
					'after' => $home_after . '</div></div>',
					'current_before' => $before,
					'current_after'  => $after,
				));
			
			if ($bbp_crumbs) {
				echo wp_kses_stripslashes($bbp_crumbs);
				return;
			}
		}
		
		/*
		 * Use WooCommerce's breadcrumbs when available
		 */
		if (function_exists('woocommerce_breadcrumb') && (is_woocommerce() OR is_cart() OR is_shop())) {
			woocommerce_breadcrumb(array(
				'delimiter' => $delimiter,
				'before' => '',
				'after' => '',
				'wrap_before' => '<div class="breadcrumbs"><div class="wrap">' . $home_before,
				'wrap_after' => $home_after . '</div></div>',
				'home' => $text['home'],
			));
			
			return;
		}
		
		// normal breadcrumbs
		if ((is_home() || is_front_page())) {
			
			if ($show_on_home == 1) {
				echo '<div class="breadcrumbs"><div class="wrap">'. $home_before . '<a href="' . $home_link . '">' . $text['home'] . '</a>'. $home_after .'</div></div>';
			}
	
		} else {
	
			echo '<div class="breadcrumbs"><div class="wrap">' . $home_before . sprintf($link, $home_link, $text['home']) . $home_after . $delimiter;
			
			if (is_category() || is_tax()) 
			{
				$the_cat = get_category(get_query_var('cat'), false);
				
				// have parents?
				if ($the_cat->parent != 0) {
					
					$cats = get_category_parents($the_cat->parent, true, $delimiter);
					$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
					
					echo wp_kses_stripslashes($cats);
				}
								
				// print category
				echo wp_kses_stripslashes($before . sprintf((is_category() ? $text['category'] : $text['tax']), single_cat_title('', false)) . $after);
	
			}
			else if (is_search()) {
				
				echo wp_kses_stripslashes($before . sprintf($text['search'], get_search_query()) . $after);
	
			}
			else if (is_day()) {
				
				echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
					. sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter
					. $before . get_the_time('d') . $after;
	
			}
			else if (is_month()) {
				
				echo  sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter
					. $before . get_the_time('F') . $after;
	
			}
			else if (is_year()) {
				
				echo wp_kses_stripslashes($before . get_the_time('Y') . $after);
	
			}
			// single post or page
			else if (is_single() && !is_attachment()) {
				
				// custom post type
				if (get_post_type() != 'post') {
					
					$post_type = get_post_type_object(get_post_type());
					printf($link, get_post_type_archive_link(get_post_type()), $post_type->labels->name);
					
					if ($show_current == 1) {
						echo wp_kses_stripslashes($delimiter . $before . esc_html(get_the_title()) . $after);
					}
				}
				else {
					
					$cat = get_the_category();
					
					if ($cat) {
						$cats = get_category_parents($cat[0], true, $delimiter);
						
						if ($show_current == 0) {
							$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);	
						}
	
						$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
						
						echo wp_kses_stripslashes($cats);
						
						if ($show_current == 1) {
							echo wp_kses_stripslashes($before . esc_html(get_the_title()) . $after);
						}
					}
				}
	
			}
			elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {

				$post_type = get_post_type_object(get_post_type());				
				echo wp_kses_stripslashes($before . $post_type->labels->name . $after);	
			} 
			elseif (is_attachment()) {
				
				$parent = get_post($post->post_parent);
				$cat = current(get_the_category($parent->ID));
				$cats = get_category_parents($cat, true, $delimiter);
				
				if (!is_wp_error($cats)) {
					$cats = preg_replace('#<a([^>]+)>([^<]+)</a>#', $replace, $cats);
					echo wp_kses_stripslashes($cats);
				}
				
				printf($link, get_permalink($parent), $parent->post_title);
				
				if ($show_current == 1) {
					echo wp_kses_stripslashes($delimiter . $before . esc_html(get_the_title()) . $after);				}
	
			}
			elseif (is_page() && !$post->post_parent && $show_current == 1) {
	
				echo wp_kses_stripslashes($before . esc_html(get_the_title()) . $after);
	
			} 
			elseif (is_page() && $post->post_parent) {
				
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				
				while ($parent_id) {
					$page = get_post($parent_id);
					$breadcrumbs[] = sprintf($link, get_permalink($page->ID), esc_html(get_the_title($page->ID)));
					$parent_id  = $page->post_parent;
				}
				
				$breadcrumbs = array_reverse($breadcrumbs);
				
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					
					echo wp_kses_stripslashes($breadcrumbs[$i]);
					
					if ($i != count($breadcrumbs)-1) {
						echo wp_kses_stripslashes($delimiter);	
					}
				}
				
				if ($show_current == 1) {
					echo wp_kses_stripslashes($delimiter . $before . esc_html(get_the_title()) . $after);	
				}
	
			}
			elseif (is_tag()) {
				echo wp_kses_stripslashes($before . sprintf($text['tag'], single_tag_title('', false)) . $after);
	
			}
			elseif (is_author()) {
				
				global $author;
				
				$userdata = get_userdata($author);
				echo wp_kses_stripslashes($before . sprintf($text['author'], $userdata->display_name) . $after);
	
			}
			elseif (is_404()) {
				echo wp_kses_stripslashes($before . $text['404'] . $after);
			}
	
			// have pages?
			if (get_query_var('paged')) {
				
				if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {					
					echo sprintf( __(' (Page %s)', 'flipmag'), get_query_var('paged'));
				}
			}
	
			echo '</div></div>';
	
		}
	
	} // breadcrumbs() 
	
}