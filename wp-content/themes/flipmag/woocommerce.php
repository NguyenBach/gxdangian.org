<?php

/**
 * WooCommerce Main Template Catch-All 
 */

if ( class_exists( 'WooCommerce' ) ) {
   Flipmag::core()->add_body_class('woocommerce');
}
get_header();

?>

<div class="main wrap cf">

	<div class="row">
            
        <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
            
		<div class="col-8 main-content">
			
			<?php woocommerce_content(); ?>
			
		</div>
		
		<?php Flipmag::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>
