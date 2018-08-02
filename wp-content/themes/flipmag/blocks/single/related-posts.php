<?php 
/**
 * Template for related posts on single pages
 */
?>
<?php if (is_single() && Flipmag::options()->oc_related_posts && ($related = Flipmag::posts()->get_related(Flipmag::core()->get_sidebar() == 'none' ? 3 : 3))): ?>

<section class="related-posts">
	<h3 class="section-head"><span><?php _e('Related Posts', 'flipmag'); ?></span></h3> 
	<ul class="highlights-box three-col related-posts">
	
	<?php foreach ($related as $post): setup_postdata($post); ?>	
		<li class="highlights column one-third">			
			<article>
			<?php if(has_post_thumbnail()): ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="image-link">
					<?php the_post_thumbnail(
						(Flipmag::core()->get_sidebar() == 'none' ? 'flipmag-main-block' : 'flipmag-gallery-block'),
						array('class' => 'image', 'title' => esc_attr(strip_tags(get_the_title())))); ?>

					<?php if (get_post_format()): ?>
						<span class="post-format-icon <?php echo esc_attr(get_post_format()); ?>"><?php
							echo apply_filters('flipmag_post_formats_icon', ''); ?></span>
					<?php endif; ?>
				</a>
			<?php endif; ?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h2>
				
			</article>
		</li>
		
	<?php endforeach; wp_reset_postdata(); ?>
	</ul>
</section>

<?php endif; ?>