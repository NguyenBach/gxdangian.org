
	<?php do_action('flipmag_sidebar_start'); ?>		
		
        <aside class="col-4 sidebar" <?php if( !Flipmag::options()->oc_sticky_sidebar ){ echo 'data-sticky_column'; } ?> >
            
            <?php if( trim(Flipmag::options()->oc_ad_sidebar_before) != null ){ ?>
                <div class="row cf ">
                    <div class="col-12" >
                        <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_sidebar_before); ?></div>
                    </div>
                </div>
            <?php } ?>
            
			<ul>
			
			<?php if (!dynamic_sidebar('primary-sidebar')) : ?>
				<li><?php _e("Nothing yet.", 'flipmag'); ?></li>
			<?php endif; ?>
	
			</ul>
            
            <?php if( trim(Flipmag::options()->oc_ad_sidebar_after) != null ){ ?>
                <div class="row cf ">
                    <div class="col-12" >
                        <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_sidebar_after); ?></div>
                    </div>
                </div>
            <?php } ?>                    
                    
		</aside>
		
	<?php do_action('flipmag_sidebar_end'); ?>