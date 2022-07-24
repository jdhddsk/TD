<?php
function td_buy_security() {
    $pass   = $_GET['password'];
    $price  = $_GET['price'];
    $credit = get_user_meta(get_current_user_id(),'gcz_user_credit',true);
    
    $user = wp_get_current_user();
    if (!empty($pass)) {
        if (wp_check_password($pass, $user->data->user_pass, $user->data->ID)) {
            if (!empty($price)) {
                if (strpos($credit - $price,'-') === 0) {
                    $non = array(
                        'code'      => 500,
                        'message'   => '错误：余额不足，请在侧边栏充值后重试'
                    );
                    echo json_encode($non);
                } else {
                    $arr = array(
                        'code'      => 200,
                        'message'   => '密码正确',
                    );
                    
                    echo json_encode($arr);
                }
            }
        } else {
            $arr = array(
                'code'      => 500,
                'message'   => '密码不正确，请重新输入'
            );
            echo json_encode($arr);
        }
    } else {
        $arr = array(
            'code'      => 600,
            'message'   => '请输入密码'
        );
        echo json_encode($arr);
    }
    exit();
}
add_action('wp_ajax_td_buy_security', 'td_buy_security');
add_action('wp_ajax_nopriv_td_buy_security', 'td_buy_security');