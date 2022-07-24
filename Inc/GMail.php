<?php
function td_code() {
    $arr=range(100000,999999);
    shuffle($arr);
    foreach($arr as $values) {
        return "$values";//显示随机数
    }
}
function td_variety() {
    $to = $_GET['to'];
    $code = td_code();
    $subject = '短信验证码';
    $body = '<h1>'.get_bloginfo("name").'</h1><div>您的验证码是：'.$code.'</div>';
    $headers = array('Content-Type:text/html;charset=UTF-8');
    wp_mail($to,$subject,$body,$headers);
    $arr = array(
        "code"  => $code,
    );
    echo json_encode($arr);
    exit();
}

add_action('wp_ajax_td_variety', 'td_variety');
add_action('wp_ajax_nopriv_td_variety', 'td_variety');