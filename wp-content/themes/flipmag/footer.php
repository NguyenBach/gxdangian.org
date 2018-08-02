<?php 
    do_action('flipmag_post_main_content');
    
    $col = Flipmag::options()->oc_footer_layout;
?>
	
	<footer class="main-footer">
	
	<?php if (Flipmag::options()->oc_disable_footer): ?>
		<div class="wrap">
            <div class="widgets row cf">                
                <?php if( $col == 4 ){ ?>                
                    <div class="col-3">
                        <?php dynamic_sidebar( 'footer-1' ); ?>            
                    </div>
                    <div class="col-3">            
                        <?php dynamic_sidebar( 'footer-2' ); ?>            
                    </div>
                    <div class="col-3">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>
                    <div class="col-3">
                        <?php dynamic_sidebar( 'footer-4' ); ?>
                    </div>                
                <?php }else if( $col == 3 ){  ?>                      
                    <div class="col-4">     
                        <?php dynamic_sidebar( 'footer-1' ); ?>            
                    </div>
                    <div class="col-4">            
                        <?php dynamic_sidebar( 'footer-2' ); ?>            
                    </div>
                    <div class="col-4">
                        <?php dynamic_sidebar( 'footer-3' ); ?>
                    </div>                
                <?php }else if( $col == 2 ){  ?>                
                    <div class="col-6">                                                										
                        <?php dynamic_sidebar( 'footer-1' ); ?>            
                    </div>
                    <div class="col-6">            
                        <?php dynamic_sidebar( 'footer-2' ); ?>            
                    </div>                
                <?php }else if( $col == 1 ){  ?>
                    <div class="col-12">
                        <?php dynamic_sidebar( 'footer-1' ); ?>            
                    </div>             
                <?php } ?>                
            </div>
		</div>	
	<?php endif; ?>
	
	<?php if (Flipmag::options()->oc_disable_subfooter): ?>		
		<div class="lower-foot">
            <div class="wrap">	
                <div class="row">
                    <div class="col-8">
                    <?php 
                        if(Flipmag::options()->oc_footer_copyright){
                            echo wp_kses(Flipmag::options()->oc_footer_copyright, 
                                array(  'a' => array(
                                        'href' => array(),
                                        'title' => array()
                                    ),
                                    'br' => array(),
                                    'em' => array(),
                                    'strong' => array(), ) );
                        }
                    ?>
                    </div>
                    <div class="col-4">
                   <?php if (Flipmag::options()->oc_subfooter_social_icon) { ?>
                        <?php get_template_part('blocks/header/social'); ?>
                    <?php } ?>
                    </div>
                </div>
            </div>
		</div>		
	<?php endif; ?>
	
	</footer>
	
</div> <!-- .main-wrap -->

<?php wp_footer(); ?>
</body>
</html>