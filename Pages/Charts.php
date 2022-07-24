<?php
/**
 * Template name: 购物车
 */
get_header();
$Core = new GCZ_Core;
?>
<div id="charts">
    <t-layout>
        <main class="gcz-pc-main">
            <div class="gcz-width">
                
                <t-steps :default-current="0" readonly>
                    <t-step-item title="购物车" content="管理商品"></t-step-item>
                    <t-step-item title="付款" content="查看详单"></t-step-item>
                    <t-step-item title="完成" content="购买完成"></t-step-item>
                </t-steps>
                
                <t-divider></t-divider>
                <div class="gcz-list" style="display:flex;justify-content: space-between;">
                    <t-tooltip content="点击刷新购物车">
                        <t-button :disabled="btnLoading" @click="refreshItem()" shape="circle" theme="primary">
                            <t-icon :name="icon" slot="icon"/>
                        </t-button>
                    </t-tooltip>
                    <a :href="href">
                        <t-button :disabled="empty">前往结算</t-button>
                    </a>
                </div>
                
                <div class="gcz-list">
                    <t-list>
                        <t-list-item
                            :asyncLoading="loading"
                            :id="'gcz_'+index"
                            :key="index"
                            v-for="(item,index) in data"
                        >
                            <t-list-item-meta :title="item.title">
                                <template #image>
                                    <img :src="item.image" />
                                </template>
                                <template #description>
                                    数量：{{ item.count }}
                                    <t-divider layout="vertical"></t-divider>
                                    {{ item.charts }}
                                </template>
                            </t-list-item-meta>
                            <template #action>
                                <span>
                                    <t-tooltip content="点击删除">
                                        <t-button
                                            @click="deleteItem(index,item.charts)"
                                            shape="circle"
                                            ><t-icon name="delete"></t-icon
                                        ></t-button>
                                    </t-tooltip>
                                </span>
                            </template>
                        </t-list-item>
                    </t-list>
                    <div v-if="empty">购物车里没有东西哦~</div>
                </div>
            </div>
        </main>
    </t-layout>
</div>

<style>
    #charts .t-list-item__meta {
        display: flex;
        align-items: center;
    }
</style>

<script>
    let TDCharts = new Vue({
        data: {
            hash:false,
            empty:false,
            loading:'loading',
            btnLoading:false,
            data:[],
            icon:'refresh',
            href: '<?php echo '/'.$Core->td_get_page('Pages/Vandilate.php');?>'
        },
        methods: {
            refreshItem:function() {
                this.loading = 'loading';
                this.btnLoading = true;
                this.icon = 'loading';
                this.empty = false;
                let that = this;
                axios.get('/wp-admin/admin-ajax.php',{
                    params: {
                        action: 'td_add_charts'
                    }
                })
                .then(function (response) {
                    console.log(response);
                    that.loading = false;
                    that.btnLoading = false;
                    that.icon = 'refresh';
                    that.$message('success','刷新成功');
                    that.data = response.data.data;
                    if (that.data == '' || that.data == null || that.data == undefined) {
                        that.empty = true;
                        that.href = 'javascript:;'
                    } else {
                        that.empty = false;
                        that.href = '<?php echo '/'.$Core->td_get_page('Pages/Vandilate.php');?>';
                    }
                })
            },
            deleteItem:function(e,hash) {
                this.loading = 'loading';
                document.querySelector('#gcz_'+e).remove();
                let that = this;
                axios.get('/wp-admin/admin-ajax.php',{
                    params: {
                        action: 'td_del_charts',
                        hash: hash
                    }
                })
                .then(function(response) {
                    console.log(response);
                    this.loading = false;
                    that.data == response.data.data;
                    if (response.data.length === 0) {
                        that.empty = true;
                        that.href = 'javascript:;'
                    } else {
                        that.empty = false;
                        that.href = '<?php echo '/'.$Core->td_get_page('Pages/Vandilate.php');?>';
                    }
                })
            }
        },
        mounted() {
            let that = this;
            axios.get('/wp-admin/admin-ajax.php',{
                params: {
                    action: 'td_add_charts'
                }
            })
            .then(function (response) {
                console.log(response);
                if (response.data.code !== 500) {
                    that.loading = false;
                    that.data = response.data.data;
                    if (response.data.data == '' || response.data.data == null || response.data.data == undefined) {
                        that.empty = true;
                        that.href = 'javascript:;'
                    } else {
                        that.empty = false;
                        that.href = '<?php echo '/'.$Core->td_get_page('Pages/Vandilate.php');?>';
                    }
                } else {
                    that.$message('error','您未登录，请先登录');
                    that.empty = true;
                    that.btnLoading = true;
                    Header.TDLogin();
                }
            })
        }
    }).$mount('#charts')
</script>
<style>
    .gcz-width {
        padding: 24px;
        background: #fff;
    }
    .t-list-item {
        padding: 12px 0;
    }
    .gcz-list {
        margin-top: 24px;
    }
</style>
<?php get_footer(); ?>