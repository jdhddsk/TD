<?php
/**
 * Function List
 * API列表
 * 菜单注册
 * 手机端判断
 * 适应手机端
 * 后台暗黑模式
 * 
 * param string GCZ_Core                Class       Author Zero
 * param string GCZ_ROOT                Coast       Author Zero
 * param string GCZ_VERSION             Coast       Author Zero
 * param string GCZ_URI                 Coast       Author Zero
 */
class GCZ_Core {
    public $GCZ_URI = GCZ_URI;
    public $GCZ_ROOT = GCZ_ROOT;
    public $GCZ_VERSION = GCZ_VERSION;
    /**
     * Function：获取用户头像函数
     * @param 仅适用于Vue实例
     */
    public function gcz_get_avatar($ID,$type) {
        if (empty($ID)) {
            $user_id = get_current_user_id();
        } else {
            $user_id = $ID;
        }
        
        if(empty($type)) {
            $size = '';
        } else {
            $size = $type;
        }
        
        global $current_user;
        
        if (is_user_logged_in()) {
            if (empty(get_user_meta($user_id,'gcz_user_avatar',true))) {
                echo '<t-avatar>';
                echo gczGetPingYing($current_user->display_name);
                echo '</t-avatar>';
            } else {
                echo '<t-avatar image="';
                echo get_user_meta($user_id,'gcz_user_avatar',true);
                echo '"size="'.$size.'"';
                echo '></t-avatar>';
            }
        } else {
            echo '<t-avatar><t-icon name="user"></t-icon></t-avatar>';
        }
    }
    /**
     * Function：输出文章Title
     */
    public function gcz_title() {
        if (is_home()) {
            bloginfo('name');
            echo " - ";
            bloginfo('description');
        } else if ( is_category() ) {
        	single_cat_title();
        	echo " - "; bloginfo('name');
        } else if (is_single() || is_page() ) {
        	single_post_title();
        	echo " - ";bloginfo('name');
        } else if (is_search() ) {
        	echo "搜索结果";
        	echo " - "; bloginfo('name');
        } else if (is_404() ) {
        	echo '页面未找到!';
        } else {
        	wp_title('',true);
        }
    }
    /**
     * Function：输出SEO信息
     */
    public function gcz_keywords() {
        $gcz = get_option('gcz_options');
        if (is_home() || is_search() || is_page()) {
            return $gcz['gcz-keywords'];
        } else if (is_single()) {
            return the_tags($before = null,$sep = ',',$after = '');
        } else if (is_404()) {
            return;
        } else {
            return $gcz['gcz-keywords'];
        }
    }
    public function gcz_description() {
        $gcz = get_option('gcz_options');
        if (is_home() || is_search()) {
            return $gcz['gcz-description'];
        } else if (is_single()) {
            return get_post_meta(get_the_ID(),'gcz-description',true);
        } else if (is_404()) {
            return;
        } else {
            return $gcz['gcz-description'];
        }
    }
    /**
     * Function：API列表
     */
    public function td_api() {
        //框架主文件
        require_once $this->GCZ_ROOT.'/Core/Library/Basic/FrameWork/codestar-framework.php';
        // 设置API
        require $this->GCZ_ROOT.'/Core/Settings/Main.php';
        // Register Setup
        require $this->GCZ_ROOT.'/Core/GSetup.php';
        
        // 登录与注册API
        if (!is_user_logged_in()) {
            require $this->GCZ_ROOT.'/Core/GLogin.php';
            require $this->GCZ_ROOT.'/Core/GRegister.php';
        }
        // 文章点赞API
        require $this->GCZ_ROOT.'/Core/GLikes.php';
        // 评论API
        require $this->GCZ_ROOT.'/Core/GComments.php';
        // 投稿API
        require $this->GCZ_ROOT.'/Core/GWrite.php';
        // 用户API
        require $this->GCZ_ROOT.'/Core/GUser.php';
        // 查询订单API
        require $this->GCZ_ROOT.'/Core/GCredit.php';
        // 统计API
        require $this->GCZ_ROOT.'/Core/GPost.php';
        // 邮件验证码API
        require $this->GCZ_ROOT.'/Core/GMail.php';
        // 登出API
        require $this->GCZ_ROOT.'/Core/GLogout.php';
        // 添加购物车API
        require $this->GCZ_ROOT.'/Core/GAddCharts.php';
        // 删除购物车API
        require $this->GCZ_ROOT.'/Core/GDelCharts.php';
        // 获取VIP信息API
        require $this->GCZ_ROOT.'/Core/GVip.php';
    }
    /**
     * Function：菜单注册
     */
    public function gcz_register_menus() {
        function gcz_register_menus_init() {
            register_nav_menus( array(
                'header_menu' => __( '电脑端顶部菜单', 'gcz' ),
                'mobile_menu' => __( '手机端顶部菜单', 'gcz' ),
                'footer_menu' => __( '页脚菜单', 'gcz' )
            ));
        }
        add_action( 'init', 'gcz_register_menus_init' );
    }
    /**
     * Function：手机端判断
     */
    public function isMobile() { 
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return true;
        } 
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset($_SERVER['HTTP_VIA'])) { 
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        } 
        // 脑残法
        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia','sony','ericsson','mot','samsung','htc','sgh','lg','sharp','sie-','philips','panasonic','alcatel','lenovo','iphone','ipod','blackberry','meizu','android','netfront','symbian','ucweb','windowsce','palm','operamini','operamobi','openwave','nexusone','cldc','midp','wap','mobile','MicroMessenger'); 
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return true;
            }
        }
        // 协议法
        if (isset ($_SERVER['HTTP_ACCEPT'])) { 
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return true;
            }
        }
        return false;
    }
    /**
     * Function：适应手机端
     */
    public function td_get_template($name,$root) {
        if ($root == true) {
            if ($this->isMobile()) {
                require $this->GCZ_ROOT.'/Mobile/'.$name.'.php';
            } else {
                require $this->GCZ_ROOT.'/PC/'.$name.'.php';
            }
        } else {
            if ($this->isMobile()) {
                require $this->GCZ_ROOT.'/Mobile/'.$name;
            } else {
                require $this->GCZ_ROOT.'/PC/'.$name;
            }
        }
    }
    /**
     * Function：后台暗黑模式
     */
    public function gcz_backend_darkmode() {
        if (get_option('gcz_options')['gcz-backend'] == '1') {
            return 'dark';
        } else {
            return 'light';
        }
    }
    /**
     * Function：查询模板
     */
    public function td_get_page($name) {
        global $wpdb;
        $sql1 = "SELECT post_id FROM `wp_postmeta` WHERE meta_value='".$name."';";
        $sql2 = "SELECT post_name FROM `wp_posts` WHERE ID='".$wpdb->get_var($sql1)."'";
        return $wpdb->get_var($sql2);
    }
    /**
     * Function：查询权限
     */
    public function gcz_capabilities() {
        $gcz = get_option('gcz_options');
        $arr = array();
        if (is_array($gcz['gcz-level'])) {
            foreach($gcz['gcz-level'] as $role) {
                $arr[$role['gcz-level-id']] = $role['gcz-level-name'];
            }
        }
        return $arr;
    }
    /**
     * Function：后台订单列表
     */
    public function gcz_pavement_init() {
        function gcz_pavement() {
            add_menu_page(
                '订单',
                '订单',
                'administrator',
                'gcz_pavement',
                $function = 'gcz_pavement_page',
                $icon = 'dashicons-schedule',
                $position = 62
            );
        }
        function gcz_pavement_page() {
            require GCZ_ROOT.'/Core/Settings/Money/Money.php';
        }
        add_action('admin_menu', 'gcz_pavement');
    }
    /**
     * Function：小工具区域自动注册
     */
    public function td_auto_register_widget_init() {
        
        register_sidebar(
            array(
                'name'			=> '微谈左侧小工具',
                'id'			=> 'talk-left-sidebar',
                'before_widget'	=> '<section class="gcz-radius widget %2$s">', 
                'after_widget'	=> '</section>', 
                'before_title'	=> '<h3 class="widget-title">',
                'after_title'	=> '</h3>' 
            )
        );
        
        register_sidebar(
            array(
                'name'			=> '微谈右侧小工具',
                'id'			=> 'talk-right-sidebar',
                'before_widget'	=> '<section class="gcz-radius widget %2$s">', 
                'after_widget'	=> '</section>', 
                'before_title'	=> '<h3 class="widget-title">',
                'after_title'	=> '</h3>' 
            )
        );
        
        
        $gcz = get_option('gcz_options');
        foreach ($gcz['gcz-pc-modules'] as $gcz_func_get_modules_pc_item) {
            if ($gcz_func_get_modules_pc_item['gcz-pc-modules-sidebar'] == '1') {
                register_sidebar(
                    array(
                        'name'			=> $gcz_func_get_modules_pc_item['gcz-pc-modules-title'].'右侧小工具',
                        'id'			=> $gcz_func_get_modules_pc_item['gcz-pc-modules-class'].'-sidebar',
                        'before_widget'	=> '<aside class="gcz-radius widget %2$s">', 
                        'after_widget'	=> '</aside>', 
                        'before_title'	=> '<h3 class="widget-title">',
                        'after_title'	=> '</h3>' 
                    )
                );
            }
        }
    }
}