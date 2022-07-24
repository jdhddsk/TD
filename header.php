<?php $core = new GCZ_Core; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
        <title><?php $core->gcz_title(); ?></title>
        <meta name="keywords" content="<?php echo $core->gcz_keywords(); ?>">
        <meta name="description" content="<?php echo $core->gcz_description(); ?>">
        
        <script type="text/javascript">
            let Charts = {};
        </script>
        
        <!--基础库-->
	    <script src="<?php bloginfo("template_url"); ?>/Core/Library/Basic/Vue/vue.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Basic/Vue/vue-router.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/axios.min.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Basic/Vue/httpVueLoader.js"></script>
        
        <!--UI库-->
        <link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/Core/Library/Basic/TDesign/tdesign.min.css">
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Basic/TDesign/tdesign.min.js"></script>
        
        <!--扩展库-->
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Basic/JQuery/jquery.min.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Headroom/headroom.min.js"></script>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/Core/Library/Iconoir/iconoir.css" type="text/css" media="screen"/>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/Less/less.min.js"></script>
        <script src="<?php bloginfo("template_url"); ?>/Core/Library/ECharts/echarts.min.js"></script>
        <link href="<?php bloginfo("template_url"); ?>/Core/Library/PrettyPrint/css.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/PC/Assets/FrontEnd.css" type="text/css" media="screen"/>
        
        <!--WordPress库-->
        <?php wp_head(); ?>
    </head>
    <body>
        <!--头部-->
        <header class="t-layout__header" id="td-header">
            <?php gcz_get_template('Header',true); ?>
        </header>