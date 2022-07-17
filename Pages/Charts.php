<?php
/**
 * Template name: 购物车
 */
get_header();
?>
<div id="charts">
    <t-layout>
        <main class="gcz-pc-main">
            <div class="gcz-width">
                <h1>购物车</h1>
                <t-list>
                    <t-list-item key="index" v-for="item in data">
                        <t-list-item-meta :title="item.title">
                            <template #image>
                                <img :src="item.image"/>
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
                                <t-button shape="circle"><t-icon name="delete"></t-icon></t-button>
                            </t-tooltip>
                          </span>
                        </template>
                    </t-list-item>
                </t-list>
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
            data:[]
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
                that.data = response.data.data;
            })
        }
    }).$mount('#charts')
</script>
<?php get_footer(); ?>