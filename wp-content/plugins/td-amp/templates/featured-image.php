<?php
/**
 * Post featured image template part.
 *
 */
?>

<?php

//if it's a video post...
if ( get_post_format( $this->post->ID ) == 'video' ) {
    $featured_video_amp_html = $this->get( 'featured_video' );

    if ( is_null( $featured_video_amp_html ) ) {
        return;
    }

    echo $featured_video_amp_html;

} else {
    $featured_image = $this->get( 'featured_image' );

    if ( empty( $featured_image ) ) {
        return;
    }

    $amp_html = $featured_image['amp_html'];
    $caption = $featured_image['caption'];

?>
    <figure class="amp-wp-article-featured-image wp-caption">
        <?php echo $amp_html; // amphtml content; no kses ?>
        <?php if ( $caption ) : ?>
            <p class="wp-caption-text">
                <?php echo wp_kses_data( $caption ); ?>
            </p>
        <?php endif; ?>
    </figure>

<?php
}