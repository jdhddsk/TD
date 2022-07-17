<?php
$gcz = get_option('gcz_options');
$Core = new GCZ_Core;
global $current_user;
$user_id = get_current_user_id();
?>
<div id="gcz-pc-header">
    <!--菜单-->
    <t-head-menu theme="dark">
        <?php
            $menuParameters = array(
                'theme_location' =>'header_menu',
                'container'     => false,
                'echo'          => false,
                'items_wrap'    => '%3$s',
                'walker'        => new GCZ_Walker_Menu()
            );
            echo wp_nav_menu( $menuParameters );
        ?>
        <template #operations>
            <a href="javascript:;" @click="TDSearch()">
                <t-icon class="t-menu__operations-icon" name="search"/>
            </a>
            <?php if(!is_user_logged_in()) { ?>
            <a href="javascript:;" @click="TDLogin()">
                <t-icon class="t-menu__operations-icon" name="user-circle"/>
            </a>
            <?php } else { ?>
            <a href="javascript:;" @click="TDSide()" style="text-decoration:none">
                <?php echo $Core->gcz_get_avatar($user_id,''); ?>
            </a>
            <?php } ?>
        </template>
    </t-head-menu>
    
    <!--搜索-->
    <t-dialog :visible.sync="TDSearchVisible" :footer="false" :header="false" :close-btn="false">
        <h1 style="text-align:center">搜索</h1>
        <form action="//<?php echo $_SERVER["HTTP_HOST"]; ?>" method="get">
            <t-input type="search" size="large" name="s" v-model="TDSearchInput" placeholder="请输入你想要的..."></t-input>
            <div style="display:flex;justify-content: center;margin-top:20px">
                <t-button size="large" type="submit"><t-icon name="search"></t-icon> 搜索</t-button>
            </div>
        </form>
    </t-dialog>
    <?php if(!is_user_logged_in()) { ?>
    
    <!--登录-->
    <t-dialog :visible.sync="TDLoginVisible" :footer="false" :header="false" :close-btn="false">
        <h1 style="text-align:center">登录</h1>
        <p>
        <t-input size="large" placeholder="请输入用户名或电子邮箱地址" v-model="TDUserName"></t-input>
        </p>
        <p>
        <t-input type="password" size="large" placeholder="密码" v-model="TDPassWord"></t-input>
        </p>
        <p>
        <t-button :loading="TDLoginButtonLoading" block size="large" @click="TDLoginAction()">登录</t-button>
        </p>
        <div style="display:flex;justify-content: space-between;">
            <t-button theme="default" @click="TDRegister()">注册</t-button>
            <div>
                <?php if ($gcz['gcz-qq'] == '1') { ?>
                <a target="_blank" style="text-decoration:none" href="<?php echo qq_oauth_url(); ?>">
                    <t-button theme="default" @click="TDRegister()">QQ登录</t-button>
                </a>
                <?php } ?>
                <?php if ($gcz['gcz-weibo'] == '1') { ?>
                <a target="_blank" style="text-decoration:none" href="<?php echo weibo_oauth_url(); ?>">
                    <t-button theme="default" @click="TDRegister()">微博登录</t-button>
                </a>
                <?php } ?>
            </div>
        </div>
    </t-dialog>
    
    <!--注册-->
    <t-dialog :visible.sync="TDRegisterVisible" :footer="false" :header="false" :close-btn="false">
        <h1 style="text-align:center">注册</h1>
        <p>
        <t-input size="large" v-model="TDRegisterEmail" placeholder="请输入邮箱地址"></t-input>
        </p>
        <p style="display: flex;align-items: center;">
        <t-input @change="TDRegisterRe()" :status="TDRegisterCodeStatus" :tips="TDRegisterCodeTips" size="large" style="margin-right:7px" v-model="TDRegisterCode" placeholder="验证码"></t-input>
        <t-button @click="TDRegisterEmailAction()" :disabled="TDRegisterSendEmailButton" :loading="TDRegisterEmailLoading" size="large" style="margin-left:7px">{{ count }}{{ TDRegisterSendEmail }}</t-button>
        </p>
        <p>
        <t-input size="large" @change="TDRegisterRe()" v-model="TDRegisterUserName" placeholder="请输入用户名"></t-input>
        </p>
        <p>
        <t-input type="password" @change="TDRegisterRe()" size="large" v-model="TDRegisterPassWord" placeholder="请输入密码"></t-input>
        </p>
        <p>
        <t-input type="password" @change="TDRegisterRe()" :status="TDRegisterPassWordReStatus" :tips="TDRegisterPassWordReTips" size="large" v-model="TDRegisterPassWordRe" placeholder="请再次输入密码"></t-input>
        </p>
        <t-button :loading="TDRegisterButtonLoading" :disabled="TDRegisterButton" size="large" block @click="TDRegisterAction()">立即注册</t-button>
    </t-dialog>
    <?php } ?>
    
    <!--侧边栏-->
    <t-drawer :close-btn="false" attach="body" :footer="false" :visible.sync="TDSideVisible" mode="push">
        <template #header>
            <div class="gcz-side-header" style="display: flex;justify-content: space-between;">
                <div>个人中心</div>
                <t-popconfirm :visible.sync="TDLoggout" :popup-props="{placement:'bottom-right'}" :on-cancel="TDLoggoutWindow" :on-confirm="TDLoggoutAction" content="确认退出登录？">
                    <a style="cursor:pointer" style="text-decoration:none" @click="TDLoggout = true">登出</a>
                </t-popconfirm>
            </div>
        </template>
        <t-comment author="<?php echo $current_user->display_name; ?>">
            <template #avatar>
                <?php $Core->gcz_get_avatar($user_id,'60px');?>
            </template>
            <template #content>
                <?php if (empty(get_user_meta($user_id,'gcz_user_saying',true))) {
                    echo '这个人很懒，什么都没有写哦';
                } else {
                    echo get_user_meta($user_id,'gcz_user_saying',true);
                }
                ?>
            </template>
        </t-comment>
        
        <div class="td-side-list">
            
            <t-divider>信息</t-divider>
            
            <div class="td-side-list-item">
                <div class="td-side-title">
                    <div class="td-side-title-text">手机号</div>
                    <a href="" class="td-side-title-option">
                        <div>修改<t-icon name="chevron-right"></t-icon></div>
                    </a>
                </div>
                <div class="td-side-content">
                    <?php if (empty(get_user_meta($user_id,'gcz_user_phone',true))) {
                        echo '未绑定';
                    } else {
                        echo get_user_meta($user_id,'gcz_user_phone',true);
                    }?>
                </div>
            </div>
            
            <div class="td-side-list-item">
                <div class="td-side-title">
                    <div class="td-side-title-text">邮箱</div>
                    <a href="" class="td-side-title-option">
                        <div>修改<t-icon name="chevron-right"></t-icon></div>
                    </a>
                </div>
                <div class="td-side-content"><?php echo $current_user->user_email; ?></div>
            </div>
            
            <t-divider>操作</t-divider>
            
            <div class="td-side-list-item" style="display: flex;justify-content: space-between;">
                <t-tooltip content="发布新文章">
                    <a href="/<?php echo $Core->td_get_page('Pages/WorkSpace.php').'#/write'; ?>">
                        <t-button style="height:50px;width: 50px;border-radius:40px" size="large" shape="circle">
                            <t-icon style="font-size: 24px;" name="edit"></t-icon>
                        </t-button>
                    </a>
                </t-tooltip>
                <t-tooltip content="发布新帖子">
                    <t-button style="height:50px;width: 50px;border-radius:40px" shape="circle" theme="danger">
                        <t-icon style="font-size: 24px;" name="chat"></t-icon>
                    </t-button>
                </t-tooltip>
                <t-tooltip content="发布新快讯">
                    <t-button style="height:50px;width: 50px;border-radius:40px" shape="circle" theme="warning">
                        <t-icon style="font-size: 24px;" name="format-horizontal-align-bottom"></t-icon>
                    </t-button>
                </t-tooltip>
                <t-tooltip content="前往工作台">
                    <a href="/<?php echo $Core->td_get_page('Pages/WorkSpace.php'); ?>">
                        <t-button style="height:50px;width: 50px;border-radius:40px" shape="circle" variant="outline" theme="success">
                            <t-icon style="font-size: 24px;" name="view-module"></t-icon>
                        </t-button>
                    </a>
                </t-tooltip>
            </div>
            
            <t-divider>账户</t-divider>
            
            <div class="td-side-list-item money">
                <t-card title="余额">
                    <template #actions>
                        <a href="javascript:void(0)" @click="TDAddMoneyVisible()">充值</t-icon></a>
                    </template>
                    <div class="money-number">
                        <span>￥</span>
                        <?php if (empty(get_user_meta($user_id,'gcz_user_credit',true))) {
                            echo '0.00';
                        } else {
                            echo get_user_meta($user_id,'gcz_user_credit',true);
                        }
                        ?>
                    </div>
                </t-card>
                
                <t-dialog :footer="false" attach="body" header="充值" :visible.sync="TDAddMoney">
                    <div>
                        <div style="margin-bottom:10px;display: flex;align-items: center;justify-content: center;">
                            <t-input-number tips="最小0.01" :min="0.01" v-model="TDAddMoneyNumber"></t-input-number>
                        </div>
                        <div style="display:flex;justify-content: space-around;">
                            <?php if ($gcz['gcz-wechat-pay'] == 'xunhupay') { ?>
                            <t-button size="large" @click="TDAddMoneyWx" theme="success">微信支付</t-button>
                            <?php } ?>
                            <t-button size="large" @click="TDAddMoneyAli">支付宝支付</t-button>
                        </div>
                    </div>
                </t-dialog>
            </div>
        </div>
    </t-drawer>
    
    <!--充值-->
    <t-drawer class="gczPavement" :footer="false" :header="false" size="large" attach="body" :visible.sync="TDAddMoneyWxDrawer" :header="false" :close-btn="true">
        <iframe style="border:none;width:100%;height:100%" :src="gczWxIframe"></iframe>
    </t-drawer>
    
    <t-loading :loading="loading" text="加载中..." fullscreen />
</div>