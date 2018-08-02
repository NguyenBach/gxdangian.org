<div id="flipmag-bid-<?php echo esc_attr($instance['widget_id']); ?>">
<?php

Flipmag::blocks()->TwitterAuth();
 
if( !empty($instance['title']) ){
    echo  $instance['title'] != null ? $instance['header'] == null ? $args['before_title'] . esc_html($instance['title']) . $args['after_title'] : '<h3 class="widget-title '.esc_attr( $instance['controls']['header'] ).'"><span>'. esc_html($instance['title']) .'</span></h3>' : '' ;
}

$connection = new TwitterOAuth( $instance['consumer-key'], $instance['consumer-secret'], $instance['access-token'], $instance['token-secret']);

$my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $instance['twitter-username'], 'count' =>  $instance['count'] ));

echo '<div class="oc_recent_tweets">';
    echo '<ul class="no-margin">';
        if(isset($my_tweets->errors)){   
            echo '<li>'. sprintf( __( 'Error : %s - %s','flipmag'), $my_tweets->errors[0]->code, $my_tweets->errors[0]->message ).'</li>';
        }else{
            for( $i = 0; $i < $instance['count']; $i++ ){                
                
                echo '<li><i class="fa fa-twitter fa-fw"></i><span>'.Flipmag::blocks()->tp_convert_links( $my_tweets[$i]->text ).'</span><br />';
                echo '<span class="twitter_time"><i class="fa fa-clock-o fa-fw"></i> '.Flipmag::blocks()->tp_relative_time( $my_tweets[$i]->created_at ).'</span></li>';
            }
        }
    echo '</ul>';        
echo '</div>';

?>
</div>