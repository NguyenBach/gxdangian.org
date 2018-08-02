<?php

/**
 * bbPress Forum Template 
 */

if( Flipmag::posts()->meta('layout_style') == "left" ){
    Flipmag::core()->set_sidebar( Flipmag::posts()->meta('layout_style') );
}
get_header();

?>

<div class="main wrap cf">

	<div class="row">            
            <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
		<div class="col-8 main-content">
			
			<?php if (have_posts()): the_post(); endif; // load the page ?>

			<div <?php post_class(); ?>>

				<header class="post-header">				
				
					<h1 class="main-heading"><?php echo esc_html(get_the_title()); ?></h1>
				
				</header><!-- .post-header -->
				
			<?php //endif; ?>
		
			<div>			
				
				<?php Flipmag::posts()->the_content(); ?>
				
			</div>

			</div>
			
		</div>
		
		<?php Flipmag::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>