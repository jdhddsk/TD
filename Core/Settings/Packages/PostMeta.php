<?php
if( class_exists( 'CSF' ) ) {
  
    $prefix = 'gcz_postmeta';

    CSF::createMetabox( $prefix, array(
        'title'     => '数据设置',
        'post_type' => 'post',
        'data_type' => 'unserialize'
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '文章设置',
        'fields' => array(
            array(
                'id'        => 'gcz-post-type',
                'type'      => 'image_select',
                'title'     => '选择模板',
                'options'   => array(
                    'normal' => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Normal.png&h=207.5&w=166',
                    'app'    => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/App.png&h=207.5&w=166',
                    'single' => GCZ_URI.'/Core/Library/Timthumb/TimThumb.php?src='.GCZ_URI.'/Core/Img/Single.png&h=207.5&w=166',
                ),
                'default'   => 'normal'
            ),
            array(
                'id'      => 'gcz-app-icon',
                'type'    => 'upload',
                'title'   => 'APP图标',
                'dependency' => array( 'gcz-post-type', '==', 'app' ),
                'preview' => true,
            ),
            array(
                'id'            => 'gcz-app-name',
                'type'          => 'text',
                'title'         => 'APP名称',
                'dependency'    => array( 'gcz-post-type', '==', 'app' ),
            ),
            array(
                'id'            => 'gcz-app-link',
                'type'          => 'text',
                'title'         => 'APP下载链接',
                'placeholder'   => 'http(s)://',
                'dependency'    => array( 'gcz-post-type', '==', 'app' ),
            ),
            array(
                'id'            => 'gcz-app-code',
                'type'          => 'text',
                'title'         => '提取码',
                'placeholder'   => '如果没有提取码可以留空',
                'dependency'    => array( 'gcz-post-type', '==', 'app' ),
            ),
            array(
                'id'            => 'gcz-app-size',
                'type'          => 'text',
                'title'         => 'APP大小',
                'desc'          => '请务必填写单位，如MB，GB',
                'dependency'    => array( 'gcz-post-type', '==', 'app' ),
            ),
            array(
                'id'                    => 'gcz-app-history',
                'type'                  => 'group',
                'title'                 => 'APP历史版本',
                'accordion_title_auto'  => 'gcz-app-history-version',
                'dependency' => array( 'gcz-post-type', '==', 'app' ),
                'fields'    => array(
                    array(
                      'id'    => 'gcz-app-history-version',
                      'type'  => 'text',
                      'title' => '版本号',
                    ),
                    array(
                      'id'    => 'gcz-app-history-link',
                      'type'  => 'text',
                      'title' => '下载链接',
                    ),
                    array(
                      'id'    => 'gcz-app-history-content',
                      'type'  => 'wp_editor',
                      'title' => '更新内容',
                      'desc'  => '不支持CSS，JS，请勿使用此类标签'
                    ),
                ),
            ),
            array(
                'type'          => 'submessage',
                'style'         => 'warning',
                'content'       => 'SEO关键词请用WordPress自带的标签功能进行设置，主题会自动读取标签设置为SEO关键词'
            ),
            array(
                'id'          => 'gcz-description',
                'type'        => 'textarea',
                'title'       => 'SEO描述',
            ),
        )
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '高级设置',
        'fields' => array(
            array(
                'type'    => 'submessage',
                'style'   => 'danger',
                'content' => '一般情况下，请勿乱改此处配置。这些配置往往链接着TD主题的核心函数，如果擅自修改出问题了，自己没法弄的情况下，请联系Zero的QQ。',
            ),
            array(
                'id'          => 'gcz-likes',
                'type'        => 'select',
                'title'       => '点赞',
                'multiple'    => true,
                'chosen'      => true,
                'placeholder' => '',
                'default'     => '',
                'options'     => 'user',
                'desc'        => '一般情况下切勿改动，表单限制最少留一个点赞的用户。如果您要删除所有已经点赞的用户，请前往数据库删除。'
            ),
        )
    ));
}
