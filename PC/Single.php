<?php
if (get_post_meta(get_the_ID(),'gcz-post-type',true) == 'normal') {
    require 'Template/Single-Default.php';
} else if (get_post_meta(get_the_ID(),'gcz-post-type',true) == 'app') {
    require 'Template/Single-APP.php';
} else if (get_post_meta(get_the_ID(),'gcz-post-type',true) == 'single') {
    require 'Template/Single-Single.php';
}
?>