<div id="flipmag-bid-<?php echo esc_attr($instance['widget_id']); ?>">
<?php

if( !empty($instance['title']) ) echo wp_kses_stripslashes( $instance['header'] == null ? $args['before_title'] . esc_html($instance['title']) . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['header'] ).'"><span>'. esc_html($instance['title']) .'</span></h3>' ) ;



$html = '<div id="oc-social-counter" class="'. esc_attr( $instance['theme_style'] ) .'" >';
if( class_exists('Flipmag')){
//Facebook
if( $instance['facebook']['check'] ){
    
    $count = 0;
    
    if( $instance['facebook']['username'] != null ){
        //url
        $url = $instance['facebook']['username'];    

        // Query in FQL
        $fql  = "SELECT share_count, like_count, comment_count ";
        $fql .= " FROM link_stat WHERE url = '$url'";

        //JSON
        $json = wp_remote_retrieve_body( wp_remote_get( "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql) ) );
        $app = json_decode($json);

        // facebook like count
        if( !property_exists($app, "error_code") ){
            $count = $app[0]->like_count;
        }
    }

 
    if( $count == 0 && $instance['facebook']['default'] != null ){
        $count = $instance['facebook']['default'];
    }
    $html .= '<div class="facebook"><i class="fa fa-facebook"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Likes", 'flipmag') .'</span></div>';
}

//Twitter
if( $instance['twitter']['check'] ){
    
    $count = 0;

    if( !empty($instance['twitter']['consumer-key']) && !empty($instance['twitter']['consumer-secret']) && !empty($instance['twitter']['access-token']) && !empty($instance['twitter']['token-secret']) ){
        Flipmag::blocks()->TwitterAuth();    
        $connection = new TwitterOAuth( $instance['twitter']['consumer-key'], $instance['twitter']['consumer-secret'], $instance['twitter']['access-token'], $instance['twitter']['token-secret']);

        $followers = $connection->get('statuses/user_timeline', array('screen_name' => $instance['twitter']['username'] ));

        if(is_object($followers->errors)){            
            echo sprintf( __( 'Error : %s - %s','flipmag'), $followers->errors[0]->code, $followers->errors[0]->message );
        }else{
             $count = $followers[0]->user->followers_count;
        }
    }
    
    if( $count == 0 && $instance['twitter']['default'] != null ){
        $count = $instance['twitter']['default'];
    }
    $html .= '<div class="twitter"><i class="fa fa-twitter"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Google Plus
if( $instance['google-plus']['check'] ){
    
    $count = 0;
    
    if( $instance['google-plus']['username'] != null && $instance['google-plus']['api-key'] != null ){
        
        $json = wp_remote_retrieve_body( wp_remote_get( "https://www.googleapis.com/plus/v1/people/".$instance['google-plus']['username']."?key=".$instance['google-plus']['api-key'] ));
        $app = json_decode($json);
        if ( isset( $app->circledByCount)) {              
            $count = intval($app->circledByCount);                    
        }        
    }
 
    if( $count == 0 && $instance['google-plus']['default'] != null ){
        $count = $instance['google-plus']['default'];
    } 
    $html .= '<div class="google"><i class="fa fa-google-plus"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Youtube
if( $instance['youtube']['check'] ){
    
    $count = 0;
    
    $api = $instance['youtube']['api-key'];
    
    if( $api != null ){
        if( $instance['youtube']['channel'] != null ){
            //channel
            $json = wp_remote_retrieve_body( wp_remote_get("https://www.googleapis.com/youtube/v3/channels?key=$api&part=statistics&id=".$instance['youtube']['channel']) );
            $app = json_decode($json);

            if( isset($app->items[0]->statistics->subscriberCount) ){
                $count = $app->items[0]->statistics->subscriberCount;
            }
        }

        //user
        if( $instance['youtube']['username'] != null && $count == 0 ){
            $json = wp_remote_retrieve_body( wp_remote_get("https://www.googleapis.com/youtube/v3/channels?key=$api&part=statistics&forUsername=".$instance['youtube']['username'] ) );
            $app = json_decode($json);
            if( isset($app->items[0]->statistics->subscriberCount) ){
                $count = $app->items[0]->statistics->subscriberCount;
            }
        }
    }
    
    if( $count == 0 && $instance['youtube']['default'] != null ){
        $count = $instance['youtube']['default'];
    }
    
    $html .= '<div class="youtube"><i class="fa fa-youtube"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Subscribers", 'flipmag') .'</span></div>';
}

//Linkedin
if( $instance['linkedin']['check'] ){
    
    $count = 0;
    
    if( $instance['linkedin']['url'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://www.linkedin.com/countserv/count/share?format=json&url=".$instance['linkedin']['url'] ) );
        $app = json_decode($json);
        if( is_object($app) ){
            $count = $app->count;
        }
    }
    
    if( $count == 0 && $instance['linkedin']['default'] != null ){
        $count = $instance['linkedin']['default'];
    }
    $html .= '<div class="linkedin"><i class="fa fa-linkedin"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Instagram
if( $instance['instagram']['check'] ){
    
    $count = 0;

    if( $instance['instagram']['username'] != null && $instance['instagram']['api'] != null ){    
        $json = wp_remote_retrieve_body( wp_remote_get("https://api.instagram.com/v1/users/". $instance['instagram']['username'] ."?access_token=".$instance['instagram']['api'] ));
        $app = json_decode($json);
        if( is_object($app) ){
            $count = $app->data->counts->followed_by;    
        }        
    }
        
    if( $count == 0 && $instance['instagram']['default'] != null ){
        $count = $instance['instagram']['default'];
    }
    $html .= '<div class="instagram"><i class="fa fa-instagram"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Pinterest
if( $instance['pinterest']['check'] ){
    
    $count = 0;
    
    if( $instance['pinterest']['url'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=". $instance['pinterest']['url'] ));
        $json = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $json);

        $app = json_decode($json);

        if( isset($app->count) ){
            $count = $app->count;
        }
    }
    
    if( $count == 0 && $instance['pinterest']['default'] != null ){
        $count = $instance['pinterest']['default'];
    }
    $html .= '<div class="pinterest"><i class="fa fa-pinterest"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//SoundCloud
if( $instance['soundcloud']['check'] ){
    
    $count = 0;
    
    if( $instance['soundcloud']['id'] != null && $instance['soundcloud']['api'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("http://api.soundcloud.com/users/". $instance['soundcloud']['id'] ."?client_id=". $instance['soundcloud']['api'] ) );
        $app = json_decode($json);
        if( is_object($app) ){
            $count = $app->followers_count;
        }
    }
    
    if( $count == 0 && $instance['soundcloud']['default'] != null ){
        $count = $instance['soundcloud']['default'];
    }
    $html .= '<div class="soundcloud"><i class="fa fa-soundcloud"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Stumbleupon
if( $instance['stumbleupon']['check'] ){
    
    $count = 0;
    
    if( $instance['stumbleupon']['url'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://www.stumbleupon.com/services/1.01/badge.getinfo?url=". $instance['stumbleupon']['url'] ) );
        $json = substr($json, 1, -1);    
        $app = json_decode(str_replace( substr( $json, strpos( $json , '}' ) ) ,"}", substr( $json, strpos( $json , '{' ) ) ) );

        if( is_object($app) ){
            $count = $app->views;
        }
    }
    
    if( $count == 0 && $instance['stumbleupon']['default'] != null ){
        $count = $instance['stumbleupon']['default'];
    }   
    $html .= '<div class="stumbleupon"><i class="fa fa-stumbleupon"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Views", 'flipmag') .'</span></div>';
}

//Dribbble
if( $instance['dribbble']['check'] ){
    
    $count = 0;
    
    if( $instance['dribbble']['username'] != null && $instance['dribbble']['api'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://api.dribbble.com/v1/users/". $instance['dribbble']['username'].'?access_token='. $instance['dribbble']['api'] ) );
        $app = json_decode($json);
        if( is_object($app) ){
            $count = $app->followers_count;
        }
    }
    
    if( $count == 0 && $instance['dribbble']['default'] != null ){
        $count = $instance['dribbble']['default'];
    }    
    $html .= '<div class="dribbble"><i class="fa fa-dribbble"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Vimeo
if( $instance['vimeo']['check'] ){
    
    $count = 0;
    
    if( $instance['vimeo']['username'] != null && $instance['vimeo']['api'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://api.vimeo.com/users/". $instance['vimeo']['username'].'?access_token='.$instance['vimeo']['api'] ));
        $app = json_decode($json);
        
        if( isset($app->metadata->connections->followers->total) ){
            $count = $app->metadata->connections->followers->total;
        }
    }
    
    if( $count == 0 && $instance['vimeo']['default'] != null ){
        $count = $instance['vimeo']['default'];
    }
    $html .= '<div class="vimeo"><i class="fa fa-vimeo"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Vine
if( $instance['vine']['check'] ){
    
    $count = 0;
    
    if( $instance['vine']['username'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("http://usocial.me/vine.php?user=". $instance['vine']['username'] ));
        $app = json_decode($json);

        if( is_object($app) ){
            $count = $app->followers;
        }
    }
    
    if( $count == 0 && $instance['vine']['default'] != null ){
        $count = $instance['vine']['default'];
    }    
    $html .= '<div class="vine"><i class="fa fa-vine"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Tumblr
if( $instance['tumblr']['check'] ){
    
    $count = 0;
    
    if( $instance['tumblr']['username'] != null && $instance['tumblr']['api'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://api.tumblr.com/v2/blog/". $instance['tumblr']['username'] .'.tumblr.com/info?api_key='. $instance['tumblr']['api'] ));
        $app = json_decode($json);

        if( is_object($app->response) ){
            $count = $app->response->blog->posts;
        }
    }
    
    if( $count == 0 && $instance['tumblr']['default'] != null ){
        $count = $instance['tumblr']['default'];
    }    
    $html .= '<div class="tumblr"><i class="fa fa-tumblr"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Github
if( $instance['github']['check'] ){
    
    $count = 0;
    
    if( $instance['github']['username'] != null ){
        $json = wp_remote_retrieve_body( wp_remote_get("https://api.github.com/users/". $instance['github']['username'] ));
        $app = json_decode($json);

        if( is_object($app) ){
            $count = $app->followers;
        }
    }
    
    if( $count == 0 && $instance['github']['default'] != null ){
        $count = $instance['github']['default'];
    }    
    $html .= '<div class="github"><i class="fa fa-github"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Followers", 'flipmag') .'</span></div>';
}

//Posts
if( $instance['posts']['check'] ){
    $count = wp_count_posts()->publish;
    $html .= '<div class="posts"><i class="fa fa-clone"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Posts", 'flipmag') .'</span></div>';
}

//Comments
if( $instance['comment']['check'] ){
    $count = wp_count_comments()->approved;
    $html .= '<div class="comment"><i class="fa fa-comments"></i><span class="count">'. Flipmag::blocks()->format_num( intval($count), 1 ) .'</span><span class="followers">'. __("Comments", 'flipmag') .'</span></div>';
}
}

$html .= '</div>';

echo wp_kses_stripslashes($html);

?>
</div>