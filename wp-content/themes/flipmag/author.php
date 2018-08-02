<?php

/**
 * Author Page
 */

Flipmag::core()->set_sidebar( Flipmag::options()->oc_author_sidebar );

get_header();

$authordata = get_userdata(get_query_var('author'));

?>

<div class="main wrap cf">

	<div class="row">
            <?php Flipmag::core()->theme_left_sidebar( Flipmag::options()->oc_author_sidebar ); ?>
		<div class="col-8 main-content">		
                    <?php if( trim(Flipmag::options()->oc_ad_archive_before) != null ){ ?>
                        <div class="row cf ">
                            <div class="col-12" >
                                <div class="ads"><?php echo trim(Flipmag::options()->oc_ad_archive_before); ?></div>
                            </div>
                        </div>
                    <?php } ?>
                    
			<h1 class="main-heading author-title"><?php echo sprintf(__('Author %s', 'flipmag'), '<strong>' . get_the_author() . '</strong>'); ?></h1>

			<?php get_template_part('partial-author'); ?>
	
			<?php  //get_template_part(Flipmag::options()->oc_author_loop_template);
                        
                        $block = Flipmag::options()->oc_author_template;
                        //$query = get_posts( 'author='.  the_author_meta() );
                        $query = array("author"=> the_author_meta() );
                        $options = array(
                            "id" => Flipmag::blocks()->unique_id(),
                            "title" => null,
                            "pagination" => Flipmag::options()->oc_author_template_pagination,
                            "animation" => Flipmag::options()->oc_author_template_animation,
                            "date_format" => Flipmag::options()->oc_author_template_date_format,
                            "disable_date" => Flipmag::options()->oc_author_template_disable_date,
                            "date_link" => Flipmag::options()->oc_author_template_date_link,
                            "disable_cat" => Flipmag::options()->oc_author_template_disable_cat,
                            "disable_comment" => Flipmag::options()->oc_author_template_disable_comment,
                            "disable_author" => Flipmag::options()->oc_author_template_disable_author,
                            "disable_excerpt" => Flipmag::options()->oc_author_template_disable_excerpt,
                            "excerpt_length" => Flipmag::options()->oc_author_template_excerpt_length,
                            "disable_more" => Flipmag::options()->oc_author_template_disable_more,
                            "thumb_size" => Flipmag::blocks()->get_thumb_size( $block )
                        );                        
                        
                        echo wp_kses_stripslashes(Flipmag::blocks()->blocks( $options, $block, $query ));
                        
                        if( trim(Flipmag::options()->oc_ad_archive_after) != null ){ ?>
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