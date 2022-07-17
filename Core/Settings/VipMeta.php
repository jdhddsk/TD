<?php
$prefix_page_opts = 'gcz_vips';

CSF::createMetabox( $prefix_page_opts, array(
    'title'          => '页面设置',
    'post_type'      => 'page',
    'page_templates' => 'Pages/Vips.php',
    'data_type'      => 'unserialize',
));

CSF::createSection( $prefix_page_opts, array(
    'fields' => array(
        array(
            'id'    => 'gcz-vips-image',
            'type'  => 'upload',
            'title' => 'VIP页面顶部图片',
        ),
    )
));