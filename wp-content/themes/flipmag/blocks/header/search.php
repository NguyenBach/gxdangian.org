<?php
/**
 * Partial: Search used in header
 */
?>
    <div class="search">
            <form role="search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
                    <input type="text" name="s" class="query" id="header-search-text" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search...', 'flipmag'); ?>" />
                    <button class="search-button" type="submit"><?php _e('Search', 'flipmag'); ?></button>
            </form>
    </div> <!-- .search <i class="fa fa-search"></i>-->