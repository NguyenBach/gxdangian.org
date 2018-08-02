<?php 
/**
 * Classic post style title and meta template - called from content.php
 */
?>

    <div class="cats"><?php echo get_the_category_list(); ?></div>            
        <?php 
                $tag = 'h1';
                if (!is_single() OR is_front_page()) {
                        $tag = 'h2';
                }
        ?>
        <<?php echo wp_kses_stripslashes($tag); ?> class="post-title item fn" itemprop="name">
            <?php if (!is_front_page() && is_singular()): the_title(); else: ?>
               <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php echo esc_html(get_the_title()); ?></a>
            <?php endif;?>
            </<?php echo wp_kses_stripslashes($tag); ?>>            
            
        <div class="post-meta">
		<span class="posted-by">
            <?php if( is_rtl() ){ ?>
                <span class="author" itemprop="author"><?php the_author_posts_link(); ?></span>
                <?php _ex('By', 'Post Meta', 'flipmag'); ?> 
            <?php }else{ ?>
                <?php _ex('By', 'Post Meta', 'flipmag'); ?> 
                <span class="author" itemprop="author"><?php the_author_posts_link(); ?></span>
            <?php } ?>
		</span>
		 
		<span class="posted-on">
			<span class="dtreviewed">
                <?php
                    if( Flipmag::options()->oc_post_date_link == "year" ){

                        $link = get_year_link( get_post_time('Y') );
                    }else if( Flipmag::options()->oc_post_date_link == "month" ){

                        $link = get_month_link( get_post_time('Y'), get_post_time('m') );
                    }else if( Flipmag::options()->oc_post_date_link == "day" ){

                        $link = get_day_link( get_post_time('Y'), get_post_time('m'), get_post_time('j') );
                    }
                ?>
				<time class="value-title" datetime="<?php echo esc_attr(get_the_time(DATE_W3C)); ?>" title="<?php 
					echo esc_attr(get_the_time('Y-m-d')); ?>" itemprop="datePublished"><a href="<?php echo esc_url($link); ?>"><?php echo esc_html(get_the_date( Flipmag::options()->oc_post_date_format )); ?></a></time>
			</span>
		</span>			
        <span class="posted-comment">
            <a href="<?php comments_link(); ?>" class="comments"><i class="fa fa-comments"></i> <?php echo get_comments_number(); ?></a> 
        </span>
	</div>        