<?php
if( class_exists( 'CSF' ) ) {
  
    $prefix = 'gcz_storemeta';

    CSF::createMetabox( $prefix, array(
        'title'     => '数据设置',
        'post_type' => 'store',
        'data_type' => 'unserialize'
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '信息',
        'fields' => array(
            array(
                'id'            => 'gcz_store_swiper',
                'type'          => 'repeater',
                'title'         => '商品头图',
                'button_title'  => '添加图片',
                'fields' => array(
                    array(
                        'id'    => 'gcz_store_swiper_item',
                        'type'  => 'upload',
                        'title' => '上传图片'
                    ),
                ),
            ),
        )
    ));
    
    CSF::createSection( $prefix, array(
        'title'  => '价格',
        'fields' => array(
            array(
                'id'        => 'gcz_store_default_price',
                'type'      => 'spinner',
                'title'     => '默认价格',
                'desc'      => '纯数字，不得为负数',
                'min'       => 0,
                'default'   => 0
            ),
            array(
                'id'        => 'gcz_store_discount_price',
                'type'      => 'spinner',
                'title'     => '折扣价格',
                'desc'      => '纯数字，不得为负数。如果设置和默认价格一样的数字，则不显示折扣价',
                'min'       => 0,
                'default'   => 0
            ),
        )
    ));
}
