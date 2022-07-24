<?php
function gcz_follow() {
    $user_id = get_current_user_id();
}
add_action('wp_ajax_gcz_follow', 'gcz_follow');
add_action('wp_ajax_nopriv_gcz_follow', 'gcz_follow');