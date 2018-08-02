<?php
/**
 * Template for Author Box on single pages
 */
?>
<?php if (is_single() && Flipmag::options()->oc_author_box && get_the_author_meta('description') != null ) : // author box? ?>
	<h3 class="section-head"><span><?php _e('About Author', 'flipmag'); ?></span></h3>
	<?php get_template_part('partial-author'); ?>
<?php endif; ?>