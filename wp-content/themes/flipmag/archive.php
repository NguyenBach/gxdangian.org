<?php

/**
 * Archives Page!
 * 
 * This page is used for all kind of archives from custom post types to blog to 'by date' archives.
 * 
 * Flipmag framework recommends this template to be used as generic template wherever any sort of listing 
 * needs to be done.
 * 
 * @link http://codex.wordpress.org/images/1/18/Template_Hierarchy.png
 */

global $flipmag_block;

if(!is_category()){
    Flipmag::core()->set_sidebar( Flipmag::options()->oc_archive_sidebar );
}
get_header();

//archive
if( $flipmag_block == null ){
   $flipmag_block = Flipmag::options()->oc_archive_template;
}

$options = array(
    "title"=> NULL,
    "id" => Flipmag::blocks()->unique_id(),
    "pagination" => Flipmag::options()->oc_archive_template_pagination,
    "animation" => Flipmag::options()->oc_archive_template_animation,
    "date_format" => Flipmag::options()->oc_archive_template_date_format,
    "disable_date" => Flipmag::options()->oc_archive_template_disable_date,
    "date_link" => Flipmag::options()->oc_archive_template_date_link,
    "disable_cat" => Flipmag::options()->oc_archive_template_disable_cat,
    "disable_comment" => Flipmag::options()->oc_archive_template_disable_comment,
    "disable_author" => Flipmag::options()->oc_archive_template_disable_author,
    "disable_excerpt" => Flipmag::options()->oc_archive_template_disable_excerpt,
    "excerpt_length" => Flipmag::options()->oc_archive_template_excerpt_length,
    "disable_more" => Flipmag::options()->oc_archive_template_disable_more,
    "thumb_size" => Flipmag::blocks()->get_thumb_size( $flipmag_block )
);

//categories
if (is_category()) {
	$meta = Flipmag::options()->get('cat_meta_' . get_query_var('cat'));        
	get_template_part('partial-sliders');
        
        //options
        $meta["oc_pagination_type"] != null ? $options["pagination"] = $meta["oc_pagination_type"] : $options["pagination"] = Flipmag::options()->oc_category_template_pagination;
        $meta["animation"] != null ? $options["animation"] = $meta["animation"] : $options["animation"] = Flipmag::options()->oc_category_template_animation;
        $meta["disable_date"] != null ? $options["disable_date"] = $meta["disable_date"] : $options["disable_date"] = Flipmag::options()->oc_category_template_disable_date;
        $meta["date_format"] != "default" ? $options["date_format"] = $meta["date_format"] : $options["date_format"] = Flipmag::options()->oc_category_template_date_format;
        $meta["disable_date"] != null ? $options["disable_date"] = $meta["disable_date"] : $options["disable_date"] = Flipmag::options()->oc_category_template_disable_date;
        $meta["date_link"] != null ? $options["date_link"] = $meta["date_link"] : $options["date_link"] = Flipmag::options()->oc_category_template_date_link;
        $meta["disable_cat"] != null ? $options["disable_cat"] = $meta["disable_cat"] : $options["disable_cat"] = Flipmag::options()->oc_category_template_disable_cat;
        $meta["disable_comment"] != null ? $options["disable_comment"] = $meta["disable_comment"] : $options["disable_comment"] = Flipmag::options()->oc_category_template_disable_comment;
        $meta["disable_author"] != null ? $options["disable_author"] = $meta["disable_author"] : $options["disable_author"] = Flipmag::options()->oc_category_template_disable_author;
        $meta["disable_excerpt"] != null ? $options["disable_excerpt"] = $meta["disable_excerpt"] : $options["disable_excerpt"] = Flipmag::options()->oc_category_template_disable_excerpt;
        $meta["excerpt_length"] != null ? $options["excerpt_length"] = $meta["excerpt_length"] : $options["excerpt_length"] = Flipmag::options()->oc_category_template_excerpt_length;
        $meta["disable_more"] != null ? $options["disable_more"] = $meta["disable_more"] : $options["disable_more"] = Flipmag::options()->oc_category_template_disable_more;
        $meta["thumb_size"]  = Flipmag::blocks()->get_thumb_size( $flipmag_block );        
}

?>
<div class="main wrap cf">
	<div class="row">
        <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
		<div class="col-8 main-content">
	
                <?php if( is_category() && trim(Flipmag::options()->oc_ad_cat_before) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_cat_before); ?></div>
                        </div>
                    </div>
                <?php } else if( !is_category() && trim(Flipmag::options()->oc_ad_archive_before) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_archive_before); ?></div>
                        </div>
                    </div>
                <?php } ?>
                    
		<?php 
		/* can be combined into one below with is_tag() || is_category() || is_tax() - extended for customization */
		?>
		
		<?php if (is_tag()): ?>
		
			<h2 class="main-heading"><?php printf(__('Browsing: %s', 'flipmag'), '<strong>' . single_tag_title( '', false ) . '</strong>'); ?></h2>
			
			<?php if (tag_description()): ?>
				<div class="post-content"><?php echo do_shortcode(tag_description()); ?></div>
			<?php endif; ?>
		
		<?php elseif (is_category()): // category page ?>
		
			<h2 class="main-heading"><?php printf(__('Browsing: %s', 'flipmag'), '<strong>' . single_cat_title('', false) . '</strong>'); ?></h2>
			
			<?php if (category_description()): ?>
				<div class="post-content"><?php echo do_shortcode(category_description()); ?></div>
			<?php endif; ?>
			
		<?php elseif (is_tax()): // custom taxonomies ?>
			
			<h2 class="main-heading"><?php printf(__('Browsing: %s', 'flipmag'), '<strong>' . single_term_title('', false) . '</strong>'); ?></h2>
			
			<?php if (term_description()): ?>
				<div class="post-content"><?php echo do_shortcode(term_description()); ?></div>
			<?php endif; ?>
			
		<?php elseif (is_search()): // search page ?>
			<?php $results = $wp_query->found_posts; ?>
			<h2 class="main-heading"><?php printf(__('Search Results: %s (%d)', 'flipmag'),  get_search_query(), $results); ?></h2>
			
		<?php elseif (is_archive()): ?>
			<h2 class="main-heading"><?php	
			if (is_day()):
				printf(__('Daily Archives: %s', 'flipmag'), '<strong>' . get_the_date() . '</strong>');
			elseif (is_month()):
				printf(__('Monthly Archives: %s', 'flipmag'), '<strong>' . get_the_date('F, Y') . '</strong>');
			elseif (is_year()):
				printf(__('Yearly Archives: %s', 'flipmag'), '<strong>' . get_the_date('Y') . '</strong>');
			endif;				
			?></h2>
		<?php endif; ?>	
                        
                <?php echo wp_kses_stripslashes(Flipmag::blocks()->blocks( $options, $flipmag_block, null )); ?>
                <?php if( is_category() && trim(Flipmag::options()->oc_ad_cat_after) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads marginTop"><?php echo trim(Flipmag::options()->oc_ad_cat_after); ?></div>
                        </div>
                    </div>
                <?php } else if( !is_category() && trim(Flipmag::options()->oc_ad_archive_after) != null ){ ?>
                    <div class="row cf ">
                        <div class="col-12" >
                            <div class="ads marginTop"><?php echo trim(Flipmag::options()->oc_ad_archive_after); ?></div>
                        </div>
                    </div>
                <?php } ?>
		</div>
		
		<?php Flipmag::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>