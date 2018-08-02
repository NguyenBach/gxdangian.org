<?php

Class Flipmag_Blocks{
    
    public $more_text;
    public $more_html;
    
    public function __construct(){

    }
    
    public function blocks( $options = array(), $block, $query ){
        
        $html = "";

        $html .= '<div id="flipmag-bid-'. esc_attr($options['id']) .'">';

        
        if( $options['pagination'] == 'ajax' ){
                        
            $html .= $this->blocks_ajax( $options, $block, $query );
            
        }else if( $options['pagination'] == 'infinite' ||  $options['pagination'] == 'normal' || $options['pagination'] == 'disable' ){
                        
            $html .= $this->block_normal( $options, $block, $query );
        }

        $html .='</div>';
       
        
        return $html;
    }
    
    public function block_normal( $options = array(), $block, $query ){
        
        $html = "";
        
        if( $options['pagination'] == 'infinite' ){
            wp_enqueue_script('flipmag-infinite-scroll');
        }
        
        //query            
        $paged = (get_query_var('paged') ? get_query_var('paged') : get_query_var('page'));
        if( $query != null  ){
            $query = array_merge( $query , array( 'paged' => $paged ) );
            $posts = new WP_Query( $query );
        }else{
            global $wp_query;
            $posts = $wp_query;
        }
        
        if( method_exists( $this , $block ) ){
            if($posts->have_posts()) :
                
                $html .= $options['title'];
                
                $html .= $this->$block( $options, $posts );
                                
                if( $options['pagination'] != 'disable' ){
                    //pagination
                    $html .= '<div id="page_'. $options['id'] .'" class="main-pagination">';
                        $html .= Flipmag::posts()->paginate(array(), $posts);
                    $html .= '</div>';
                }
            endif; 
        }
        
        return $html;        
    }
        
    public function blocks_ajax( $options = array(), $block, $query ){
        
        $html = "";
        
        wp_enqueue_script('flipmag-ajax-paginate');
        
        if( $query != null  ){
            $posts = new WP_Query( $query );
        }else{
            global $wp_query;
            $query = $wp_query;
            $posts = $wp_query;
        }

        if( array_key_exists('date_query_relative', $query) ){
            unset($query[ 'date_query_relative' ]);
        }
        
        if( method_exists( $this , $block ) ){
            if($posts->have_posts()) :

                $ajaxblock = $options;
                $ajaxblock["title"] = esc_html($ajaxblock["title"]);
        
                $ajaxblock = array( "id" => $options['id'], "block" => $block, "options" => $ajaxblock, "query" => $query );
                    
                $html .= '<script type="text/javascript">';
                    $html .= 'ajaxblock[ "'. esc_js($options['id']) .'" ] = '. json_encode( $ajaxblock ) .';';
                $html .= '</script>';
                
                $html .= $options['title'];
                
                $html .= $this->$block( $options, $posts );
                
                $html .= '<div id="ajax_'. esc_attr($options['id']) .'" class="main-pagination" data-total="'. esc_attr($posts->found_posts) .'"  data-count="'. esc_attr($posts->post_count) .'"  ></div>';
                
            endif;
        }

        return $html;        
    }
    
    public function Module_1( $options = array(), $query, $query2 ){
        $html = '';

        $html .= '<div id="flipmag-bid-'. esc_attr($options['id']) .'">';

        //title
        $html .= $options['title'];
        
        //query 1
        $posts = new WP_Query( $query );
        $html .='<div class="oc-module module-1">';
        $html .='<div class="row highlights-box">';
        $html .='<div class="column half">';
        if($posts->have_posts()) :
            $i = 0;
            while($posts->have_posts()) : $posts->the_post();
            
                if( $i == 0 ){                    
                    if( $options["col_1"]["feature_post"] == "classic" ){
                    $html .='<div class="oc-block block-7 " data-id="module_1'. esc_attr($options['id']) .'" id="module_1'. esc_attr($options['id']) .'" >';
                    
                        $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_1"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()):
                                $html .= '<div class="thumbs">';
                                
                                //category
                                $html .= $this->post_cat( $options["col_1"] );

                                //thumbnail
                                $html .= $this->post_thumbnail( $options["col_1"] );
                                
                                $html .= '</div>';
                            endif;

                            $html .= '<div class="content">'; 

                            //title
                            $html .= $this->post_title( $options["col_1"] );

                            $html .= '<div class="block-meta">';
                            //author
                            $html .= $this->post_author( $options["col_1"] );                    

                            //date
                            $html .= $this->post_date( $options["col_1"] );

                            //comment
                            $html .= $this->post_comment( $options["col_1"] );               

                            $html .= '</div>';

                            //excerpt
                            $html .= $this->post_excerpt( $options["col_1"] );

                            $html .= '</div>';

                        $html .= '</article>';                    
                    $html .='</div>';
                    
                    }else if( $options["col_1"]["feature_post"] == "modern" ){
                        $html .='<div class="oc-block block-11" '.' data-id="module_1'. esc_attr($options['id']) .'" id="module_1'. esc_attr($options['id']) .'"  >';
                            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_1"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()){
                                $html .= '<div class="thumbs">';
                            }else{
                                $html .= '<div class="thumbs no-image">';
                            }

                            //thumbnail
                            $html .= $this->post_thumbnail( $options["col_1"] );

                            $html .= '<div class="title-bar">';                

                                //category
                                $html .= $this->post_cat( $options["col_1"] );

                                //title
                                $html .= $this->post_title( $options["col_1"] );

                                $html .= '<div class="block-meta">';

                                //author
                                $html .= $this->post_author( $options["col_1"] );                    

                                //date
                                $html .= $this->post_date( $options["col_1"] );

                                //comment
                                $html .= $this->post_comment( $options["col_1"] );

                                $html .= '</div>';

                            $html .= '</div>';

                            $html .= '</div>';

                            $html .= '<div class="content">'; 

                            //excerpt
                            $html .= $this->post_excerpt( $options["col_1"] );

                            $html .= '</div>';

                        $html .= '</article>';
                        $html .='</div>';
                    }
                }else{
                    if( $i == 1 ){
                        $html .='<ul class="oc-block block-3 " '.' data-id="module_2'. esc_attr($options['id']) .'" id="module_2'. esc_attr($options['id']) .'" >';
                        $options["col_1"]['thumb_size'] = "flipmag-extra-small";
                    }
                    $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_1"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                        $html .= '';

                        if(has_post_thumbnail()):
                            $html .= '<div class="thumbs">';

                            //thumbnail
                            $html .= $this->post_thumbnails( $options["col_1"] );                   

                            $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options["col_1"] ); 

                        $html .= '<div class="block-meta">';  

                        //author
                        $html .= $this->post_author( $options["col_1"] );                    

                        //date
                        $html .= $this->post_date( $options["col_1"] );

                        //comment
                        $html .= $this->post_comment( $options["col_1"] );

                        $html .= '</div>';

                        $html .= '</div>';

                    $html .= '</li>';
                    
                    if( $posts->post_count-1 == $i ){
                        $html .='</ul>';
                    }
                }
            $i++;
            endwhile; wp_reset_postdata();
        endif;
        $html .='</div>';
        
        //query 2
        $posts = new WP_Query( $query2 );
        $html .='<div class="column half">';
        if($posts->have_posts()) :
            $i = 0;
            while($posts->have_posts()) : $posts->the_post();
            
                if( $i == 0 ) {                    
                    if( $options["col_2"]["feature_post"] == "classic" ){
                    $html .='<div class="oc-block block-7 " data-id="module_3'. esc_attr($options['id']) .'" id="module_3'. esc_attr($options['id']) .'"  >';
                    
                        $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_2"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()):
                                $html .= '<div class="thumbs">';
                                
                                //category
                                $html .= $this->post_cat( $options["col_2"] );

                                //thumbnail
                                $html .= $this->post_thumbnail( $options["col_2"] );
                                
                                $html .= '</div>';
                            endif;

                            $html .= '<div class="content">'; 

                            //title
                            $html .= $this->post_title( $options["col_2"] );

                            $html .= '<div class="block-meta">';  

                            //author
                            $html .= $this->post_author( $options["col_2"] );               

                            //date
                            $html .= $this->post_date( $options["col_2"] );

                            //comment
                            $html .= $this->post_comment( $options["col_2"] );

                            $html .= '</div>';

                            //excerpt
                            $html .= $this->post_excerpt( $options["col_2"] );

                            $html .= '</div>';

                        $html .= '</article>';                    
                    $html .='</div>';
                    
                    }else if( $options["col_2"]["feature_post"] == "modern" ){
                        $html .='<div class="oc-block block-11" '. ' data-id="module_3'. esc_attr($options['id']) .'" id="module_3'. esc_attr($options['id']) .'" >';
                            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_2"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()){
                                $html .= '<div class="thumbs">';
                            }else{
                                $html .= '<div class="thumbs no-image">';
                            }

                            //thumbnail
                            $html .= $this->post_thumbnail( $options["col_2"] );

                            $html .= '<div class="title-bar">';                

                                //category
                                $html .= $this->post_cat( $options["col_2"] );

                                //title
                                $html .= $this->post_title( $options["col_2"] );

                                $html .= '<div class="block-meta">'; 

                                //author
                                $html .= $this->post_author( $options["col_2"] );

                                //date
                                $html .= $this->post_date( $options["col_2"] );

                                //comment
                                $html .= $this->post_comment( $options["col_2"] );

                                $html .= '</div>';

                            $html .= '</div>';

                            $html .= '</div>';

                            $html .= '<div class="content">'; 

                            //excerpt
                            $html .= $this->post_excerpt( $options["col_2"] );

                            $html .= '</div>';

                        $html .= '</article>';
                        $html .='</div>';
                    }
                }else{
                    if( $i == 1 ){
                        $html .='<ul class="oc-block block-3 " '. ' data-id="module_4'. esc_attr($options['id']) .'" id="module_4'. esc_attr($options['id']) .'" >';
                        $options["col_2"]['thumb_size'] = "flipmag-extra-small";
                    }
                    $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options["col_2"]['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                        $html .= '';

                        if(has_post_thumbnail()):
                        $html .= '<div class="thumbs">';

                        //thumbnail
                        $html .= $this->post_thumbnails( $options["col_2"] );

                        $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options["col_2"] );

                        $html .= '<div class="block-meta">'; 

                        //author
                        $html .= $this->post_author( $options["col_2"] );                    

                        //date
                        $html .= $this->post_date( $options["col_1"] );

                        //comment
                        $html .= $this->post_comment( $options["col_2"] );

                        $html .= '</div>';

                        $html .= '</div>';

                    $html .= '</li>';
                    
                    if( $posts->post_count-1 == $i ){
                        $html .='</ul>';
                    }
                }
            $i++;
            endwhile; wp_reset_postdata();
        endif;
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';
        $html .='</div>';
        
        return $html;
    }
    
    public function Module_2( $options, $query ){
        $html = "";
        $posts = new WP_Query( $query );

        $html .= '<div id="flipmag-bid-'. esc_attr($options['id']) .'">';
        
        //title
        $html .= $options['title'];
        
        $html .= '<div class="oc-module module-2 gallery-block">';

        if($posts->have_posts()) :
            $html .= '<div class="flexslider">';
            $html .= '<ul class="slides oc-block">';
                while($posts->have_posts()) : $posts->the_post();
                    $html .= '<li>';
                    
                    $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';                
                        if(has_post_thumbnail()):
                            $html .= '<div class="thumbs">';
                            
                            //thumbnail
                            $html .= $this->post_thumbnail( $options );
                            
                            $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">';

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';                        
                        
                        $html .= '</div>';

                    $html .= '</article>';
                        
                    $html .= '</li>';
                endwhile; wp_reset_postdata();
            $html .= '</ul>';
            $html .= '<div class="title-bar"></div>';
            $html .= '</div>';
        endif;
        
        $html .= '</div>';
        $html .= '</div>';
        
       return $html;
    }
    
    public function Module_3( $options, $query,  $bool ){
        $html = "";
        
        if( $bool ){
            $ajaxblock = $options;
            $ajaxblock["title"] = esc_html($ajaxblock["title"]);
            $ajaxblock = array( "id" => $options['id'], "options" => $ajaxblock );

            $html .= '<script type="text/javascript">';
                $html .= 'ajaxblock[ "'. esc_js($options['id']) .'" ] = '. json_encode( $ajaxblock) .';';
            $html .= '</script>';
        
            $html .='<div class="oc-module module-3" id="flipmag-bid-'. esc_attr($options['id']) .'" >';

            if( count($options["query"]) > 0 ){
                //title
                $html .= $options['title'];
            }
        }
        
        if( $query == null ){
            $options["query"] = array_values( $options["query"] );           
            if( count($options["query"]) > 0 ){
                $i = 0;$count = 0;$pid = array();
                foreach( $options["query"] as $index => $row ){

                    $count = $count + $row['posts_per_page'];
                    $pid = array_merge( $pid, get_posts( array_merge( $row, array( 'fields'=> 'ids' ) ) ) );
                    $i++;
                }

                $posts = new WP_Query( array_merge( array( 'post__in' => $pid ), array( 'posts_per_page' => 5 ) ) );

            }else{
              $query = array();
              $posts = new WP_Query( $query );
            }
        }else{
            $posts = new WP_Query( $query );
        }
                
        if( count($options["query"]) > 0 ){            
            if($posts->have_posts()) :
                $i = 0;
                if( $bool ){
                    $html .='<div class="row" id="module_'. esc_attr($options['id']) .'" >';
                }
                $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
                while($posts->have_posts()) : $posts->the_post();
                if( $i == 0 ){ 
                    $html .='<div class="column half">';
                    if( $options["feature_post"] == "classic" ){
                    $html .='<div class="oc-block block-7 " data-id="module_1'. esc_attr($options['id']) .'" id="module_1'. esc_attr($options['id']) .'" >';
                    
                        $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()):
                                $html .= '<div class="thumbs">';
                                
                                //category
                                $html .= $this->post_cat( $options );

                                //thumbnail
                                $html .= $this->post_thumbnail( $options );
                                
                                $html .= '</div>';
                            endif;

                            $html .= '<div class="content">'; 

                            //title
                            $html .= $this->post_title( $options );

                            $html .= '<div class="block-meta">';

                            //author
                            $html .= $this->post_author( $options );

                            //date
                            $html .= $this->post_date( $options );

                            //comment
                            $html .= $this->post_comment( $options );

                            $html .= '</div>';

                            //excerpt
                            $html .= $this->post_excerpt( $options );

                            $html .= '</div>';

                        $html .= '</article>';                    
                    $html .='</div>';
                    
                    }else if( $options["feature_post"] == "modern" ){
                        $html .='<div class="oc-block block-11" '. ' data-id="module_2'. esc_attr($options['id']) .'" id="module_2'. esc_attr($options['id']) .'" >';
                            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()){
                                $html .= '<div class="thumbs">';
                            }else{
                                $html .= '<div class="thumbs no-image">';
                            }

                            //thumbnail
                            $html .= $this->post_thumbnail( $options );

                            $html .= '<div class="title-bar">';                

                                //category
                                $html .= $this->post_cat( $options );

                                //title
                                $html .= $this->post_title( $options );

                                $html .= '<div class="block-meta">';

                                //author
                                $html .= $this->post_author( $options );                    

                                //date
                                $html .= $this->post_date( $options );

                                //comment
                                $html .= $this->post_comment( $options );

                                $html .= '</div>';

                            $html .= '</div>';

                            $html .= '</div>';

                            $html .= '<div class="content">'; 

                            //excerpt
                            $html .= $this->post_excerpt( $options );

                            $html .= '</div>';

                        $html .= '</article>';
                        $html .='</div>';
                    }
                    $html .='</div>';
                }else{
                    if( $i == 1 ){                        
                        $html .='<ul class="oc-block block-3 column half" '. ' data-id="module_3'. esc_attr($options['id']) .'" id="module_3'. esc_attr($options['id']) .'" >';
                        $options['thumb_size'] = "flipmag-extra-small";
                    }
                    $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                        $html .= '';

                        if(has_post_thumbnail()):
                            $html .= '<div class="thumbs">';

                            //thumbnail
                            $html .= $this->post_thumbnails( $options );

                            $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">';

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';

                        $html .= '</div>';

                    $html .= '</li>';
                    if( $posts->post_count-1 == $i || $i == 4 ){
                        $html .='</ul>'; 
                    }
                }
                if( $i == 4 ){ 
                    break;
                }
                    $i++;
                endwhile; wp_reset_postdata();
                if( $bool ){ 
                    $html .='</div>';                     
                }
            endif;            
        }else{
            $html .= __('Select posts in module.', "flipmag");
        }
        if( $bool ){
            $html .='</div>';
        }
        
        return $html;
    }
    
    public function Module_4( $options ){
        $html = "";

        $html .='<div class="oc-module module-4 tabs" id="flipmag-bid-'. esc_attr($options['id'] ).'" >';
        
        //title
        $html .= $options['title'];
        
        $html .='<div class="tab-content">';
               
        if( count($options["query"]) > 0 ){ 
            foreach ( $options["query"] as $index => $row ){
            $posts = new WP_Query( $options["query"][$index] );
            if($posts->have_posts()) :                
                if( $index == 0 ){
                    $html .='<div class="row tab active" id="tab_'.esc_attr($options['id'].'_'.$index) .'" >';
                }else{
                    $html .='<div class="row tab" id="tab_'. esc_attr($options['id'].'_'.$index) .'" >';
                }
                $options['thumb_size'] = "flipmag-main-block";
                
                $i = 0;
                while($posts->have_posts()) : $posts->the_post();
                $rand = mt_rand();
                if( $i == 0 ){
                    $html .='<div class="column half">';
                    if( $options["feature_post"] == "classic" ){
                    $html .='<div class="oc-block block-7 " data-id="module_'. esc_attr($rand . $options['id']) .'" id="module_'. esc_attr($rand.$options['id']) .'" >';
                    
                        $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()):
                                $html .= '<div class="thumbs">';
                                
                                //category
                                $html .= $this->post_cat( $options );

                                //thumbnail
                                $html .= $this->post_thumbnail( $options );
                                
                                $html .= '</div>';
                            endif;

                            $html .= '<div class="content">'; 

                            //title
                            $html .= $this->post_title( $options );

                            $html .= '<div class="block-meta">';

                            //author
                            $html .= $this->post_author( $options );

                            //date
                            $html .= $this->post_date( $options );

                            //comment
                            $html .= $this->post_comment( $options );

                            $html .= '</div>';

                            //excerpt
                            $html .= $this->post_excerpt( $options );

                            $html .= '</div>';

                        $html .= '</article>';                    
                    $html .='</div>';
                    
                    }else if( $options["feature_post"] == "modern" ){
                        $html .='<div class="oc-block block-11" '.' data-id="module_'. esc_attr($rand . $options['id']) .'" id="module_'. esc_attr($rand . $options['id']) .'" >';
                            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                            $html .= '';

                            if(has_post_thumbnail()){
                                $html .= '<div class="thumbs">';
                            }else{
                                $html .= '<div class="thumbs no-image">';
                            }

                            //thumbnail
                            $html .= $this->post_thumbnail( $options );

                            $html .= '<div class="title-bar">';                

                                //category
                                $html .= $this->post_cat( $options );

                                //title
                                $html .= $this->post_title( $options );

                                $html .= '<div class="block-meta">';

                                //author
                                $html .= $this->post_author( $options );                    

                                //date
                                $html .= $this->post_date( $options );

                                //comment
                                $html .= $this->post_comment( $options );

                                $html .= '</div>';

                            $html .= '</div>';

                            $html .= '</div>';

                            $html .= '<div class="content">'; 

                            //excerpt
                            $html .= $this->post_excerpt( $options );

                            $html .= '</div>';

                        $html .= '</article>';
                        $html .='</div>';
                    }
                    $html .='</div>';
                }else{
                    if( $i == 1 ){                        
                        $html .='<ul class="oc-block block-3 column half" '. ' data-id="module_'. esc_attr($rand . $options['id']) .'" id="module_'. esc_attr($rand . $options['id']) .'" >';
                        $options['thumb_size'] = "flipmag-extra-small";
                    }
                    $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                        $html .= '';

                        if(has_post_thumbnail()):
                            $html .= '<div class="thumbs">';

                            //thumbnail
                            $html .= $this->post_thumbnails( $options );

                            $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">';

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';

                        $html .= '</div>';

                    $html .= '</li>';
                    if( $posts->post_count-1 == $i || $i == 4 ){
                        $html .='</ul>';
                    }
                }
                if( $i == 4 ){ 
                    break;
                }                
                    $i++;
                endwhile; wp_reset_postdata();
                
                $html .='</div>';

             else:

                if( $index == 0 ){
                    $html .='<div class="row tab active" id="tab_'.esc_attr($options['id'].'_'.$index) .'" >';
                }else{
                    $html .='<div class="row tab" id="tab_'. esc_attr($options['id'].'_'.$index) .'" >';
                }

                $html .= '<div class="col-12">'. __('Select posts in module.', "flipmag") . '</div>';

                $html .='</div>';                  
                
            endif; 
            }
        }else{
            $html .= __('Select posts in module.', "flipmag");
        }
        
        $html .='</div>';        
        $html .='</div>';
        
        
        return $html;
    }
    
    public function Module_5( $options, $query ){
        $html = "";
        $posts = new WP_Query( $query );

        $html .= '<div id="flipmag-bid-'. esc_attr($options['id']) .'">';

        //title
        $html .= $options['title'];

        $html .= '<div class="oc-module module-5 slideThumb" >';

        if($posts->have_posts()) :
            $html .= '<div class="flexslider">';
            $html .= '<ul class="slides oc-block block-11 ">';
                while($posts->have_posts()) : $posts->the_post();
                    if( has_post_thumbnail() ):
                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'flipmag-slider-small'  );
                        $html .= '<li data-thumb="'. esc_url($thumb[0]) .'" >';

                        $html .= '<article class="'. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                        
                            $html .= '<div class="thumbs">';

                            //thumbnail
                            $html .= $this->post_thumbnail( $options );

                                $html .= '<div class="title-bar">';                

                                    //category
                                    $html .= $this->post_cat( $options );

                                    //title
                                    $html .= $this->post_title( $options );

                                    $html .= '<div class="block-meta">';

                                    //author
                                    $html .= $this->post_author( $options );                 

                                    //date
                                    $html .= $this->post_date( $options );

                                    //comment
                                    $html .= $this->post_comment( $options );

                                    $html .= '</div>';

                                $html .= '</div>';

                            $html .= '</div>';

                        $html .= '</article>';
                        
                    $html .= '</li>';
                    endif;
                endwhile; wp_reset_postdata();
            $html .= '</ul>';            
            $html .= '</div>';
        endif;
        
        $html .= '</div>';
        $html .= '</div>';
        
       return $html;
    }
        
    public function Module_6( $options, $query ){
        $html = "";
        $posts = new WP_Query( $query );

        $html .= '<div class="module-6" id="flipmag-bid-'. esc_attr($options['id']) .'">';
        
        //title
        $html .= $options['title'];
        
        $html .= '<div class="gallery-block">';

        if($posts->have_posts()) :
            $html .= '<div class="flexslider carousel">';
            $html .= '<ul class="slides oc-block">';
                while($posts->have_posts()) : $posts->the_post();
                    $html .= '<li>';
                    
                    $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';                

                        if(has_post_thumbnail()):
                            $html .= '<div class="thumbs">';
                            
                            //thumbnail
                            $html .= $this->post_thumbnail( $options );
                            
                            $html .= '</div>';
                        endif;

                        $html .= '<div class="content">'; 

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">'; 

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';                        
                        
                        $html .= '</div>';

                    $html .= '</article>';
                        
                    $html .= '</li>';
                endwhile; wp_reset_postdata();
            $html .= '</ul>';
            $html .= '<div class="title-bar"></div>';
            $html .= '</div>';
        endif;
        
        $html .= '</div>';
        $html .= '</div>';
        
       return $html;
    }
        
    public function Module_7( $options, $query ){
        $html = "";
        $posts = new WP_Query( $query );
        
        wp_enqueue_script('flipmag-jssor');
        
        $html .= '<section class="full-thumb" id="flipmag-bid-'. esc_attr($options['id']) .'">';
        
        //title
        $html .= $options['title'];
        
        $html .= '<div class="oc-module module-7 full_thumb_container" id="slider_'. esc_attr($options['id']) .'" >';

        if($posts->have_posts()) :
            
            $html .= '<!-- Loading Screen -->
            <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block; top: 0px; left: 0px;width: 100%;height:100%;">
                </div>
                <div style="position: absolute; display: block; top: 42%; left: 48%;width: 100%;height:100%;"><i class="fa fa-circle-o-notch fa-spin fa-2x"></i>
                </div>
            </div>';

        $html .= '<div data-u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 720px; height: 350px; overflow: hidden;">';
       
       while($posts->have_posts()) : $posts->the_post();  
        $html .= '<div itemscope itemtype="http://schema.org/Organization" >';
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'flipmag-slider-small'  );
       
            $html .= '<a href="'. esc_url(get_the_permalink()) .'" itemprop="url">';
            if( has_post_thumbnail() ):
                $html .= get_the_post_thumbnail( get_the_ID() , $options['thumb_size'] , array('data-u' => 'image','title' => esc_attr(strip_tags(get_the_title())), 'itemprop' => 'image') );            
            endif;
            if (get_post_format() && has_post_thumbnail() ):
                $html .= '<span class="post-format-icon '.esc_attr(get_post_format()) .'">';
                    $html .= apply_filters('flipmag_post_formats_icon', '');
                $html .= '</span>';
            endif;
            
            $html .= '</a>';

           if( has_post_thumbnail() ):
               $html .= get_the_post_thumbnail( get_the_ID() , 'flipmag-slider-small' , array('data-u' => 'thumb','title' => esc_attr(strip_tags(get_the_title())), 'itemprop' => 'image') );
           endif;

            $html .= '<div class="caption">';
            
            //category
            $html .= $this->post_cat( $options );
            
            //title
            $html .= $this->post_title( $options );
            
            $html .= '</div>';
            
         $html .= '</div>';
       endwhile; wp_reset_postdata();
       
       $html .= '</div>';
       
       $html .= '<div data-u="thumbnavigator" class="jssort07" style="width: 720px; height: 100px; left: 0px; bottom: 0px;">
                <!-- Thumbnail Item Skin Begin -->
                <div data-u="slides" style="cursor: default;">
                    <div data-u="prototype" class="p">
                        <div data-u="thumbnailtemplate" class="i"></div>
                        <div class="o"></div>
                    </div>
                </div>
                <!-- Arrow Left -->
                <span data-u="arrowleft" class="jssora11l" style="top: 123px; left: 8px;">
                </span>
                <!-- Arrow Right -->
                <span data-u="arrowright" class="jssora11r" style="top: 123px; right: 8px;">
                </span>
                <!--#endregion Arrow Navigator Skin End -->
            </div> ';
       
       $html .= '</div>';
       $html .= '</section>';
       
       $html .= '<script>jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)
                $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $Cols: 6,
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $Loop: 1,                                       //[Optional] Enable loop(circular) of carousel or not, 0: stop, 1: loop, 2 rewind, default value is 1
                    $SpacingX: 2,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 3,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 6,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 100,                          //[Optional] The offset position to park thumbnail,
                    $ArrowNavigatorOptions: {
                        $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                        $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                        $AutoCenter: 2,                                 //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                        $Steps: 6                                       //[Optional] Steps to go for each navigation request, default value is 1
                    }
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider_'. esc_js($options['id']) .'", options);
            //responsive code begin
            //you can remove responsive code if you don\'t want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, 720));
                else
                    window.setTimeout(ScaleSlider, 30);
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            //responsive code end
        });
    </script>';
        endif;     
       
       return $html;
    }
    
    public function block_1( $options = array(), $posts ){
        $html = '';
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-1-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-1-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-1 " '. $data_infinite .' data-id="'. $options['id'] .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_1( $options, $posts );
           
        $html .='</div>';
            
        return $html;
        
    }
    
    public function post_block_1( $options = array(), $posts ){
        $html = '';
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post();
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';
                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
        endwhile; wp_reset_postdata();     
        
        return $html;
    }
    
    public function block_2( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-2-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-2-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-2 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_2( $options, $posts );
        
        $html .='</div>';
            
        return $html;
        
    }
    
    public function post_block_2( $options = array(), $posts ){
        $html = '';
     
            if( $options['pagination'] == 'ajax' ){
                $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
            }
        
            while($posts->have_posts()) : $posts->the_post();
                $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                    $html .= '';
                    
                    if(has_post_thumbnail()):

                        $html .= '<div class="thumbs">';
                        
                        //category
                        $html .= $this->post_cat( $options );
                        
                        //thumbnail
                        $html .= $this->post_thumbnail( $options );                    
                        
                        $html .= '</div>';

                    endif;
                    
                    $html .= '<div class="content">'; 
                    
                    //title
                    $html .= $this->post_title( $options );

                    $html .= '<div class="block-meta">';   
		
                    //author
                    $html .= $this->post_author( $options );                    
                    
                    //date
                    $html .= $this->post_date( $options );
                    
                    //comment
                    $html .= $this->post_comment( $options );

                    $html .= '</div>';
                    
                    //excerpt
                    $html .= $this->post_excerpt( $options );
                    
                    $html .= '</div>';
                    
                $html .= '</article>';
            endwhile; wp_reset_postdata(); 
        
        
        return $html;
    }
        
    public function block_3( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-3-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-3-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-3 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_3( $options, $posts );
        
        $html .='</div>';
            
        return $html;        
    }
    
    public function post_block_3( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        $html .= '<ul class="no-margin">';
        
        while($posts->have_posts()) : $posts->the_post();
            $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';

                    //thumbnail
                    $html .= $this->post_thumbnails( $options );                    

                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                $html .= '</div>';

            $html .= '</li>';
        endwhile; wp_reset_postdata();
        
        $html .= '</ul>';
        
        return $html;
    }
            
    public function block_4( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-4-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-4-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-4 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_4( $options, $posts );
        
        $html .='</div>';
            
        return $html;        
    }
    
    public function post_block_4( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
            $html .= '<ul class="no-margin">';
        
            while($posts->have_posts()) : $posts->the_post();
                $html .= '<li class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                    $html .= '';

                    if(has_post_thumbnail()):
                    
                        $html .= '<div class="thumbs">';
                        
                        //thumbnail
                        $html .= $this->post_thumbnails( $options );                    
                        
                        $html .= '</div>';

                    endif;
                    
                    $html .= '<div class="content">'; 
                    
                    //title
                    $html .= $this->post_title( $options );

                    $html .= '<div class="block-meta">'; 
		
                    //author
                    $html .= $this->post_author( $options );                    
                    
                    //date
                    $html .= $this->post_date( $options );
                    
                    //comment
                    $html .= $this->post_comment( $options );

                    $html .= '</div>';
                    
                    $html .= '</div>';
                    
                $html .= '</li>';
            endwhile; wp_reset_postdata();
            
            $html .= '</ul>';
        
        return $html;
    }
                
    public function block_5( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-5-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-5-' )) .'"'; 
        }
        
        $html .='<ul class="oc-block block-5 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_5( $options, $posts );
        
        $html .='</ul>';
            
        return $html;
    }
    
    public function post_block_5( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post();            
            $html .= '<li class=" column half '. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';

                    //thumbnail
                    $html .= $this->post_thumbnails( $options );                    

                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';   

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                $html .= '</div>';

            $html .= '</li>';            
            
        endwhile; wp_reset_postdata();
        
        return $html;
    }
                
    public function block_6( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-6-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-6-' )) .'"'; 
        }
        
        $html .='<ul class="oc-block block-6 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_6( $options, $posts );
        
        $html .='</ul>';
            
        return $html;
    }
    
    public function post_block_6( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post();            
            $html .= '<li class=" column half '. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';

                    //thumbnail
                    $html .= $this->post_thumbnails( $options );                    

                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';  

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                $html .= '</div>';

            $html .= '</li>';            
            
        endwhile; wp_reset_postdata();
        
        return $html;
    }
    
    public function block_7( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-7-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-7-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-7 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_7( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_7( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
        endwhile; wp_reset_postdata();
        
        return $html;
    }
        
    public function block_8( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-8-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-8-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-8 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_8( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_8( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'.esc_attr( $options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';  

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
        endwhile; wp_reset_postdata();
        
        return $html;
    }
    
    public function block_9( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-9-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-9-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-9 row" '. $data_infinite .' data-id="'. esc_attr($options['id'] ).'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_9( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_9( $options = array(), $posts ){
        $html = '';
    
        while($posts->have_posts()) : $posts->the_post();         
        
            $html .= '<div class="column half">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
            
        endwhile; wp_reset_postdata();
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
        
    public function block_10( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-10-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-10-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-10 row" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_10( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_10( $options = array(), $posts ){
        $html = '';
    
        while($posts->have_posts()) : $posts->the_post();         
        
            $html .= '<div class="column one-third">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
            
        endwhile; wp_reset_postdata();
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
        
    public function block_11( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-11-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-11-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-11" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_11( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_11( $options = array(), $posts ){
        $html = '';
    
        while($posts->have_posts()) : $posts->the_post();         
        
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()){
                    $html .= '<div class="thumbs">';
                }else{
                    $html .= '<div class="thumbs no-image">';
                }

                //thumbnail
                $html .= $this->post_thumbnail( $options );
                
                    $html .= '<div class="title-bar">';                

                        //category
                        $html .= $this->post_cat( $options );

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">'; 

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';

                    $html .= '</div>';

                $html .= '</div>';

                if( $options["disable_excerpt"] == "no" ):

                    $html .= '<div class="content">'; 

                    //excerpt
                    $html .= $this->post_excerpt( $options );

                    $html .= '</div>';

                endif;

            $html .= '</article>';
            
        endwhile; wp_reset_postdata();
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
        
    public function block_12( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-12-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-12-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-12 row" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_12( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_12( $options = array(), $posts ){
        $html = '';
    
        while($posts->have_posts()) : $posts->the_post();         
        
            $html .= '<div class="column half">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()){
                    $html .= '<div class="thumbs">';
                }else{
                    $html .= '<div class="thumbs no-image">';
                }

                //thumbnail
                $html .= $this->post_thumbnail( $options );
                
                    $html .= '<div class="title-bar">';                

                        //category
                        $html .= $this->post_cat( $options );

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">';

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';

                    $html .= '</div>';

                $html .= '</div>';

                if( $options["disable_excerpt"] == "no" ):

                    $html .= '<div class="content">'; 

                    //excerpt
                    $html .= $this->post_excerpt( $options );

                    $html .= '</div>';

                endif;

            $html .= '</article>';
            $html .= '</div>';
            
        endwhile; wp_reset_postdata();
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
        
    public function block_13( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-13-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-13-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-13 row" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_13( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_13( $options = array(), $posts ){
        $html = '';
    
        while($posts->have_posts()) : $posts->the_post();         
        
            $html .= '<div class="column one-third">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()){
                    $html .= '<div class="thumbs">';
                }else{
                    $html .= '<div class="thumbs no-image">';
                }

                //thumbnail
                $html .= $this->post_thumbnail( $options );
                
                    $html .= '<div class="title-bar">';                

                        //category
                        $html .= $this->post_cat( $options );

                        //title
                        $html .= $this->post_title( $options );

                        $html .= '<div class="block-meta">';

                        //author
                        $html .= $this->post_author( $options );                    

                        //date
                        $html .= $this->post_date( $options );

                        //comment
                        $html .= $this->post_comment( $options );

                        $html .= '</div>';

                    $html .= '</div>';

                $html .= '</div>';

                if( $options["disable_excerpt"] == "no" ):

                    $html .= '<div class="content">'; 

                    //excerpt
                    $html .= $this->post_excerpt( $options );

                    $html .= '</div>';

                endif;

            $html .= '</article>';
            $html .= '</div>';
            
        endwhile; wp_reset_postdata();
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
            
    public function block_14( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-14-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-14-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-14 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_14( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_14( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
        endwhile; wp_reset_postdata();
        
        return $html;
    }
    
    public function block_15( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-15-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-15-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-15 row" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_15( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_15( $options = array(), $posts ){
        $html = '';
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<div class="column half">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';  

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
        endwhile; wp_reset_postdata();
        
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
    
    public function block_16( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-16-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-16-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-16 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_16( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_16( $options = array(), $posts ){
        $html = '';
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<div class="column one-third">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';   

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
        endwhile; wp_reset_postdata();
        
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
    
        
        return $html;
    }
    
    public function block_17( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-17-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-17-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-17 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_17( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_17( $options = array(), $posts ){
        $html = '';
    
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
        endwhile; wp_reset_postdata();
        
        return $html;
    }
    
    public function block_18( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-18-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-18-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-18 row" '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_18( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_18( $options = array(), $posts ){
        $html = '';
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<div class="column half">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">'; 

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
        endwhile; wp_reset_postdata();
        
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
        
        return $html;
    }
    
    public function block_19( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-19-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-19-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-19 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_19( $options, $posts );
        
        $html .='</div>';
            
        return $html;
    }
    
    public function post_block_19( $options = array(), $posts ){
        $html = '';
        
        while($posts->have_posts()) : $posts->the_post(); 
            $html .= '<div class="column one-third">';
            $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                $html .= '';

                if(has_post_thumbnail()):

                    $html .= '<div class="thumbs">';
                    
                    //category
                    $html .= $this->post_cat( $options );

                    //thumbnail
                    $html .= $this->post_thumbnail( $options );
                    
                    $html .= '</div>';

                endif;

                $html .= '<div class="content">'; 

                //title
                $html .= $this->post_title( $options );

                $html .= '<div class="block-meta">';

                //author
                $html .= $this->post_author( $options );                    

                //date
                $html .= $this->post_date( $options );

                //comment
                $html .= $this->post_comment( $options );

                $html .= '</div>';

                //excerpt
                $html .= $this->post_excerpt( $options );

                $html .= '</div>';

            $html .= '</article>';
            $html .= '</div>';
        endwhile; wp_reset_postdata();
        
        
        if( $options['pagination'] == 'ajax' ){
            $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
        }
    
        
        return $html;
    }
    
    
    public function block_20( $options = array(), $posts ){
        $html = '';        
        $data_infinite = '';
        
        if( $options['pagination'] == 'infinite' ){
            $data_infinite = 'data-infinite="'. esc_attr(Flipmag::markup()->unique_id( 'block-20-' )) .'"'; 
        }
        
        if( $options['pagination'] == 'ajax' ){
            $data_infinite = 'data-ajax="'. esc_attr(Flipmag::markup()->unique_id( 'block-20-' )) .'"'; 
        }
        
        $html .='<div class="oc-block block-20 " '. $data_infinite .' data-id="'. esc_attr($options['id']) .'" id="block_'. esc_attr($options['id']) .'" >';
        
            $html .= $this->post_block_20( $options, $posts );
        
        $html .='</div>';
            
        return $html;
        
    }
    
    public function post_block_20( $options = array(), $posts ){
        $html = '';
     
            if( $options['pagination'] == 'ajax' ){
                $html .= '<div class="block-ajax-loading"  id="bloader_'. esc_attr($options['id']) .'" ><i class="fa fa-circle-o-notch fa-spin"></i></div>';
            }
        
            while($posts->have_posts()) : $posts->the_post();
                $html .= '<article class="'. implode(' ', get_post_class()).' '. esc_attr($options['animation']) .'" itemscope itemtype="http://schema.org/Article" >';
                    $html .= '';
                    
                    $html .= '<div class="content">'; 
                    
                    //title
                    $html .= $this->post_title( $options );

                    $html .= '<div class="block-meta">';  
		
                    //author
                    $html .= $this->post_author( $options );                    
                    
                    //date
                    $html .= $this->post_date( $options );
                    
                    //comment
                    $html .= $this->post_comment( $options );

                    $html .= '</div>';
                    
                    //excerpt
                    $html .= $this->post_excerpt( $options );
                    
                    $html .= '</div>';
                    
                $html .= '</article>';
            endwhile; wp_reset_postdata(); 
        
        
        return $html;
    }
    
    public function post_author( $options = array() ){
        $html = '';
        
        if( $options["disable_author"] == "no" ){
			$user = get_user_by('id', get_the_author_meta( 'ID' ) );

            if( !empty($user) ){ 
                $html .= '<span class="posted-by">';
                if(is_rtl()){                        
                    $html .= ' <span class="author" itemprop="author"><a href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'. esc_html($user->display_name). '</a></span>&nbsp;';
                    $html .= __('By','flipmag');                
                }else{
                    $html .= __('By','flipmag');        
                    $html .= ' <span class="author" itemprop="author"><a href="'. esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'. esc_html($user->display_name). '</a></span>';
                }
                $html .= '</span>';
            }            
        }
        return $html;
    }
    
    public function post_date( $options = array() ){
        $html = '';
        
        if( $options["disable_date"] == "no" ){
            
            if( $options["date_link"] == "year" ){
                
                $link = get_year_link( get_post_time('Y') );
            }else if( $options["date_link"] == "month" ){
                
                $link = get_month_link( get_post_time('Y'), get_post_time('m') );
            }else if( $options["date_link"] == "day" ){
                
                $link = get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') );
            }
            
            $html .= '<time datetime="'. esc_attr(get_the_date('Y-m-d\TH:i:sP')) .'" itemprop="datePublished"><a href="'. esc_url($link) .'">'. esc_html(get_the_date( $options["date_format"]) ).'</a></time>';
        }
        return $html;
    }
    
    public function post_comment( $options = array() ){
        $html = '';
        
        if( $options["disable_comment"] == "no" ){
            $html .= '<span class="comments"><a href="'. esc_url(get_comments_link()) .'"><i class="fa fa-comments-o"></i> '. get_comments_number() .'</a></span>';
        }
        return $html;
    }
     
    public function post_excerpt( $options = array() ){
        $html = '';
        
        if( $options["disable_excerpt"] == "no" ){
            $html .= '<div class="excerpt">';
               $html .= $this->excerpt( null ,  $options['excerpt_length'] , array());

               if (array_key_exists('disable_more', $options)) { 
                   if( $options["disable_more"] == "no" ){
                       $html .= $this->excerpt_read_more();
                   }
               }

            $html .= '</div>';
        }        
        
        return $html;
    }
    
    public function post_title( $options = array() ){
        $html = '';
        $html .= '<a href="'. esc_url(get_the_permalink()) .'" title="'. esc_attr(get_the_title() ? get_the_title() : get_the_ID()) .'" itemprop="name url"><h3>';
            $html .= esc_html(get_the_title() ? get_the_title() : get_the_ID());
        $html .= '</h3></a>';
        
        return $html;
    }
    
    public function post_thumbnail( $options = array() ){
        $html = '<span class="fa fa-circle-o-notch fa-spin loader-img"></span>';
        
        $html .= '<a href="'. esc_url(get_the_permalink()) .'" itemprop="url">';
        
            if(has_post_thumbnail()):
                $html .= get_the_post_thumbnail( get_the_ID() , $options["thumb_size"], array('title' => esc_attr(strip_tags(get_the_title())), 'itemprop' => 'image') ); 
            endif;
            
            if (get_post_format() && has_post_thumbnail() ):
                $html .= '<span class="post-format-icon '.esc_attr(get_post_format()) .'">';
                    $html .= apply_filters('flipmag_post_formats_icon', '');
                $html .= '</span>';
            endif;
            
        $html .= '</a>'; 
        
        return $html;
    }
    
    public function get_thumb_size( $block ){
        $size = "flipmag-main-full";

        $b = explode("_", $block );
        if( $b[1] == "1" || $b[1] == "2" || $b[1] == "10" ){
            $size = "flipmag-main-block";
        }else if( $b[1] == "3" || $b[1] == "4" || $b[1] == "5" || $b[1] == "6" ){
            $size = "flipmag-extra-small";
        }else if( $b[1] == "7" || $b[1] == "9" || $b[1] == "15" || $b[1] == "16" || $b[1] == "18" || $b[1] == "19" ){
            $size = "flipmag-main-slider";
        }
       
        return $size;
    }


    public function post_thumbnails( $options = array() ){
        $html = '<span class="fa fa-circle-o-notch fa-spin loader-img"></span>';
        
        $html .= '<a href="'. esc_url(get_the_permalink()) .'" itemprop="url">';  
            if(has_post_thumbnail()):
                $html .= get_the_post_thumbnail( get_the_ID() ,  $options["thumb_size"], array('title' => esc_attr(strip_tags(get_the_title())), 'itemprop' => 'image') );
            endif;
            
        $html .= '</a>'; 
        
        return $html;
    }
    
    public function post_cat( $options = array() ){
        $html = '';
        
        if ( $options["disable_cat"] == "no" && in_array('category', get_object_taxonomies(get_post_type()))):
				
            // custom label selected?				
            if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                $category = get_category($cat_label);
            }
            else {
                $category = current(get_the_category());						
            }

            $html .= '<span class="cat-title cat-'. esc_attr($category->cat_ID) .'">';
                $html .= '<a href="'. esc_url(get_category_link($category)) .'">'. esc_html($category->name) .'</a>';
            $html .= '</span>';
        endif;
        
        return $html;
    }
    
    public function unique_id(){
        return str_shuffle('abcdefghijklmnopqrtuvwxyz');
    }
    /**
    * Custom excerpt function - utilize existing wordpress functions to add real support for <!--more-->
    * to excerpts which is missing in the_excerpt().
    * 
    * Maintain plugin functionality by utilizing wordpress core functions and filters. 
    * 
    * @param  string|null  $text
    * @param  integer  $length
    * @param  array   $options   add_more: add more if needed, more_text = more link anchor, force_more: always add more link
    * @return string
    */
    public function excerpt($text = null, $length = 55, $options = array())
    {
            global $flipmag_more;

            // add defaults
            $options = array_merge(array('add_more' => null, 'force_more' => null), $options);

            // add support for <!--more--> cut-off on custom home-pages and the like
            $old_more = $flipmag_more;
            $flipmag_more = false;

            // override options
            $more_text = $this->more_text;
            extract($options);

            // set global more_text 
            $this->more_text = $more_text;

            if (!$text) {

                    // have a manual excerpt?
                    if (has_excerpt()) {                        
                            return apply_filters('the_excerpt', get_the_excerpt());
                    }			
                    // don't add "more" link
                    $text = get_the_content('');
            }

            $text = strip_shortcodes(apply_filters('flipmag_excerpt_pre_strip_shortcodes', $text));
            $text = str_replace(']]>', ']]&gt;', $text);

            // get plaintext excerpt trimmed to right length
            $excerpt = wp_trim_words($text, $length, '&hellip;'); 


            /*
             * Force "More" link?
             * 
             * wp_trim_words() will only add the read more link if it's needed - if the length actually EXCEEDS. In some cases,
             * for styling, read more has to be always present. 
             * 
             */
            
            // fix extra spaces
            $excerpt = trim(str_replace('&nbsp;', ' ', $excerpt)); 

            // apply filters after to prevent added html functionality from being stripped
            // REMOVED: the_content filters often clutter the HTML - use the_excerpt filter instead 
            // $excerpt = apply_filters('the_content', $excerpt);

            $excerpt = apply_filters('the_excerpt', apply_filters('get_the_excerpt', $excerpt));

            // revert
            $flipmag_more = $old_more;

            return $excerpt;
    }
    
    /**
    * Add the read more text to excerpts
    */
    public function excerpt_read_more()
    {
            global $post;

            if (is_feed()) {
                    return __(' [...]', 'flipmag');
            }
            
            $text = $this->more_text;
            if (!$text) {
                    $text = __('Read More', 'flipmag');
            }
            
            return '<div class="read-more"><a href="'. get_permalink($post->ID) . '" title="'. esc_attr($text) . '">'. esc_html($text) .'</a></div>';	

    }
    
    public function tp_relative_time($a) {
        //get current timestampt
        $b = strtotime('now'); 
        //get timestamp when tweet created
        $c = strtotime($a);
        //get difference
        $d = $b - $c;
        //calculate different time values
        $minute = 60;
        $hour = $minute * 60;
        $day = $hour * 24;
        $week = $day * 7;

        if(is_numeric($d) && $d > 0) {
                //if less then 3 seconds
                if($d < 3) return __('right now','flipmag');
                //if less then minute
                if($d < $minute) return floor($d) . __(' seconds ago','flipmag');
                //if less then 2 minutes
                if($d < $minute * 2) return __('about 1 minute ago','flipmag');
                //if less then hour
                if($d < $hour) return floor($d / $minute) . __(' minutes ago','flipmag');
                //if less then 2 hours
                if($d < $hour * 2) return __('about 1 hour ago','flipmag');
                //if less then day
                if($d < $day) return floor($d / $hour) . __(' hours ago','flipmag');
                //if more then day, but less then 2 days
                if($d > $day && $d < $day * 2) return __('yesterday','flipmag');
                //if less then year
                if($d < $day * 365) return floor($d / $day) . __(' days ago','flipmag');
                //else return more than a year
                return __('over a year ago','flipmag');
        }
    }
    
    public function tp_convert_links($status,$targetBlank=true,$linkMaxLen=250){

        // the target
        $target=$targetBlank ? " target=\"_blank\" " : "";

        // convert link to url								
        $status = preg_replace('/\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[A-Z0-9+&@#\/%=~_|]/i', '<a href="\0" target="_blank" class="links">\0</a>', $status);

        // convert @ to follow
        $status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

        // convert # to search
        $status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

        // return the status
        return $status;
    }

    public function TwitterAuth(){

        if( class_exists( 'Flipmag_ShortCodes' ) ){
            $Flipmag_ShortCodes = new Flipmag_ShortCodes();
            $Flipmag_ShortCodes->twiiterLibrary();
        }
    }

    public function format_num($num, $precision = 2) {
        if ($num >= 1000 && $num < 1000000) {
            $n_format = number_format($num/1000,$precision).'K';
        }else if ($num >= 1000000 && $num < 1000000000) {
            $n_format = number_format($num/1000000,$precision).'M';
        } else if ($num >= 1000000000) {
            $n_format=number_format($num/1000000000,$precision).'B';
        } else {
            $n_format = $num;
         }
       return $n_format;
    } 
}