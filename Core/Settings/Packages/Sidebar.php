<?php
if( class_exists( 'CSF' ) ) {

    CSF::createWidget('gcz_user_panel', array(
        'title'       => 'GCZ-用户面板',
        'classname'   => 'gcz-user-panel gcz-radius',
        'description' => '显示当前已登录用户信息',
        'fields'      => array(
    
            array(
                'id'      => 'gcz-none-login-widget',
                'type'    => 'text',
                'title'   => '未登录时用户看到的内容',
                'default' => '请登录或注册一个账号',
            ),
            
        )
    ));

    if(!function_exists( 'gcz_user_panel')) {
    function gcz_user_panel($args, $instance) {

        echo $args['before_widget'];


        // var_dump( $args ); // Widget arguments
        // var_dump( $instance ); // Saved values from database
        if (is_user_logged_in()) {
            global $current_user;
            $user_id   = get_current_user_id();
            echo '<img class="gcz-user-headering" src="'.get_user_meta($current_user->ID,'gcz_user_headering',true).'">';
            echo '<div class="information">'.'<img class="gcz-radius" src="'.get_user_meta($current_user->ID,'gcz_user_avatar',true).'"/>';
                echo '<div class="text">';
                    echo '<div style="color: #fff;margin-bottom: 5px;">'.$current_user->display_name.'</div>';
                    echo '<div class="gcz-saying">'.get_user_meta($current_user->ID,'gcz_user_saying',true).'</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="releasedposts">';
                echo '<t-divider>发布的文章</t-divider>';
                
                $query = new WP_Query(
                    array(
                        'author' => 1,
                        'posts_per_page' => 60,
                    )
                );
                $posts = $query->posts;
                ?>
                <ul class="userwzlist">
                    <?php foreach($posts as $k => $p): ?>
                        <li class="clearfix">
                        <a href="<?php echo get_permalink($p->ID); ?>">
                        <?php echo $p->post_title;?>
                        </a>
                        <span class="fright"><?php the_time('Y-m-d'); ?></span>
                        </li>
                    <?php endforeach;?>
                </ul>
                <?php
            echo '</div>';
            } else {
                echo '<div class="nologin">';
                echo $instance['gcz-none-login-widget'];
                echo '</div>';
                echo '<div class="nologin">';
                echo '<t-button onclick="Header.TDLoginVisible = true">登录</t-button>';
                echo '<t-button onclick="Header.TDRegisterVisible = true" variant="outline" theme="primary" style="margin-left:10px" ghost>注册</t-button>';
                echo '</div>';
                
            }
            echo $args['after_widget'];
        }
    }
}
