<?php 
$category = get_category( $item->object_id );
$mid = str_shuffle('abcdefghijklmnopqrtuvwxyz0123456789'); 
?>
<div class="mega-menu row" id="megamenu" data-mid="<?php echo esc_attr($mid); ?>" >
	<div class="col-3 sub-cats">
		<ol class="sub-nav">
            <li data-cat-id="<?php echo esc_attr($item->object_id); ?>" id="menu-item-all" class="menu-item menu-item-type-taxonomy menu-item-object-category mega-cat menu-cat-all-<?php echo esc_attr($item->object_id); ?>">
                <a href="<?php echo esc_url(get_category_link( $item->object_id )); ?>"><?php _e('All', 'flipmag'); ?></a>
            </li>
			<?php echo wp_kses_stripslashes($sub_menu); ?>
		</ol>	
	</div>
	<div class="col-9 extend" >  
            <div class="menu-ajax-loading" id="mloader-<?php echo esc_attr($mid); ?>" ><i class="fa fa-circle-o-notch fa-spin"></i></div>
            <div id="mcontainer-<?php echo esc_attr($mid); ?>">
                <?php 
                        $query = new WP_Query(apply_filters(
                                'flipmag_mega_menu_query_args', 
                                array('cat' => $item->object_id, 'meta_key' => '_flipmag_featured_post', 'meta_value' => 1, 'order' => 'date', 'posts_per_page' => 3, 'ignore_sticky_posts' => 1),
                                'category-featured'
                        ));
                ?>                
            <?php while ($query->have_posts()): $query->the_post(); ?>
                <div class="col-4 featured fadeInDown">
                    <div class="highlights">
                        <article>
                        <?php if(has_post_thumbnail()): ?>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="image-link">
                                <?php the_post_thumbnail('flipmag-main-block', array('class' => 'image', 'title' => esc_attr(strip_tags(get_the_title())))); ?>
                                
                                <?php if (get_post_format()): ?>
                                <span class="post-format-icon <?php echo esc_attr(get_post_format( )); ?>">
                                    <?php echo apply_filters('flipmag_post_formats_icon', ''); ?>
                                </span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                            <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_attr(get_the_title()); ?></a></h2>
                        </article>
                    </div>
                </div>  
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
</div>			