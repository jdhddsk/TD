<?php
/**
 * @package APP文章类型注册
 * @author Zero
 * @since 2022
 */

function gcz_store_init() {
    $labels = array(
        'name'                  => _x( '商品', 'Post type general name', 'gcz' ),
        'singular_name'         => _x( '商品', 'Post type singular name', 'gcz' ),
        'menu_name'             => _x( '商品', 'Admin Menu text', 'gcz' ),
        'name_admin_bar'        => _x( '商品', 'Add New on Toolbar', 'gcz' ),
        'add_new'               => __( '添加新商品', 'gcz' ),
        'add_new_item'          => __( '添加新商品', 'gcz' ),
        'new_item'              => __( '添加新商品', 'gcz' ),
        'edit_item'             => __( '编辑商品', 'gcz' ),
        'view_item'             => __( '查看商品', 'gcz' ),
        'all_items'             => __( '所有商品', 'gcz' ),
        'search_items'          => __( '搜索商品', 'gcz' ),
        'parent_item_colon'     => __( '父商品:', 'gcz' ),
        'not_found'             => __( '未发现任何商品.', 'gcz' ),
        'not_found_in_trash'    => __( '回收站里没有任何商品.', 'gcz' ),
        'featured_image'        => _x( '商品封面', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'gcz' ),
        'set_featured_image'    => _x( '设置商品封面', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'remove_featured_image' => _x( '移除商品封面', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'use_featured_image'    => _x( '设置为封面', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'archives'              => _x( '商品归档', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'gcz' ),
        'insert_into_item'      => _x( '插入到商品', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'gcz' ),
        'uploaded_to_this_item' => _x( '上传该商品', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'gcz' ),
        'filter_items_list'     => _x( '筛选商品', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'gcz' ),
        'items_list_navigation' => _x( '商品导航', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'gcz' ),
        'items_list'            => _x( '商品列表', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'gcz' ),
    );

    $args = array(
        'labels'             => $labels,
        //是否公开
        'public'             => true,
        //是否可查询
        'publicly_queryable' => true,
        //显示在后台菜单中
        'show_ui'            => true,
        //显示在后台菜单中
        'show_in_menu'       => true,
        //是否可以查询，和publicly_queryable一起使用
        'query_var'          => true,
        //重写url
        'rewrite'            => array( 'slug' => 'store' ),
        //该文章类型的权限
        'capability_type'    => 'post',
        //是否有归档
        'has_archive'        => true,
        //是否水平，如果水平就是页面，否则类似文章这种可以有分类目录（需要自定义分类目录）
        'hierarchical'       => false,
        //菜单定位
        'menu_position'      => 5,
        // 菜单图标
        'menu_icon'          => 'dashicons-products',
        //该文章类型支持的功能
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true
    );

    register_post_type( 'store', $args );
}
add_action( 'init', 'gcz_store_init' );

// 分类
add_action( 'init', 'gcz_create_store_taxonomies', 0 );
 

function gcz_create_store_taxonomies() {
$labels = array(
    'name'              => _x( '商品分类', 'taxonomy general name', 'gcz' ),
    'singular_name'     => _x( 'stores-library', 'taxonomy singular name', 'gcz' ),
    'search_items'      => __( '搜索分类...', 'gcz' ),
    'all_items'         => __( '所有类别', 'gcz' ),
    'parent_item'       => __( '父级分类', 'gcz' ),
    'parent_item_colon' => __( '父级分类:', 'gcz' ),
    'edit_item'         => __( '编辑类别', 'gcz' ),
    'update_item'       => __( '更新类别', 'gcz' ),
    'add_new_item'      => __( '添加新类别', 'gcz' ),
    'new_item_name'     => __( '新类别名称', 'gcz' ),
    'menu_name'         => __( '商品分类', 'gcz' ),
);

$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'store' ),
);
register_taxonomy( 'store', array( 'store' ), $args );
}


/**
 * @package TALK文章类型注册
 * @author Zero
 * @since 2022
 */
function gcz_talk_init() {
    $labels = array(
        'name'                  => _x( '微谈', 'Post type general name', 'gcz' ),
        'singular_name'         => _x( '微谈', 'Post type singular name', 'gcz' ),
        'menu_name'             => _x( '微谈', 'Admin Menu text', 'gcz' ),
        'name_admin_bar'        => _x( '微谈', 'Add New on Toolbar', 'gcz' ),
        'add_new'               => __( '写个新想法', 'gcz' ),
        'add_new_item'          => __( '添加新想法', 'gcz' ),
        'new_item'              => __( '添加新想法', 'gcz' ),
        'edit_item'             => __( '编辑想法', 'gcz' ),
        'view_item'             => __( '查看想法', 'gcz' ),
        'all_items'             => __( '所有想法', 'gcz' ),
        'search_items'          => __( '搜索想法', 'gcz' ),
        'parent_item_colon'     => __( '父想法:', 'gcz' ),
        'not_found'             => __( '未发现任何想法.', 'gcz' ),
        'not_found_in_trash'    => __( '回收站里没有任何想法.', 'gcz' ),
        'featured_image'        => _x( '想法封面', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'gcz' ),
        'set_featured_image'    => _x( '设置想法封面', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'remove_featured_image' => _x( '移除想法封面', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'use_featured_image'    => _x( '设置为封面', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'gcz' ),
        'archives'              => _x( '想法归档', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'gcz' ),
        'insert_into_item'      => _x( '插入到想法', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'gcz' ),
        'uploaded_to_this_item' => _x( '上传该想法', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'gcz' ),
        'filter_items_list'     => _x( '筛选想法', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'gcz' ),
        'items_list_navigation' => _x( '想法导航', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'gcz' ),
        'items_list'            => _x( '想法列表', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'gcz' ),
    );

    $args = array(
        'labels'             => $labels,
        //是否公开
        'public'             => true,
        //是否可查询
        'publicly_queryable' => true,
        //显示在后台菜单中
        'show_ui'            => true,
        //显示在后台菜单中
        'show_in_menu'       => true,
        //是否可以查询，和publicly_queryable一起使用
        'query_var'          => true,
        //重写url
        'rewrite'            => array( 'slug' => 'talk' ),
        //该文章类型的权限
        'capability_type'    => 'post',
        //是否有归档
        'has_archive'        => true,
        //是否水平，如果水平就是页面，否则类似文章这种可以有分类目录（需要自定义分类目录）
        'hierarchical'       => false,
        //菜单定位
        'menu_position'      => 5,
        // 菜单图标
        'menu_icon'          => 'dashicons-welcome-edit-page',
        //该文章类型支持的功能
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => true
    );

    register_post_type( 'talk', $args );
}
add_action( 'init', 'gcz_talk_init' );

// 分类
add_action( 'init', 'gcz_create_talk_taxonomies', 0 );
 

function gcz_create_talk_taxonomies() {
$labels = array(
    'name'              => _x( '圈子', 'gcz', 'gcz' ),
    'singular_name'     => _x( 'talk-circle', 'taxonomy singular name', 'gcz' ),
    'search_items'      => __( '搜索圈子...', 'gcz' ),
    'all_items'         => __( '所有圈子', 'gcz' ),
    'parent_item'       => __( '父级圈子', 'gcz' ),
    'parent_item_colon' => __( '父级圈子:', 'gcz' ),
    'edit_item'         => __( '编辑圈子', 'gcz' ),
    'update_item'       => __( '更新圈子', 'gcz' ),
    'add_new_item'      => __( '添加新圈子', 'gcz' ),
    'new_item_name'     => __( '新圈子名称', 'gcz' ),
    'menu_name'         => __( '圈子', 'gcz' ),
);

$args = array(
    'hierarchical'      => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array( 'slug' => 'circle' ),
);
register_taxonomy( 'circle', array( 'talk' ), $args );
}

add_action( 'init', 'gcz_create_talk_label', 0 );
function gcz_create_talk_label() {
 
  $labels = array(
    'name' => _x( '话题', 'gcz' ),
    'singular_name' => _x( '话题', 'taxonomy singular name' ),
    'search_items' =>  __( '搜索话题' ),
    'popular_items' => __( '热门话题' ),
    'all_items' => __( '所有话题' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( '编辑话题' ), 
    'update_item' => __( '更新话题' ),
    'add_new_item' => __( '新增话题' ),
    'new_item_name' => __( '话题名称' ),
    'separate_items_with_commas' => __( 'Separate topics with commas' ),
    'add_or_remove_items' => __( '添加或移除话题' ),
    'choose_from_most_used' => __( '选择用的最多的话题' ),
    'menu_name' => __( '话题' ),
  ); 
 
  register_taxonomy('talk_tag','talk',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'item_tag' ),
  ));
}


//*****
//自定义固定链接
add_filter('post_type_link', 'custom_talk_link', 1, 3);
function custom_talk_link( $link, $post = 0 ){
	//echo '###' . $post->post_type;
	if( $post->post_type == 'talk' ){
		return home_url( 'talk/' . $post->ID .'.html' );
	}else{
		return $link;
	}
}
add_action( 'init', 'custom_talk_rewrites_init' );
function custom_talk_rewrites_init(){
	add_rewrite_rule( 'talk/([0-9]+)?.html$', 'index.php?post_type=talk&p=$matches[1]', 'top');
	add_rewrite_rule( 'article/([0-9]+)?.html$', 'index.php?post_type=talk&p=$matches[1]', 'top');
}
 
 
//********************
 
function custom_page_rules() {
    global $wp_rewrite;
	
	//修改分类的固定链接结构
    $wp_rewrite->extra_permastructs['circle']['with_front'] = '';
    $wp_rewrite->extra_permastructs['circle']['struct'] = '/circle/%circle%';
 
    //修改tag的固定链接结构
    $wp_rewrite->extra_permastructs['talk_tag']['with_front'] = '';
    $wp_rewrite->extra_permastructs['talk_tag']['struct'] = 'talk_tag/%talk_tag%';
	
}
add_action( 'init', 'custom_page_rules' );


//*****
//自定义固定链接
add_filter('post_type_link', 'custom_store_link', 1, 3);
function custom_store_link( $link, $post = 0 ){
	//echo '###' . $post->post_type;
	if( $post->post_type == 'store' ){
		return home_url( 'store/' . $post->ID .'.html' );
	}else{
		return $link;
	}
}
add_action( 'init', 'custom_store_rewrites_init' );
function custom_store_rewrites_init(){
	add_rewrite_rule( 'store/([0-9]+)?.html$', 'index.php?post_type=store&p=$matches[1]', 'top');
	add_rewrite_rule( 'article/([0-9]+)?.html$', 'index.php?post_type=store&p=$matches[1]', 'top');
}
 
 
//********************
 
function custom_store_rules() {
    global $wp_rewrite;
	
	//修改分类的固定链接结构
    $wp_rewrite->extra_permastructs['store']['with_front'] = '';
    $wp_rewrite->extra_permastructs['store']['struct'] = '/store/%store%';
 
    //修改tag的固定链接结构
    $wp_rewrite->extra_permastructs['store_tag']['with_front'] = '';
    $wp_rewrite->extra_permastructs['store_tag']['struct'] = 'store_tag/%store_tag%';
	
}
add_action( 'init', 'custom_store_rules' );