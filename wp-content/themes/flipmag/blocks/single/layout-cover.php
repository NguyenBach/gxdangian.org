<?php 
/**
 *  Template for Single Post "Cover Layout" - called from single.php
 */
?>

<?php if (have_posts()) : the_post(); ?>
<?php

	// post has review? 
	$review = Flipmag::posts()->meta('reviews');
	
	// Category custom label selected?				
	if (($cat_label = Flipmag::posts()->meta('cat_label'))) {
		$category = get_category($cat_label);
	}
	else {
		$category = current(get_the_category());						
	}

?>
	
<article id="post-<?php the_ID(); ?>" class="post-wrap <?php
	// hreview has to be first class because of rich snippet classes limit 
	echo esc_attr($review ? 'hreview ' : '') . join(' ', get_post_class()); ?>" itemscope itemtype="http://schema.org/Article">

	<section class="post-cover">
	
			<div class="featured">
					
				<?php if (Flipmag::posts()->meta('featured_video')): // featured video available? ?>
				
				<div class="featured-vid">
						<?php echo apply_filters('flipmag_featured_video', Flipmag::posts()->meta('featured_video')); ?>
				</div>
					
				<?php else: 

					if (get_post_format() == 'gallery'): 
						/**
						 * Emulate disabled sidebar for the gallery to be rendered full-width
						 */
						$sidebar = Flipmag::core()->get_sidebar();
						Flipmag::core()->set_sidebar('none');
						
						get_template_part('partial-gallery');

						Flipmag::core()->set_sidebar($sidebar);
					
					else:
					
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
						<?php the_post_thumbnail('flipmag-main-full', array('title' => strip_tags(get_the_title()), 'itemprop' => 'image')); ?>										
						<?php if (!empty($caption)): // have caption ? ?>								
							<div class="caption"><?php echo esc_html($caption); ?></div>								
						<?php endif;?>
					</a>
						
					<?php 
					endif; // end check for featured image/gallery
					?>
					
					<div class="overlay">
						
						<span class="cat-title cat-<?php echo esc_attr($category->cat_ID); ?>"><a href="<?php 
							echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a></span>
						
						<h1 class="item fn" itemprop="name headline"><?php echo esc_html(get_the_title()); ?></h1>
						
						<div class="post-meta"><?php
							if(is_rtl()){ ?>
								<span class="posted-by"><span class="reviewer" itemprop="author"><?php the_author_posts_link(); ?></span><?php _ex('By', 'Post Meta', 'flipmag'); ?>
								</span>
							<?php }else{ ?>
								<span class="posted-by"><?php _ex('By', 'Post Meta', 'flipmag'); ?> 
									<span class="reviewer" itemprop="author"><?php the_author_posts_link(); ?></span>
								</span>
							<?php } ?>							
							 
							<span class="posted-on">
								<span class="dtreviewed">
                                <?php
                                    if( Flipmag::options()->oc_post_date_link == "year" ){

                                        $link = get_year_link( get_post_time('Y') );
                                    }else if( Flipmag::options()->oc_post_date_link == "month" ){

                                        $link = get_month_link( get_post_time('Y'), get_post_time('m') );
                                    }else if( Flipmag::options()->oc_post_date_link == "day" ){

                                        $link = get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') );
                                    }
                                ?>
								<time class="value-title" datetime="<?php echo esc_attr(get_the_time(DATE_W3C)); ?>" title="<?php 
										echo esc_attr(get_the_time('Y-m-d')); ?>" itemprop="datePublished"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html(get_the_date( Flipmag::options()->oc_post_date_format )); ?></a></time>
								</span>
							</span>
							
							<span class="comments">
								<a href="<?php comments_link(); ?>"><i class="fa fa-comments-o"></i> <?php 
									printf(_n('%d ', '%d ', get_comments_number(), 'flipmag'), get_comments_number()); 
								?></a>
							</span>
						</div>
						
					</div>
					
																			
				<?php if (!empty($caption)): // have caption ? ?>
						
					<div class="caption"><?php echo esc_html($caption); ?></div>
						
				<?php endif;?>
				
					
				<?php endif; // end normal featured image ?>
			</div>
	
	</section>	
	
	<div class="row cf">

        <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
            
		<div class="col-8 main-content">
			<article>
                <?php 
					// add social share
					get_template_part('blocks/single/share');
				?>

				<?php if( trim(Flipmag::options()->oc_ad_post_before) != null ){ ?>
	            <div class="row cf ">
	                <div class="col-12" >
	                    <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_post_before); ?></div>
	                </div>
	            </div>
	            <?php } ?>

				<div class="post-container cf">				
					<div class="post-content description <?php echo esc_attr(Flipmag::posts()->meta('content_slider') ? 'post-slideshow' : ''); ?>" itemprop="articleBody">				
						<?php 
							// get post body content
							get_template_part('blocks/single/post-content'); 
						?>					
					</div><!-- .post-content -->					
				</div>
					
			</article>

			<?php if( trim(Flipmag::options()->oc_ad_post_after) != null ){ ?>
			<div class="row cf ">
			    <div class="col-12" >
			        <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_post_after); ?></div>
			    </div>
			</div>
			<?php } ?>
			
			<?php 
			
			// add next/previous 
			get_template_part('blocks/single/post-navigation');
			
			// add author box
			get_template_part('blocks/single/author-box');
			
			// add related posts
			get_template_part('blocks/single/related-posts');
			
			?>
	
			<div class="comments">
				<?php comments_template('', true); ?>
			</div>
	
		</div>
	
		<?php Flipmag::core()->theme_sidebar(); ?>
	
	</div> <!-- .row -->

</article> <!-- .post-wrap -->

<?php endif; // end of "the loop" ?>