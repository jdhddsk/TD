<?php $gcz = get_option('gcz_options'); ?>
<style>
    .gcz-radius,.t-card,aside figure.wp-block-image,aside figure.wp-block-image figcaption {
        border-radius: <?php echo $gcz['gcz-radius']; ?>px!important;
    }
</style>