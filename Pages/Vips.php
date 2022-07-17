<?php
/**
 * Template name: VIP页面
 */
get_header();
?>
<div id="vip">
    <t-layout class="gcz-talk-home">
        <main class="gcz-pc-main" style="background:linear-gradient(180deg, #ffffffb3 0%, #fff 100%),url(<?php echo get_post_meta(get_the_ID(),'gcz-vips-image',true); ?>) 0% 0% / contain no-repeat;">
                <div class="name"><?php bloginfo('name'); ?></div>
                <div class="description"><?php bloginfo("description"); ?></div>
                <?php if (is_user_logged_in()) { ?>
                <div class="status"><t-tag theme="primary"><?php echo 'LV0';?></t-tag></div>
                <?php } else { ?>
                <div class="status">您未登录，请先<a onclick="Header.TDLoginVisible = true" href="javascript:void(0)">登录</a></div>
                <?php } ?>
                
                <div class="list">
                    <div class="list-item" v-for="item in data">
                        <div>{{ item.name }}</div>
                        <div>{{ item.money }}元/{{ item.time }}天</div>
                        <div>已加入{{ item.ability.false_people }}人</div>
                        <div></div>
                        <ul>
                            <li>
                                <t-icon v-if="item.ability.post_ability.likes == 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.post_ability.likes == 0 || item.ability.post_ability.likes == ''" name="close"></t-icon>
                                文章点赞
                            </li>
                            <li>
                                <t-icon v-if="item.ability.talk_ability.likes == 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.talk_ability.likes == 0 || item.ability.talk_ability.likes == ''" name="close"></t-icon>
                                帖子点赞
                            </li>
                            <li>
                                <t-icon v-if="item.ability.post_ability.comments == 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.post_ability.comments == 0 || item.ability.post_ability.comments == ''" name="close"></t-icon>
                                文章评论
                            </li>
                            <li>
                                <t-icon v-if="item.ability.talk_ability.comments == 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.talk_ability.comments == 0 || item.ability.talk_ability.comments == ''" name="close"></t-icon>
                                文章评论
                            </li>
                            <li>
                                <t-icon v-if="item.ability.post_ability.post == 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.post_ability.post == 0 || item.ability.post_ability.post == ''" name="close"></t-icon>
                                发布文章
                            </li>
                            <li>
                                <t-icon v-if="item.ability.talk_ability.post === 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.talk_ability.post == 0 || item.ability.talk_ability.post == ''" name="close"></t-icon>
                                发布帖子
                            </li>
                            <li>
                                <t-icon v-if="item.ability.talk_ability.circle === 1" name="check"></t-icon>
                                <t-icon v-if="item.ability.talk_ability.circle == 0 || item.ability.talk_ability.circle == ''" name="close"></t-icon>
                                创建圈子
                            </li>
                        </ul>
                    </div>
                </div>
        </main>
    </t-layout>
</div>
<script>
    let VIP = new Vue({
        data: {
            data:[]
        },
        mounted() {
            let that = this;
            axios.get('/wp-admin/admin-ajax.php',{
                params: {
                    action: 'td_get_vip'
                }
            })
            .then(function (response) {
                console.log(response);
                that.data = response.data;
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    }).$mount('#vip')
</script>
<style>
    .name {
        text-align: center;
        font-size: 22px;
        margin-top: 20px;
    }
    .description {
        font-size: 18px;
        margin-top: 20px;
        color: var(--td-text-color-secondary);
    }
    .status {
        margin-top: 20px;
    }
    #vip .list {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
    }
    #vip .list-item {
        background: #fff;
        padding: 24px;
        margin: 0 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    #vip .list-item ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }
</style>
<?php get_footer(); ?>