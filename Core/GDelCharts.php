<?php
function td_del_charts() {
    global $wpdb;
    $user = get_current_user_id();
    $hash = $_GET['hash'];
    $arr = unserialize($wpdb->get_var("SELECT `meta_value` FROM `wp_usermeta` WHERE `user_id`=".$user." AND `meta_key`='gcz_charts'"));
    
    foreach ($arr as $k=>$v) {
        if ($v['charts'] == $hash) {
            unset($arr[$k]);
        }
    }
    update_user_meta(get_current_user_id(),'gcz_charts',$arr);
    echo json_encode($arr);
    exit();
}
add_action('wp_ajax_td_del_charts', 'td_del_charts');
add_action('wp_ajax_nopriv_td_del_charts', 'td_del_charts');