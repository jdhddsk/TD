<?php
if (class_exists('CSF')) {

    $prefix = 'gcz-hide';

    CSF::createShortcoder( $prefix, array(
        'button_title'   => '添加内容',
        'insert_title'   => '插入至文章',
        'show_in_editor' => true,
        'gutenberg'      => array(
            'title'        => '隐藏模块',
            'description'  => '插入一个隐藏内容模块',
            'icon'         => 'hidden',
            'category'     => 'text',
            'keywords'     => array('shortcode', 'csf', 'insert'),
            'placeholder'  => '请点击上方按钮添加隐藏内容',
        )
    ));
    
    CSF::createSection($prefix, array(
        'title' => '隐藏下载设置',
        'view' => 'normal', 
        'shortcode' => 'gcz-hide', 
        'fields' => array(
            array(
                'id'       => 'gcz-hide-content',
                'type'     => 'wp_editor',
                'title'    => '要隐藏的内容',
                'sanitize' => false,
            ),
            array(
                'id'          => 'gcz-hide-level',
                'type'        => 'select',
                'title'       => '选择哪个等级的人可查看',
                'chosen'      => true,
                'multiple'    => true,
                'placeholder' => '请至少选择一个等级',
                'options'     => gcz_level_init()
            ),
            array(
                'id'          => 'gcz-hide-vips',
                'type'        => 'select',
                'title'       => '选择哪个VIP的人可查看',
                'chosen'      => true,
                'multiple'    => true,
                'placeholder' => '可留空非必填',
                'options'     => gcz_vips_init()
            ),
        )
    ));
}

