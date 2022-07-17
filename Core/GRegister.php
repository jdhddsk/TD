<?php
/**
 * package GCZ register
 * author Zero
 * since 2022
 */
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end() {
	  $new_user_name = stripcslashes($_GET['new_user_name']);
	  $new_user_email = stripcslashes($_GET['new_user_email']);
	  $new_user_password = $_GET['new_user_password'];
	  $user_nice_name = strtolower($_GET['new_user_email']);
	  $user_data = array(
	      'user_login'      => $new_user_name,
	      'user_email'      => $new_user_email,
	      'user_pass'       => $new_user_password,
	      'user_nicename'   => $user_nice_name,
	      'display_name'    => $new_user_first_name,
	      'role'            => 'subscriber'
	  	);
	  $user_id = wp_insert_user($user_data);
	  if (empty($new_user_name)||empty($new_user_email)||empty($new_user_password)||empty($user_nice_name)) {
	      echo '{"code":300,"message":"所有内容都是必填，别偷懒ε≡٩(๑>₃<)۶ "}';
	  } else if (!is_wp_error($user_id)) {
	      echo '{"code":340,"message":"正在注册您的账号 请稍后..."}';
	  } else {
	        if (isset($user_id->errors['empty_user_login'])) {
	            $notice_key = '{"code":330,"message":"用户名和电子邮件是必填项"}';
	            echo $notice_key;
            } else if (isset($user_id->errors['existing_user_login'])) {
	            echo'{"code":320,"message":"用户名已存在。"}';
	        } else {
	            echo'{"code":310,"message":"出现错误，请仔细填写表单，别弄虚作假"}';
	        }
      }
    die;
}