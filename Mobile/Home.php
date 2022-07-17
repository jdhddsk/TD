<main class="gcz-mobile-main">
    <?php
    $options = get_option('gcz_options');
    if (is_array($options['gcz-mobile-modules'])) {
        foreach ($options['gcz-mobile-modules'] as $gcz) {
            // 轮播
            if ($gcz['gcz-mobile-modules-select'] == 'swiper') {
                require 'TemplateParts/Swiper.php';
            // 自定义
            } else if ($gcz['gcz-mobile-modules-select'] == 'custom') {
                require 'TemplateParts/Custom.php';
            // 搜索
            } else if ($gcz['gcz-mobile-modules-select'] == 'search') {
                require 'TemplateParts/Search.php';
            // 导航
            } else if ($gcz['gcz-mobile-modules-select'] == 'navbtn') {
                require 'TemplateParts/Navbtn.php';
            // 文章
            } else if ($gcz['gcz-mobile-modules-select'] == 'rounds') {
                require 'TemplateParts/Rounds.php';
            }
        }
    } else {
        echo '<div id="gcz-mobile-modules-empty">您没有添加任何模块,请前往后台添加一个模块</div>';
    }
    ?>
</main>