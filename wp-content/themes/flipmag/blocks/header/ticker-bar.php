<?php
/**
 * Partial: Top bar template - displayed above header
 */
?>
<?php if (!Flipmag::options()->oc_disable_tickerbar): ?>	
	<div class="ticker-bar">
		<div class="wrap">
			<div class="ticker-bar-content">				
				<div class="trending-ticker">
                    <div class="row">
                        <div class="col-8">
                            <?php if (!Flipmag::options()->oc_disable_tickerbar_ticker): ?>
                            <span class="heading"><?php echo esc_html(Flipmag::options()->oc_tickerbar_ticker_text); ?></span>
                            <ul>
                                <?php $query = new WP_Query(apply_filters('flipmag_ticker_query_args', array('orderby' => 'date', 'order' => 'desc'))); ?>

                                <?php while($query->have_posts()): $query->the_post(); ?>

                                    <li><a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo esc_html(get_the_title()); ?></a></li>

                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                        <div class="col-4">
                            <?php if (Flipmag::options()->oc_ticker_social_icon) { ?>
                                <?php get_template_part('blocks/header/social'); ?>
                            <?php } ?>
                        </div>
                    </div>
				</div>
				
			</div>
		</div>		
	</div>	
<?php endif; ?>