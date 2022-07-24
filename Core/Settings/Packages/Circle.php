<?php
if( class_exists( 'CSF' ) ) {

    $prefix = 'gcz_circle';

    CSF::createTaxonomyOptions( $prefix, array(
        'taxonomy'  => 'circle',
        'data_type' => 'serialize',
    ));

    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'id'    => 'gcz-circle-headering',
                'type'  => 'upload',
                'title' => '圈子头图',
            ),
        )
    ));
}
