<main class="gcz-pc-main">
    <?php
    $options = get_option('gcz_options');
    if (is_array($options['gcz-pc-modules'])) {
        foreach ($options['gcz-pc-modules'] as $gcz) {
            // 轮播
            if ($gcz['gcz-pc-modules-select'] == 'swiper') {
                require 'TemplateParts/Swiper.php';
            // 自定义
            } else if ($gcz['gcz-pc-modules-select'] == 'custom') {
                require 'TemplateParts/Custom.php';
            // 搜索
            } else if ($gcz['gcz-pc-modules-select'] == 'search') {
                require 'TemplateParts/Search.php';
            // 文章
            } else if ($gcz['gcz-pc-modules-select'] == 'rounds') {
                require 'TemplateParts/Rounds.php';
            }
        }
    } else {
        echo '<div id="gcz-pc-modules-empty">您没有添加任何模块,请前往后台添加一个模块</div>';
    }
    ?>
</main>