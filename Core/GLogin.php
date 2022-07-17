<?php
/**
 * package GCZ Login
 * author Zero
 * since 2022
 */
function ajax_login_init() {
    wp_register_script('ajax-login-script',''); 
    wp_enqueue_script('ajax-login-script');
    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url('admin-ajax.php'),
        'redirecturl' => home_url(),
    ));
    add_action('wp_ajax_nopriv_ajax_login', 'ajax_login');
}
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login() {
    // check_ajax_referer( 'ajax-login-nonce', 'security' );
    $info = array();
    $info['user_login'] = $_GET['username'];
    $info['user_password'] = $_GET['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if (!empty($info['user_login']) || !empty($info['user_password'])) {
        if (!empty($info['user_login'])) {
            if (!empty($info['user_password'])) {
                if (!is_wp_error($user_signon)){
                    wp_set_current_user($user_signon->ID);
                    wp_set_auth_cookie($user_signon->ID);
                    echo json_encode(
                        array(
                            'loggedin'  => true,
                            'code'      => 500,
                            'message'   =>__('登录成功')
                        )
                    );
                } else {
                    echo json_encode(
                        array(
                            'code'    => 400,
                            'message' => '用户名或密码错误，请检查'
                        ),
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'code'    => 300,
                        'message' => '密码呢？'
                    ),
                );
            }
        } else {
            echo json_encode(
                array(
                    'code'    => 200,
                    'message' => '用户名呢？'
                ),
            );
        }
    } else {
        echo json_encode(
            array(
                'code'    => 100,
                'message' => '用户名和密码都没填呢....'
            ),
        );
    }
    exit();
}