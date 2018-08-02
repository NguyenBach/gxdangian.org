<?php

if (!function_exists('flipmag_comment')):

	/**
	 * Callback for displaying a comment
	 * 
	 * @todo eventually move to flipmag templates with auto-generated functions as template containers
	 * 
	 * @param mixed   $comment
	 * @param array   $args
	 * @param integer $depth
	 */
	function flipmag_comment($comment, $args, $depth)
	{
		$GLOBALS['comment'] = $comment;
		
		switch ($comment->comment_type):
			case 'pingback':
			case 'trackback':
			?>
			
			<li class="post pingback">
				<p><?php _e('Pingback:', 'flipmag'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'flipmag'), '<span class="edit-link">', '</span>'); ?></p>
			<?php
				break;


			default:
			?>
		
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
				
					<div class="comment-avatar">
					<?php
						echo get_avatar($comment, 40);
					?>
					</div>
					
					<div class="comment-meta">					
						<span class="comment-author"><?php comment_author_link(); ?></span> <?php _e('on', 'flipmag'); ?> 
						<a href="<?php comment_link(); ?>" class="comment-time" title="<?php comment_date(); _e(' at ', 'flipmag'); comment_time(); ?>">
							<time pubdate datetime="<?php comment_time('c'); ?>"><?php comment_date(); ?> <?php comment_time(); ?></time>
						</a>
		
						<?php edit_comment_link(__( 'Edit', 'flipmag' ), '<span class="edit-link"> &middot; ', '</span>' ); ?>
					</div> <!-- .comment-meta -->
		
					<div class="comment-content">
						<?php comment_text(); ?>
						
						<?php if ($comment->comment_approved == '0'): ?>
							<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'flipmag'); ?></em>
						<?php endif; ?>
						
                        <?php if ( !Flipmag::options()->oc_comment_posts ){ ?>
                            <div class="reply">
                                <?php
                                    comment_reply_link(array_merge($args, array(
                                            'reply_text' => __( 'Reply', 'flipmag') . ' <i class="fa fa-angle-right"></i>',
                                            'depth'      => $depth,
                                            'max_depth'  => $args['max_depth']
                                    ))); 
                                ?>
                            </div><!-- .reply -->
                        <?php } ?>
						
					</div>
				</article><!-- #comment-N -->
	
		<?php
				break;
		endswitch;
		
	}
	
endif;