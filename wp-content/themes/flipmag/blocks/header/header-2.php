<div class="main-wrap">
<?php 
	
	/**
	 * Get the partial template for top bar
	 */
	get_template_part('blocks/header/ticker-bar');

	?>

 <div id="main-head" class="main-head <?php echo esc_attr(Flipmag::options()->oc_header_layout); ?>">
                
            <div class="wrap">               
                <header class="row">                    
                        <div class="col-4">
		                    <div class="title">
		                        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( Flipmag::options()->oc_logo_title ); ?>" rel="home">
		                        <?php if (Flipmag::options()->oc_image_logo): // custom logo ?>
		                                <img src="<?php echo esc_url(Flipmag::options()->oc_image_logo); ?>" class="logo-image" alt="<?php echo esc_attr( Flipmag::options()->oc_logo_alt ); ?>" <?php echo (Flipmag::options()->oc_image_logo_retina ? 'data-at2x="'. esc_attr(Flipmag::options()->oc_image_logo_retina) .'"' : ''); 
		                                ?> />

		                        <?php else: ?>
		                                <?php echo do_shortcode( esc_html(Flipmag::options()->oc_text_logo) ); ?>
		                        <?php endif; ?>
		                        </a>
		                    </div>
                        </div>
                        <div class="col-8 right">
                            <?php if( trim(Flipmag::options()->oc_ad_header_right) != null ){ ?>                               
                                <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_header_right); ?></div>
                            <?php } ?>
                        </div>                                        
                </header>
            </div>
            
            <div class="wrap" data-wrap="yes" >
                <nav class="navigation cf <?php if (Flipmag::options()->oc_layout_style =="boxed" ) { echo 'boxed'; } ?>" <?php if (Flipmag::options()->oc_sticky_nav) { echo ' data-sticky-nav="1" '; } ?> >
                    
                    <div class="wrap navigate">                        
	                    <div class="mobile" data-type="<?php echo esc_attr(Flipmag::options()->oc_mobile_menu_type); ?>">
	                        <a href="#" class="selected off_canvas" >                                    
	                            <i class="hamburger fa fa-bars"></i>
	                        </a>
	                        <span class="selected off_canvas">
	                            <span class="text"><?php echo __('Navigate', 'flipmag'); ?></span>
	                            <span class="current"></span>
	                        </span>
	                        <?php if( Flipmag::options()->oc_mobile_nav_search){ ?> <span class="header-search-button" id="header-search-button" ><i id="header-search-buttoni"  class="fa fa-search"></i></span> <?php } ?>
	                    </div>                        
               		<?php wp_nav_menu(array('theme_location' => 'main', 'fallback_cb' => '', 'walker' =>  'Flipmag_Menu_Walker')); ?>                        
                    </div>

                <div class="pull-right header-search-wrap" >
                    <div class="header-search-button" id="header-search-button" ><i class="fa fa-search"></i></div>
                    <div class="header-drop-down-search" id="header_drop_down_search">
                        <?php get_template_part('blocks/header/search'); ?>
                    </div>
                </div>

                </nav>            
            </div>


		<?php if (!Flipmag::options()->oc_disable_breadcrumbs): ?>
			<div class="wrap">	    
				<?php Flipmag::core()->breadcrumbs(); ?>
			</div>
		<?php endif; ?>
</div>