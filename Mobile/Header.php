<?php
$user_id = get_current_user_id();
$gcz     = get_option('gcz_options');
$Core    = new GCZ_Core;
?>
<div id="Header" class="gcz-mobile-header">
    <div class="Public-Header">
        <img alt="logo" width="30px" src="<?php echo $gcz['gcz-logo'];?>"/>
        <div class="Public-Header-Right">
            <div @click="TDMobileUserDrawer = true" class="space">
                <?php echo $Core->gcz_get_avatar('',''); ?>
            </div>
            <div @click="TDMobileSearchDrawer = true">
                <t-icon name="search"></t-icon>
            </div>
        </div>
    </div>
    
    <!--搜索框-->
    <t-drawer class="gcz-page" size="100%" :close-btn="false" :visible.sync="TDMobileSearchDrawer" :header="false" :footer="false">
        <div class="UnHeader">
            <div @click="TDMobileSearchDrawer = false" class="icon"><t-icon @click="TDMobileSearchDrawer = false" name="chevron-left"></t-icon></div>
            <div class="title">搜索</div>
        </div>
        <div class="UnBody">
            <form action class="gcz-mobile-search">
                <t-input name="s" placeholder="搜索你想要的内容"></t-input>
                <t-button type="submit" style="margin-left:10px">搜索</t-button>
            </form>
        </div>
    </t-drawer>
    
    <?php if (is_user_logged_in()) { ?>
    <!--个人中心-->
    <?php require 'Components/UserCenter/User.php'; ?>
    <!--关注的人-->
    <?php require 'Components/UserCenter/Follow.php'; ?>
    <?php } else { ?>
    <!--登录-->
    <t-drawer class="gcz-page" size="100%" :close-btn="false" :visible.sync="TDMobileUserDrawer" :header="false" :footer="false">
        <div class="UnHeader">
            <div @click="TDMobileUserDrawer = false" class="icon">
                <t-icon @click="TDMobileUserDrawer = false" name="chevron-left"></t-icon>
            </div>
            <div class="title">个人中心</div>
        </div>
        <div class="UnBody No-Padding">
            
        </div>
    </t-drawer>
    <?php } ?>
</div>