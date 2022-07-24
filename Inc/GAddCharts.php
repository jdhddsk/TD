<?php
function td_add_charts() {
    global $wpdb;
    $user = get_current_user_id();
    $chart_id = md5(time());
    $ID = $_GET['post_id'];
    $title = $_GET['post_title'];
    $image = $_GET['image'];
    $count = $_GET['count'];
    $price = get_the_price($ID,$count);
    $arr = unserialize($wpdb->get_var("SELECT `meta_value` FROM `wp_usermeta` WHERE `user_id`=1 AND `meta_key`='gcz_charts'"));
    
    if (is_user_logged_in()) {
        if (!empty($count)) {
            if (!empty($ID)) {
                if (is_array($arr)) {
                    $arr_length = count($arr);
                    $g_array = array(
                        'charts'=> $chart_id,
                        'count' => $count,
                        'id'    => $ID,
                        'title' => $title,
                        'image' => $image,
                        'price' => $price
                    );
                    $arr[$arr_length] = $g_array;
                    update_user_meta(get_current_user_id(),'gcz_charts',$arr);
                    echo '{"message":"添加成功","data":'.json_encode($arr).'}';
                } else {
                    $g_array = array(
                        'charts'=> $chart_id,
                        'count' => $count,
                        'id'    => $ID,
                        'title' => $title,
                        'image' => $image,
                        'price' => $price
                    );
                    $arr[0] = $g_array;
                    update_user_meta(get_current_user_id(),'gcz_charts',$arr);
                    echo '{"message":"添加成功","data":'.json_encode($arr).'}';
                }
            } else {
                for ($i = 0;$i < count($arr);$i++) {
                    $price = get_the_price($arr[$i]['id'],$arr[$i]['count']);
                    $arr[$i]['price'] = $price;
                }
                echo '{"message":"参数不齐","data":'.json_encode($arr).'}';
            }
        } else {
            for ($i = 0;$i < count($arr);$i++) {
                $price = get_the_price($arr[$i]['id'],$arr[$i]['count']);
                $arr[$i]['price'] = $price;
            }
            echo '{"message":"参数不齐","data":'.json_encode($arr).'}';
        }
    } else {
        echo '{"code":500,"message":"您未登录"}';
    }
    exit();
}
add_action('wp_ajax_td_add_charts', 'td_add_charts');
add_action('wp_ajax_nopriv_td_add_charts', 'td_add_charts');