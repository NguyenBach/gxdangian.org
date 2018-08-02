<?php

/**
 * Content Template is used for every post format and used on single posts
 */

$classes = get_post_class();

// using the title above featured image variant?
$layout = Flipmag::posts()->meta('layout_template');
if (is_single() && $layout == 'classic-above') {
	$classes[] = 'title-above'; 
}else{
	$layout = 'classic';
}

?>

<article id="post-<?php the_ID(); ?>" class="<?php echo join(' ',  $classes ); ?>" itemscope itemtype="http://schema.org/Article">
	
	<header class="post-header cf">

        <?php if ($layout == 'classic-above'): ?>
            <?php 
                //Title Meta
                get_template_part('blocks/single/title-meta'); 
            ?>
        <?php endif; ?>
            
	<?php if (!Flipmag::posts()->meta('featured_disable') ): ?>

			<?php if (get_post_format() == 'gallery'): // get gallery template ?>
				<div class="featured">
					<?php get_template_part('partial-gallery'); ?>
				</div>
			<?php elseif (Flipmag::posts()->meta('featured_video')): // featured video available? ?>
				<div class="featured">
					<div class="featured-vid">
						<?php echo apply_filters('octo_featured_video', Flipmag::posts()->meta('featured_video')); ?>
					</div>
				</div>
			<?php elseif ( has_post_thumbnail() ):  ?>
				<div class="featured">
				<?php 
					/**
					 * Normal featured image
					 */			
					$caption = get_post(get_post_thumbnail_id())->post_excerpt;
					$url     = get_permalink();
					
					// on single page? link to image
					if (is_single()):
						$url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
						$url = $url[0];
					endif;
				?>			
				<a href="<?php echo esc_url($url); ?>" title="<?php the_title_attribute(); ?>" itemprop="image">
				
				<?php if (Flipmag::options()->blog_thumb != 'thumb-left'): // normal container width image ?>
				
					<?php if ((!in_the_loop() && Flipmag::posts()->meta('layout_style') == 'full') OR Flipmag::core()->get_sidebar() == 'none'): // largest images - no sidebar? ?>
				
						<?php the_post_thumbnail('flipmag-main-full', array('title' => esc_attr(strip_tags(get_the_title())))); ?>
				
					<?php else: ?>
					
						<?php the_post_thumbnail('flipmag-main-slider', array('title' => esc_attr(strip_tags(get_the_title())))); ?>
					
					<?php endif; ?>
					
				<?php else: ?>
					<?php the_post_thumbnail('thumbnail', array('title' => esc_attr(strip_tags(get_the_title())))); ?>
				<?php endif; ?>
								
				</a>
								
				<?php if (!empty($caption)): // have caption ? ?>
						
					<div class="caption"><?php echo esc_html($caption); ?></div>
						
				<?php endif;?>
				</div>
			<?php endif; // end normal featured image ?>

	<?php endif; // featured check ?>            
            <?php if ($layout != 'classic-above'): ?>	
			<?php
                    //Title Meta
                    get_template_part('blocks/single/title-meta'); 
                ?>	
            <?php endif; ?>            
	</header><!-- .post-header -->
	
	<?php 
            //Social Share 
            get_template_part('blocks/single/share'); 
    ?>
	<?php if( trim(Flipmag::options()->oc_ad_post_before) != null ){ ?>
        <div class="row cf ">
            <div class="col-12" >
                <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_post_before); ?></div>
            </div>
        </div>
    <?php } ?>
<?php
	// page builder for posts enabled?
	$panels = get_post_meta(get_the_ID(), 'panels_data', true);	
	if (!empty($panels) && !empty($panels['grids']) && is_singular() && !is_front_page()):
		Flipmag::posts()->the_content();
	else: ?>
	<div class="post-container cf">	
		<div class="post-content-right">
			<div class="post-content description <?php echo esc_attr(Flipmag::posts()->meta('content_slider') ? 'post-slideshow' : ''); ?>" itemprop="articleBody">			
                    <?php 
                        // get post body content
                        get_template_part('blocks/single/post-content'); 
                    ?>				
			</div><!-- .post-content -->
		</div>		
	</div>	
<?php 
	endif; // end page builder blocks test
?>		
</article>

<?php if( trim(Flipmag::options()->oc_ad_post_after) != null ){ ?>
<div class="row cf ">
    <div class="col-12" >
        <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_post_after); ?></div>
    </div>
</div>
<?php } ?>

<?php 
    //Posts Navigation
    get_template_part('blocks/single/post-navigation'); 
?>

<?php 
    //Author Box
    get_template_part('blocks/single/author-box'); 
?>

<?php 
    //Related Posts
    get_template_part('blocks/single/related-posts'); 
?>