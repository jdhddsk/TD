<?php
if( class_exists( 'CSF' ) ) {

  $prefix = 'gcz_menu';

    CSF::createNavMenuOptions( $prefix, array(
        'data_type' => 'serialize', 
    ));

    CSF::createSection( $prefix, array(
        'fields' => array(
            array(
                'id'    => 'icon',
                'type'  => 'icon',
                'title' => '图标',
            ),
            array(
                'id'          => 'gcz_menu_type',
                'type'        => 'select',
                'title'       => '子菜单样式',
                'desc'        => '此选项仅仅适用于顶级菜单，二级菜单请勿选择，否则CSS将出错！',
                'options'     => array(
                    'default'   => '默认样式',
                    'tab'       => 'Tab样式',
                ),
                'default'     => 'default'
            ),
        )
    ));
}
if(!class_exists('GCZ_Walker_Menu')) {
    class GCZ_Walker_Menu extends Walker_Nav_Menu {
        
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $meta = get_post_meta( $item->ID, 'gcz_menu', true );
            
            if(!empty( $meta['icon'] ) ) {
                $item->title = '<i class="'. $meta['icon'] .'"></i>' . $item->title;
            }
            
            if ($meta['gcz_menu_type'] == 'tab') {
                array_push($item->classes,'gcz-tab');
            } else if ($meta['gcz_menu_type'] == 'default') {
                array_push($item->classes,'gcz-default');
            }
            
            array_push($item->classes,'t-menu__item');
            array_push($item->classes,'t-menu__item--plain');
            
            if (in_array('current-menu-item',$item->classes)) {
                array_push($item->classes,'t-is-active');
            }
            
            // print_r($item);
            
            // if ($depth > 0) {
            //     array_push($item->classes,'gcz-tab-item');
            // }
            
            // print_r($item);
            parent::start_el( $output, $item, $depth, $args, $id );
        }
        
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            if( $depth == 0 ){
                $output .= "</ul>";
            } else {
                $output .= '</ul>';
            }
        }
        
        public function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class='gcz-radius sub-menu depth-".$depth."'>\n";
        }
        
    }
}