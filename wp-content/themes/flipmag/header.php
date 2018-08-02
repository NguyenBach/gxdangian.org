<!DOCTYPE html>
<!--
o o     o     +              o
+   +     +             o     +       +
            +
o  +    +        o  +           +        +
     ___ _   _      _   _ _    _ _    _ _    ____      _ _ _    _ 
~_,-|  ___| | |    | | |  _ \ |   \  /   |  / __ \    / _ _ |          
    | |___  | |    | | | |_| || |\ \/ /| | / /__\ \  / /  _ _    - ,
~_,-| |___| | |_ _ | | |  _ / | | \__/ | || |____| | \ \_ _| |        /\_/\
    |_|     |_ _ _||_| |_|    |_|      |_||_|    |_|  \_ _ _ /   ~=|__( ^ .^)
~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,-~_,""   ""
o o     o     +              o
+   +     +             o     +       +
            +
o  +    +        o  +           +        +
-->
<!--[if IE 8]> <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]> <html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->

<head>

<?php 
/**
 * Match wp_head() indent level
 */
?>

<meta charset="<?php bloginfo('charset'); ?>" />

<?php if (!Flipmag::options()->oc_no_responsive): // don't add if responsiveness disabled ?> 
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php endif; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>> 

<?php

    /**
     * Get the partial template for header
     */
    get_template_part('blocks/header/'. Flipmag::options()->oc_header_layout );


    /**
     * custom action for add content from this hooks
     */
    do_action('flipmag_pre_main_content'); 

?>