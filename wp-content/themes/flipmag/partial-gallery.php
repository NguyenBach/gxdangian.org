<?php

/**
 * Partial Template - Display the gallery slider for gallery post formats
 */

$image_ids = Flipmag::posts()->get_first_gallery_ids();

if (!$image_ids) {
	return;
}

$images = get_posts(array(
	'post_type' => 'attachment',
	'post_status' => 'inherit',
	'post__in' => $image_ids,
	'orderby' => 'post__in',
	'posts_per_page' => -1
));

?>

	<div class="gallery-slider slider-arrows">
		<div class="frame flexslider">
			<ul class="slides">
			<?php foreach ($images as $attachment): ?>
				
				<li>
					<a href="<?php echo wp_get_attachment_url($attachment->ID); ?>">
					
					<?php if ((!in_the_loop() && Flipmag::posts()->meta('layout_style') == 'full') OR Flipmag::core()->get_sidebar() == 'none'): // largest images - no sidebar? ?>
					
						<?php echo wp_get_attachment_image($attachment->ID, 'flipmag-main-full'); ?>
					
					<?php else: ?>
						
						<?php echo wp_get_attachment_image($attachment->ID, 'flipmag-main-slider'); ?>
						
					<?php endif; ?>
					
					<?php if ($attachment->post_excerpt): // caption ?>
						
						<div class="caption"><?php echo esc_html($attachment->post_excerpt); ?></div>
						
					<?php endif; ?>
					
					</a>
				</li>
				
			<?php endforeach; // no reset query needed; get_posts() uses a new instance ?>
			</ul>
		</div>
	</div>

<?php wp_reset_query(); ?>