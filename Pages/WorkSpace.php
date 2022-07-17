<?php
/**
 * Template Name: 工作台页面
 */
get_header();
?>
<div id="WorkSpace" style="height: 100%;position: fixed;width: 100%;">
    <t-layout style="height: 100%;">
        <t-aside style="width: auto;">
            <t-menu theme="dark" default-value="dashboard" :collapsed="Collapsed">
                <t-menu-group title="通用">
                    <t-menu-item value="dashboard" to="/">
                        <t-icon slot="icon" name="dashboard"></t-icon>仪表盘
                    </t-menu-item>
                    <t-menu-item value="write" to="/write">
                        <t-icon slot="icon" name="edit"></t-icon>撰写文章
                    </t-menu-item>
                </t-menu-group>
                <t-menu-group title="账户管控">
                    <t-menu-item value="credit" to="/settings">
                        <t-icon slot="icon" name="setting"></t-icon>账户设置
                    </t-menu-item>
                    <t-menu-item value="list" to="/list">
                        <t-icon slot="icon" name="root-list"></t-icon>账单管理
                    </t-menu-item>
                    <t-menu-item value="post" to="/post">
                        <t-icon slot="icon" name="logo-windows"></t-icon>文章管理
                    </t-menu-item>
                </t-menu-group>
                <t-menu-group title="杂项">
                    <t-menu-item value="notify" to="/message">
                        <t-icon slot="icon" name="chat"></t-icon>站内消息
                    </t-menu-item>
                    <?php if (current_user_can('level_10')) { ?>
                    <t-tooltip content="仅限最高管理员有此菜单">
                        <t-menu-item value="wpdash" href="/wp-admin">
                            <t-icon slot="icon" name="link-unlink"></t-icon>前往WordPress仪表盘
                        </t-menu-item>
                    </t-tooltip>
                    <?php } ?>
                </t-menu-group>
                <template #operations>
                    <t-icon class="t-menu__operations-icon" name="view-list" @click.native="changeCollapsed"></t-icon>
                </template>
            </t-menu>
        </t-aside>
        <t-layout>
            <t-content>
                <router-view></router-view>
            </t-content>
            <t-footer>Copyright @ 2019-{{new Date().getFullYear()}} <?php echo bloginfo('name'); ?>. All Rights Reserved</t-footer>
        </t-layout>
    </t-layout>
</div>
<?php get_footer(); ?>