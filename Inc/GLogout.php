<?php
function gcz_logout() {
    wp_logout();
    exit();
}
add_action('wp_ajax_gcz_logout', 'gcz_logout');
add_action('wp_ajax_nopriv_gcz_logout', 'gcz_logout');