<?php
if( class_exists( 'CSF' ) ) {

    $prefix = 'gcz_customize';

    CSF::createCustomizeOptions( $prefix );
    
    CSF::createSection( $prefix, array(
        'title'  => '网站公告',
        'fields' => array(
            array(
                'id'        => 'gcz_notice',
                'type'      => 'group',
                'title'     => '公告设置',
                'fields'    => array(
                    array(
                        'id'      => 'gcz_notice_title',
                        'type'    => 'text',
                        'title'   => '公告标题',
                        'desc'    => '请填写一个标题'
                    ),
                    array(
                        'id'       => 'gcz_notice_content',
                        'type'     => 'code_editor',
                        'title'    => '公告内容',
                        'desc'     => '支持html以及部分TDesign组件，但由于Vue容器限制，所以不支持css、js与php。要添加CSS可以使用WP自带的“额外CSS”',
                        'settings' => array(
                            'theme'  => 'monokai',
                            'mode'   => 'htmlmixed',
                        ),
                        'default'  => '<h1>Hello world</h1>',
                    ),
                    array(
                        'id'          => 'gcz_notice_position',
                        'type'        => 'select',
                        'title'       => '选择公告显示位置',
                        'options'     => array(
                            'top'       => '屏幕顶端',
                            'dialog'    => '弹窗显示',
                            'notify'    => '作为通知显示',
                        ),
                        'default'     => 'dialog'
                    ),
                    array(
                        'type'    => 'content',
                        'dependency' => array( 'gcz_notice_position', '==', 'notify' ),
                        'content' => '作为通知显示时，内容不允许使用任何html标签。这是TDesign规定的，别问我为什么。',
                    ),
                ),
            ),
        )
    ));
}