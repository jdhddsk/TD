<?php
$Core = new GCZ_Core;
if( class_exists( 'CSF' ) ) {

    $prefix = 'gcz_profile';

    CSF::createProfileOptions( $prefix, array(
        'data_type' => 'unserialize',
    ));

    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'type'    => 'content',
                'content' => '<h2>基础前台信息</h2>',
            ),
            array(
                'id'    => 'gcz_user_avatar',
                'type'  => 'upload',
                'title' => '设置前端头像',
                'desc'  => '前端头像显示在此'
            ),
            array(
                'id'    => 'gcz_user_headering',
                'type'  => 'upload',
                'title' => '设置头图',
                'desc'  => '设置个人中心头图'
            ),
            array(
                'id'        => 'gcz_user_saying',
                'type'      => 'text',
                'title'     => '个人说明',
                'default'   => '这个人很懒，什么都没有写哦',
                'desc'      => '设置个人说明'
            ),
            array(
                'id'    => 'gcz_user_phone',
                'type'  => 'text',
                'title' => '手机号',
                'desc'  => '设置手机号'
            ),
            array(
                'type'    => 'content',
                'content' => '<h2>高级前台信息</h2><p>无特殊情况请勿修改,改错了Zero也不会修，别问我</p>',
            ),
            array(
                'id'    => 'qq_openid',
                'type'  => 'text',
                'title' => 'QQ OpenID',
                'desc'  => '无特殊情况请勿修改'
            ),
            array(
                'id'    => 'gcz_user_weibo_avatar',
                'type'  => 'text',
                'title' => '微博头像',
                'desc'  => '无特殊情况请勿修改'
            ),
            array(
                'id'    => 'sina_uid',
                'type'  => 'text',
                'title' => '微博UID',
                'desc'  => '无特殊情况请勿修改'
            ),
            array(
                'id'    => 'sina_name',
                'type'  => 'text',
                'title' => '微博用户名',
                'desc'  => '无特殊情况请勿修改'
            ),
            array(
                'type'    => 'content',
                'content' => '<h2>金融管理</h2>',
            ),
            array(
                'id'        => 'gcz_user_credit',
                'type'      => 'number',
                'unit'      => '元',
                'default'   => '0.00',
                'title'     => '余额',
            ),
            array(
                'type'    => 'content',
                'content' => '<h2>高级</h2>',
            ),
            array(
                'id'            => 'gcz-fans',
                'type'          => 'select',
                'title'         => '关注此用户的人',
                'chosen'        => true,
                'multiple'      => true,
                'options'       => 'users',
                'placeholder'   => '选择用户以让其成为此用户的粉丝',
                'desc'          => '无特殊情况请勿修改,这个改乱了别找Zero,我不会修。'
            ),
            array(
                'id'            => 'gcz-follow',
                'type'          => 'select',
                'title'         => '此用户关注的人',
                'chosen'        => true,
                'multiple'      => true,
                'options'       => 'users',
                'placeholder'   => '选择用户以让此用户关注',
                'desc'          => '无特殊情况请勿修改,这个改乱了别找Zero,我不会修。'
            ),
        )
    ));
}