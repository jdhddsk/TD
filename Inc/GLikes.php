<?php
/**
 * API Version: 2.1
 */
function likes() {
    global $wpdb;
    $gcz_user = $_GET['user']; //获取用户id
    $gcz_post = $_GET['post']; //获取文章id
    $gcz_echo = $_GET['echo']; //查询还是点赞
    $meta = "SELECT meta_value FROM `wp_postmeta` WHERE post_id=".$gcz_post." AND meta_key='gcz-likes'"; //获取点赞数目
    $unserialize = unserialize($wpdb->get_var($meta));
    
    if ($gcz_echo == 'true') {
        if (is_user_logged_in()) {
            if (gcz_get_level('','gcz_level_likes')) {
                if (is_array($unserialize)) {
                    if(in_array($gcz_user,$unserialize)) { //检查此用户是否已经点赞
                        foreach($unserialize as $k=>$v) {
                            if($gcz_user == $v) {
                                unset($unserialize[$k]);
                            }
                        }
                        serialize($unserialize);
                        update_post_meta($gcz_post,'gcz-likes',$unserialize);
                        echo '{"message":"已取消点赞","in_array":false,"post_id":'.$gcz_post.',"user_id":'.$gcz_user.',"post_meta":'.json_encode(get_post_meta($gcz_post,"gcz-likes",true)).'}';
                    } else {
                        array_push($unserialize,$gcz_user); // push此用户的id
                        serialize($unserialize);
                        update_post_meta($gcz_post,'gcz-likes',$unserialize);
                        echo '{"message":"已点赞","in_array":true,"post_id":'.$gcz_post.',"user_id":'.$gcz_user.',"post_meta":'.json_encode(get_post_meta($gcz_post,"gcz-likes",true)).'}';
                    }
                } else {
                    $arr = array($gcz_user);
                    serialize($arr);
                    update_post_meta($gcz_post,'gcz-likes',$arr);
                    echo '{"message":"已点赞","in_array":true,"post_id":'.$gcz_post.',"user_id":'.$gcz_user.',"post_meta":'.json_encode(get_post_meta($gcz_post,"gcz-likes",true)).'}';
                }
            } else {
                echo '{"message":"此等级不允许点赞","post_meta":'.json_encode(get_post_meta($gcz_post,"gcz-likes",true)).'}';
            }
        } else {
            echo '{"message":"您未登录，请先登录","post_meta":'.json_encode(get_post_meta($gcz_post,"gcz-likes",true)).'}';
        }
    } else {
        if(in_array($gcz_user,$unserialize)) {
            echo '{"code":200,"in_array":true,"post_meta":'.json_encode(get_post_meta($gcz_post,'gcz-likes',true)).'}';
        } else {
            echo '{"code":200,"in_array":false,"post_meta":'.json_encode(get_post_meta($gcz_post,'gcz-likes',true)).'}';
        }
    }
    die();
}
add_action('wp_ajax_likes', 'likes');
add_action('wp_ajax_nopriv_likes', 'likes');