<?php
define("GCZ_URI", get_stylesheet_directory_uri());
define("TD", get_stylesheet_directory_uri().'/Core/Library');
define("GCZ_ROOT",get_template_directory());
define("GCZ_VERSION","0.7");
require 'Core/Classes/GCore.php';
require 'Core/Classes/GQQ.php';
$gcz = get_option('gcz_options');

/**
 * OutPut
 */
$Core = new GCZ_Core;
$Core->gcz_register_menus();
$Core->td_api();
$Core->gcz_pavement_init();
$Core->td_auto_register_widget_init();


function gcz_money($order) {
    global $wpdb;
    $sql = "SELECT gcz_money FROM `wp_gcz_order` WHERE gcz_order = ".$order."";
    return $wpdb->get_var($sql);
}
function gcz_get_template($name,$path) {
    $template = new GCZ_Core;
    $template->td_get_template($name,$path);
}
function gcz_get_limit() {
    $gcz = get_option('gcz_options');
    foreach ($gcz['gcz-level'] as $level) {
        return $level;
    }
}

/**
 * @param 权限判断
 * @author Zero
 * @since 2022
 */
function gcz_get_level($ID = '',$Cap = '') {
    if (isset($ID)) {
        $ID = get_current_user_id();
    }
    
    $gcz   = get_option('gcz_options');
    $level = get_user_meta($ID,'gcz_level',true);
    
    if ($gcz['gcz-level'][$level]['gcz_level_tabbed'][$Cap] == true) {
        return true;
    } else {
        return false;
    }
}

function gcz_get_vips($ID = '',$Cap = '') {
    if (isset($ID)) {
        $ID = get_current_user_id();
    }
    
    $gcz  = get_option('gcz_options');
    $vips = get_user_meta($ID,'gcz_vips',true);
    
    if ($gcz['gcz-vips'][$vips]['gcz_vips_tabbed'][$Cap] == true) {
        return true;
    } else {
        return false;
    }
}

function get_user_role($id) {
    return new WP_User($id);
}

function gcz_main_style() {
    wp_enqueue_style('td_main_style', GCZ_URI.'/style.css',GCZ_VERSION,'screen');
    wp_enqueue_script('td_pre_js',    GCZ_URI.'/Core/Library/PrettyPrint/js.js',GCZ_VERSION,array('jquery'));
    wp_enqueue_script('td_onload_js', GCZ_URI.'/Core/Script/Back.js',GCZ_VERSION,array('jquery'));
    wp_register_script('gcz_js',''); 
    wp_enqueue_script('gcz_js');
    wp_localize_script( 'gcz_js', 'ajax_login_object', array( 
        'ajaxurl' => admin_url('admin-ajax.php'),
        'userid' => get_current_user_id(),
    ));
    $Core = new GCZ_Core;
    if ($Core->isMobile()) {
        wp_enqueue_style('mobile_style', GCZ_URI.'/Mobile/Assets/Mobile.css',GCZ_VERSION,'screen');
        } else {
        wp_enqueue_style('pc_style', GCZ_URI.'/PC/Assets/PC.css',GCZ_VERSION,'screen');
    }
}
add_action('wp_enqueue_scripts', 'gcz_main_style');
add_action('admin_enqueue_scripts', 'gcz_main_style');

// 浏览量
function gcz_views() {
    if (is_single()) {
        global $post;
        $post_id = $post->ID;
        if($post_id) {
            $post_views = get_post_meta($post_id, 'views', true);
            if(!update_post_meta($post_id, 'views', ($post_views + 1))) {
                add_post_meta($post_id, 'views', 1, true);
            }
        }
    }
    ?>
    <script type="text/javascript">
        let userid = "<?php echo get_current_user_id();?>";
        let postid = "<?php if(is_single()){echo get_the_ID();}?>";
        let wordpressajax = "<?php echo admin_url('admin-ajax.php'); ?>";
        let GCZ = "<?php bloginfo("template_url"); ?>";
        let Write = "<?php $Core = new GCZ_Core; echo home_url($Core->td_get_page('Pages/Write.php')); ?>";
    </script>
    <?php
}
add_action('wp_head', 'gcz_views');

function gcz_footer() {
    require 'Core/Classes/GStyle.php';
}
add_action('wp_footer', 'gcz_footer');

// 字数统计
function cnwper_count_words($text) {
	global $post;
	if ( '' == $text ) {
		$text = $post->post_content;
		if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '<span class="word-count">' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') .'</span>';
		return $output;
	}
}

// 统计预估阅读时间
function count_words_read_time() {
	global $post;
	$text_num = mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8');
	$read_time = ceil($text_num/300); // 修改数字300调整时间
	$output .= '本文共计' . $text_num . '个字，预计阅读时长' . $read_time  . '分钟';
	return $output;
}

// 文章浏览量
function td_views($before = '点击 ', $after = ' 次', $echo = 1){
    global $post;
    $post_ID = $post->ID;
    $views = (int)get_post_meta($post_ID, 'views', true);
    if ($echo) echo $before, number_format($views), $after;
    else return $views;
}

function td_get_views() {
    $views = get_post_meta(get_the_ID(),'views',true);
    if (!$views == 0) {
        return $views;
    } else {
        return 0;
    }
}

function td_get_likes() {
    $views = get_post_meta(get_the_ID(),'gcz-likes',true);
    if (!$views == 0) {
        return count($views);
    } else {
        return 0;
    }
}

/**
 * @param string 自动计算函数
 * since 2022
 * author Zero
 */
function gcz_auto_math($e) {
    $format = number_format($e);
    $math = 100/$format;
    return $math;
}

/**
 * @param string 等级数组
 * since 2022
 * author Zero
 */
function gcz_level_init() {
    $gcz = get_option('gcz_options');
    $arr = array();
    foreach ($gcz['gcz-level'] as $item) {
        $arr[$item['gcz_level_name']] = $item['gcz_level_name'];
        return $arr;
    }
}
function gcz_vips_init() {
    $gcz = get_option('gcz_options');
    $arr = array();
    foreach ($gcz['gcz-vips'] as $item) {
        $arr[$item['gcz_vips_name']] = $item['gcz_vips_name'];
        return $arr;
    }
}
/**
 * @param string 隐藏内容
 * since 2022
 * author Zero
 */
function gcz_hide_field($arr) {
    return $arr['gcz-hide-content'];
}
add_shortcode('gcz-hide','gcz_hide_field');

function the_price($id,$count) {
    if (get_post_meta($id,'gcz_store_discount_price',true) == get_post_meta($id,'gcz_store_default_price',true)) {
            echo get_post_meta($id,'gcz_store_default_price',true) * $count;
        } else {
            echo get_post_meta($id,'gcz_store_discount_price',true) * $count;
    }
}

function get_the_price($id,$count) {
    if (get_post_meta($id,'gcz_store_discount_price',true) == get_post_meta($id,'gcz_store_default_price',true)) {
            return get_post_meta($id,'gcz_store_default_price',true) * $count;
        } else {
            return get_post_meta($id,'gcz_store_discount_price',true) * $count;
    }
}

/**
 * @param 公告
 * since 2022
 * author Zero
 */
function td_get_position() {
    $gcz        = get_option('gcz_customize');
    $lastest    = count($gcz['gcz_notice']);
    $final      = $gcz['gcz_notice'][$lastest-1]['gcz_notice_position'];
    return $final;
}