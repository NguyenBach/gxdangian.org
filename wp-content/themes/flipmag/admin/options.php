<?php
/**
 * Theme Settings - All the relevant options!
 * 
 * @uses Flipmag_Admin_Options::render_options()
 */

$shortname = "oc";

return apply_filters('flipmag_theme_options', array(
    
//------------------------------------------------------------------------------------------
//Welcome
//------------------------------------------------------------------------------------------

    array(
		'title' => __('Welcome', 'flipmag'),
		'id'    => 'options-welcome',
		'icon'  => 'dashicons-store',
		'sections' => array(
	
			array(
				'title'  => __('Thank You', 'flipmag'),				
				'fields' => array(
					array(
						'name'  => $shortname."_intro",
						'value' => '',
                                   'label' => '',
						'desc'  => sprintf( __("%s Thanks %s Thanks for using our theme, we had worked very hard to release a great product and we will do our absolute best to support this theme and fix all the issues. %s", 'flipmag'), "<div class='of-info'><h3 style=\"margin: 0 0 10px;\">", "</h3>", "</div>" ),							
						'type'  => 'info'						
					),
					
                                    )
			), // end section
	
			array(
				'title'  => __('About Theme', 'flipmag'),
				'fields' => array(
                                    
					array(
						'name'  =>  $shortname.'_theme_info',
						'value' => '',
						'label' => __('Theme Information', 'flipmag'),
						'desc'  => sprintf( __( 'Theme Name: %s %s Version: %s %s Author: %s Octo Creation %s %s Documentation URL : %s Documentation Here %s %s Demo URL : %s Demo Here %s Support URL : %s Support Here %s', 'flipmag'), THEMENAME , "<br>" , THEMEVERSION , "<br>" , '<a target="_blank" href="'.esc_url('http://octocreation.com').'">', "</a>", "<hr>", '<a target="_blank" href="'.esc_url('http://demo.octocreation.com/flipmag_demo/documentation').'">', "</a>", "<br>", '<a target="_blank" href="'.esc_url('http://demo.octocreation.com/flipmag_demo/preview/').'">', "</a><br>", '<a target="_blank" href="'.esc_url('http://support.octocreation.com/').'">' , '</a>' ),
						'type'  => 'info'
					),
					
				)
					
			), // end section
						
		), // end sections
	),
//------------------------------------------------------------------------------------------
//General Settings
//------------------------------------------------------------------------------------------ 
           
    array(
		'title' => __('General Settings', 'flipmag'),
		'id'    => 'options-tab-global',
		'icon'  => 'dashicons-admin-generic',
		'sections' => array(
			array(
                'title'  => __('Layout', 'flipmag'),
				'fields' => array(
			
                    array(
						'name'   => $shortname.'_predefined_style',
						'value' => '',
						'label' => __('Pre-defined Skin', 'flipmag'),
						'desc'  => __('Select a predefined skin or create your own customized one below.', 'flipmag'),
						'type'  => 'radio',
						'options' => array(
							'' => __('Default', 'flipmag'),
							'light' => __('Light Scheme (Light Nav, Sidebar, Footer)', 'flipmag'),
							'dark'  => __('Black Scheme (All Dark)', 'flipmag'),
						),
					),
	                array(
						'name'    =>  "css_body_margin_top",
						'label'   => __('Body margin from top', 'flipmag'),
	                    'value'   => 0,							
						'type'    => 'number',
						'css'   => array(
							'selectors' => array('.main-wrap' => 'margin-top: %spx !important;')
						),						
					),

					array(
						'name'    =>  "css_body_margin_bottom",
						'label'   => __('Body margin from bottom', 'flipmag'),
	                    'value'   => 0,							
						'type'    => 'number',
						'css'   => array(
							'selectors' => array('.main-wrap' => 'margin-bottom: %spx !important;')
						),					
					),
                )
			), // end section
	
			array(
				'title'  => __('Skin', 'flipmag'),
				'fields' => array(
                                    
                                    
					array(
						'name'   => $shortname.'_layout_style',
						'value' => 'full',
						'label' => __('Layout Style', 'flipmag'),
						'desc'  => __('Select whether you want a boxed or a full-width layout. It affects every page and the whole layout.', 'flipmag'),
						'type'  => 'radio',
						'options' => array(
							'full' => __('Full Width', 'flipmag'),
							'boxed' => __('Boxed', 'flipmag'),
						),
					),
                                    )
			), // end section
	
			array(
				'title'  => __('Sidebar', 'flipmag'),
				'fields' => array(

					array(
						'name' => $shortname.'_default_sidebar',
						'label'   => __('Default Sidebar', 'flipmag'),
						'value'   => 'right',
						'desc'    => __('Specify the sidebar to use by default. This can be overriden per-page or per-post basis when creating a page or post.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array('none' => __('No Sidebar', 'flipmag'), 'left' => __('Left Sidebar', 'flipmag'), 'right' => __('Right Sidebar', 'flipmag'))
					),
                                    
                                        array(
						'name'   => $shortname.'_sticky_sidebar',
						'value' => 0,
						'label' => __('Disable Sticky Sidebar', 'flipmag'),
						'desc'  => __('Disabling / Enabling sticky sidebar on scroll for both left and right sidebar.', 'flipmag'),
						'type'  => 'checkbox'
					),
                                    
                                     )
			), // end section

			array(
				'title'  => __('Section Header Style', 'flipmag'),
				'fields' => array(
					
					array(
						'name'   => $shortname.'_header_style',
						'value' => 'style-1',
						'label' => __('Header Style', 'flipmag'),
						'desc'  => __('Select the section header style you want to use.', 'flipmag'),
						'type'  => 'radio',
						'options' =>  array(
							'style-1' => __('Style 1', 'flipmag'),   
                            'style-2' => __('Style 2', 'flipmag'), 
                            'style-3' => __('Style 3', 'flipmag'), 
                            'style-4' => __('Style 4', 'flipmag'),
                            'style-5' => __('Style 5', 'flipmag'), 
                            'style-6' => __('Style 6', 'flipmag'),
                        )
					),					
					
				),
			), // end section

			array(
				'title'  => __('Responsive', 'flipmag'),
				'fields' => array(
					
					array(
						'name'   => $shortname.'_no_responsive',
						'value' => 0,
						'label' => __('Disable Responsive Layout', 'flipmag'),
						'desc'  => __('Disabling responsive layout means mobile phones and tablets will no longer see a better optimized design. Do not disable this unless really necessary.', 'flipmag'),
						'type'  => 'checkbox'
					),					
					
				),
			), // end section
             
						
		), // end sections
	),

//------------------------------------------------------------------------------------------
//Header
//------------------------------------------------------------------------------------------
    
    array(
		'title' => __('Header', 'flipmag'),
		'id'    => 'options-header',
		'icon'  => 'dashicons-welcome-widgets-menus',
		'sections' => array(

			array(
				'title'  => __('Header Layout', 'flipmag'),
				'fields' => array(
                                    
					array(
						'name' => $shortname.'_header_layout',
						'value' => 'header-1',
						'label' => __('Header Style', 'flipmag'),
						'desc'  => __('Select the header style you want to use.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array(
							'header-1' => __('Header 1 (Top Header)', 'flipmag'),
							'header-2' => __('Header 2 (Left Logo + Right Ad)', 'flipmag'),
							'header-3' => __('Header 3 (Left Logo + Right Ad with Stretch Navigation)', 'flipmag'),
							'header-4' => __('Header 4 (Centered Logo)', 'flipmag'),
							'header-5' => __('Header 5 (Centered Logo with Stretch Navigation)', 'flipmag'),
							'header-6' => __('Header 6', 'flipmag'),
							'header-7' => __('Header 7', 'flipmag'),
							'header-8' => __('Header 8', 'flipmag'),
						)
					),                
                )
			), // end section

			array(
			    'title'  => __('Logo', 'flipmag'),				
                        'fields'  => array(					                                   
                                        array(
						'name'    =>  $shortname.'_text_logo',
						'label'   => __('Logo Text', 'flipmag'),
						'desc'    => __('It will be used if logo images are not provided below.', 'flipmag'),
						'value'   => get_bloginfo('name'),
						'type'    => 'text',
					),
			
					array(
						'name'    =>  $shortname.'_image_logo',
						'label'   => __('Logo Image', 'flipmag'),
						'desc'    => __('By default, a text-based logo is created using your site title. But you can upload an image-based logo here.', 'flipmag'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'flipmag'), 
							'insert_label' => __('Use As Logo', 'flipmag')
						),
					),
					
					array(
						'name'    =>  $shortname.'_image_logo_retina',
						'label'   => __('Logo Image Retina (2x)', 'flipmag'),
						'desc'    => __('The retina version is 2x version of the same logo above. This will be used for higher resolution devices like iPhone. Requires WP Retina 2x plugin.', 'flipmag'),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'flipmag'), 
							'insert_label' => __('Use As Logo', 'flipmag')
						),
					),
                                
                    array(
						'name'    =>  $shortname."_logo_alt",
						'label'   => __('Logo alt attribute', 'flipmag'),
                                                'value'   => get_bloginfo('name'),
						'desc'    => sprintf(__('%s Alt attribute %s for the logo. This is the alternative text if the logo cannot be displayed. It\'s useful for SEO and generally is the name of the site.', 'flipmag') , '<a href="'.esc_url('http://www.w3schools.com/tags/att_img_alt.asp').'" target="_blank">', "</a>" ),
						'type'    => 'text'
					),
                                    
                    array(
						'name'    =>  $shortname."_logo_title",
						'label'   => __('Logo title attribute', 'flipmag'),
                                                'value'   => get_bloginfo('name'),
						'desc'    => sprintf(__("%s Title attribute %s for the logo. This attribute specifies extra information about the logo. Most browsers will show a tooltip with this text on logo hover.", 'flipmag'), "<a href=\"".esc_url('http://www.w3schools.com/tags/att_global_title.asp')."\" target=\"_blank\">", "</a>"),
						'type'    => 'text'
					),                                
                )
			), // end section
	
			array(
				'title'  => __('Breadcrumbs', 'flipmag'),
				'fields' => array(
                                    
					array(
						'name' => $shortname.'_disable_breadcrumbs',
						'value' => 0,
						'label' => __('Disable Breadcrumbs', 'flipmag'),
						'desc'  => __('Breadcrumbs are a hierarchy of links displayed below the main navigation. They are displayed on all pages but the home-page.', 'flipmag'),
						'type'  => 'checkbox',
					),
                                    )
			), // end section
	
			array(
				'title'  => __('Navigation', 'flipmag'),
				'fields' => array(
                                    
					array(
						'name' =>  $shortname."_sticky_nav",
						'value' => 1,
						'label' => __('Sticky Navigation', 'flipmag'),
						'desc'  => __('This makes navigation float at the top when the user scrolls below the fold - essentially making navigation menu always visible.', 'flipmag'),
						'type'  => 'checkbox',
					),
                                            
					array(
						'name' => $shortname.'_mobile_nav_search',
						'value' => 1,
						'label' => __('Enable Search on Mobile Menu', 'flipmag'),
						'desc'  => __('Disabling this will remove the search icon from the mobile navigation menu.', 'flipmag'),
						'type'  => 'checkbox',
					),                                    
                                                                    
                                        array(
						'name' => $shortname.'_mobile_menu_type',
						'value' => 'classic',
						'label' => __('Mobile Menu Type', 'flipmag'),
						'desc'  => __('Select the mobile menu you wish to use. The classic menu expands below the mobile navigation. The off-canvas menu appears in a mobile app style at the left side.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array(
							'classic' => __('Classic Menu', 'flipmag'),
							'off-canvas' => __('Off-Canvas Menu', 'flipmag')
						)
					),
                    array(
						'name'    =>  "css_nav_border_top",
						'label'   => __('Add top border width of navigation.', 'flipmag'),
	                    'value'   => 0,							
						'type'    => 'number',
						'css'   => array(
							'selectors' => array('.navigation ' => 'border-top-width: %spx;')
						),						
					),

					array(
						'name'    =>  "css_nav_border_bottom",
						'label'   => __('Add bottom border width of navigation.', 'flipmag'),
	                    'value'   => 0,							
						'type'    => 'number',
						'css'   => array(
							'selectors' => array('.navigation ' => 'border-bottom-width: %spx;')
						),					
					),
                )
			), // end section
	
			array(
				'title'  => __('Ticker Bar & News Ticker', 'flipmag'),
				'fields' => array(
                                    
                                        array(
						'name'  => $shortname.'_disable_tickerbar',
						'value' => 0,
						'label' => __('Disable Ticker Bar', 'flipmag'),
						'desc'  => __('Setting this to yes will disable the top bar element that appears above the logo area.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => $shortname.'_disable_tickerbar_ticker',
						'value' => 0,
						'label' => __('Disable News Ticker', 'flipmag'),
						'desc'  => __('Setting this to yes will disable the top bar news ticker', 'flipmag'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => $shortname.'_tickerbar_ticker_text',
						'value' => __('Trending', 'flipmag'),
						'label' => __('Topbar Ticker Text', 'flipmag'),
						'desc'  => __('Enter the text you wish to display before the headlines in the ticker.', 'flipmag'),
						'type'  => 'text'
					),
                                    
                                        array(
						'name'   => $shortname."_ticker_social_icon",
						'value' => 1,
						'label' => __('Show Social Icon', 'flipmag'),
						'desc'  => __('Show or hide the social icons in ticker.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
				)
					
			), // end section dashicons-editor-kitchensink
						
		), // end sections
	),
//------------------------------------------------------------------------------------------
//Footer
//------------------------------------------------------------------------------------------    
    array(
		'title' => __('Footer', 'flipmag'),
		'id'    => 'options-footer',
		'icon'  => 'dashicons-editor-kitchensink',
		'sections' => array(
	
			array(
				'title'  => __('Footer', 'flipmag'),				
				'fields' => array(
					array(
						'name'   => $shortname."_disable_footer",
						'value' => 1,
						'label' => __('Show Footer', 'flipmag'),
						'desc'  => __('Show or hide the footer.', 'flipmag'),
						'type'  => 'checkbox'
					),
                                 
                                        array(
						'name'   => $shortname."_footer_layout",
						'value' => 3,
						'label' => __('Show Footer', 'flipmag'),
						'desc'  => __('Show or hide the footer.', 'flipmag'),
						'type'  => 'images',
                                                "options" 	=> array(                                        
                                                    '4' 	=> ADMIN_DIR . 'images/footer-template/footer-4.png',
                                                    '3' 	=> ADMIN_DIR . 'images/footer-template/footer-3.png',
                                                    '2' 	=> ADMIN_DIR . 'images/footer-template/footer-2.png',
                                                    '1' 	=> ADMIN_DIR . 'images/footer-template/footer-1.png'
                                            )
					),
                                    )
			), // end section
	
			array(
				'title'  => __('Sub-Footer', 'flipmag'),
				'fields' => array(
                                    
                                    array(
						'name'   => $shortname."_disable_subfooter",
						'value' => 1,
						'label' => __('Show Sub-Footer', 'flipmag'),
						'desc'  => __('Show or hide the sub-footer.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
                                    array(
						'name'   => $shortname."_footer_copyright",
						'value' => "Powered by <a href=\"http://octocreation.com\">Octo Creation</a>",
						'label' => __('Footer Copyright Text', 'flipmag'),
						'desc'  => __('Set footer copyright text.', 'flipmag'),
						'type'  => 'text'
					),
					
                                    array(
						'name'   => $shortname."_subfooter_social_icon",
						'value' => 1,
						'label' => __('Show Social Icon', 'flipmag'),
						'desc'  => __('Show or hide the social icons in sub footer.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
                                    
				)
					
			), // end section
						
		), // end sections
	),
    
//------------------------------------------------------------------------------------------
//ADS
//------------------------------------------------------------------------------------------    
      array(
		'title' => __('Ads', 'flipmag'),
		'id'    => 'options-ads',
		'icon'  => 'dashicons-megaphone',
		'sections' => array(

			array(
		        'title'  => __('Header', 'flipmag'),				
		        'fields' => array(

	            array(
	                    'name'  => $shortname.'_ad_header_right',
	                    'value' => '',
	                    'label' => __('Hedaer Right', 'flipmag'),
	                    'desc'  => __('Paste your ad code here so its display header logo right side.', 'flipmag'),
	                    'type'  => 'textarea',
	                    'options' => array('cols' => 75, 'rows' => 5)
		                ),
		        )
		    ), // end section
	
			array(
				'title'  => __('Page', 'flipmag'),				
				'fields' => array(
					
                    array(
						'name'  => $shortname.'_ad_page_feature',
						'value' => '',
						'label' => __('Feature Section', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every page in feature section. ', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
					array(
						'name'   => $shortname.'_ad_page_before',
						'value' => '',
						'label' => __('Before Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every page in before the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
                                        array(
						'name'   => $shortname.'_ad_page_after',
						'value' => '',
						'label' => __('After Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every page in after the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
					
				)
					
			), // end section
                    
            array(
				'title'  => __('Post', 'flipmag'),				
				'fields' => array(
					
					array(
						'name'   => $shortname.'_ad_post_before',
						'value' => '',
						'label' => __('Before Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every post in before the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
                                        array(
						'name'   => $shortname.'_ad_post_after',
						'value' => '',
						'label' => __('After Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every post in after the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
					
				)
					
                            ), // end section
                    
                        array(
				'title'  => __('Sidebar', 'flipmag'),				
				'fields' => array(
					
					array(
						'name'   => $shortname.'_ad_sidebar_before',
						'value' => '',
						'label' => __('Before Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every left sidebar and right sidebar in before the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
                                        array(
						'name'   => $shortname.'_ad_sidebar_after',
						'value' => '',
						'label' => __('After Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every left sidebar and right sidebar in after the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
					
				)
					
                            ), // end section
                    
                        array(
				'title'  => __('Category', 'flipmag'),				
				'fields' => array(
					
                                        array(
						'name'   => $shortname.'_ad_cat_feature',
						'value' => '',
						'label' => __('Feature Section', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every category page in feature section.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
					array(
						'name'   => $shortname.'_ad_cat_before',
						'value' => '',
						'label' => __('Before Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every category page in before the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
                                        array(
						'name'   => $shortname.'_ad_cat_after',
						'value' => '',
						'label' => __('After Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every category page in after the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
					
				)
					
                ), // end section
                    
                        array(
				'title'  => __('Archive', 'flipmag'),				
				'fields' => array(
					
					array(
						'name'   => $shortname.'_ad_archive_before',
						'value' => '',
						'label' => __('Before Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every archive page in before the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
                                    
                                        array(
						'name'   => $shortname.'_ad_archive_after',
						'value' => '',
						'label' => __('After Content', 'flipmag'),
						'desc'  => __('Paste your ad code here so its display every archive page in after the content.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 5),
						'strip' => 'none',
					),
					
				)
					
                            ), // end section
						
		), // end sections
	),
    
    
//------------------------------------------------------------------------------------------
//Listing Layouts
//------------------------------------------------------------------------------------------ 
    
    array(
		'title' => __('Listing Layouts', 'flipmag'),
		'id'    => 'options-listing-layouts',
		'icon'  => 'dashicons-list-view',
		'sections' => array(
	
                        array(
				'title'  => __('Category Layout Style', 'flipmag'),
				'fields' => array(
                                    
                                        array(
						'name' => $shortname.'_category_sidebar',
						'label'   => __('Sidebar', 'flipmag'),
						'value'   => 'right',
						'desc'    => __('Specify the sidebar to use by default for category template.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array('none' => __('No Sidebar', 'flipmag'), 'left' => __('Left Sidebar', 'flipmag'), 'right' => __('Right Sidebar', 'flipmag'))
					),
                                    
					array(
						'name' => $shortname.'_category_template',
						'label'   => __('Category Listing Style', 'flipmag'),
						'value'   => 'block_1',
						'desc'    => __('This style is used while browsing category page.', 'flipmag'),
						'type'    => 'select',
						'options' =>  array(
                                                    'block_1' => __('Block 1', 'flipmag'),
                                                    'block_2' => __('Block 2', 'flipmag'),
                                                    'block_3'  => __('Block 3', 'flipmag'),
                                                    'block_4'  => __('Block 4', 'flipmag'),
                                                    'block_5'  => __('Block 5', 'flipmag'),
                                                    'block_6'  => __('Block 6', 'flipmag'),
                                                    'block_7'  => __('Block 7', 'flipmag'),
                                                    'block_8'  => __('Block 8', 'flipmag'),
                                                    'block_9'  => __('Block 9', 'flipmag'),
                                                    'block_10'  => __('Block 10', 'flipmag'),
                                                    'block_11'  => __('Block 11', 'flipmag'),
                                                    'block_12'  => __('Block 12', 'flipmag'),
                                                    'block_13'  => __('Block 13', 'flipmag'),
                                                    'block_14'  => __('Block 14', 'flipmag'),
                                                    'block_15'  => __('Block 15', 'flipmag'),
                                                    'block_16'  => __('Block 16', 'flipmag'),
                                                    'block_17'  => __('Block 17', 'flipmag'),
                                                    'block_18'  => __('Block 18', 'flipmag'),
                                                    'block_19'  => __('Block 19', 'flipmag'),                                                                                                       
						)
					),
				
                                        array(
						'name'   => $shortname.'_category_template_pagination',
						'value'  => 'normal',
						'label'  => __('Pagination Type', 'flipmag'),
						'desc'   => __('Sets pagination type on all category template.', 'flipmag'),
						'type'   => 'radio',
						'options' =>  array(                                                    
                                                    'normal' => __('Normal Pagination', 'flipmag'),                                                    
                                                    'infinite' => __('Infinite Scroll', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_animation',
						'value'  => '',
						'label'  => __('Listing Animation', 'flipmag'),
						'desc'   => __('Animation of listing for category page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    '' => __('None', 'flipmag'),
                                                    'fadeInDown animation' => __('Fade In Down', 'flipmag'),
                                                    'fadeInUp animation' => __('Fade In Up', 'flipmag'),
                                                    'fadeInLeft animation' => __('Fade In Left', 'flipmag'),
                                                    'fadeInRight animation' => __('Fade In Right', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_disable_date',
						'value'  => 'no',
						'label'  => __('Disable Date', 'flipmag'),
                        'desc'   => __('Disable date from category archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_date_format',
						'value'  => 'Y-m-d\TH:i:sP',
						'label'  => __('Date Format', 'flipmag'),
						'desc'   => __('Date Format of listing for category page block.When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                    '' => sprintf(__('JANUARY 25, %s', 'flipmag'), date('Y')),
                                    'F jS, Y' => sprintf(__('JANUARY 25TH, %s' , 'flipmag'), date('Y')),
                                    'j F, Y' => sprintf(__('25 JANUARY, %s' , 'flipmag'), date('Y')),
                                    'jS F, Y' => sprintf(__('25TH JANUARY, %s' , 'flipmag'), date('Y')),
                                    'M j, Y' => sprintf(__('JAN 25, %s' , 'flipmag'), date('Y')),
                                    'M jS, Y' => sprintf(__('JAN 25TH, %s', 'flipmag'), date('Y')),
                                    'j M, Y' => sprintf(__('25 JAN, %s' , 'flipmag'), date('Y')),
                                    'jS M, Y' => sprintf(__('25TH JAN, %s', 'flipmag'), date('Y')),
                                    'd-m-Y' => sprintf(__( '25-1-%s' , 'flipmag'), date('Y')),
                                    'd/m/Y' => sprintf(__( '25/1/%s' , 'flipmag'), date('Y')),
                                    'Y-m-d' => sprintf(__( '%s-1-25' , 'flipmag'), date('Y')),
                                    'Y/m/d' => sprintf(__( '%s/1/25' , 'flipmag'), date('Y')),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_date_link',
						'value'  => 'day',
						'label'  => __('Date Link', 'flipmag'),
						'desc'   => __('Date archive link url of listing for category page block. When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'day' => __('Day', 'flipmag'),
                                                    'month' => __('Month', 'flipmag'),
                                                    'year' => __('Year', 'flipmag'),
						)
					),
					
                                        array(
						'name'   => $shortname.'_category_template_disable_cat',
						'value'  => 'no',
						'label'  => __('Disable Category', 'flipmag'),
                        'desc'   => __('Disable category from category archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_disable_comment',
						'value'  => 'no',
						'label'  => __('Disable Comment', 'flipmag'),
                        'desc'   => __('Disable comment from category archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_disable_author',
						'value'  => 'no',
						'label'  => __('Disable Author', 'flipmag'),
                        'desc'   => __('Disable author from category archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_disable_excerpt',
						'value'  => 'no',
						'label'  => __('Disable Excerpt', 'flipmag'),
                        'desc'   => __('Disable excerpt from category archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'    =>  $shortname.'_category_template_excerpt_length',
						'label'   => __('Excerpt Length', 'flipmag'),
						'desc'    => __('If excerpt enable.', 'flipmag'),
						'value'   => '55',
						'type'    => 'number',
					),
                                    
                                        array(
						'name'   => $shortname.'_category_template_disable_more',
						'value'  => 'no',
						'label'  => __('Disable Read More (If excerpt enable)', 'flipmag'),
                                                'desc'    => __('(If excerpt enable)', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
					
                                    
				)
			), // end section
                    			
			array(
				'title'  => __('Archive Layout Style', 'flipmag'),
				'fields' => array(
                                    
                                        array(
						'name' => $shortname.'_archive_sidebar',
						'label'   => __('Sidebar', 'flipmag'),
						'value'   => 'right',
						'desc'    => __('Specify the sidebar to use by default for archive template.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array('none' => __('No Sidebar', 'flipmag'), 'left' => __('Left Sidebar', 'flipmag'), 'right' => __('Right Sidebar', 'flipmag'))
					),
                                    
					array(
						'name' => $shortname.'_archive_template',
						'label'   => __('Archive Listing Style', 'flipmag'),
						'value'   => 'block_1',
						'desc'    => __('This style is used while browsing archive page.', 'flipmag'),
						'type'    => 'select',
						'options' =>  array(
                                    'block_1' => __('Block 1', 'flipmag'),
                                    'block_2' => __('Block 2', 'flipmag'),
                                    'block_3'  => __('Block 3', 'flipmag'),
                                    'block_4'  => __('Block 4', 'flipmag'),
                                    'block_5'  => __('Block 5', 'flipmag'),
                                    'block_6'  => __('Block 6', 'flipmag'),
                                    'block_7'  => __('Block 7', 'flipmag'),
                                    'block_8'  => __('Block 8', 'flipmag'),
                                    'block_9'  => __('Block 9', 'flipmag'),
                                    'block_10'  => __('Block 10', 'flipmag'),
                                    'block_11'  => __('Block 11', 'flipmag'),
                                    'block_12'  => __('Block 12', 'flipmag'),
                                    'block_13'  => __('Block 13', 'flipmag'),
                                    'block_14'  => __('Block 14', 'flipmag'),
                                    'block_15'  => __('Block 15', 'flipmag'),
                                    'block_16'  => __('Block 16', 'flipmag'),
                                    'block_17'  => __('Block 17', 'flipmag'),
                                    'block_18'  => __('Block 18', 'flipmag'),
                                    'block_19'  => __('Block 19', 'flipmag'),                                                                                                       
						)
					),
				
                                        array(
						'name'   => $shortname.'_archive_template_pagination',
						'value'  => 'normal',
						'label'  => __('Pagination Type', 'flipmag'),
						'desc'   => __('Sets pagination type on all archive template.', 'flipmag'),
						'type'   => 'radio',
						'options' =>  array(                                                    
                                'normal' => __('Normal Pagination', 'flipmag'),
                                'infinite' => __('Infinite Scroll', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_animation',
						'value'  => '',
						'label'  => __('Listing Animation', 'flipmag'),
						'desc'   => __('Animation of listing for archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    '' => __('None', 'flipmag'),
                                                    'fadeInDown animation' => __('Fade In Down', 'flipmag'),
                                                    'fadeInUp animation' => __('Fade In Up', 'flipmag'),
                                                    'fadeInLeft animation' => __('Fade In Left', 'flipmag'),
                                                    'fadeInRight animation' => __('Fade In Right', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_disable_date',
						'value'  => 'no',
						'label'  => __('Disable Date', 'flipmag'),
                        'desc'   => __('Disable date from archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_date_format',
						'value'  => 'Y-m-d\TH:i:sP',
						'label'  => __('Date Format', 'flipmag'),
						'desc'   => __('Date Format of listing for archive page block.When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                            '' => sprintf(__('JANUARY 25, %s', 'flipmag'), date('Y')),
                            'F jS, Y' => sprintf(__('JANUARY 25TH, %s' , 'flipmag'), date('Y')),
                            'j F, Y' => sprintf(__('25 JANUARY, %s' , 'flipmag'), date('Y')),
                            'jS F, Y' => sprintf(__('25TH JANUARY, %s' , 'flipmag'), date('Y')),
                            'M j, Y' => sprintf(__('JAN 25, %s' , 'flipmag'), date('Y')),
                            'M jS, Y' => sprintf(__('JAN 25TH, %s', 'flipmag'), date('Y')),
                            'j M, Y' => sprintf(__('25 JAN, %s' , 'flipmag'), date('Y')),
                            'jS M, Y' => sprintf(__('25TH JAN, %s', 'flipmag'), date('Y')),
                            'd-m-Y' => sprintf(__( '25-1-%s' , 'flipmag'), date('Y')),
                            'd/m/Y' => sprintf(__( '25/1/%s' , 'flipmag'), date('Y')),
                            'Y-m-d' => sprintf(__( '%s-1-25' , 'flipmag'), date('Y')),
                            'Y/m/d' => sprintf(__( '%s/1/25' , 'flipmag'), date('Y')),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_date_link',
						'value'  => 'day',
						'label'  => __('Date Link', 'flipmag'),
						'desc'   => __('Date archive link url of listing for archive page block. When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'day' => __('Day', 'flipmag'),
                                                    'month' => __('Month', 'flipmag'),
                                                    'year' => __('Year', 'flipmag'),
						)
					),
					
                                        array(
						'name'   => $shortname.'_archive_template_disable_cat',
						'value'  => 'no',
						'label'  => __('Disable Category', 'flipmag'),
                        'desc'   => __('Disable category from archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_disable_comment',
						'value'  => 'no',
						'label'  => __('Disable Comment', 'flipmag'),
                        'desc'   => __('Disable comment from archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_disable_author',
						'value'  => 'no',
						'label'  => __('Disable Author', 'flipmag'),
                         'desc'   => __('Disable author from archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_disable_excerpt',
						'value'  => 'no',
						'label'  => __('Disable Excerpt', 'flipmag'),
                        'desc'   => __('Disable excerpt from archive page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'    =>  $shortname.'_archive_template_excerpt_length',
						'label'   => __('Excerpt Length', 'flipmag'),
						'desc'    => __('If excerpt enable.', 'flipmag'),
						'value'   => '55',
						'type'    => 'number',
					),
                                    
                                        array(
						'name'   => $shortname.'_archive_template_disable_more',
						'value'  => 'no',
						'label'  => __('Disable Read More (If excerpt enable)', 'flipmag'),
                                                'desc'    => __('(If excerpt enable)', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
					
                                    
				)
			), // end section                    
				
                    array(
				'title'  => __('Author Layout Style', 'flipmag'),
				'fields' => array(
                                    
                                        array(
						'name' => $shortname.'_author_sidebar',
						'label'   => __('Sidebar', 'flipmag'),
						'value'   => 'right',
						'desc'    => __('Specify the sidebar to use by default for author template.', 'flipmag'),
						'type'    => 'radio',
						'options' =>  array('none' => __('No Sidebar', 'flipmag'), 'left' => __('Left Sidebar', 'flipmag'), 'right' => __('Right Sidebar', 'flipmag'))
					),
                                    
					array(
						'name' => $shortname.'_author_template',
						'label'   => __('Author Listing Style', 'flipmag'),
						'value'   => 'block_1',
						'desc'    => __('This style is used while browsing author page.', 'flipmag'),
						'type'    => 'select',
						'options' =>  array(
                                                    'block_1' => __('Block 1', 'flipmag'),
                                                    'block_2' => __('Block 2', 'flipmag'),
                                                    'block_3'  => __('Block 3', 'flipmag'),
                                                    'block_4'  => __('Block 4', 'flipmag'),
                                                    'block_5'  => __('Block 5', 'flipmag'),
                                                    'block_6'  => __('Block 6', 'flipmag'),
                                                    'block_7'  => __('Block 7', 'flipmag'),
                                                    'block_8'  => __('Block 8', 'flipmag'),
                                                    'block_9'  => __('Block 9', 'flipmag'),
                                                    'block_10'  => __('Block 10', 'flipmag'),
                                                    'block_11'  => __('Block 11', 'flipmag'),
                                                    'block_12'  => __('Block 12', 'flipmag'),
                                                    'block_13'  => __('Block 13', 'flipmag'),
                                                    'block_14'  => __('Block 14', 'flipmag'),
                                                    'block_15'  => __('Block 15', 'flipmag'),
                                                    'block_16'  => __('Block 16', 'flipmag'),
                                                    'block_17'  => __('Block 17', 'flipmag'),
                                                    'block_18'  => __('Block 18', 'flipmag'),
                                                    'block_19'  => __('Block 19', 'flipmag'),                                                                                                       
						)
					),
				
                                        array(
						'name'   => $shortname.'_author_template_pagination',
						'value'  => 'normal',
						'label'  => __('Pagination Type', 'flipmag'),
						'desc'   => __('Sets pagination type on all author template.', 'flipmag'),
						'type'   => 'radio',
						'options' =>  array(                                                    
                                                    'normal' => __('Normal Pagination', 'flipmag'),                                                    
                                                    'infinite' => __('Infinite Scroll', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_animation',
						'value'  => '',
						'label'  => __('Listing Animation', 'flipmag'),
						'desc'   => __('Animation of listing for author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    '' => __('None', 'flipmag'),
                                                    'fadeInDown animation' => __('Fade In Down', 'flipmag'),
                                                    'fadeInUp animation' => __('Fade In Up', 'flipmag'),
                                                    'fadeInLeft animation' => __('Fade In Left', 'flipmag'),
                                                    'fadeInRight animation' => __('Fade In Right', 'flipmag')
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_disable_date',
						'value'  => 'no',
						'label'  => __('Disable Date', 'flipmag'),
                        'desc'   => __('Disable date from author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_date_format',
						'value'  => 'Y-m-d\TH:i:sP',
						'label'  => __('Date Format', 'flipmag'),
						'desc'   => __('Date Format of listing for author page block.When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                            '' => sprintf(__('JANUARY 25, %s', 'flipmag'), date('Y')),
                            'F jS, Y' => sprintf(__('JANUARY 25TH, %s' , 'flipmag'), date('Y')),
                            'j F, Y' => sprintf(__('25 JANUARY, %s' , 'flipmag'), date('Y')),
                            'jS F, Y' => sprintf(__('25TH JANUARY, %s' , 'flipmag'), date('Y')),
                            'M j, Y' => sprintf(__('JAN 25, %s' , 'flipmag'), date('Y')),
                            'M jS, Y' => sprintf(__('JAN 25TH, %s', 'flipmag'), date('Y')),
                            'j M, Y' => sprintf(__('25 JAN, %s' , 'flipmag'), date('Y')),
                            'jS M, Y' => sprintf(__('25TH JAN, %s', 'flipmag'), date('Y')),
                            'd-m-Y' => sprintf(__( '25-1-%s' , 'flipmag'), date('Y')),
                            'd/m/Y' => sprintf(__( '25/1/%s' , 'flipmag'), date('Y')),
                            'Y-m-d' => sprintf(__( '%s-1-25' , 'flipmag'), date('Y')),
                            'Y/m/d' => sprintf(__( '%s/1/25' , 'flipmag'), date('Y')),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_date_link',
						'value'  => 'day',
						'label'  => __('Date Link', 'flipmag'),
						'desc'   => __('Date archive link url of listing for author page block. When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'day' => __('Day', 'flipmag'),
                                                    'month' => __('Month', 'flipmag'),
                                                    'year' => __('Year', 'flipmag'),
						)
					),
					
                                        array(
						'name'   => $shortname.'_author_template_disable_cat',
						'value'  => 'no',
						'label'  => __('Disable Category', 'flipmag'),
                        'desc'   => __('Disable category from author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_disable_comment',
						'value'  => 'no',
						'label'  => __('Disable Comment', 'flipmag'),
                        'desc'   => __('Disable comment from author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_disable_author',
						'value'  => 'no',
						'label'  => __('Disable Author', 'flipmag'),
                        'desc'   => __('Disable author from author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_disable_excerpt',
						'value'  => 'no',
						'label'  => __('Disable Excerpt', 'flipmag'),
                        'desc'   => __('Disable excerpt from author page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
                                    
                                        array(
						'name'    =>  $shortname.'_author_template_excerpt_length',
						'label'   => __('Excerpt Length', 'flipmag'),
						'desc'    => __('If excerpt enable.', 'flipmag'),
						'value'   => '55',
						'type'    => 'number',
					),
                                    
                                        array(
						'name'   => $shortname.'_author_template_disable_more',
						'value'  => 'no',
						'label'  => __('Disable Read More (If excerpt enable)', 'flipmag'),
                        'desc'    => __('(If excerpt enable)', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'yes' => __('Yes', 'flipmag'),
                                                    'no' => __('No', 'flipmag'),
						)
					),
					
                                    
				)
			), // end section
                    
                    
		), // end sections
	),
    
//------------------------------------------------------------------------------------------
//Page/Post Settings
//------------------------------------------------------------------------------------------ 
    
	
	array(
		'title' => __('Page/Post Settings', 'flipmag'),
		'id'    => 'options-specific-pages',
		'icon'  => 'dashicons-admin-post',
		'sections' => array(
	
			array(
				'title'  => __('Single Post / Article Page', 'flipmag'),
				'fields' => array(

                                        array(
						'name' => $shortname.'_post_layout_template',
						'label'   => __('Default Posts Layout', 'flipmag'),
						'value'   => 'classic',
						'desc'    => __('Default single post layout to use, unless explicitly overriden in the post options.', 'flipmag'),
						'type'    => 'select',
						'options' =>  array(
							'classic' => __('Classic', 'flipmag'),
							'cover' => __('Post Cover', 'flipmag'),
                            'full-cover' => __('Post Full Cover', 'flipmag'),
							'classic-above' => __('Classic - Title First', 'flipmag'),
						)
					),
                                    
					array(
						'name'   => $shortname.'_lightbox_prettyphoto',
						'value'  => 1,
						'label'  => __('Enable prettyPhoto Lightbox', 'flipmag'),
						'desc'   => __('When enabled, prettyPhoto lightbox will auto-bind to images such as featured images, WordPress galleries etc.', 'flipmag'),
						'type'   => 'checkbox'
					),
			
					array(
						'name'   => $shortname.'_show_featured',
						'value'  => 1,
						'label'  => __('Show Featured', 'flipmag'),
						'desc'   => __('Disabling featured area will mean the featured image or video will no longer show at top of the article.', 'flipmag'),
						'type'   => 'checkbox'
					),
								
					array(
						'name'   => $shortname.'_show_tags',
						'value'  => 0,
						'label'  => __('Show Tags', 'flipmag'),
						'desc'   => __('Show tags below posts? We recommend using categories instead of tags.', 'flipmag'),
						'type'   => 'checkbox'
					),
					
					array(
						'name'  => $shortname.'_social_share',
						'value' => 1,
						'label' => __('Show Social Sharing', 'flipmag'),
						'desc'  => __('Show twitter, facebook, etc. share images beneath posts?', 'flipmag'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => $shortname.'_post_navigation',
						'value' => 1,
						'label' => __('Previous/Next Navigation?', 'flipmag'),
						'desc'  => __('Enabling this will add a Previous and Next post link in the single post page.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
					array(
						'name'  => $shortname.'_author_box',
						'value' => 1,
						'label' => __('Show Author Box', 'flipmag'),
						'desc'  => __('Setting to No will disable author box displayed below posts on post page.( author description require. )', 'flipmag'),
						'type'  => 'checkbox'
					),
                                    
                                        array(
						'name'   => $shortname.'_post_date_format',
						'value'  => 'Y-m-d\TH:i:sP',
						'label'  => __('Date Format', 'flipmag'),
						'desc'   => __('Date Format of listing for post page block.When date is enable.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                            '' => sprintf(__('JANUARY 25, %s', 'flipmag'), date('Y')),
                            'F jS, Y' => sprintf(__('JANUARY 25TH, %s' , 'flipmag'), date('Y')),
                            'j F, Y' => sprintf(__('25 JANUARY, %s' , 'flipmag'), date('Y')),
                            'jS F, Y' => sprintf(__('25TH JANUARY, %s' , 'flipmag'), date('Y')),
                            'M j, Y' => sprintf(__('JAN 25, %s' , 'flipmag'), date('Y')),
                            'M jS, Y' => sprintf(__('JAN 25TH, %s', 'flipmag'), date('Y')),
                            'j M, Y' => sprintf(__('25 JAN, %s' , 'flipmag'), date('Y')),
                            'jS M, Y' => sprintf(__('25TH JAN, %s', 'flipmag'), date('Y')),
                            'd-m-Y' => sprintf(__( '25-1-%s' , 'flipmag'), date('Y')),
                            'd/m/Y' => sprintf(__( '25/1/%s' , 'flipmag'), date('Y')),
                            'Y-m-d' => sprintf(__( '%s-1-25' , 'flipmag'), date('Y')),
                            'Y/m/d' => sprintf(__( '%s/1/25' , 'flipmag'), date('Y')),
						)
					),
                                    
                                        array(
						'name'   => $shortname.'_post_date_link',
						'value'  => 'day',
						'label'  => __('Date Link', 'flipmag'),
						'desc'   => __('Date archive link url of listing for post page block.', 'flipmag'),
						'type'   => 'select',
						'options' =>  array(
                                                    'day' => __('Day', 'flipmag'),
                                                    'month' => __('Month', 'flipmag'),
                                                    'year' => __('Year', 'flipmag'),
						)
					),
					
				)
			), // end section
			
						
			array(
				'title'  => __('Related Posts', 'flipmag'),
				'fields' => array(	
			
					array(
						'name'  => $shortname.'_related_posts',
						'value' => 1,
						'label' => __('Show Related Posts', 'flipmag'),
						'desc'  => __('Setting to No will disable the related posts that appear on the single post page.', 'flipmag'),
						'type'  => 'checkbox'
					),
					
					
					array(
						'name'  => $shortname.'_related_posts_by',
						'value' => 'cats',
						'label' => __('Related Posts By', 'flipmag'),
						'desc'  => __('By default, related posts will be displayed by finding posts based on the categories of post being viewed. You can change it to tags.', 'flipmag'),
						'type'  => 'select',
						'options' => array(
							'cats' => __('Categories', 'flipmag'), 'tags' => __('Tags', 'flipmag')
						)
					),
					
				)
			),
						                    
             array(
				'title'  => __('comment', 'flipmag'),
				'fields' => array(					

					array(
						'name'  => $shortname.'_comment_posts',
						'value' => 0,
						'label' => __('Disable comments on posts', 'flipmag'),
						'desc'  => __('Enable or disable the comments for post, on the entire site. This option is disabled by default.', 'flipmag'),
						'type'  => 'checkbox'
					),			
			
				)
			) // end section
						
		), // end sections
	),

//------------------------------------------------------------------------------------------
//Typography
//------------------------------------------------------------------------------------------ 
	
	array(
		'title' => __('Typography', 'flipmag'),
		'id'    => 'options-typography',
		'icon'  => 'dashicons-editor-spellcheck',
		'sections' => array(
	
			array(
				'title'  => __('General', 'flipmag'),
				'fields' => array(
                   array(
                        'label' => '',
						'name'  => $shortname."_intro",
						'value' => '',
						'desc'  => sprintf(__('%s Selecting a font will show a basic preview. Go to %s google fonts directory %s for more details. It is highly recommended that you choose fonts that have similar heights to the default fonts to maintain pleasing aesthetics. %s',
								'flipmag'), '<div class="of-info">','<a href="'.esc_url('http://www.google.com/webfonts').'" target="_blank">', '</a>', '</div>'),
						'type'  => 'info'						
					),
                                    
                                    
					array(
						'name'   =>  'css_main_font',
						'value' => 'Open Sans',
						'label' => __('Main Font Family', 'flipmag'),
						'desc'  => __('This effects almost every element on the theme. Please use a family that has regular, semi-bold and bold style. You may want to set the same for "Blog Post & Pages Body" too.', 'flipmag'),
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'body, .main .sidebar .widgettitle, .tabbed .tabs-list, h3.gallery-title, .comment-respond small, .main-heading, .gallery-title, .section-head, .main-footer .widgettitle, .entry-title, .page-title'
						),
						'families' => true,
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),
					),
					
					array(
						'name'   =>  'css_heading_font',
						'value' => 'Open Sans',
						'label' => __('Contrast Font Family', 'flipmag'),
						'desc'  => __('This font will apply to mainly post headlines in post pages, slider, homepage, etc.', 'flipmag'),
						'type'  => 'typography',
						'css'   => array(
							'selectors' => 'h1, h2, h3, h4, h5, h6, .gallery-block .carousel .title a, .list-timeline .posts article, .posts-list .content > a, .block.posts a, 
								#bbpress-forums .bbp-topic-title, #bbpress-forums .bbp-forum-title, .bbpress.single-topic .main-heading, .navigate-posts .link'
						),
						'families' => true,						
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),
					),
					
					array(
						'name'   =>  'css_post_body_font',
						'value' => 'Open Sans',
						'label' => __('Blog Post & Pages Body', 'flipmag'),
						'desc'  => __('Pages and blog posts body can also use a font of your choice. Readability is cruicial. Choose wisely.', 'flipmag'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.post-content'),
						'families' => true,						
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),						
					),
					
					array(
						'name'   =>  'css_navigation_font',
						'value' => 'Open Sans',
						'label' => __('Navigation Font', 'flipmag'),
						'desc'  => __('Change the font used in the navigation menu.', 'flipmag'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.navigation .menu'),
						'families' => true,
						//'size'  => array('value' => 13),
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),	
					),
					
					array(
						'name'   =>  'css_post_title_font',
						'value' => 'Open Sans',
						'label' => __('Pages & In-Post Headings', 'flipmag'),
						'desc'  => __('Changing this will affect the font used for pages heading and heading h1-h6 used within posts or default template pages.', 'flipmag'),
						'type'  => 'typography',
						'css'   => array('selectors' => '.post-header h1, .post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6, .oc-block .content > a > h3'),
						'families' => true,	
						'suggested' => array(
							'Open Sans' => 'Open Sans',
							'PT Sans' => 'PT Sans',
							'Lato' => 'Lato',
							'Roboto' => 'Roboto',
							'Merriweather Sans' => 'Merriweather Sans',
							'Ubuntu' => 'Ubuntu'							
						),	
					),
					
				),
			), // end section
			
			array(
				'title'  => __('Content Heading Sizes', 'flipmag'),				
								
				'fields' => array(
                    array(
                        'label' => '',
						'name'  => $shortname."_intro",
						'value' => '',						
						'desc'  => sprintf(__('%s These sizes affects the heading of fonts used within posts. %s', 'flipmag'), '<div class="of-info">', '</div>' ),
						'type'  => 'info'						
					),
					array(
						'name'   =>  'css_post_h1',
						'value' =>  24,
						'label' => __('H1 Size', 'flipmag'),
						'desc'  => __('h1 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h1' => 'font-size: %spx;')
						),
					),
					
					array(
						'name'   =>  'css_post_h2',
						'value' => 21,
						'label' => __('H2 Size', 'flipmag'),
						'desc'  => __('h2 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h2' => 'font-size: %spx;')
						),
					),
					
					array(
						'name'   =>  'css_post_h3',
						'value' => 18,
						'label' => __('H3 Size', 'flipmag'),
						'desc'  => __('h3 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h3' => 'font-size: %spx;')
						),
					),
					
					array(
						'name'   =>  'css_post_h4',
						'value' => 16,
						'label' => __('H4 Size', 'flipmag'),
						'desc'  => __('h4 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h4' => 'font-size: %spx;')
						),
					),
					
					array(
						'name'   =>  'css_post_h5',
						'value' => 15,
						'label' => __('H5 Size', 'flipmag'),
						'desc'  => __('h5 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h5' => 'font-size: %spx;')
						),
					),
					
					array(
						'name'   =>  'css_post_h6',
						'value' => 14,
						'label' => __('H6 Size', 'flipmag'),
						'desc'  => __('h6 size for in-post headings.', 'flipmag'),
						'type'  => 'number',
						'css'   => array(
							'selectors' => array('.post-content h6' => 'font-size: %spx;')
						),
					),					
				),
			), // end section
			
			array(
				'title' => __('Advanced', 'flipmag'),
				'fields' => array(
					array(
						'name' =>  'font_charset',
						'label'   => __('Font Character Set', 'flipmag'),
						'value'   => '',
						'desc'    => __('For some languages, you will need an extended character set. Please note, not all fonts will have the subset. Check the google font to make sure.', 'flipmag'),
						'type'    => 'checkbox',
						'multiple' => array(
							'latin' => __('Latin', 'flipmag'),
							'latin-ext' => __('Latin Extended', 'flipmag'),
							'cyrillic'  => __('Cyrillic', 'flipmag'),
							'cyrillic-ext'  => __('Cyrillic Extended', 'flipmag'),
							'greek'  => __('Greek', 'flipmag'),
							'greek-ext' => __('Greek Extended', 'flipmag'),
							'vietnamese' => __('Vietnamese', 'flipmag'),
						),
					),
				
				),
			),
						
		), // end sections
	),
//------------------------------------------------------------------------------------------
//Style & Color
//------------------------------------------------------------------------------------------ 
		
	array(
		'title' => __('Style & Color', 'flipmag'),
		'id'    => 'options-style-color',
		'icon'  => 'dashicons-admin-appearance',
		'sections' => array(
	
			array(
				//'title'  => __('Defaults', 'flipmag'),
				'id' => 'defaults',
				'fields' => array(
					
					
					array(
						'label' => __('Reset Colors', 'flipmag'),
						'desc'  => __('Clicking this button will reset all the color settings below to the default color settings.', 'flipmag'),
						'type'  => 'html',
						'html' => "<input type='submit' class='button' id='reset-colors' name='reset-colors' data-confirm='" 
								. __('Do you really wish to reset colors to defaults?', 'flipmag') . "' value='". __('Reset Colors', 'flipmag') ."' />",
					),
				)
			), // end section
			
			array(
				'title' => __('General', 'flipmag'),
				'fields' => array(		
					array(
						'name'  => 'css_main_color',
						'value' => '#4db2ec',
						'label' => __('Theme Color', 'flipmag'),
						'desc'  => __('It is the contrast color for the theme. It will be used for all links, menu, category overlays, main page and many contrasting elements.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
									'::selection' => 'background: %s',
									':-moz-selection' => 'background: %s',
									
									'.breadcrumbs .location, .news-focus .heading, .gallery-title, 
									.news-focus .heading .subcats a.active, .post-content a, .comments-list .bypostauthor .comment-author a, .error-page 
									.text-404, .main-color, .section-head.prominent, .block.posts .fa-angle-right, a.bbp-author-name, .main-stars span:before,
									.main-stars, .recentcomments  .url, .oc-block .block-ajax-loading i,.module-3 .dropbtn:hover, .module-1 .dropbtn:focus, .module-3 .dropdown-content a
                                                                        ' 
										=> 'color: %s',

									'.gallery-title, .section-head, .navigation .menu > li:hover > a, .navigation .menu >.current-menu-item > a, .navigation .menu > .current-menu-parent > a,
									.navigation .menu > .current-menu-ancestor > a, .tabbed .tabs-list .active a,  
									.comment-content .reply, .sc-tabs .active a, .oc-module.module-4 .tab-links,.widget-title.style-1, .widget-title.style-2, .widget-title.style-1' 
										=> 'border-bottom-color: %s',

									'.widget-title.style-3, .widget-title.style-4' 
										=> 'border-color: %s',
										
									'.trending-ticker .heading, .main-featured .cat, .main-featured .pages .flex-active,
									.main-pagination .current, .main-pagination a:hover, .cat-title, .sc-button-default:hover, .drop-caps,
									.overall, .post .read-more a, .button, .post-pagination > span, .post-header .cats a , .main-pagination .current, .main-pagination ul li.disabled a, .main-pagination a:hover,  #comment-submit:hover, .oc-module.module-4 .tab-links li.active a, .widget-title.style-1 > span, .widget-title.style-5 > span, .widget-title.style-6  ' 
										=> 'background: %s',
									
									'.widget-title, .page-content .widget-title, .single-post .widget-title, .post-content .wpcf7-not-valid-tip, .main-heading, .post-header .post-title:before, 
									.highlights h2:before, div.bbp-template-notice, div.indicator-hint, div.bbp-template-notice.info, 
									.modal-header .modal-title, .entry-title, .page-title' 
										=> 'border-bottom-color: %s',

									'@media only screen and (max-width: 799px) { .navigation .mobile .fa' 
										=> 'background: %s',
							),
						)
					),
					
					
					array(
						'name'  => 'css_body_bg_color',
						'value' => '#e5e5e5',
						'label' => __('Body Background Color', 'flipmag'),
						'desc'  => __('Use light colors only in non-boxed layout. Setting a body background image below will override it.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'body, body.boxed' => 'background-color: %s;',
							),
						)
					),
					
					array(
						'name'  => 'css_body_bg',
						'value' => '',
						'label' => __('Body Background', 'flipmag'),
						'desc'  => __('Use light patterns in non-boxed layout. For patterns, use a repeating background. Use photo to fully cover the background with an image. Note that it will override the background color option.', 'flipmag'),
						'css' => array(
							'selectors' => array(
								'body' => 'background-image: url(%s);',
								'body.boxed' => 'background-image: url(%s);',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'flipmag'), 
							'button_label' => __('Upload Image',  'flipmag'),
							'insert_label' => __('Use as Background',  'flipmag')
						),
						'bg_type' => array('value' => 'cover'),
					),

					array(
						'name'  => 'css_main_content_bg',
						'value' => '#fff',
						'label' => __('Main Content Background Color', 'flipmag'),
						'desc'  => __('Use main content backgroud color for all pages and posts.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-wrap > .main ' => 'background-color: %s;',
							),
						)
					),
					
					array(
						'name'  => 'css_post_text_color',
						'value' => '#606569',
						'label' => __('Posts Main Text Color', 'flipmag'),
						'desc'  => __('Text color applies to body text of posts and pages.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_listing_text_color',
						'value' => '#949697',
						'label' => __('Blocks Excerpt Color', 'flipmag'),
						'desc'  => __('Text color applies to excerpt text displayed on homepage blocks and category listings.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.highlights .excerpt, .oc-block .excerpt' => 'color: %s !important',
							),
						)
					),
					
					array(
						'name'  => 'css_headings_text_color',
						'value' => '#000000',
						'label' => __('Main Headings Color', 'flipmag'),
						'desc'  => __('Applies to headings such as main post/page heading and all the in-post headings.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'h1, h2, h3, h4, h5, h6' => 'color: %s',
								'.post-content h1, .post-content h2, .post-content h3, .post-content h4, .post-content h5, .post-content h6' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_links_color',
						'value' => '#4db2ec',
						'label' => __('Posts Link Color', 'flipmag'),
						'desc'  => __('Changes all the links color within posts and pages.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content a' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_links_hover_color',
						'value' => '#19232d',
						'label' => __('Posts Link Hover Color', 'flipmag'),
						'desc'  => __('This color is applied when you mouse-over a certain link.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.post-content a:hover' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_slider_bg_color',
						'value' => '#f2f2f2',
						'label' => __('Featured Slider Background Color', 'flipmag'),
						'desc'  => __('Setting a body background pattern below will override it.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-featured' => 'background-color: %s; background-image: none;',
							),
						)
					),
					
					array(
						'name'  => 'css_slider_bg_pattern',
						'value' => '',
						'label' => __('Featured Slider Background', 'flipmag'),
						'desc'  => __('Please use a background pattern that can be repeated. Note that it will override the background color option.', 'flipmag'),
						'css' => array(
							'selectors' => array(
								'.main-featured' => 'background-image: url(%s);',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'flipmag'), 
							'button_label' => __('Upload Image',  'flipmag'),
							'insert_label' => __('Use as Background',  'flipmag')
						),
						'bg_type' => array('value' => 'repeat'),
					),
				),
			), // end section
			
			array(
				'title' => __('Header & Navigation Menu', 'flipmag'),
				'fields' => array(
			
					array(
						'name'  => 'css_menu_bg_color',
						'value' => '#4db2ec',
						'label' => __('Main Menu Background Color', 'flipmag'),
						'desc'  => __('Menu background affects the top-level background only.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation, .navigation.sticky' => 'background-color: %s;',
                                                                '.menu-ajax-loading' => 'color: %s;',
								'@media only screen and (max-width: 799px) { .navigation .menu > li:hover > a, .navigation .menu > .current-menu-item > a, 
								.navigation .menu > .current-menu-parent > a' 
									=> 'background-color: %s;',								
							),
						)
					),
					
					array(
						'name'  => 'css_menu_drop_bg',
						'value' => '#4db2ec',
						'label' => __('Menu Dropdowns Background Color', 'flipmag'),
						'desc'  => __('Menu background color is only used when a background pattern is not specified below.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'@media only screen and (min-width: 799px) { .navigation .mega-menu, .navigation .menu ul' => 'background-color: %s;',

								//'@media only screen and (max-width: 799px) { .navigation .mega-menu.links > li:hover'
								//	=> 'background-color: %s;',
							),
						)
					),									
					
					array(
						'name'  => 'css_menu_big_border_color',
						'value' => '#00aeef',
						'label' => __('Menu Border Below', 'flipmag'),
						'desc'  => __('Navigation sub menu has a 3 pixel border below it. Changing this color will only affect that border.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation, .navigation .mega-menu, .navigation .menu ul' => 'border-color: %s;', 
							),
						)
					),
					
                   array(
						'name'  => 'css_menu_link_color',
						'value' => '#efefef',
						'label' => __('Header Menu Text Color', 'flipmag'),
						'desc'  => __('Applies to top menu items. Does not apply to drop down.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation .menu > li > a' => 'color: %s;',
							),
						)
					),

                    array(
						'name'  => 'css_header_background',
						'value' => '#efefef',
						'label' => __('Header Background', 'flipmag'),
						'desc'  => __('Applies to header background color.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-head' => 'background-color: %s;',
							),
						)
					),

					array(
						'name'  => 'css_nav_border',
						'value' => '#dddddd',
						'label' => __('Navigation Border Color', 'flipmag'),
						'desc'  => __('Applies to navigation border color.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.navigation' => 'border-color: %s;',
							),
						)
					),
                                    
					array(
						'name'  => 'css_menu_text_color',
						'value' => '#2a3746',
						'label' => __('Menu Text Color', 'flipmag'),
						'desc'  => __('Applies to drop down items. ', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								' .mega-menu .heading, .mega-menu .featured h2 a, .menu .cart-widget .total,'
                                . ' .menu .shopping-cart .product_list_widget .quantity, .menu .shopping-cart .product_list_widget li a,'
                                . '.navigation li li a ' => 'color: %s;',
							),
						)
					),

                    array(
                        'name'  => 'css_mobile_menu_background_color',
                        'value' => '#4db2ec',
                        'label' => __('Mobile Menu Background Color', 'flipmag'),
                        'desc'  => __('Applies to mobile menu drop down background.', 'flipmag'),
                        'type' => 'color',
                        'css' => array(
                            'selectors' => array(
                                '@media only screen and (max-width: 799px) { .navigation .mobile-menu.active, .navigation .off-canvas ' => 'background-color: %s;',
                            ),
                        )
                    ),
					
				),
			), // end section
			
                        array(
				'title' => __('Ticker Bar & Sticky Post', 'flipmag'),
				'fields' => array(
			
					array(
						'name'  => 'css_ticker_bg_color',
						'value' => '#202224',
						'label' => __('Ticker Bar Background', 'flipmag'),
						'desc'  => __('Ticker Bar background color affects  for all page.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.ticker-bar' => 'background-color: %s;',
							),
						)
					),

					array(
						'name'  => 'css_ticker_link_color',
						'value' => '#efefef',
						'label' => __('Ticker Bar Link Color', 'flipmag'),
						'desc'  => __('Change color of posts link in ticker bar.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.ticker-bar-content a' => 'color: %s',
							),
						)
					),

					array(
						'name'  => 'css_sticky_bg_color',
						'value' => '#d8e7ff',
						'label' => __('Sticky Post Background', 'flipmag'),
						'desc'  => __('Sticky Post change background color for all block as well as module.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.oc-block.block-1 .sticky, .oc-block.block-2 .sticky, .oc-block.block-3 li.sticky, .oc-block.block-4 li.sticky, .oc-block.block-5 li.sticky, .oc-block.block-6 li.sticky, .oc-block.block-7 .sticky, .oc-block.block-8 .sticky, .oc-block.block-9 .sticky, .oc-block.block-10 .sticky, .oc-block.block-11 .sticky, .oc-block.block-12 .sticky, .oc-block.block-13 .sticky, .oc-block.block-14 .sticky .content, .oc-block.block-15 .sticky .content, .oc-block.block-16 .sticky .content, .oc-block.block-17  .sticky .content, .oc-block.block-18 .sticky .content, .oc-block.block-19 .sticky .content, .oc-block.block-20 .sticky' => 'background: %s;',
							),
						)
					),				
				),
			), // end section
                    
                        array(
				'title' => __('Breadcrumbs', 'flipmag'),
				'fields' => array(
			
					array(
						'name'  => 'css_breadcrumbs_bg_color',
						'value' => '#202224',
						'label' => __('Breadcrumbs Background', 'flipmag'),
						'desc'  => __('Breadcrumbs background color affects  for all page.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.breadcrumbs' => 'background-color: %s;',
							),
						)
					),

					array(
						'name'  => 'css_breadcrumbs_link_color',
						'value' => '#efefef',
						'label' => __('Breadcrumbs Link Color', 'flipmag'),
						'desc'  => __('Change color of posts link in breadcrumbs.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.breadcrumbs a' => 'color: %s',
							),
						)
					),
                                    
                                        array(
                                    		'name'  => 'css_breadcrumbs_text_color',
						'value' => '#8d97a1',
						'label' => __('Breadcrumbs Text Color', 'flipmag'),
						'desc'  => __('Change color of delimiter and current page/post text color  in breadcrumbs.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.breadcrumbs, .breadcrumbs .delim' => 'color: %s',
							),
						)
					),
				),
			), // end section
                    
			array(
				'title' => __('Main Sidebar', 'flipmag'),
				'fields' => array(
			
					array(
						'name'  => 'css_sidebar_heading_bg_color',
						'value' => '#19232d',
						'label' => __('Sidebar Heading Background', 'flipmag'),
						'desc'  => __('Sidebar heading background color affects all the headings in the main sidebar.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main .sidebar .widgettitle, .tabbed .tabs-list' => 'background-color: %s;',
							),
						)
					),

					array(
						'name'  => 'css_sidebar_heading_color',
						'value' => '#efefef',
						'label' => __('Sidebar Heading Color', 'flipmag'),
						'desc'  => __('Change color of headings/widget titles in the main sidebar.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main .sidebar .widgettitle, .tabbed .tabs-list a' => 'color: %s',
							),
						)
					),					
				),
			), // end section
			
			array(
				'title' => __('Footer', 'flipmag'),
				'fields' => array(
			
					array(
						'name'  => 'css_footer_bg_color',
						'value' => '#19232d',
						'label' => __('Footer Background Color', 'flipmag'),
						'desc'  => __('Footer background color is only used when a background pattern is not specified below.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer' => 'background-color: %s; background-image: none;',
							),
						)
					),

					array(
						'name'  => 'css_footer_bg_pattern',
						'value' => '',
						'label' => __('Footer Background Pattern', 'flipmag'),
						'desc'  => __('Please use a background pattern that can be repeated. Note that it will override the background color option.', 'flipmag'),
						'css' => array(
							'selectors' => array(
								'.main-footer' => 'background-image: url(%s)',
							),
						),
						'type'    => 'upload',
						'options' => array(
							'type'  => 'image',
							'title' => __('Upload This Picture', 'flipmag'), 
							'button_label' => __('Upload Pattern', 'flipmag'),
							'insert_label' => __('Use as Background Pattern', 'flipmag')
						),
					),

					array(
						'name'  => 'css_footer_headings_color',
						'value' => '#c5c7cb',
						'label' => __('Footer Headings Color', 'flipmag'),
						'desc'  => __('Change color of headings in the footer.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer .widgettitle, .main-footer .widget-title' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_text_color',
						'value' => '#d7dade',
						'label' => __('Footer Text Color', 'flipmag'),
						'desc'  => __('Affects color of text in the footer.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer, .main-footer .widget' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_links_color',
						'value' => '#d7dade',
						'label' => __('Footer Links Color', 'flipmag'),
						'desc'  => __('Affects color of links in the footer.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.main-footer .widget a' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_bg',
						'value' => '#121a21',
						'label' => __('Lower Footer Background Color', 'flipmag'),
						'desc'  => __('Second footer uses this color in the background.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot' => 'background-color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_text',
						'value' => '#8d8e92',
						'label' => __('Lower Footer Text Color', 'flipmag'),
						'desc'  => __('Second footer uses this color for text.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot' => 'color: %s',
							),
						)
					),
					
					array(
						'name'  => 'css_footer_lower_links',
						'value' => '#b6b7b9',
						'label' => __('Lower Footer Links Color', 'flipmag'),
						'desc'  => __('Affects color of links in the footer.', 'flipmag'),
						'type' => 'color',
						'css' => array(
							'selectors' => array(
								'.lower-foot a' => 'color: %s',
							),
						)
					),
					
				),
			), // end section
						
		), // end sections
	),

//------------------------------------------------------------------------------------------
//Custom CSS
//------------------------------------------------------------------------------------------ 
	
	array(
		'title' => __('Custom CSS', 'flipmag'),
		'id'    => 'options-custom-css',
		'icon'  => 'dashicons-editor-code',
		'sections' => array(
	
			array(
				'title'  => __('CSS', 'flipmag'),								
				'fields' => array(
					array(
						'name'   => 'css_custom',
						'value' => '',
						'label' => __('Custom CSS', 'flipmag'),
						'desc'  => __('Custom CSS will be added at end of all other customizations and thus can be used to overwrite rules. Less chances of specificity wars.', 'flipmag'),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 15)
					),
					
					array(
						'name'   => 'css_custom_output',
						'value' => 'external',
						'label' => __('Output Method', 'flipmag'),
						'desc'  => __('On-page is better for performance unless your Custom CSS is too large. If you are experiencing problem with a cache plugin or your Custom CSS is large, use external method.', 'flipmag'),
						'type'  => 'select',
						'options' => array(
							'inline' => __('On-page (For few lines of Custom CSS)', 'flipmag'),
							'external' => __('External (For a lot of Custom CSS)', 'flipmag'),
						)
					),
					
				)
					
			), // end section
						
		), // end sections
	),
    
//------------------------------------------------------------------------------------------
//Custom JS
//------------------------------------------------------------------------------------------ 
	
	array(
		'title' => __('Custom JS', 'flipmag'),
		'id'    => 'options-custom-js',
		'icon'  => 'dashicons-media-code',
		'sections' => array(
	
			array(
				'title'  => __('JavaScript', 'flipmag'),		
				'fields' => array(					
                                    
                                        array(
						'name'   => $shortname.'_header_custom_code',
						'value' => '',
						'label' => __('Custom JavaScript', 'flipmag'),
						'desc'  => esc_html(__('Quickly add some JavaScript to your theme by adding it to this block.', 'flipmag')),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 10),
						'strip' => 'none',
					),
					
				)
					
			), // end section
						
		), // end sections
	),
 //------------------------------------------------------------------------------------------
//Analytics
//------------------------------------------------------------------------------------------ 
	
	array(
		'title' => __('Analytics', 'flipmag'),
		'id'    => 'options-custom-analytics',
		'icon'  => 'dashicons-chart-line',
		'sections' => array(
	
			array(
				'title'  => __('Analytics', 'flipmag'),	
				'fields' => array(
					array(
						'name'   => $shortname.'_footer_custom_code',
						'value' => '',
						'label' => __('Tracking Code', 'flipmag'),
						'desc'  => esc_html(__('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'flipmag')),
						'type'  => 'textarea',
						'options' => array('cols' => 75, 'rows' => 10),
						'strip' => 'none',
					),
                                    
				)
					
			), // end section
						
		), // end sections
	),

//------------------------------------------------------------------------------------------
//Social Icons
//------------------------------------------------------------------------------------------     
    
    array(
		'title' => __('Social Networks', 'flipmag'),
		'id'    => 'options-social',
		'icon'  => 'dashicons-share',
		'sections' => array(
	
			array(
				'title'  => __('Social Networks', 'flipmag'),
				'fields' => array(
                                    array(
						'name'   => $shortname."_social_Behance",
						'value' => '',
						'label' => __('BEHANCE', 'flipmag'),
						'desc'  => esc_html(__('Link to : Behance', 'flipmag')),
						"type" 		=> "text"
					),                                    
                                    
                                    array(
						'name'  =>  $shortname."_social_Delicious",
						'value' => '',
						'label' => __('DELICIOUS', 'flipmag'),
						'desc'  => esc_html(__('Link to : Delicious', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Deviantart",
						'value' => '',
						'label' => __('DEVIANTART', 'flipmag'),
						'desc'  => esc_html(__('Link to : Deviantart', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Digg",
						'value' => '',
						'label' => __('DIGG', 'flipmag'),
						'desc'  => esc_html(__('Link to : Digg', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Dribbble",
						'value' => '',
						'label' => __('DRIBBBLE', 'flipmag'),
						'desc'  => esc_html(__('Link to : Dribbble', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Facebook",
						'value' => '',
						'label' => __('FACEBOOK', 'flipmag'),
						'desc'  => esc_html(__('Link to : Facebook', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Flickr",
						'value' => '',
						'label' => __('FLICKR', 'flipmag'),
						'desc'  => esc_html(__('Link to : Flickr', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Google_Plus",
						'value' => '',
						'label' => __('GOOGLE PLUS', 'flipmag'),
						'desc'  => esc_html(__('Link to : Google Plus', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Html5",
						'value' => '',
						'label' => __('HTML5', 'flipmag'),
						'desc'  => esc_html(__('Link to : Html5', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Instagram",
						'value' => '',
						'label' => __('INSTAGRAM', 'flipmag'),
						'desc'  => esc_html(__('Link to : Instagram', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Lastfm",
						'value' => '',
						'label' => __('LASTFM', 'flipmag'),
						'desc'  => esc_html(__('Link to : Lastfm', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Linkedin",
						'value' => '',
						'label' => __('LINKEDIN', 'flipmag'),
						'desc'  => esc_html(__('Link to : Linkedin', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Mail",
						'value' => '',
						'label' => __('MAIL', 'flipmag'),
						'desc'  => esc_html(__('Link to : Mail', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Paypal",
						'value' => '',
						'label' => __('PAYPAL', 'flipmag'),
						'desc'  => esc_html(__('Link to : Paypal', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Pinterest",
						'value' => '',
						'label' => __('PINTEREST', 'flipmag'),
						'desc'  => esc_html(__('Link to : Pinterest', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Reddit",
						'value' => '',
						'label' => __('REDDIT', 'flipmag'),
						'desc'  => esc_html(__('Link to : Reddit', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Rss",
						'value' => '',
						'label' => __('RSS', 'flipmag'),
						'desc'  => esc_html(__('Link to : Rss', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Share",
						'value' => '',
						'label' => __('SHARE', 'flipmag'),
						'desc'  => esc_html(__('Link to : Share', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Skype",
						'value' => '',
						'label' => __('SKYPE', 'flipmag'),
						'desc'  => esc_html(__('Link to : Skype', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Soundcloud",
						'value' => '',
						'label' => __('SOUNDCLOUD', 'flipmag'),
						'desc'  => esc_html(__('Link to : Soundcloud', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Spotify",
						'value' => '',
						'label' => __('SPOTIFY', 'flipmag'),
						'desc'  => esc_html(__('Link to : Spotify', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Stackoverflow",
						'value' => '',
						'label' => __('STACKOVERFLOW', 'flipmag'),
						'desc'  => esc_html(__('Link to : Stackoverflow', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Steam",
						'value' => '',
						'label' => __('STEAM', 'flipmag'),
						'desc'  => esc_html(__('Link to : Steam', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_StumbleUpon",
						'value' => '',
						'label' => __('STUMBLEUPON', 'flipmag'),
						'desc'  => esc_html(__('Link to : StumbleUpon', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Tumblr",
						'value' => '',
						'label' => __('TUMBLR', 'flipmag'),
						'desc'  => esc_html(__('Link to : Tumblr', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Twitter",
						'value' => '',
						'label' => __('TWITTER', 'flipmag'),
						'desc'  => esc_html(__('Link to : Twitter', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Vimeo",
						'value' => '',
						'label' => __('VIMEO', 'flipmag'),
						'desc'  => esc_html(__('Link to : Vimeo', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_VKontakte",
						'value' => '',
						'label' => __('VKONTAKTE', 'flipmag'),
						'desc'  => esc_html(__('Link to : VKontakte', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Windows",
						'value' => '',
						'label' => __('WINDOWS', 'flipmag'),
						'desc'  => esc_html(__('Link to : Windows', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Woordpress",
						'value' => '',
						'label' => __('WOORDPRESS', 'flipmag'),
						'desc'  => esc_html(__('Link to : Woordpress', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Yahoo",
						'value' => '',
						'label' => __('YAHOO', 'flipmag'),
						'desc'  => esc_html(__('Link to : Yahoo', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                    array(
						'name'   => $shortname."_social_Youtube",
						'value' => '',
						'label' => __('YOUTUBE', 'flipmag'),
						'desc'  => esc_html(__('Link to : Youtube', 'flipmag')),
						"type" 		=> "text"
					),
                                    
                                   
                                    
                                    
                                    
				)
					
			), // end section
						
		), // end sections
	),
//------------------------------------------------------------------------------------------
//Backup & Restore
//------------------------------------------------------------------------------------------ 
	
	array(
		'title' => __('Backup & Restore', 'flipmag'),
		'id'    => 'options-backup-restore',
		'icon'  => 'dashicons-backup',
		'sections' => array(

			array(
                                'title'  => __('Backup', 'flipmag'),
				'fields' => array(
			
					array(
						'label'  => __('Backup / Export', 'flipmag'),
						'desc'   => __('This allows you to create a backup of your options and settings. Please note, it will not backup anything else.', 'flipmag'),
						'type'   => 'html',
						'html'   => "<input type='button' class='button' id='options-backup' value='". __('Download Backup', 'flipmag') ."' />",
					),
					
					array(
						'label'  => __('Restore / Import', 'flipmag'),
						'desc'   => sprintf( __('%s It will override your current settings! %s Please make sure to select a valid backup file.', 'flipmag'),'<strong>','</strong>'),
						'type'   => 'html',
						'html'   => "<input type='file' name='import_backup' id='options-restore' />",
					)
					
				),
			
			),
	
		),
	),
//------------------------------------------------------------------------------------------
//Sample Import
//------------------------------------------------------------------------------------------ 
		
	array(
		'title' => __('Sample Import', 'flipmag'),
		'id'    => 'options-sample-import',
		'icon'  => 'dashicons-download',
		'sections' => array(

			array(
				'title' => __('Import Sample Content', 'flipmag'),                                
				'fields' => array(

                    array(
						'name'  => $shortname."_intro",
                        'label' => '',
						'value' => '',						
						'desc'  => sprintf( __('%s Import Sample Content %s Import sample content from FlipMag official demo site. It needs a powerful webhost and may fail on a weaker one. It may take %s 2-4 %s minutes to complete. %s WARNING: Only use on an empty site and make sure you have enabled recommended plugins first! Existing widgets will NOT be deleted but it is a good idea to remove them. %s Important: %s Once import is completed, you will have to install and run "Regenerate Thumbnails" plugin.', 'flipmag'),
							'<div class="of-info"><h3 style="margin: 0 0 10px;">','</h3>','<strong>','</strong>','<strong>','</strong></div><br><strong>', '</strong>'),
						'type'  => 'info'						
					),

					array(
						'name'  => 'import_demo_type',
						'label' => __('Select Demo', 'flipmag'),
						'value' => '',
						'type' => 'radio',
						'desc' => '',
						'options' => array(
							'' => __('Default Demo', 'flipmag'), 
							'tech' => __('Tech Demo', 'flipmag'), 
							'travel' => __('Travel Demo', 'flipmag'), 
							'video' => __('Video Demo', 'flipmag'),
							'fashion' => __('Fashion Demo', 'flipmag'),
							'sport' => __('Sport Demo', 'flipmag'),
							'classic' => __('Classic Demo', 'flipmag'),							
							'rtl' => __('RTL Demo', 'flipmag'), 							
						),
					),
                    
					array(
						'name'  => 'import_media',
						'label' => __('Images & Media', 'flipmag'),
						'value' => 1,
						'type' => 'radio',
						'desc' => __('When enabled, random public domain licensed (CC0) images will be imported.', 'flipmag'),
						'options' => array(0 => __('Skip images & media', 'flipmag'), 1 => __('Import random images', 'flipmag')),
					),

					array(
						'name'  => 'import_type',
						'label' => __('Full or Settings Only?', 'flipmag'),
						'value' => 'full',
						'type' => 'radio',
						'desc' => '',
						'options' => array('settings' => __('Theme Settings Only', 'flipmag'), 'full' => __('Full Import', 'flipmag')),
					),

					array(
						'label'  => __('Start Import', 'flipmag'),						
						'type'   => 'html',
						'html'   => "<input type='hidden' name='import_demo' value='1' />
							<p><input type='button' class='button-primary' id='options-demo-import' value='". __('Import Sample Data', 'flipmag') ."' data-confirm='"
							. __('WARNING: Do not use this on site with existing content. Enable Flipmag plugins before importing. Do you really wish to import sample data?', 'flipmag') . "'/></p>
						",
                        "desc" => '',
					),	
				),
			
			),
	
		),
	),

	
));