<?php
$user_id = get_current_user_id();
$Core = new GCZ_Core;
global $current_user;
?>
<template>
    <div>
        <t-drawer class="gcz-page" id="gcz-mobileuser" size="100%" :visible.sync="TDMobileUserDrawer" :header="false" :footer="false">
            
            <div class="UnHeader">
                <div @click="TDMobileUserDrawer = false" class="icon">
                    <t-icon @click="TDMobileUserDrawer = false" name="chevron-left"></t-icon>
                </div>
                <div class="title">个人中心</div>
            </div>
            
            <div class="UnBody No-Padding">
                <t-card :bordered="false" id="gcz-mobileuser-info" style="height: 180px;background:url(<?php echo get_user_meta($user_id,'gcz_user_headering',true); ?>)">
                    <template #footer>
                        <t-comment content="<?php echo get_user_meta($user_id,'gcz_user_saying',true); ?>" author="<?php echo $current_user->display_name; ?>">
                            <template #avatar>
                                <?php echo $Core->gcz_get_avatar('','53px'); ?>
                            </template>
                        </t-comment>
                        <div id="gcz-mobileuser-action">
                            <div id="gcz-mobileuser-action-left">
                                <a @click="TDMobileFollowDrawer = true">
                                    <div id="gcz-mobileuser-action-fans">
                                        <p style="margin-top:0">关注</p>
                                        <span>
                                            <?php  
                                            if (!empty(get_user_meta($user_id,'gcz-follow',true))) {
                                                echo count(get_user_meta($user_id,'gcz-follow',true));
                                            } else {
                                                echo '0';
                                            }
                                            ?>
                                        </span>
                                    </div>
                                </a>
                                <div id="gcz-mobileuser-action-fans">
                                    <p style="margin-top:0">粉丝</p>
                                    <span>
                                    <?php
                                    if (!empty(get_user_meta($user_id,'gcz-fans',true))) {
                                        echo count(get_user_meta($user_id,'gcz-fans',true));
                                    } else {
                                        echo '0';
                                    }
                                    ?>
                                    </span>
                                </div>
                                <div id="gcz-mobileuser-action-fans">
                                    <p style="margin-top:0">获赞</p>
                                    <span>1000</span>
                                </div>
                            </div>
                            <div id="gcz-mobileuser-action-right">
                                <t-button ghost variant="outline">编辑背景图</t-button>
                            </div>
                        </div>
                    </template>
                </t-card>
                
                <t-tabs :default-value="1" theme="card">
                    <t-tab-panel :value="1" label="个人信息">
                        <div style="padding:12px">
                            <div class="td-side-list-item">
                                <div class="td-side-title">
                                    <div class="td-side-title-text">手机号</div>
                                    <a href="" class="td-side-title-option">
                                        <div>修改<svg class="t-icon t-icon-chevron-right"><use href="#t-icon-chevron-right"></use></svg></div>
                                    </a>
                                </div>
                                <div class="td-side-content">未绑定</div>
                            </div>
                            
                            <div class="td-side-list-item">
                                <div class="td-side-title">
                                    <div class="td-side-title-text">邮箱</div>
                                    <a href="" class="td-side-title-option">
                                        <div>修改<svg class="t-icon t-icon-chevron-right"><use href="#t-icon-chevron-right"></use></svg></div>
                                    </a>
                                </div>
                                <div class="td-side-content"><?php echo $current_user->user_email; ?></div>
                            </div>
                        </div>
                    </t-tab-panel>
                    <t-tab-panel :value="2" label="文章管理">
                        <p style="margin: 20px">选项卡2内容区</p>
                    </t-tab-panel>
                    <t-tab-panel :value="3" label="个人设置">
                        <p style="margin: 20px">选项卡3内容区</p>
                    </t-tab-panel>
                </t-tabs>
            </div>
        </t-drawer>
    </div>
</template>