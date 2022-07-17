<?php
$user_id = get_current_user_id();
function gcz_write() {
    $gcz_title = $_GET['title'];
    $gcz_content = $_GET['content'];
    $gcz_category = $_GET['category'];
    $gcz_comment = $_GET['comment'];
    $gcz_array = array(
        'post_author'           => $user_id,
        'post_content'          => $gcz_content,
        'post_title'            => $gcz_title,
        'post_status'           => 'draft',
        'post_type'             => 'post',
        'comment_status'        => $gcz_content,
    );
    if (empty($gcz_title)) {
        $return = array(
            'code'      => 200,
            'status'    => 'error',
            'message'   => '请填写标题',
        );
    } else if (empty($gcz_content)) {
        $return = array(
            'code'      => 200,
            'status'    => 'error',
            'message'   => '请填写内容',
        );
    } else if (empty($gcz_category)) {
        $return = array(
            'code'      => 200,
            'status'    => 'error',
            'message'   => '请填写分类',
        );
    } else {
        wp_insert_post($gcz_array);
        $return = array(
            'code'      => 200,
            'status'    => 'success',
            'message'   => '发布成功',
        );
    }
    echo json_encode($return);
    exit();
}
add_action('wp_ajax_gcz_write', 'gcz_write');
add_action('wp_ajax_nopriv_gcz_write', 'gcz_write');

function gcz_write_category() {
    $gcz_array = array(
        'code'      =>  200,
        'message'   =>  '成功',
        'category'  =>  get_terms(array('taxonomy' => 'category','hide_empty' => false,))
    );
    echo json_encode($gcz_array);
    exit();
}
add_action('wp_ajax_gcz_write_category', 'gcz_write_category');
add_action('wp_ajax_nopriv_gcz_write_category', 'gcz_write_category');