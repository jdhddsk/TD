<?php
$id = $_REQUEST['id'];
$count = $_REQUEST['count'];
$Core = new GCZ_Core;
?>
<div id="vandilate">
    <t-layout>
        <main class="gcz-pc-main">
            <div class="gcz-width">
                <t-steps :default-current="1" readonly>
                    <t-step-item>
                        <Template #title>
                            <a href="<?php echo '/'.$Core->td_get_page('Pages/Charts.php'); ?>">购物车</a>
                        </Template>
                        <Template #content>
                            <a href="<?php echo '/'.$Core->td_get_page('Pages/Charts.php'); ?>">点击前往购物车</a>
                        </Template>
                    </t-step-item>
                    <t-step-item title="付款" content="查看详单">
                    </t-step-item>
                    <t-step-item title="完成" content="购买完成">
                    </t-step-item>
                </t-steps>
                <t-divider></t-divider>
                <div style="display: flex;justify-content: flex-end;align-items: center;">
                    <div style="font-size:24px;margin-right: 24px;">￥{{ price }}</div>
                    <t-button :disabled="disabled" @click="pay = true">余额支付</t-button>
                </div>
                <t-divider>详单</t-divider>
                <t-table
                  stripe
                  row-key="index"
                  :data="maindata"
                  :columns="columns"
                  :table-layout="tableLayout"
                  :max-height="fixedTopAndBottomRows ? 500 : 300"
                  :fixed-rows="fixedTopAndBottomRows ? [2, 2] : undefined"
                  bordered
                ></t-table>
            </div>
        </main>
    </t-layout>
    
    <t-dialog :visible.sync="pay" :on-confirm="securityAction">
        <t-form style="margin: 25px 0;">
            <t-form-item>
                <t-input v-model="password" size="large" type="password" placeholder="请输入此账户的登录密码以确认付款">
                    <t-icon name="lock-on" slot="prefix-icon"></t-icon>
                </t-input>
            </t-form-item>
        </t-form>
    </t-dialog>
</div>
<?php require GCZ_ROOT.'/PC/Assets/Vandilate.php'; ?>