<?php
/*
Widget Name: Module 3
Description: Gives you a widget to display your posts as a block.
Author: Flipmag
Author URI: http://octocreation.com/
*/

class Flipmag_Module_3 extends SiteOrigin_Widget {

    private $widget_id;
    
    function __construct() {
            parent::__construct(
                    'oc-module-3',
                    __('Module 3 - Flipmag', 'flipmag'),
                    array(
                            'description' => __('Display your posts as module 3 module as news block.', 'flipmag'),
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
                                'description' => __('Set main color for this module.', 'flipmag')
                            ),
                            
                            'info' => array(
                                    'type' => 'error',
                                    'description' => __('Maximum 5 posts in one category block.', 'flipmag'),
                            ),
                        
                            'lists' => array(
                                    'type'       => 'repeater',
                                    'label'      => __( 'Select Category', 'flipmag' ),
                                    'item_name'  => __( 'Category', 'flipmag' ),
                                    'item_label' => array(
                                            'selector'     => "[id*='networks-name'] :selected",
                                            'update_event' => 'change',
                                            'value_method' => 'text'
                                    ),
                                    'fields'     => array(
                                        'ctitle' => array(
                                            'type' => 'text',
                                            'label' => __('Title', 'flipmag'),
                                        ),
                                        'posts' => array(
                                            'type' => 'posts',
                                            'label' => __('Posts query', 'flipmag'),
                                        ),
                                    )
                            ),
                        
                            'controls' => array(
                                            'type' => 'section',
                                            'label' => __('Controls', 'flipmag'),
                                            'fields' => array(
                                                
                                                'feature_post' => array(
                                                        'type' => 'select',
                                                        'label' => __('Feature article style', 'flipmag'),
                                                        'options' => array(
                                                                'classic' => __('Classic Style', 'flipmag'),
                                                                'modern' => __('Modern Style', 'flipmag'),                                            
                                                        ),
                                                        'default' => 'classic',
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

                                                'animation' => array(
                                                                'type' => 'select',
                                                                'label' => __('Animation', 'flipmag'),
                                                                'options' => array(
                                                                        '' => __('None', 'flipmag'),
                                                                        'fadeInDown animation' => __('Fade In Down', 'flipmag'),                                                                        
                                                                        'fadeInUp animation' => __('Fade In Up', 'flipmag'),
                                                                        'fadeInLeft animation' => __('Fade In Left', 'flipmag'),
                                                                        'fadeInRight animation' => __('Fade In Right', 'flipmag'),
                                                                ),
                                                                'default' => 'normal',
                                                        ),
                                                                               
                                                'disable_date' => array(
                                                                'type' => 'select',
                                                                'label' => __('Disable Date', 'flipmag'),
                                                                'options' => array(
                                                                        'yes' => __('Yes', 'flipmag'),
                                                                        'no' => __('No', 'flipmag'),                                            
                                                                ),
                                                                'default' => 'no',
                                                        ),
                                                
                                                'date_format' => array(
                                                                'type' => 'select',
                                                                'label' => __('Choose date format ', 'flipmag'),
                                                                'description' => sprintf(__( 'example date : JANUARY 25, %s  When date is enable.', 'flipmag'), date('Y')),
                                                                'options' => array(
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
                                                                ),
                                                                'default' => 'Y-m-d\TH:i:sP',
                                                        ),
                                                
                                                'date_link' => array(
                                                                'type' => 'select',
                                                                'label' => __('Date archive link url', 'flipmag'),
                                                                'description' => __( 'If date enable.', 'flipmag'),
                                                                'options' => array(
                                                                        'day' => __('Day', 'flipmag'),
                                                                        'month' => __('Month', 'flipmag'),
                                                                        'year' => __('Year', 'flipmag'),
                                                                ),
                                                                'default' => 'day',
                                                        ),
                                                
                                                'disable_cat' => array(
                                                                'type' => 'select',
                                                                'label' => __('Disable Category', 'flipmag'),
                                                                'options' => array(
                                                                        'yes' => __('Yes', 'flipmag'),
                                                                        'no' => __('No', 'flipmag'),                                            
                                                                ),
                                                                'default' => 'no',
                                                        ),
                                                
                                                'disable_comment' => array(
                                                                'type' => 'select',
                                                                'label' => __('Disable Comment', 'flipmag'),
                                                                'options' => array(
                                                                        'yes' => __('Yes', 'flipmag'),
                                                                        'no' => __('No', 'flipmag'),                                            
                                                                ),
                                                                'default' => 'no',
                                                        ),
                                                
                                                'disable_author' => array(
                                                                'type' => 'select',
                                                                'label' => __('Disable Author', 'flipmag'),
                                                                'options' => array(
                                                                        'yes' => __('Yes', 'flipmag'),
                                                                        'no' => __('No', 'flipmag'),                                            
                                                                ),
                                                                'default' => 'no',
                                                        ),
                                                
                                                'disable_excerpt' => array(
                                                    'type' => 'select',
                                                    'label' => __('Disable Excerpt', 'flipmag'),
                                                    'options' => array(
                                                            'yes' => __('Yes', 'flipmag'),
                                                            'no' => __('No', 'flipmag'),                                            
                                                    ),
                                                    'default' => 'no',
                                                ),

                                                'excerpt_length' => array(
                                                            'type' => 'number',
                                                            'label' => __('Excerpt Length ', 'flipmag'),
                                                            'description' => __( 'If excerpt enable.', 'flipmag'),
                                                            'default' => 20,
                                                    ),
                                                
                                            )
                                    )
                        
                    ),
                get_template_directory_uri()
            );
    }
    
    function initialize() {

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
    
    function getCat(){
        $categories = get_categories( array(
            'orderby' => 'name',
            'order'   => 'ASC'
        ) );

        $arr = array();
            foreach( $categories as $category ) {
                $arr[ $category->slug ] = $category->name;
            }  
        return $arr;
    }
}

siteorigin_widget_register('oc-module-3', __FILE__, 'Flipmag_Module_3');