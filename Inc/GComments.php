<?php
/**
 * @package 评论API
 * @author Zero
 * @since 2022
 */
function gcz_comments() {
    $user_name = $_GET['user_name'];
    $user_email = $_GET['user_email'];
    $user_url = $_GET['user_url'];
    
    $content = $_GET['content'];
    $parent = $_GET['parent'];
    
    $post_id = $_GET['post'];
    $user_id = $_GET['user'];
    
    if (is_user_logged_in()) {
        if ( comments_open( $post_id ) ) {
            $data = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $content,
                'comment_parent'       => $parent,
                'user_id'              => $user_id,
            );
 
            $comment_id = wp_insert_comment( $data );
            if ( ! is_wp_error( $comment_id ) ) {
                echo '{"message":"发送成功","id":"'.$comment_id.'"}';
            }
        } else {
            echo '{"message":"评论区已关闭"}';
        }
    } else {
        if ( comments_open( $post_id ) ) {
            $data = array(
                'comment_post_ID'      => $post_id,
                'comment_content'      => $content,
                'comment_parent'       => $parent,
                'comment_author'       => $user_name,
                'comment_author_email' => $user_email,
                'comment_author_url'   => $user_url,
            );
     
            $comment_id = wp_insert_comment( $data );
            if ( ! is_wp_error( $comment_id ) ) {
                $gcz_array = array(
                    "code"      => 200,
                    "message"   => "发送成功",
                    "id"        => $comment_id,
                    
                );
                echo json_encode($gcz_array);
            }
        }
    }
    exit();
}
add_action('wp_ajax_gcz_comments', 'gcz_comments');
add_action('wp_ajax_nopriv_gcz_comments', 'gcz_comments');