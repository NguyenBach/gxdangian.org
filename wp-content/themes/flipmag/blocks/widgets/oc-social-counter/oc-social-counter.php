<?php
/*
Widget Name: Social Counter 
Description: Get social counter for your social account.
Author: Flipmag
Author URI: http://octocreation.com/
*/

class Flipmag_Social_Counter extends SiteOrigin_Widget {

    private $widget_id;

    function __construct() {
            parent::__construct(
                    'oc-social-counter',
                    __('Social Counter - Flipmag', 'flipmag'),
                    array(
                            'description' => __('Get social counter for your social account.', 'flipmag'),
                            'panels_groups' => array('oc-widgets-bundle'),
                            'panels_icon' => 'oc-widget-icon'
                    ),
                    array(

                    ),
                    array(
                            'title' => array(
                                    'type' => 'text',
                                    'label' => __('Title', 'flipmag'),
                            ),

                            'theme_bgcolor' => array(
                                'type' => 'color',
                                'label' => __('Color', 'flipmag'),
                                'description' => __('Set main color for this block.', 'flipmag')
                            ),

                            'header' => array(
                                    'type' => 'select',
                                    'label' => __('Section Header Style', 'flipmag'),
                                    'options' => array(
                                        '' => __('Default', 'flipmag'),                                                  
                                        'style-1' => __('Style 1', 'flipmag'),   
                                        'style-2' => __('Style 2', 'flipmag'), 
                                        'style-3' => __('Style 3', 'flipmag'), 
                                        'style-4' => __('Style 4', 'flipmag'),
                                        'style-5' => __('Style 5', 'flipmag'), 
                                        'style-6' => __('Style 6', 'flipmag'),                             
                                    ),
                                    'default' => '',
                            ), 

                            'theme_style' => array(
                                'type' => 'select',
                                'label' => __('Style', 'flipmag'),
                                'options' => array(                                        
                                        'style-1' => __('Style 1', 'flipmag'),                                                              
                                        'style-2' => __('Style 2', 'flipmag'),
                                        'style-3' => __('Style 3', 'flipmag'),
                                        'style-4' => __('Style 4', 'flipmag'),
                                        'style-5' => __('Style 5', 'flipmag'),
                                        'style-6' => __('Style 6', 'flipmag'),
                                        'style-7' => __('Style 7', 'flipmag'),
                                ),
                                'default' => 'style-1',
                            ),
                            
                            'facebook' => array(
                                    'type' => 'section',
                                    'label' => __('Facebook', 'flipmag'),
                                    'hide' => true,
                                    'fields' => array(
                                        
                                        'check' => array(
                                            'type' => 'checkbox',                                                    
                                            'label' => __( 'Hide/Show', 'flipmag' ),
                                            'default' => false,
                                        ),
                                        
                                        'username' => array(
                                            'type' => 'text',
                                            'label' => __('Facebook Page ID', 'flipmag'),
                                            'description' => __( 'Please enter the page ID or page name.For example:If your page url is https://www.facebook.com/Flipmag then your page ID is Flipmag.', 'flipmag'),
                                        ),
                                        
                                        'default' => array(
                                            'type' => 'text',
                                            'label' => __('Default Count', 'flipmag'),
                                            'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                        ),
                                        
                                    )
                            ),
                        
                            'twitter' => array(
                                'type' => 'section',
                                'label' => __('Twitter', 'flipmag'),
                                'hide' => true,
                                'fields' => array(

                                    'info' => array(
                                            'type' => 'error',
                                        'description' => sprintf(__('Get your API keys &amp; tokens at: %s', 'flipmag'), '<a href="'.esc_url('https://apps.twitter.com/').'" target="_blank">'.esc_url('https://apps.twitter.com/').'</a>'),
                                    ),
                                    
                                    'check' => array(
                                        'type' => 'checkbox',                                                    
                                        'label' => __( 'Hide/Show', 'flipmag' ),
                                        'default' => false,
                                    ),

                                    'username' => array(
                                        'type' => 'text',
                                        'label' => __('Twitter Username', 'flipmag'),
                                        'description' => __( 'Please enter the twitter username.For example:octocreation.', 'flipmag'),
                                    ),
                                    
                                    'consumer-key' => array(
                                        'type' => 'text',
                                        'label' => __('Twitter Consumer Key', 'flipmag'),                                                
                                    ),
                                    
                                    'consumer-secret' => array(
                                        'type' => 'text',
                                        'label' => __('Twitter Consumer Secret', 'flipmag'),                                                
                                    ),

                                    'access-token' => array(
                                        'type' => 'text',
                                        'label' => __('Twitter Access Token', 'flipmag'),                                                
                                    ),

                                    'token-secret' => array(
                                        'type' => 'text',
                                        'label' => __('Twitter Access Token Secret', 'flipmag'),                                                
                                    ),

                                    'default' => array(
                                        'type' => 'text',
                                        'label' => __('Default Count', 'flipmag'),
                                        'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                    ),

                                )
                        ),
                        
                        'google-plus' => array(
                                'type' => 'section',
                                'label' => __('Google Plus', 'flipmag'),
                                'hide' => true,
                                'fields' => array(

                                    'check' => array(
                                        'type' => 'checkbox',                                                    
                                        'label' => __( 'Hide/Show', 'flipmag' ),
                                        'default' => false,
                                    ),

                                    'username' => array(
                                        'type' => 'text',
                                        'label' => __('Google Plus Page Name or Profile ID', 'flipmag'),
                                        'description' => __( 'Please enter the page name or profile ID.For example:If your page url is https://plus.google.com/+BBCNews then your page name is +BBCNews', 'flipmag'),
                                    ),
                                    
                                    'api-key' => array(
                                        'type' => 'text',
                                        'label' => __('Google API Key', 'flipmag'),
                                        'description' => sprintf(__('To get your API Key, first create a project/app in %s and then turn on Google+ API from "APIs &amp; auth &gt;APIs inside your project.Then again go to "APIs &amp; auth &gt; APIs &gt; Credentials &gt; Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field. ', 'flipmag'), '<a href="'.esc_url('https://console.developers.google.com/project').'" target="_blank">'.esc_url('https://console.developers.google.com/project').'</a>')
                                    ),
                                    
                                    'default' => array(
                                        'type' => 'text',
                                        'label' => __('Default Count', 'flipmag'),
                                        'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                    ),

                                )
                            ),
                        
                            'youtube' => array(
                                        'type' => 'section',
                                        'label' => __('Youtube', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'channel' => array(
                                                'type' => 'text',
                                                'label' => __('Youtube Channel ID', 'flipmag'),
                                                'description' => sprintf( __( 'Please enter the youtube channel ID.Your channel ID looks like: UC4WMyzBds5sSZcQxyAhxJ8g. And please note that your channel ID is different from username.Please go %s to know how to get your channel ID.', 'flipmag'), '<a href="'.esc_url('https://support.google.com/youtube/').'answer/3250431?hl=en" target="_blank">here</a>' ),
                                            ),
 
                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Youtube Username', 'flipmag'),
                                                'description' => __( 'Please enter the youtube username.For example:https://www.youtube.com/user/mezzi07animator so your username is mezzi07animator.', 'flipmag'),
                                            ),
 
                                            'api-key' => array(
                                                'type' => 'text',
                                                'label' => __('Youtube API Key', 'flipmag'),
                                                'description' => sprintf(__( 'To get your API Key, first create a project/app in %s and then turn on both Youtube Data and Analytics API from "APIs &amp; auth &gt;APIs inside your project.Then again go to "APIs &amp; auth &gt; APIs &gt; Credentials &gt; Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.', 'flipmag') , '<a href="'.esc_url('https://console.developers.google.com/project').'" target="_blank">'.esc_url('https://console.developers.google.com/project').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'linkedin' => array(
                                        'type' => 'section',
                                        'label' => __('Linkedin', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'url' => array(
                                                'type' => 'text',
                                                'label' => __('Linkedin URL', 'flipmag'),                                                
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'instagram' => array(
                                        'type' => 'section',
                                        'label' => __('Instagram', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Instagram Id', 'flipmag'),
                                                'description' => __( 'Enter your instagram id example: 1574083', 'flipmag'),
                                            ),
                                            
                                            'api' => array(
                                                'type' => 'text',
                                                'label' => __('Instagram Access Token', 'flipmag'),
                                                'description' => sprintf(__( 'Create your access token %s. ', 'flipmag'), '<a href="'.esc_url('https://www.instagram.com/developer').'" target="_blank">'.esc_url('https://www.instagram.com/developer').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'pinterest' => array(
                                        'type' => 'section',
                                        'label' => __('Pinterest', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'url' => array(
                                                'type' => 'text',
                                                'label' => __('URL', 'flipmag'),                                                
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'soundcloud' => array(
                                        'type' => 'section',
                                        'label' => __('SoundCloud', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'id' => array(
                                                'type' => 'text',
                                                'label' => __('User Id ', 'flipmag'),                                                
                                            ),
                                            
                                            'api' => array(
                                                'type' => 'text',
                                                'label' => __('Client Id ', 'flipmag'),
                                                'description' => sprintf(__( 'Get your client id from %s.', 'flipmag'),'<a href="'.esc_url('http://soundcloud.com/you/apps').'">'.esc_url('http://soundcloud.com/you/apps').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'stumbleupon' => array(
                                        'type' => 'section',
                                        'label' => __('Stumbleupon', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'url' => array(
                                                'type' => 'text',
                                                'label' => __('URL', 'flipmag'),                                                
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'dribbble' => array(
                                        'type' => 'section',
                                        'label' => __('Dribbble', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Username', 'flipmag'),                                                
                                            ),
                                            
                                            'api' => array(
                                                'type' => 'text',
                                                'label' => __('Access Token', 'flipmag'),
                                                'description' => sprintf(__( 'get your access token from %s', 'flipmag'), '<a href="'.esc_url('http://developer.dribbble.com/').'" target="_blank">'.esc_url('http://developer.dribbble.com/').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'vimeo' => array(
                                        'type' => 'section',
                                        'label' => __('Vimeo', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Username', 'flipmag'),                                                
                                            ),
                                            
                                            'api' => array(
                                                'type' => 'text',
                                                'label' => __('Access Token', 'flipmag'),
                                                'description' => sprintf(__( 'You can create your access token here %s', 'flipmag'), '<a href="'.esc_url('https://developer.vimeo.com/apps').'" target="_blank">'.esc_url('https://developer.vimeo.com/apps').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                            'vine' => array(
                                        'type' => 'section',
                                        'label' => __('Vine', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('User Id ', 'flipmag'),
                                                'description' => __( 'example : 1150982282283315200', 'flipmag'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'tumblr' => array(
                                        'type' => 'section',
                                        'label' => __('Tumblr', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Username', 'flipmag'),                                                
                                            ),
                                            
                                            'api' => array(
                                                'type' => 'text',
                                                'label' => __('Api Key', 'flipmag'),
                                                'description' => sprintf(__( 'Get your api key %s', 'flipmag'), '<a href="'.esc_url('https://www.tumblr.com/oauth/apps').'" target="_blank">'.esc_url('https://www.tumblr.com/oauth/apps').'</a>'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                        
                                'github' => array(
                                        'type' => 'section',
                                        'label' => __('Github', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),

                                            'username' => array(
                                                'type' => 'text',
                                                'label' => __('Username', 'flipmag'),
                                                'description' => __( 'example : octocreation', 'flipmag'),
                                            ),
                                            
                                            'default' => array(
                                                'type' => 'text',
                                                'label' => __('Default Count', 'flipmag'),
                                                'description' => __( 'Please enter the default count to show whenever the API is unavailable.', 'flipmag'),
                                            ),                                            
                                        ),
                                ),
                                                
                                'posts' => array(
                                        'type' => 'section',
                                        'label' => __('Website Posts', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),                                          
                                        ),
                                ),
                        
                                'comment' => array(
                                        'type' => 'section',
                                        'label' => __('Website Comment', 'flipmag'),
                                        'hide' => true,
                                        'fields' => array(

                                            'check' => array(
                                                'type' => 'checkbox',                                                    
                                                'label' => __( 'Hide/Show', 'flipmag' ),
                                                'default' => false,
                                            ),                                          
                                        ),
                                ),
                        
                    ),
                    get_template_directory_uri()
            );
    }
    
    function initialize() {		
        $this->register_frontend_styles(
                array(
                        array(
                                'oc-counter-base',
                                get_template_directory_uri(). '/blocks/widgets/oc-social-counter/css/style.css',
                                array(),
                                SOW_BUNDLE_VERSION
                        ),
                )
        );
    }

    function modify_instance($instance){
        $this->widget_id = Flipmag::blocks()->unique_id();
        $instance['widget_id'] = $this->widget_id;
        return $instance;
    }

    function get_less_variables( $instance ) {

        return array(
            'id' => $this->widget_id,
            'theme_bgcolor' => @$instance['theme_bgcolor'],
        );
    }

    function get_template_name($instance){
        return 'base';
    }

    function get_style_name($instance){
        return 'default';
    }
}

siteorigin_widget_register('oc-social-counter', __FILE__, 'Flipmag_Social_Counter');