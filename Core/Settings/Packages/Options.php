<?php
$Core = new GCZ_Core;
if( class_exists( 'CSF' ) ) {

    $prefix = 'gcz_options';

    CSF::createOptions( $prefix, array(
        'menu_title'            => '主题',
        'framework_title'       => 'GCZ主题设置',
        'menu_position'         => '61',
        'menu_slug'             => 'gcz-main-settings',
        'menu_icon'             => 'dashicons-feedback',
        'admin_bar_menu_icon'   => '',
        'theme'                 => $Core->gcz_backend_darkmode()
    ));

    CSF::createSection( $prefix, array(
        'title'  => '通用',
        'icon'   => 'iconoir-settings',
        'fields' => array(
            array(
                'id'    => 'gcz-logo',
                'type'  => 'upload',
                'title' => '网站LOGO',
            ),
            array(
                'id'    => 'gcz-record',
                'type'  => 'text',
                'title' => '网站备案号',
            ),
            array(
                'id'    => 'gcz-keywords',
                'type'  => 'text',
                'title' => '网站关键词',
            ),
            array(
                'id'    => 'gcz-description',
                'type'  => 'textarea',
                'title' => '网站描述',
            ),
            array(
                'id'        => 'gcz-default-picture',
                'type'      => 'upload',
                'title'     => '默认缩略图',
                'default'   => GCZ_URI.'/Core/Img/none.png',
            ),
            array(
                'id'        => 'gcz-radius',
                'type'      => 'slider',
                'title'     => '圆角大小',
                'unit'      => 'px',
                'default'   => '3'
            ),
            array(
                'id'        => 'gcz-pc-modules-width-number',
                'type'      => 'slider',
                'title'     => '非全宽模块的最高宽度限制',
                'unit'      => 'px',
                'max'       => '2000',
                'default'   => '1300',
                'desc'      => '默认1300px',
            ),
            array(
                'id'        => 'gcz-pc-modules-min-width-number',
                'type'      => 'slider',
                'title'     => '非全宽模块的最低宽度限制',
                'unit'      => 'px',
                'max'       => '2000',
                'default'   => '1300',
                'desc'      => '默认1300px',
            ),
            array(
                'id'        => 'gcz-color',
                'type'      => 'image_select',
                'title'     => '色彩预设',
                'options'   => array(
                    'tencent'   => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Tencent.png',
                    'wechat'    => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Wechat.png',
                    'yellow'    => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Yellow.png',
                    'pink'      => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Pink.png',
                    'red'       => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Red.png',
                    'orange'    => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Orange.png',
                    'custom'    => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Custom.png',
                ),
                'default'   => 'tencent',
                'desc'      => '色彩搭配遵循TDesign设计原则。自定义色彩的方法：<a href="https://tdesign.tencent.com/vue/custom-theme" target="_blank">点击跳转</a>'
            ),
            array(
                'id'        => 'gcz-backend',
                'type'      => 'switcher',
                'title'     => '主题后台颜色模式',
                'text_on'   => '暗',
                'text_off'  => '亮',
                'default'   => '1'
            )
        )
    ));
    CSF::createSection($prefix, array(
        'id'    => 'gcz-modules',
        'title' => '定制',
        'icon'  => 'iconoir-add-circled-outline',
    ));
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-modules',
        'title'  => '电脑端头部',
        'icon'   => 'iconoir-smartphone-device',
        'fields' => array(
            array(
                'id'           => 'gcz-header',
                'type'         => 'sorter',
                'title'        => '顶部右侧按钮',
                'default'      => array(
                    'enabled'    => array(
                        'mode'      => '暗黑模式切换',
                        'search'    => '搜索',
                        'user'      => '注册/登录与个人中心',
                    ),
                    'disabled'   => array(
                        
                    ),
                ),
            ),
        ),
    ));
    /**
     * 手机端模块设置
     * @author Zero
     * @since 2022
    */
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-modules',
        'title'  => '手机模块',
        'icon'   => 'iconoir-smartphone-device',
        'fields' => array(
            array(
                'id'     => 'gcz-mobile-modules',
                'type'   => 'group',
                'title'  => '手机端模块设置',
                'accordion_title_auto' => 'gcz-mobile-modules-title',
                'fields' => array(
                    array(
                        'id'      => 'gcz-mobile-modules-title',
                        'type'    => 'text',
                        'title'   => '模块名称',
                        'desc'    => '必填'
                    ),
                    array(
                        'id'      => 'gcz-mobile-modules-class',
                        'type'    => 'text',
                        'title'   => '模块Class',
                        'desc'    => '必填，填写后既作为短代码的一部分，又作为此模块的CSS Class，以方便您自定义此模块的样式',
                    ),
                    array(
                        'id'          => 'gcz-mobile-modules-select',
                        'type'        => 'image_select',
                        'title'       => '选择一个模板',
                        'options'     => array(
                            'swiper'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/swiper.png',
                            'custom'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/custom.png',
                            'search'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/search.png',
                            'navbtn'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/navbtn.png',
                            'rounds'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/rounds.png',
                        ),
                        'default'     => 'swiper'
                    ),
                    /**
                     * 轮播设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'        => 'gcz-mobile-swiper-autoplay',
                        'type'      => 'switcher',
                        'title'     => '是否开启自动播放幻灯片',
                        'dependency' => array( 'gcz-mobile-modules-select', '==', 'swiper' ),
                    ),
                    array(
                        'id'        => 'gcz-mobile-swiper-height',
                        'type'      => 'text',
                        'title'     => '幻灯片高度',
                        'default'   => '150',
                        'desc'      => '默认150。请直接填写数字，不需要任何单位！<br>上传的图片得统一宽度和高度，否则图片高度不统一将导致图片错乱',
                        'dependency' => array( 'gcz-mobile-modules-select', '==', 'swiper' ),
                    ),
                    array(
                        'id'     => 'gcz-mobile-swiper',
                        'type'   => 'repeater',
                        'title'  => '添加幻灯片',
                        'button_title' => '添加幻灯片',
                        'dependency' => array( 'gcz-mobile-modules-select', '==', 'swiper' ),
                        'fields' => array(
                            array(
                                'id'    => 'gcz-mobile-swiper-picture',
                                'type'  => 'upload',
                                'title' => '幻灯片图片'
                            ),
                            array(
                                'id'    => 'gcz-mobile-swiper-link',
                                'type'  => 'link',
                                'title' => '幻灯片链接',
                                'desc'  => '如果填“#”则不跳转页面',
                            ),
                        ),
                    ),
                    /**
                     * 自定义设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'      => 'gcz-mobile-textarea',
                        'type'    => 'textarea',
                        'title'   => '自定义模块内容',
                        'desc'    => '支持HTML，CSS，php，JavaScript。默认未挂载Vue容器，如果需要挂载Vue容器，请使用Vue2语法挂载。挂载示例:<br>new Vue({}).$mount("#app")',
                        'dependency' => array( 'gcz-mobile-modules-select', '==', 'custom' ),
                    ),
                    /**
                     * 搜索设置
                     * @author Zero
                     * @since 2022
                    */
                    /**
                     * 导航设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'            => 'gcz-mobile-navbtn-row',
                        'type'          => 'repeater',
                        'dependency'    => array( 'gcz-mobile-modules-select', '==', 'navbtn' ),
                        'title'         => '添加项目',
                        'button_title'  => '添加',
                        'desc'          => '一行最多五个',
                        'max'           => '5',
                        'fields'        => array(
                            array(
                              'id'    => 'gcz-mobile-navbtn-row-link',
                              'type'  => 'link',
                              'title' => '链接'
                            ),
                            array(
                              'id'    => 'gcz-mobile-navbtn-row-icon',
                              'type'  => 'upload',
                              'title' => '图标'
                            ),
                        ),
                    ),
                ),
            ),
        )
    ));
    /**
     * 电脑端模块设置
     * @author Zero
     * @since 2022
    */
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-modules',
        'title'  => 'PC模块',
        'icon'   => 'iconoir-pc-check',
        'fields' => array(
            array(
                'id'     => 'gcz-pc-modules',
                'type'   => 'group',
                'title'  => 'PC端模块设置',
                'accordion_title_auto' => 'gcz-pc-modules-title',
                'fields' => array(
                    array(
                        'id'      => 'gcz-pc-modules-title',
                        'type'    => 'text',
                        'title'   => '模块名称',
                        'desc'    => '必填'
                    ),
                    array(
                        'id'      => 'gcz-pc-modules-class',
                        'type'    => 'text',
                        'title'   => '模块Class',
                        'desc'    => '必填，填写后既作为短代码的一部分，又作为此模块的CSS Class，如果您开启了小工具还作为小工具的slug，以方便您自定义此模块的样式',
                    ),
                    array(
                        'id'        => 'gcz-pc-modules-width',
                        'type'      => 'switcher',
                        'title'     => '是否全宽模块',
                        'text_on'   => '全宽模块',
                        'text_off'  => '限制模块',
                        'text_width'=> '90',
                        'desc'      => '如果设置为全宽模块，则此模块将会占领整个页面宽度。你可以在<mark>GCZ主题设置->通用</mark>里跳转限制模块的宽度'
                    ),
                    array(
                        'id'        => 'gcz-pc-modules-sidebar',
                        'type'      => 'switcher',
                        'title'     => '是否开启小工具',
                        'desc'      => '如果开启，请前往<a href="" target="_blank">小工具页面</a>设置小工具'
                    ),
                    array(
                        'id'          => 'gcz-pc-modules-select',
                        'type'        => 'image_select',
                        'title'       => '选择一个模板',
                        'options'     => array(
                            'swiper'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/swiper.png',
                            'custom'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/custom.png',
                            'search'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/search.png',
                            'rounds'  => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/rounds.png',
                        ),
                        'default'     => 'swiper'
                    ),
                    /**
                     * 轮播设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'        => 'gcz-pc-swiper-autoplay',
                        'type'      => 'switcher',
                        'title'     => '是否开启自动播放幻灯片',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'swiper' ),
                    ),
                    array(
                        'id'        => 'gcz-pc-swiper-height',
                        'type'      => 'slider',
                        'title'     => '幻灯片高度',
                        'unit'      => 'px',
                        'default'   => '',
                        'desc'      => '如果不填，则高度由系统自动调整。上传的图片最好统一宽度和高度，否则图片高度不统一将导致图片错乱',
                        'max'       => '1000',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'swiper' ),
                    ),
                    array(
                        'id'     => 'gcz-pc-swiper',
                        'type'   => 'repeater',
                        'title'  => '添加幻灯片',
                        'button_title' => '添加幻灯片',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'swiper' ),
                        'fields' => array(
                            array(
                                'id'    => 'gcz-pc-swiper-picture',
                                'type'  => 'upload',
                                'title' => '幻灯片图片'
                            ),
                            array(
                                'id'    => 'gcz-pc-swiper-link',
                                'type'  => 'link',
                                'title' => '幻灯片链接',
                                'desc'  => '如果填“#”则不跳转页面',
                            ),
                        ),
                    ),
                    /**
                     * 自定义设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'        => 'gcz-pc-textarea',
                        'settings'  => array(
                            'mode'   => 'htmlmixed',
                            'theme'  => 'monokai',
                        ),
                        'type'      => 'code_editor',
                        'title'     => '自定义模块内容',
                        'desc'      => '支持HTML，CSS，php。',
                        'dependency'=> array( 'gcz-pc-modules-select', '==', 'custom' ),
                    ),
                    array(
                        'id'        => 'gcz-pc-textarea-js',
                        'settings'  => array(
                            'mode'   => 'javascript',
                            'theme'  => 'monokai',
                        ),
                        'type'      => 'code_editor',
                        'title'     => '自定义模块的JS',
                        'desc'      => '默认未挂载Vue容器，如果需要挂载Vue容器，请使用Vue2语法挂载。挂载示例:<br>new Vue({}).$mount("#app")',
                        'dependency'=> array( 'gcz-pc-modules-select', '==', 'custom' ),
                    ),
                    /**
                     * 搜索设置
                     * @author Zero
                     * @since 2022
                    */
                    /**
                     * 文章循环设置
                     * @author Zero
                     * @since 2022
                    */
                    array(
                        'id'        => 'gcz-pc-rounds-show-title',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示模块标题',
                        'default'   => '1'
                    ),
                    array(
                        'id'         => 'gcz-pc-rounds-category',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'       => 'select',
                        'chosen'      => true,
                        'multiple'    => true,
                        'title'      => '选择文章目录以进行循环',
                        'options'    => 'category'
                    ),
                    array(
                        'id'         => 'gcz-pc-rounds-type',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'       => 'select',
                        'title'      => '选择循环展示样式',
                        'options'    => array(
                            'column'    => '浏览',
                            'table'     => '表格'
                        ),
                    ),
                    array(
                        'id'         => 'gcz-pc-rounds-theme',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'       => 'select',
                        'title'      => '选择循环Tab页签样式',
                        'options'    => array(
                            'normal'    => '默认风格',
                            'card'      => '卡片风格'
                        ),
                    ),
                    array(
                        'id'            => 'gcz-pc-rounds-column',
                        'type'          => 'slider',
                        'max'           => '20',
                        'desc'          => '请不要作死调很大，谢谢(･ω･)ﾉ',
                        'min'           => '1',
                        'default'       => '1',
                        'title'         => '显示几列',
                        'dependency'    => array( 'gcz-pc-modules-select|gcz-pc-rounds-type', '==|==', 'rounds|column' ),
                    ),
                    array(
                        'id'         => 'gcz-pc-rounds-layout',
                        'dependency' => array( 'gcz-pc-modules-select|gcz-pc-rounds-type', '==|==', 'rounds|column' ),
                        'type'       => 'image_select',
                        'title'      => '选择布局',
                        'options'    => array(
                            'row'        => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/leftpic.png',
                            'column'     => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/toppic.png',
                        ),
                        'desc'      => '指引：您的站如果是展示图片类型的站，最好选择上图下文式，展示图片的密度更大；如果需要大量的内容展示，则可以选择左图右文式。'
                    ),
                    // array(
                    //     'id'        => 'gcz-pc-rounds-height',
                    //     'type'      => 'number',
                    //     'title'     => '单个文章的高度',
                    //     'dependency' => array( 'gcz-pc-modules-select|gcz-pc-rounds-type', '==|==', 'rounds|column' ),
                    //     'default'   => '200',
                    //     'unit'      => 'px',
                    //     'desc'      => '默认200px'
                    // ),
                    array(
                        'id'        => 'gcz-pc-rounds-target',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否新标签页打开',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-excerpt',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章描述',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-photo',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章缩略图',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-date',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章发布日期',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-author',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章作者',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-view',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章浏览量',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-likes',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章点赞数',
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'gcz-pc-rounds-category-item',
                        'dependency' => array( 'gcz-pc-modules-select', '==', 'rounds' ),
                        'type'      => 'switcher',
                        'title'     => '是否显示文章分类',
                        'default'   => '1'
                    ),
                ),
            ),
        )
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '功能',
        'id'     => 'gcz-function',
        'icon'   => 'iconoir-3d-select-face',
    ));
    
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-function',
        'title'  => '登录与注册',
        'icon'   => 'iconoir-add-user',
        'fields' => array(
            array(
                'id'    => 'gcz-qq',
                'type'  => 'switcher',
                'title' => '是否开启QQ登录',
            ),
            array(
                'id'            => 'gcz-qq-field',
                'type'          => 'fieldset',
                'title'         => 'QQ登录信息',
                'dependency'    => array( 'gcz-qq', '==', 'true' ),
                'desc'          => '请前往<a href="connect.qq.com" target="_blank">QQ互联官网</a>申请您的APP ID和APP Secret。回调地址请填写您的<mark>网站首页</mark>,务必加上http(s)',
                'fields' => array(
                    array(
                        'id'         => 'gcz-qq-appid',
                        'type'       => 'text',
                        'title'      => '请填写您的APP ID',
                    ),
                    array(
                        'id'         => 'gcz-qq-appsecret',
                        'type'       => 'text',
                        'title'      => '请填写您的APP Secret',
                    ),
                ),
            ),
            array(
                'id'    => 'gcz-weibo',
                'type'  => 'switcher',
                'title' => '是否开启微博登录',
            ),
            array(
                'id'            => 'gcz-weibo-field',
                'type'          => 'fieldset',
                'title'         => '微博登录信息',
                'dependency'    => array( 'gcz-weibo', '==', 'true' ),
                'desc'          => '请前往<a href="open.weibo.com" target="_blank">微博开放平台</a>申请您的APP ID和APP Secret。回调地址请填写http(s)://'.$_SERVER['HTTP_HOST'].'/?type=sina',
                'fields' => array(
                    array(
                        'id'         => 'gcz-weibo-appid',
                        'type'       => 'text',
                        'title'      => '请填写您的APP ID',
                    ),
                    array(
                        'id'         => 'gcz-weibo-appsecret',
                        'type'       => 'text',
                        'title'      => '请填写您的APP Secret',
                    ),
                ),
            ),
        ),
    ));
    
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-function',
        'title'  => '权限控制',
        'icon'   => 'iconoir-sigma-function',
        'fields' => array(
            array(
                'id'         => 'gcz-comment-control',
                'type'       => 'switcher',
                'title'      => '未登录用户是否可以评论',
            ),
            array(
                'id'                    => 'gcz-vips',
                'type'                  => 'group',
                'title'                 => 'VIP设置',
                'accordion_title_auto'  => true,
                'fields'                => array(
                        array(
                            'id'      => 'gcz_vips_name',
                            'type'    => 'text',
                            'title'   => 'VIP等级名称',
                        ),
                        array(
                            'id'      => 'gcz_vips_money',
                            'type'    => 'spinner',
                            'unit'    => '元',
                            'title'   => 'VIP等级金额',
                            'desc'    => '直接填写数字即可。用户在付了这个金额之后，就会升级到此等级。'
                        ),
                        array(
                            'id'      => 'gcz_vips_time',
                            'type'    => 'spinner',
                            'unit'    => '天',
                            'title'   => 'VIP等级有效期',
                            'desc'    => '直接填写数字即可'
                        ),
                        array(
                            'id'            => 'gcz_vips_tabbed',
                            'type'          => 'tabbed',
                            'title'         => 'VIP等级管理',
                            'tabs'          => array(
                                array(
                                    'title'     => '文章权限',
                                    'icon'      => 'fa fa-heart',
                                    'fields'    => array(
                                        array(
                                            'id'    => 'gcz_vips_comments',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以评论',
                                        ),
                                        array(
                                            'id'    => 'gcz_vips_likes',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以点赞',
                                        ),
                                        array(
                                            'id'    => 'gcz_vips_post',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以发文章',
                                        ),
                                    )
                                ),
                                array(
                                    'title'     => '微谈权限',
                                    'icon'      => 'fa fa-heart',
                                    'fields'    => array(
                                        array(
                                            'id'    => 'gcz_vips_talk_comments',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以评论',
                                        ),
                                        array(
                                            'id'    => 'gcz_vips_talk_likes',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以点赞',
                                        ),
                                        array(
                                            'id'    => 'gcz_vips_talk_post',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以发帖',
                                        ),
                                        array(
                                            'id'    => 'gcz_vips_talk_circle',
                                            'type'  => 'switcher',
                                            'title' => '此等级是否可以创建圈子',
                                        ),
                                    )
                                ),
                                array(
                                    'title'     => '高级设置',
                                    'icon'      => 'fa fa-gear',
                                    'fields'    => array(
                                        array(
                                            'id'          => 'gcz-vips-people-false',
                                            'type'        => 'spinner',
                                            'title'       => '假数据（已经加入此等级的人数）',
                                            'unit'        => '人',
                                            'desc'        => '为了让前台数据好看一点，可以造个小假，哈哈哈'
                                        ),
                                    )
                                ),
                            )
                        ),
                    ),
            ),
            array(
                'id'                    => 'gcz-level',
                'type'                  => 'group',
                'title'                 => '等级设置',
                'accordion_title_auto'  => true,
                'desc'                  => '默认第一个等级为用户刚注册时的第一个等级',
                'fields'                => array(
                    array(
                        'id'      => 'gcz_level_name',
                        'type'    => 'text',
                        'title'   => '等级名称',
                    ),
                    array(
                        'id'            => 'gcz_level_tabbed',
                        'type'          => 'tabbed',
                        'title'         => '等级管理',
                        'tabs'          => array(
                            array(
                                'title'     => '文章权限',
                                'icon'      => 'fa fa-heart',
                                'fields'    => array(
                                    array(
                                        'id'    => 'gcz_level_comments',
                                        'type'  => 'switcher',
                                        'title' => '此等级是否可以评论',
                                    ),
                                    array(
                                        'id'    => 'gcz_level_likes',
                                        'type'  => 'switcher',
                                        'title' => '此等级是否可以点赞',
                                    ),
                                    array(
                                        'id'    => 'gcz_level_post',
                                        'type'  => 'switcher',
                                        'title' => '此等级是否可以发文章',
                                    ),
                                )
                            ),
                            array(
                                'title'     => '高级设置',
                                'icon'      => 'fa fa-gear',
                                'fields'    => array(
                                    
                                )
                            ),
                        )
                    ),
                ),
            ),
        ),
    ));
    
    CSF::createSection( $prefix, array(
        'parent'      => 'gcz-function',
        'title'  => '支付设置',
        'icon'   => 'iconoir-credit-card',
        'fields' => array(
            array(
                'id'         => 'gcz-wechat-pay',
                'type'       => 'select',
                'title'      => '微信支付',
                'options'     => array(
                    'close'     => '关闭',
                    'xunhupay'  => '虎皮椒支付',
                ),
            ),
            array(
                'id'     => 'gcz-wechat-pay-xunhupay',
                'type'   => 'fieldset',
                'title'  => '虎皮椒微信支付设置（必填）',
                'dependency'    => array( 'gcz-wechat-pay', '==', 'xunhupay' ),
                'fields' => array(
                    array(
                        'id'      => 'gcz-wechat-pay-xunhupay-appid',
                        'type'    => 'text',
                        'title'   => '虎皮椒支付APP ID',
                    ),
                    array(
                        'id'      => 'gcz-wechat-pay-xunhupay-appsecret',
                        'type'    => 'text',
                        'title'   => '虎皮椒支付APP Secret',
                    ),
                ),
            ),
            array(
                'id'         => 'gcz-ali-pay',
                'type'       => 'select',
                'title'      => '支付宝支付',
                'options'     => array(
                    'close'     => '关闭',
                    'xunhupay'  => '虎皮椒支付',
                ),
            ),
            array(
                'id'     => 'gcz-ali-pay-xunhupay',
                'type'   => 'fieldset',
                'title'  => '虎皮椒支付宝设置（必填）',
                'dependency'    => array( 'gcz-ali-pay', '==', 'xunhupay' ),
                'fields' => array(
                    array(
                        'id'      => 'gcz-ali-pay-xunhupay-appid',
                        'type'    => 'text',
                        'title'   => '虎皮椒支付APP ID',
                    ),
                    array(
                        'id'      => 'gcz-ali-pay-xunhupay-appsecret',
                        'type'    => 'text',
                        'title'   => '虎皮椒支付APP Secret',
                    ),
                ),
            ),
        ),
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '备份',
        'icon'   => 'iconoir-sigma-function',
        'fields' => array(
            array(
                'type' => 'backup',
            ),
        )
    ));
}