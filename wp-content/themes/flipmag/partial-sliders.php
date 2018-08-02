<?php

$limit = 5;

// get latest featured posts
$args = apply_filters(
	'flipmag_block_query_args', 
	array('meta_key' => '_flipmag_featured_post', 
              'meta_value' => 1, 
              'order' => 'date', 
              'posts_per_page' => $limit , 
              'ignore_sticky_posts' => 1),
              'slider'
);

if (is_category()) {
	$cat = get_query_var('cat');
	$meta = Flipmag::options()->get('cat_meta_' . $cat);
	
	// slider not enabled? quit!
	if (empty($meta['slider'])) {
		return;
	}
		
	$args['cat'] = $cat;
        
	// latest posts?
	if ($meta['slider'] == 'latest') {
		unset($args['meta_key'], $args['meta_value']);
	}
}

if( Flipmag::posts()->meta('featured_style') != null ){
    $meta['feature_style'] = Flipmag::posts()->meta('featured_style');
}

// use latest posts?
if (Flipmag::posts()->meta('featured_slider') == 'default-latest') {
	unset($args['meta_key'], $args['meta_value']);
}

if( $meta['feature_style'] == 2 || $meta['feature_style'] == 3 ){
    $args['posts_per_page'] = 4;
}

if( $meta['feature_style'] == 4 || $meta['feature_style'] == 5 ){
    $args['posts_per_page'] = 3;
}

$featured = new WP_Query($args);

if( Flipmag::posts()->meta('featured_slider') == 'posts' ){
    $args = siteorigin_widget_post_selector_process_query( 'post__in='.Flipmag::posts()->meta('posts') );
    $args['posts_per_page'] = $limit;
    $featured = new WP_Query( $args );
}

if ( !$featured->have_posts() ) {
	return;
}

if ( ( $meta['feature_style'] == 1 && $featured->post_count < 5 ) || 
     ( $meta['feature_style'] == 2 && $featured->post_count < 4 ) ||
     ( $meta['feature_style'] == 3 && $featured->post_count < 4 ) ||
     ( $meta['feature_style'] == 4 && $featured->post_count < 3 ) ||
     ( $meta['feature_style'] == 5 && $featured->post_count < 3 ) ||
     ( $meta['feature_style'] == 6 && $featured->post_count < 1 ) || 
     ( $meta['feature_style'] == 7 && $featured->post_count < 1 ) ) {
	return;
}

if( Flipmag::posts()->meta('feature_wrap') != null ){
    $meta['feature_wrap'] = Flipmag::posts()->meta('feature_wrap');
}

if( Flipmag::posts()->meta('featured_overlay') != null ){
    $meta['featured_overlay'] = Flipmag::posts()->meta('featured_overlay');
}

if( !isset($meta['feature_wrap']) || $meta['feature_wrap'] == null ){
    $meta['feature_wrap'] = "yes";
}

$featured_overlay = '';
if( $meta['feature_wrap'] != "0" ){
    $featured_overlay = 'featured-overlay-'. @$meta['featured_overlay'];
}

$x = 1;

?>
<div class="main-featured <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" >
     <div class="<?php echo esc_attr($meta['feature_wrap']=="yes"?"wrap":"no-wrap"); ?> cf featured-style-<?php echo esc_attr($meta['feature_style']); ?> <?php echo esc_attr($featured_overlay); ?>">
        <?php if ( is_category() && trim(Flipmag::options()->oc_ad_cat_feature) != null ) { ?>
        <div class="row cf">
            <div class="col-12" >
                <div class="ads"><?php echo wp_kses_stripslashes(trim(Flipmag::options()->oc_ad_cat_feature)); ?></div>
            </div>
        </div>        
        <?php } else if( !is_category() && trim(Flipmag::options()->oc_ad_page_feature) != null ){ ?>
        <div class="row cf">
            <div class="col-12" >
                <div class="ads"><?php echo wp_kses_stripslashes(trim(Flipmag::options()->oc_ad_page_feature)); ?></div>
            </div>
        </div>
        <?php } ?>
        
        <?php if( $meta['feature_style'] == 1 ){ ?>
        <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?> ">
            <?php while ($featured->have_posts()): $featured->the_post(); 

                $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $title = get_the_title();                
            
                // custom label selected?				
                if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                        $category = get_category($cat_label);
                }else {
                        $category = current(get_the_category());						
                }
                ?>
                <?php if( $x == 1 ){ ?>
                        <div class="col-6 <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" data-style="no-padding" >
                <?php } else if( $x == 2 ){ ?>
                        <div class="col-3" > 
                <?php } else if( $x == 4 ){ ?>
                        <div class="col-3 last <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" data-style="no-padding" > 
                <?php } ?>

                <div class="featured-container" >
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                        </div>
                    </a>                    
                    <div class="title_bar">                        
                        <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>                        
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                    </div>
                </div>                            
                <?php if( $x == 1 ){ ?> </div> <?php }else if( $x == 3 || $x == 5 ){ ?> </div> <?php } ?>
            <?php $x++; endwhile; wp_reset_postdata(); ?>
            </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>
            <?php }else if( $meta['feature_style'] == 2 ){ ?>            
                <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
                <?php while ($featured->have_posts()): $featured->the_post(); 

                        $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $title = get_the_title();                        
                    
                        // custom label selected?				
                        if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                                $category = get_category($cat_label);
                        }else {
                                $category = current(get_the_category());						
                        }
                    ?>
                    <?php if( $x == 1 ){ ?>
                            <div class="col-6 <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" data-style="no-padding" >
                    <?php } else if( $x == 2 ){ ?>
                            <div class="col-3" > 
                    <?php } else if( $x == 3 ){ ?>
                            <div class="col-3 last <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" data-style="no-padding" > 
                    <?php } ?>
                    <div class="featured-container" >
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                            </div>
                        </a>                        
                        <div class="title_bar">                            
                            <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>                            
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                        </div>
                    </div>                                
                    <?php if( $x == 1 ){ ?> </div> <?php }else if( $x == 2 || $x == 4 ){ ?> </div> <?php } ?>
                <?php $x++; endwhile; wp_reset_postdata(); ?>
                </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>      
            <?php }else if( $meta['feature_style'] == 3 ){ ?>            
                <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
                <?php while ($featured->have_posts()): $featured->the_post();
                        $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $title = get_the_title();

                        // custom label selected?				
                        if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                                $category = get_category($cat_label);
                        }else {
                                $category = current(get_the_category());						
                        }
                    ?>
                    <?php if( $x == 1 ){ ?>
                            <div class="col-3 first <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>" data-style="no-padding" >
                    <?php }else if( $x == 2 ){ ?>
                            <div class="col-3 second" >
                    <?php }else if( $x == 3 ){ ?>
                            <div class="col-3 third" >
                    <?php } else if( $x == 4 ){ ?>
                            <div class="col-3 last <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding-right":""); ?>" data-style="no-padding-right" > 
                    <?php } ?>
                    <div class="featured-container" >
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                            </div>
                        </a>
                        <div class="title_bar">
                            <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                        </div>
                    </div>
                    </div>
                <?php if( $x == 4 ){ break; } $x++; endwhile; wp_reset_postdata(); ?>
                </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>              
            <?php }else if( $meta['feature_style'] == 4 ){  ?>            
                <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
                 <?php while ($featured->have_posts()): $featured->the_post();
                        $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                        $title = get_the_title();

                        // custom label selected?				
                        if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                                $category = get_category($cat_label);
                        }else {
                                $category = current(get_the_category());						
                        }
                    ?>
                    <?php if( $x == 1 ){ ?>
                        <div class="col-4 first <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>"  data-style="no-padding" >
                    <?php }else if( $x == 2 ){ ?>
                            <div class="col-4 second" >
                    <?php }else if( $x == 3 ){ ?>
                        <div class="col-4 last <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding-right":""); ?>"  data-style="no-padding-right" >
                    <?php } ?>
                    <div class="featured-container" >
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                            <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                            </div>
                        </a>
                        <div class="title_bar">
                            <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                        </div>
                    </div>
                    </div>
                <?php if( $x == 3 ){ break; } $x++; endwhile; wp_reset_postdata(); ?>
                </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>                           
            <?php }else if( $meta['feature_style'] == 5 ){ ?>             
            <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
            <?php while ($featured->have_posts()): $featured->the_post(); 
                    $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $title = get_the_title();                    
                
                    // custom label selected?				
                    if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                            $category = get_category($cat_label);
                    }else {
                            $category = current(get_the_category());						
                    }
                ?>
                <?php if( $x == 1 ){ ?>
                        <div class="col-6 <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>"  data-style="no-padding" >
                <?php } else if( $x == 2 ){ ?>
                        <div class="col-3" > 
                <?php } else if( $x == 3 ){ ?>
                        <div class="col-3 last <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding-right":""); ?>"  data-style="no-padding-right"> 
                <?php } ?>
                <div class="featured-container" >
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                        </div>
                    </a>                    
                    <div class="title_bar">                        
                        <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>                        
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                    </div>
                </div>                            
                </div>
            <?php if( $x == 3 ){ break; } $x++; endwhile; wp_reset_postdata(); ?>
            </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>        
            <?php }else if( $meta['feature_style'] == 6 ){ ?>             
            <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
            <?php while ($featured->have_posts()): $featured->the_post(); 
                    $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $title = get_the_title();                    
                
                    // custom label selected?				
                    if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                            $category = get_category($cat_label);
                    }else {
                            $category = current(get_the_category());						
                    }                    
                ?>
                <?php if( $x == 1 ){ ?>
                <div class="col-12 <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>"  data-style="no-padding" >              
                    <div class="featured-container" >
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                        </div>
                    </a>                    
                    <div class="title_bar">                        
                        <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>                        
                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                    </div>
                </div>                            
                </div>                    
                <?php } ?>                
            <?php $x++; endwhile; wp_reset_postdata(); ?>
            </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>         
            <?php }else if( $meta['feature_style'] == 7 ){ ?>             
            <div class="row cf <?php echo esc_attr($meta['feature_wrap']=="no"?"no-margin":""); ?>">
            <?php while ($featured->have_posts()): $featured->the_post(); 
                    $thumb = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                    $title = get_the_title();                    
                
                    // custom label selected?				
                    if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
                            $category = get_category($cat_label);
                    }else {
                            $category = current(get_the_category());						
                    }
                    
                ?>
                <?php if( $x == 1 ){ ?>
                <div class="col-12 <?php echo esc_attr($meta['feature_wrap']=="no"?"no-padding":""); ?>"  data-style="no-padding" >              
                    <div class="featured-container" >
                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                        <div class="featured-box-main featured-box-<?php echo esc_attr($x); ?> " style="  background-image: url( '<?php echo esc_url($thumb); ?>' ) ; " >                            
                        </div>
                    </a>                        
                    <div class="title_bar">
                        <?php echo ($meta['feature_wrap']=="no"? '<div class="wrap">':""); ?>
                        <div class="column half wrap-text">                            
                            <div class="cat cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></div>
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h4><?php echo esc_html($title); ?></h4></a>
                        </div>                        
                        <div class="column half wrap-sub">
                            <ul class="wrap-sub-list">
                <?php }else{ ?>
                        <li>
                            <span class="feat-cat"><a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></span>
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><h3><?php echo esc_html($title); ?></h3></a>
                        </li>
                <?php } ?>
                <?php if( $featured->post_count == $x ){  ?>
                            </ul>
                        </div>
                        <?php echo ($meta['feature_wrap']=="no"? "</div>":""); ?>
                    </div>
                </div>                            
                </div>                    
                <?php } ?>                
            <?php $x++; endwhile; wp_reset_postdata(); ?>
            </div>
            <span class="fa fa-circle-o-notch fa-spin loader-img"></span>
            <?php } ?>
    </div>
</div>
