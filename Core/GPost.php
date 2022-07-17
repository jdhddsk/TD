<?php
function td_post() {
    global $wpdb;
    $user_id = get_current_user_id();
    echo '{';
    echo '"count":[';
    $count = $_GET['count'];
    $type  = $_GET['type'];
    for ($i=0;$i<=$count;$i++) {
        $time = date("Y-m-d",strtotime("-$i day"));
        $query = $wpdb->query("
            SELECT * FROM `wp_posts` WHERE `post_date` LIKE '".$time."%' AND `post_status`='publish' AND `post_type`='".$type."' AND `post_author`='".$user_id."';
        ");
        echo $query;
        if ($i < $count) {
            echo ',';
        }
    }
    echo '],';
    echo '"date":[';
    for ($i=0;$i<=$count;$i++) {
        $time = date("Y-m-d",strtotime("-$i day"));
        echo '"'.$time.'"';
        if ($i < $count) {
            echo ',';
        }
    }
    echo ']';
    echo '}';
    exit();
}
add_action('wp_ajax_td_post', 'td_post');
add_action('wp_ajax_nopriv_td_post', 'td_post');