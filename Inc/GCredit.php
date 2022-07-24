<?php
function gcz_credit() {
    $user_id = $_GET['user'];
    $charts  = $_GET['echo'];
    $count   = $_GET['count'];
    global $wpdb;
    if (empty($count || $charts) && !empty($user_id)) {
        $sql = $wpdb->get_results('SELECT * FROM `wp_gcz_order` WHERE `gcz_user`='.$user_id.'');
        echo json_encode($sql);
    }
    
    if ($charts == true && !empty($count || $user)) {
        echo '{';
        echo '"count":[';
        for ($i=0;$i<=$count;$i++) {
            $time = date("Y-m-d",strtotime("-$i day"));
            $sql = $wpdb->get_var("SELECT `gcz_money` FROM `wp_gcz_order` WHERE `gcz_time` LIKE '".$time."%' AND `gcz_user`='".$user_id."'");
            echo json_encode($sql);
            if ($i < $count) {
                echo ',';
            }
        }
        echo '],"date":[';
        for ($i=0;$i<=$count;$i++) {
            $time = date("Y-m-d",strtotime("-$i day"));
            echo '"'.$time.'"';
            if ($i < $count) {
                echo ',';
            }
        }
        echo ']';
        echo '}';
    }
    exit();
}
add_action('wp_ajax_gcz_credit', 'gcz_credit');
add_action('wp_ajax_nopriv_gcz_credit', 'gcz_credit');