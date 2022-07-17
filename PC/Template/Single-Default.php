<?php
/**
 * @Template 默认
 * @since 2022
 * @author Zero
 */
global $post;
$author_id = get_user_role($post->post_author)->ID;
$user_id = get_post_meta(get_the_ID(),'gcz-likes',true);
?>
<div class="gcz-pc-main">
    <div class="gcz-width">
        <div id="gcz-article">
            <h1><?php the_title(); ?></h1>
            <article><?php the_content(); ?></article>
            <div class="gcz-likes">
                <t-badge :count="likescount">
                    <t-button :loading="likesloading" @click="likes()"><t-icon name="thumb-up"></t-icon><span v-if="likesbool === true">已</span>点赞</t-button>
                </t-badge>
                <?php if (!empty(get_post_meta(get_the_ID(),'gcz-likes',true))) { ?>
                <t-avatar-group size="small" :max="3">
                <?php
                    foreach ($user_id as $i) {
                        if (empty(get_user_meta($i,'gcz_user_avatar',true))) {
                ?>
                    <t-avatar><?php echo gczGetPingYing(get_user_role($i)->user_nicename); ?></t-avatar>
                <?php } else { ?>
                    <t-avatar image="<?php echo get_user_meta($i,'gcz_user_avatar',true); ?>"></t-avatar>
                <?php }} ?>
                </t-avatar-group>
                <?php } ?>
                <div class="data">
                    <div style="display: flex;align-items: center;"><?php echo td_views('<t-icon name="browse"></t-icon>',''); ?></div>
                </div>
            </div>
        </div>
        <?php comments_template(); ?>
    </div>
</div>
<script src="<?php echo GCZ_URI; ?>/PC/Template/Default.js"></script>