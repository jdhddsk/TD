<?php
$Core = new GCZ_Core;
?>
<div id="app">
    <t-layout class="gcz-talk-home">
        <main class="gcz-pc-main" style="padding-top:0;margin-bottom: 30px;height: auto;">
            <div id="gcz-pc-write" class="gcz-width" style="width: 100%;">
                <t-form>
                    <p style="margin-top:0"><t-input placeholder="标题" size="large"></t-input></p>
                    <t-textarea placeholder="发布一个新帖子"></t-textarea>
                    <p v-if="TDVoteVisible" style="display:flex">
                        <t-input placeholder="请输入内容" align="right" style="margin-right:6px"></t-input>
                        <t-input placeholder="请输入内容" style="margin-left:6px"></t-input>
                    </p>
                    <p style="display: flex;justify-content: space-between;align-items: center;">
                        <span><t-switch @change="TDVoteSwitch" v-model="TDVoteSwitcher"></t-switch> PK投票</span>
                        <t-button>提交</t-button>
                    </p>
                </t-form>
                <?php
                $terms = get_terms($args = array('taxonomy' => 'circle','hide_empty' => false));
                $args = array('post_type' => 'talk',);
                
                $my_query = new WP_Query($args);
                    if($my_query->have_posts()) {
                        while ($my_query->have_posts()) : $my_query->the_post();?>
                        <div class="gcz-talk-item gcz-radius">
                            <t-comment style="padding:24px">
                                <template #avatar>
                                    <?php if (!empty(get_user_meta(get_the_author_ID(), 'gcz_user_avatar', true))) { ?>
                                    <t-avatar size="large" image="<?php echo get_user_meta(get_the_author_ID(),'gcz_user_avatar',true); ?>"></t-avatar>
                                    <?php } else { ?>
                                    <t-avatar size="large">
                                    <?php echo gczGetPingYing(the_author()); ?>
                                    </t-avatar>
                                    <?php } ?>
                                </template>
                                <template #author><?php the_author();?></template>
                                <template #content><?php echo strip_tags(get_the_excerpt()); ?></template>
                            </t-comment>
                        </div>
                        <?php endwhile; wp_reset_query(); //重置query查询
                    } else {
                        echo '暂无帖子';
                    }
                ?>
            </div>
        </main>
        <aside class="talk-right-sidebar" style="width:300px;margin-left:10px">
            <?php dynamic_sidebar('talk-right-sidebar'); ?>
        </aside>
    </t-layout>
</div>

<script>
    new Vue({
        data:{
            TDVoteSwitcher:false,
            TDVoteVisible:false,
        },
        methods: {
            TDVoteSwitch() {
                if (this.TDVoteSwitcher === false) {
                    this.TDVoteVisible = false;
                } else {
                    this.TDVoteVisible = true;
                }
            },
        },
    }).$mount('#app')
</script>

<style>
    .gcz-talk-item {
        background: #fff;
    }
    .gcz-talk-home {
        padding-top: 80px;
        height: 100vh;
        display: flex;
        flex-direction: row;
        width: 100%;
        align-items: flex-start;
        justify-content: center;
    }
    .gcz-pc-main {
        width: 70%;
        min-width: 768px;
    }
    aside.talk-right-sidebar {
        min-width: 300px;
    }
</style>