<?php
function gcz_user() {
    $user_id = $_GET['user_id'];
    $arr            = array(
        'basic' => array(
            'avatar'                    => get_user_meta($user_id,'gcz_user_avatar',true),
            'headering'                 => get_user_meta($user_id,'gcz_user_headering',true),
            'saying'                    => get_user_meta($user_id,'gcz_user_saying',true),
            'phone'                     => get_user_meta($user_id,'gcz_user_phone',true),
            'capabilities'              => get_user_meta($user_id,'gcz_user_capabilities',true),
        ),
        'qq'        => array(
            'qq_openid'                 => get_user_meta($user_id,'qq_openid',true),
        ),
        'weibo'     => array(
            'gcz_user_weibo_avatar'     => get_user_meta($user_id,'gcz_user_weibo_avatar',true),
            'sina_uid'                  => get_user_meta($user_id,'sina_uid',true),
            'sina_name'                 => get_user_meta($user_id,'sina_name',true),
        ),
        'credit'    => array(
            'gcz_user_credit'           => get_user_meta($user_id,'gcz_user_credit',true),
        ),
        'senior'    => array(
            'gcz_fans'                  => get_user_meta($user_id,'gcz-fans',true),
            'gcz_follow'                => get_user_meta($user_id,'gcz-follow',true),
        )
    );
    echo json_encode($arr);
    exit();
}
add_action('wp_ajax_gcz_user', 'gcz_user');
add_action('wp_ajax_nopriv_gcz_user', 'gcz_user');