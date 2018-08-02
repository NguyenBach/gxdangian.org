<?php 
/**
 * Template to get post body content on single page
 */
?>

            <?php
            // multi-page content slideshow post?
            if (Flipmag::posts()->meta('content_slider')):
                    get_template_part('blocks/pagination-next');
            endif;

            ?>

            <?php
            // excerpts or main content?
            if ((!is_front_page() && is_singular()) OR !Flipmag::options()->show_excerpts_classic OR Flipmag::posts()->meta('content_slider')): 
                    Flipmag::posts()->the_content();
            else:
                    echo wp_kses_stripslashes(Flipmag::posts()->excerpt(null, Flipmag::options()->excerpt_length_classic, array('force_more' => true)) );
            endif;

            ?>

            <?php 
            // multi-page post - add numbered pagination
            if (!Flipmag::posts()->meta('content_slider')):

                    wp_link_pages(array(
                            'before' => '<div class="main-pagination post-pagination">', 
                            'after' => '</div>', 
                            'link_before' => '<span>',
                            'link_after' => '</span>'));
            endif;

            ?>

            <?php if (is_single() && Flipmag::options()->oc_show_tags): ?>
                    <div class="tagcloud"><?php the_tags('', ' '); ?></div>
            <?php endif; ?>