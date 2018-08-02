<?php 

/**
 * Singular Content Template
 */

$template = Flipmag::posts()->meta('layout_template');

if( $template == "" ){
	$template = Flipmag::options()->oc_post_layout_template;
}

if (!$template OR strstr($template, 'classic')) {
	$template = 'classic';
}

if ($template != 'classic') {
	Flipmag::core()->add_body_class('post-layout-' . $template);
}

?>
<?php get_header(); ?>

<div class="main <?php  if ($template != 'full-cover'): echo 'wrap'; endif; ?> cf">	
            
        <?php if ($template != 'classic'): // not the default layout? ?>
		
		<?php get_template_part('blocks/single/layout-' . $template); ?>
	
            <?php else: ?>
        <div class="row">    
            <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>            
		<div class="col-8 main-content">
			<?php while (have_posts()) : the_post(); ?>
				<?php 
					
					$panels = get_post_meta(get_the_ID(), 'panels_data', true);
					
					if (!empty($panels) && !empty($panels['grid'])):
						
						get_template_part('content', 'builder');
					
					else:
					
						get_template_part('content', 'single');
						
					endif;
				?>
				<div class="comments">
                    <?php comments_template('', true); ?>
				</div>	
			<?php endwhile; // end of the loop. ?>
		</div>
		
            <?php Flipmag::core()->theme_sidebar(); ?>
	</div> <!-- .row -->	
            <?php endif; ?>
	
</div> <!-- .main -->

<?php get_footer(); ?>