<?php
/**
 * Partial template for social share buttons on single page
 */
?>

<?php if (is_single() && Flipmag::options()->oc_social_share): ?>
	
	<div class="post-share">
		<span class="text"><?php _e('Share', 'flipmag'); ?></span>		
		<span class="share-links">                    
       <?php
          $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        ?>
                    
        <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
           onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;">
            <i class="fa fa-facebook"></i>
			       <span class=""><?php _e('Facebook', 'flipmag'); ?></span>
        </a>
                    
        <a class="twitter" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&url=<?php echo urlencode(get_permalink()); ?>&via=<?php echo THEMENAME; ?>"
           onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" >
            <i class="fa fa-twitter"></i>
			     <span class=""><?php _e('Twitter', 'flipmag'); ?></span>
        </a>
                    
        <a class="google-plus" href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>"
          onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" >
			     <i class="fa fa-google-plus"></i>
            <span class="visuallyhidden"><?php _e('Google+', 'flipmag'); ?></span>
        </a>
                    
        <a class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()); ?>&media=<?php echo esc_url($url[0]); ?>"
        onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" >
            <i class="fa fa-pinterest-p"></i>
			       <span class="visuallyhidden"><?php _e('Pinterest', 'flipmag'); ?></span>
        </a>

        <a class="linkedin" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode(get_permalink()); ?>"
          onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" >
            <i class="fa fa-linkedin"></i>
			           <span class="visuallyhidden"><?php _e('LinkedIn', 'flipmag'); ?></span>
        </a>
                    
        <a class="envelope" href="mailto:?subject=<?php echo rawurlencode(get_the_title()); ?>&amp;body=<?php echo rawurlencode(get_permalink()); ?>"
          onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;" >
            <i class="fa fa-envelope-o"></i>
			       <span class="visuallyhidden"><?php _e('Email', 'flipmag'); ?></span>
        </a>                    
                    
		</span>
	</div>
	
	<?php endif; ?>