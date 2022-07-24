<?php
function td_get_vip() {
    $gcz = get_option('gcz_options');
    $vips = $gcz['gcz-vips'];
    echo '[';
    for ($i = 0; $i < count($vips); $i++) {
        $arr = array(
            'name'      => $vips[$i]['gcz_vips_name'],
            'money'     => $vips[$i]['gcz_vips_money'],
            'time'      => $vips[$i]['gcz_vips_time'],
            'ability'   => array(
                'post_ability'      => array(
                    'comments'      => $vips[$i]['gcz_vips_tabbed']['gcz_vips_comments'],
                    'likes'         => $vips[$i]['gcz_vips_tabbed']['gcz_vips_likes'],
                    'post'          => $vips[$i]['gcz_vips_tabbed']['gcz_vips_post'],
                ),
                'talk_ability'      => array(
                    'comments'      => $vips[$i]['gcz_vips_tabbed']['gcz_vips_talk_comments'],
                    'likes'         => $vips[$i]['gcz_vips_tabbed']['gcz_vips_talk_likes'],
                    'post'          => $vips[$i]['gcz_vips_tabbed']['gcz_vips_talk_post'],
                    'circle'        => $vips[$i]['gcz_vips_tabbed']['gcz_vips_talk_circle'],
                ),
            'people'            => $vips[$i]['gcz_vips_tabbed']['gcz_vips_people'],
            'false_people'      => $vips[$i]['gcz_vips_tabbed']['gcz-vips-people-false']
            ),
        );
        
        echo json_encode($arr);
        if ($i+1 < count($vips)) {
            echo ',';
        }
    }
    echo ']';
    exit();
}
add_action('wp_ajax_td_get_vip', 'td_get_vip');
add_action('wp_ajax_nopriv_td_get_vip', 'td_get_vip');

function td_current_vip() {
    $gcz = get_option('gcz_options');
    $user_id = get_current_user_id();
    foreach ($gcz['gcz-vips'] as $item) {
        foreach ($item['gcz-vips-tabbed']['gcz-vips-people'] as $people) {
            if ($people == $user_id) {
                echo json_encode($item);
                exit();
            }
        }
    }
}
add_action('wp_ajax_td_current_vip', 'td_current_vip');
add_action('wp_ajax_nopriv_td_current_vip', 'td_current_vip');