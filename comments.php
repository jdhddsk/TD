<?php
/**
 * @param 评论
 * @since 2022
 * @author Zero
 */
$gcz    = get_option('gcz_options');
$Core   = new GCZ_Core;
?>
<div id="gcz-comments">
    <h3>评论</h3>
        <?php if (is_user_logged_in()) { ?>
            <?php if (gcz_get_level('','gcz_level_comments')) { ?>
                <t-comment>
                    <template #avatar>
                        <?php echo $Core->gcz_get_avatar('','56px'); ?>
                    </template>
                    <template #content>
                        <t-textarea id="comment" v-model:value="gczComments" name="content" style="margin-bottom:10px">
                        </t-textarea>
                        <div style="display:flex;justify-content: space-between;">
                            <t-button @click="postComment()">提交</t-button>
                        </div>
                    </template>
                </t-comment>
            <?php } else { ?>
                <t-comment>
                    <template #avatar>
                        <t-avatar size="56px"><i class="iconoir-user"></i></t-avatar>
                    </template>
                    <template #content>
                        <t-textarea disabled v-model:value="gczComments" name="content" placeholder="此等级不允许评论" style="margin-bottom:10px"></t-textarea>
                        <t-button @click="NoLoginComment()" disabled>提交</t-button>
                    </template>
                </t-comment>
            <?php } ?>
        <?php } else { ?>
    
        <t-comment>
            <template #avatar>
                <t-avatar size="56px"><i class="iconoir-user"></i></t-avatar>
            </template>
            <template #content>
                <div style="display:flex;margin-bottom:20px">
                    <t-input v-model:value="gczCommentsName" label="名字：" placeholder="" style="margin-right:10px"></t-input>
                    <t-input v-model:value="gczCommentsEmail" label="邮箱：" placeholder="" style="margin-left:10px"></t-input>
                </div>
                <t-textarea v-model:value="gczComments" name="content" placeholder="请输入评论内容" style="margin-bottom:10px"></t-textarea>
                <t-button @click="NoLoginComment()">提交</t-button>
            </template>
        </t-comment>
        <?php } ?>
    
    <!--评论-->
    <div id="gcz-pc-comments">
        <?php
        $comments = get_comments($args = array('post_id' => get_the_ID()));
        if (!empty($comments)) {
            foreach ($comments as $key => $comment) {
                // 头像
                if (!$comment->user_id == '0') {
                    $wp_user = new WP_User(get_current_user_id());
                    $user_avatar = get_user_meta($comment->user_id,'gcz_user_avatar',true);
                    ?>
                    <t-comment
                        class="gcz-comment-item"
                        author="<?php echo $wp_user->display_name; ?>"
                        datetime="<?php echo $comment->comment_date; ?>"
                    >
                        <template #avatar>
                            <?php if (empty($user_avatar)) { ?>
                            <t-avatar size="56px"><?php gczGetPingYing($comment->comment_author); ?></t-avatar>
                            <?php } else { ?>
                            <t-avatar size="56px" image="<?php echo $user_avatar; ?>"></t-avatar>
                            <?php } ?>
                        </template>
                        <template #content>
                            <?php echo $comment->comment_content; ?>
                        </template>
                    </t-comment>
                    <?php
                } else {
                    echo 
                    '<t-comment
                        class="gcz-comment-item"
                        author="'.$comment->comment_author.'"
                        datetime="'.$comment->comment_date.'"
                    >
                        <template #avatar>
                            <t-avatar size="56px">'.gczGetPingYing($comment->comment_author).'</t-avatar>
                        </template>
                        <template #content>
                            '.$comment->comment_content.'
                        </template>
                    </t-comment>';
                }
            }
        } else {
            echo '<div style="color:#888;display:flex;justify-content: center;">这里没有任何评论~</div>';
        }
        ?>
    </div>
</div>
<script src="<?php echo GCZ_URI; ?>/Core/Script/PC/Comment.js"></script>