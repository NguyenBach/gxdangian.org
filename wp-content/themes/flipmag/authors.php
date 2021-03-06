<?php

/**
 * Template Name: Authors List
 */

get_header();

?>
<div class="main wrap cf">

	<div class="row">
            <?php Flipmag::core()->theme_left_sidebar( Flipmag::posts()->meta('layout_style') ); ?>
		<div class="col-8 main-content">
			
			<?php if (have_posts()): the_post(); endif; // load the page ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php if (Flipmag::posts()->meta('page_title') == 'yes'): ?>
			
				<header class="post-header">
					<h1 class="main-heading">
						<?php echo esc_html(get_the_title()); ?>
					</h1>
				</header><!-- .post-header -->
				
			<?php endif; ?>
		
			<div class="post-content">
				<?php Flipmag::posts()->the_content(); ?>
			</div>
		
			<div class="authors-list">
				
				<?php 
					
					$per_page = 10;
					$paged = get_query_var('paged');

					// setup user query
					$user_query = new WP_User_Query(array(
						'orderby' => 'post_count',
						'order'   => 'DESC',
						'who'     => 'authors',
						'offset' => $paged ? (($paged - 1) * $per_page) : 0,
						'number' => $per_page,
						'count_total' => true,
	        		));
	        		
	        		// how many pages?
	        		$total_users = $user_query->get_total();
					$pages = $total_users / $per_page;
					
					// get authors
					$authors = (array) $user_query->get_results();
	        		
					foreach ($authors as $author) {
	        			
						$post_count = count_user_posts($author->ID);
	        			
						if ($post_count > 0) {
							$author->description .= '<span class="posts"><a href="'. get_author_posts_url($author->ID) .'" class="button medium" title="'. esc_attr(__('Browse Author Articles', 'flipmag')) .'">' 
								. sprintf(__('%s Articles', 'flipmag'), '<strong>'. $post_count .'</strong>') . '</a></span>';
						}
						
						$authordata = $author;
	        			
						get_template_part('partial-author');
	        			
						echo '<hr class="separator" />';
					}
	        		
				?>
				
			</div>

			</article>
			
			<?php 
			if ($pages > 1): 
				$query = (object) array('max_num_pages' => $pages);
			?>
			
			<div class="main-pagination">
				<?php echo  Flipmag::posts()->paginate(array(), $query); ?>
			</div>
			
			<?php endif; ?>
			
		</div>
		
		<?php Flipmag::core()->theme_sidebar(); ?>
		
	</div> <!-- .row -->
</div> <!-- .main -->

<?php get_footer(); ?>