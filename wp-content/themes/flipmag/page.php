<?php

/**
 * Default Page Template
 */


get_header();

if (Flipmag::posts()->meta('featured_slider')):
	get_template_part('partial-sliders');
endif;

?>

<div class="main wrap cf">

	<div class="row">
            
        <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
            
		<div class="col-8 main-content">	
                    <?php if( trim(Flipmag::options()->oc_ad_page_before) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads"><?php echo wp_kses_stripslashes(trim(Flipmag::options()->oc_ad_page_before)); ?></div>
                        </div>
                    </div>
                    <?php } ?>
                    
			<?php if (have_posts()): the_post(); endif; // load the page ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (Flipmag::posts()->meta('page_title') != 'no'): ?>
			
				<header class="post-header">				
					
				<?php if (has_post_thumbnail() && !Flipmag::posts()->meta('featured_disable')): ?>
					<div class="featured">
						<a href="<?php $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); echo esc_url($url[0]); ?>" title="<?php the_title_attribute(); ?>">
						
						<?php if ((!in_the_loop() && Flipmag::posts()->meta('layout_style') == 'full') OR Flipmag::core()->get_sidebar() == 'none'): // largest images - no sidebar? ?>
						
							<?php the_post_thumbnail('flipmag-main-full', array('title' => esc_attr(strip_tags(get_the_title()))) ); ?>
						
						<?php else: ?>
							
							<?php the_post_thumbnail('flipmag-main-slider', array('title' => esc_attr(strip_tags(get_the_title()))) ); ?>
							
						<?php endif; ?>
						
						</a>
					</div>
				<?php endif; ?>
				
					<h1 class="main-heading">
						<?php echo esc_attr( get_the_title() ); ?>
					</h1>
				</header><!-- .post-header -->
				
			<?php endif; ?>
		
			<div class="post-content">				
				<?php Flipmag::posts()->the_content(); ?>
			</div>

			</article>			
                <?php if( trim(Flipmag::options()->oc_ad_page_after) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads"><?php echo wp_kses_stripslashes(trim(Flipmag::options()->oc_ad_page_after)); ?></div>
                        </div>
                    </div>
                <?php } ?>
		</div>
		
        <?php Flipmag::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>
