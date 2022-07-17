<?php
$user_id = get_current_user_id();
global $current_user;
?>
<template>
    <div>
        <t-drawer id="gcz-follow" class="gcz-page" :header="false" :footer="false" size="100%" :visible.sync="TDMobileFollowDrawer">
            <div class="UnHeader">
                <div @click="TDMobileFollowDrawer = false" class="icon">
                    <t-icon @click="TDMobileFollowDrawer = false" name="chevron-left"></t-icon>
                </div>
                <div class="title">关注的人</div>
            </div>
            
            <div style="margin-top:50px">
                <?php if (!empty(get_user_meta($user_id,'gcz-follow',true))) { ?>
                <t-list>
                    <?php foreach (get_user_meta($user_id,'gcz-follow',true) as $i) { ?>
                    <t-list-item>
                        <t-list-item-meta title="<?php echo get_user_role($i)->display_name; ?>">
                            <template #image>
                                <?php if (!empty(get_user_meta($i,'gcz_user_avatar',true))) { ?>
                                    <t-avatar size="56px" image="<?php echo get_user_meta( $i, 'gcz-user-avatar', true ); ?>"></t-avatar>
                                <?php } else { ?>
                                <t-avatar size="56px">
                                    <?php echo gczGetPingYing(get_user_role($i)->display_name); ?>
                                </t-avatar>
                                <?php } ?>
                            </template>
                            <template #description>
                                <t-button size="small">关注</t-button>
                                <t-button size="small" variant="outline">私信</t-button>
                            </template>
                        </t-list-item-meta>
                    </t-list-item>
                    <?php } ?>
                </t-list>
                <?php } else { echo '<div style="margin-top:70px;display:flex;color:#888;align-items: center;justify-content: center;">没有已关注的用户哦</div>'; } ?>
            </div>
        </t-drawer>
    </div>
</template>