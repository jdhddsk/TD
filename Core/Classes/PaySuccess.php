<?php
require '../../../../../wp-load.php';
global $wpdb;
$user_id        = $_GET['user'];
$order_id       = $_GET['order'];
$sql_security   = $wpdb->get_var("SELECT `gcz_status` FROM `wp_gcz_order` WHERE `gcz_order`=".$order_id."");
if ($sql_security = 1 || $sql_security = '1' || $sql_security == 1 || $sql_security == '1') {
    $sql            = "UPDATE `wp_gcz_order` SET `gcz_user` = '".$user_id."' WHERE `gcz_order`=".$order_id."";
    $sql_security   = "UPDATE `wp_gcz_order` SET `gcz_status` = '0' WHERE `gcz_order`=".$order_id."";
    sleep(3);
    $wpdb->query($sql);
    $new_money      = gcz_money($order_id);
    $rel_money      = get_user_meta($user_id,'gcz_user_credit',true);
    $money          = $new_money + $rel_money;
    update_user_meta($user_id,'gcz_user_credit',$money);
    $wpdb->query($sql_security);
} else {
    echo 'error:请勿再次打开本页面';
}

?>
<html>
    <head>
        <style>
            @keyframes success {
                from {
                    transform: scale(0);
                }
                to {
                    transform: scale(1);
                }
            }
            @keyframes text {
                from {
                    transform: translateY(20px);
                    opacity: 0;
                }
                to {
                    transform: translateY(0px);
                    opacity: 1;
                }
            }
            @keyframes mask {
                from {
                    background: #fff;
                }
                to {
                    background: #fff0;
                }
            }
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: absolute;
                height: 98%;
                width: 99%;
            }
            p {
                margin: 0;
            }
            p svg {
                animation: success 1s infinite;
                animation-iteration-count:1;
            }
            .text {
                animation: text 1s infinite;
                animation-iteration-count:1;
                margin-top: 28px;
                font-weight: 500;
                font-size: 20px;
            }
            .tips {
                font-size: 14px;
                color: #0009;
                margin: 8px 0 32px;
                text-align: center;
            }
            .mask {
                position: fixed;
                width: 100%;
                height: 100%;
                animation: mask 2s infinite;
                animation-iteration-count:1;
            }
        </style>
    </head>
    <body>
        <div class="mask"> </div>
        <p style="font-size: 72px;color:#00a870">
            <svg data-v-cb6aa450="" fill="none" viewBox="0 0 16 16" width="1em" height="1em" class="t-icon t-icon-check-circle result-success-icon"><path data-v-cb6aa450="" fill="currentColor" d="M4.5 8.2L7 10.7l4.5-4.5-.7-.7L7 9.3 5.2 7.5l-.7.7z" fill-opacity="0.9"></path><path data-v-cb6aa450="" fill="currentColor" d="M4.11 2.18a7 7 0 117.78 11.64A7 7 0 014.1 2.18zm.56 10.8a6 6 0 106.66-9.97A6 6 0 004.67 13z" fill-opacity="0.9"></path></svg>
        </p>
        <p class="text">支付成功</p>
        <p class="tips">
            请刷新页面，并检查余额与订单列表是否已更新
            <br>
            如果余额未更新，请联系站长
        </p>
    </body>
</html>