<?php 

echo '<div class="social-bar">';

    if( Flipmag::options()->oc_social_Behance != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Behance ) .'" title="'. __('Behance', 'flipmag') .'" ><i class="fa fa-behance"></i></a>';
    }
    if( Flipmag::options()->oc_social_Delicious != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Delicious ) .'" title="'. __('Delicious', 'flipmag') .'" ><i class="fa fa-delicious"></i></a>';
    }    
    if( Flipmag::options()->oc_social_Deviantart != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Deviantart ) .'" title="'. __('Deviantart', 'flipmag') .'" ><i class="fa fa-deviantart"></i></a>';
    }
    if( Flipmag::options()->oc_social_Digg != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Digg ) .'" title="'. __('Digg', 'flipmag') .'" ><i class="fa fa-digg"></i></a>';
    }
    if( Flipmag::options()->oc_social_Dribbble != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Dribbble ) .'" title="'. __('Dribbble', 'flipmag') .'" ><i class="fa fa-dribbble"></i></a>';
    }
    if( Flipmag::options()->oc_social_Facebook != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Facebook ) .'" title="'. __('Facebook', 'flipmag') .'" ><i class="fa fa-facebook"></i></a>';
    }
    if( Flipmag::options()->oc_social_Flickr != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Flickr ) .'" title="'. __('Flickr', 'flipmag') .'" ><i class="fa fa-flickr"></i></a>';
    }    
    if( Flipmag::options()->oc_social_Google_Plus != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Google_Plus ) .'" title="'. __('Google Plus', 'flipmag') .'" ><i class="fa fa-google-plus"></i></a>';
    }    
    if( Flipmag::options()->oc_social_Html5 != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Html5 ) .'" title="'. __('Html5', 'flipmag') .'" ><i class="fa fa-html5"></i></a>';
    }
    if( Flipmag::options()->oc_social_Instagram != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Instagram ) .'" title="'. __('Instagram', 'flipmag') .'" ><i class="fa fa-instagram"></i></a>';
    }
    if( Flipmag::options()->oc_social_Lastfm != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Lastfm ) .'" title="'. __('Lastfm', 'flipmag') .'" ><i class="fa fa-lastfm"></i></a>';
    }
    if( Flipmag::options()->oc_social_Linkedin != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Linkedin ) .'" title="'. __('Linkedin', 'flipmag') .'" ><i class="fa fa-linkedin"></i></a>';
    }    
    if( Flipmag::options()->oc_social_Mail != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Mail ) .'" title="'. __('Mail', 'flipmag') .'" ><i class="fa fa-envelope-o"></i></a>';
    }    
    if( Flipmag::options()->oc_social_Paypal != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Paypal ) .'" title="'. __('Paypal', 'flipmag') .'" ><i class="fa fa-paypal"></i></a>';
    }
    if( Flipmag::options()->oc_social_Pinterest != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Pinterest ) .'" title="'. __('Pinterest', 'flipmag') .'" ><i class="fa fa-pinterest"></i></a>';
    }
    if( Flipmag::options()->oc_social_Reddit != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Reddit ) .'" title="'. __('Reddit', 'flipmag') .'" ><i class="fa fa-reddit-alien"></i></a>';
    }
    if( Flipmag::options()->oc_social_Rss != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Rss ) .'" title="'. __('Rss', 'flipmag') .'" ><i class="fa fa-rss"></i></a>';
    }
    if( Flipmag::options()->oc_social_Share != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Share ) .'" title="'. __('Share', 'flipmag') .'" ><i class="fa fa-share-alt"></i></a>';
    }
    if( Flipmag::options()->oc_social_Skype != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Skype ) .'" title="'. __('Skype', 'flipmag') .'" ><i class="fa fa-skype"></i></a>';
    }
    if( Flipmag::options()->oc_social_Soundcloud != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Soundcloud ) .'" title="'. __('Soundcloud', 'flipmag') .'" ><i class="fa fa-soundcloud"></i></a>';
    }
    if( Flipmag::options()->oc_social_Spotify != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Spotify ) .'" title="'. __('Spotify', 'flipmag') .'" ><i class="fa fa-spotify"></i></a>';
    }
    if( Flipmag::options()->oc_social_Stackoverflow != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Stackoverflow ) .'" title="'. __('Stackoverflow', 'flipmag') .'" ><i class="fa fa-stack-overflow"></i></a>';
    }
    if( Flipmag::options()->oc_social_Steam != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Steam ) .'" title="'. __('Steam', 'flipmag') .'" ><i class="fa fa-steam"></i></a>';
    }
    if( Flipmag::options()->oc_social_StumbleUpon != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_StumbleUpon ) .'" title="'. __('StumbleUpon', 'flipmag') .'" ><i class="fa fa-stumbleupon"></i></a>';
    }
    if( Flipmag::options()->oc_social_Tumblr != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Tumblr ) .'" title="'. __('Tumblr', 'flipmag') .'" ><i class="fa fa-tumblr"></i></a>';
    }
    if( Flipmag::options()->oc_social_Twitter != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Twitter ) .'" title="'. __('Twitter', 'flipmag') .'" ><i class="fa fa-twitter"></i></a>';
    }
    if( Flipmag::options()->oc_social_Vimeo != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Vimeo ) .'" title="'. __('Vimeo', 'flipmag') .'" ><i class="fa fa-vimeo"></i></a>';
    }
    if( Flipmag::options()->oc_social_VKontakte != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_VKontakte ) .'" title="'. __('VKontakte', 'flipmag') .'" ><i class="fa fa-vk"></i></a>';
    }
    if( Flipmag::options()->oc_social_Windows != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Windows ) .'" title="'. __('Windows', 'flipmag') .'" ><i class="fa fa-windows"></i></a>';
    }
    if( Flipmag::options()->oc_social_Woordpress != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Woordpress ) .'" title="'. __('Woordpress', 'flipmag') .'" ><i class="fa fa-wordpress"></i></a>';
    }
    if( Flipmag::options()->oc_social_Yahoo != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Yahoo ) .'" title="'. __('Yahoo', 'flipmag') .'" ><i class="fa fa-yahoo"></i></a>';
    }
    if( Flipmag::options()->oc_social_Youtube != null ){        
        echo '<a href="'. esc_url( Flipmag::options()->oc_social_Youtube ) .'" title="'. __('Youtube', 'flipmag') .'" ><i class="fa fa-youtube"></i></a>';
    }
  echo '</div>';  
    
 ?>