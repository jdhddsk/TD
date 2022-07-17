<template>
    <div style="padding:24px">
        <t-loading size="large" text="正在载入..." :loading="TDMoneyCardLoading" :fullscreen="true"></t-loading>
        <t-row>
            <t-col :span="3" style="padding-right: 12px">
                <t-card class="card" header="余额">
                    <div><span>￥</span>{{ TDMoney }}</div>
                </t-card>
            </t-col>
            <t-col :span="3" style="padding-left: 12px;padding-right: 12px">
                <t-card class="text" header="已发布的文章总数">
                    <div style="display:flex;align-items: center;justify-content: space-between;">
                        <div>{{ TDPostCount }}</div>
                        <div id="post_cont" style="height:30%;width:50%"></div>
                    </div>
                </t-card>
            </t-col>
            <t-col :span="3" style="padding-left: 12px;padding-right: 12px">
                <t-card class="text" header="已发布的帖子总数">
                    <div>{{ TDTalkCount }}</div>
                </t-card>
            </t-col>
            <t-col :span="3" style="padding-left: 12px;">
                <t-card class="text" header="余额">
                    <div>666</div>
                </t-card>
            </t-col>
        </t-row>
        <t-row style="margin-top:24px;">
            <t-col :span="9" style="padding-right:12px">
                <t-card header="你的动态" style="padding:0">
                    <div id="echarts" style="height:300px;width:100%"></div>
                </t-card>
            </t-col>
            <t-col :span="3" style="padding-left:12px">
                <t-card header="账户绑定">
                    
                </t-card>
            </t-col>
        </t-row>
    </div>
</template>

<script>
    module.exports = {
        data() {
            return {
                TDMoney:'0.00',
                TDMoneyCardLoading:true,
                TDPostCount:'0',
                TDTalkCount:'0'
            }
        },
        mounted() {
            let that = this;
            axios.get('/wp-admin/admin-ajax.php', {
                params: {
                  action:'gcz_user',
                  user_id:userid
                }
            })
            .then(function (response) {
                console.log(response);
                that.TDMoney = response.data.credit.gcz_user_credit;
            })
            .catch(function (error) {
                console.log(error);
            })
            
            axios.get('/wp-json/wp/v2/posts', {
                params: {
                    author:userid,
                }
            })
            .then(function (response) {
                console.log(response);
                that.TDPostCount = response.data.length;
            })
            .catch(function (error) {
                console.log(error);
            })
            
            axios.get('/wp-json/wp/v2/talk', {
                params: {
                    author:userid,
                }
            })
            .then(function (response) {
                console.log(response);
                that.TDMoneyCardLoading = false;
                that.TDTalkCount = response.data.length;
            })
            .catch(function (error) {
                console.log(error);
            })
            
            // 图表统计
            axios.get('/wp-admin/admin-ajax.php', {
                params: {
                    action:'td_post',
                    count:10,
                    type:'post'
                }
            })
            .then(function (response) {
                console.log(response);
                let post = response;
                axios.get('/wp-admin/admin-ajax.php', {
                    params: {
                        action:'td_post',
                        count:10,
                        type:'talk'
                    }
                })
                .then(function (response) {
                    let talk = response;
                    console.log(response);
                    axios.get('/wp-admin/admin-ajax.php', {
                        params: {
                            action:'gcz_credit',
                            user:userid,
                            echo:true,
                            count:10
                        }
                    })
                    .then(function (response) {
                        console.log(response);
                        let option = {
                            xAxis: {
                                type: 'category',
                                data: post.data.date,
                                axisLabel: {
                                    align: 'center'
                                }
                            },
                            yAxis: {
                                type: 'value',
                                axisLabel: {
                                    align: 'center'
                                }
                            },
                            tooltip: {},
                            legend: {
                                data: [
                                    {
                                        name: '帖子',
                                        icon: 'circle'
                                    },
                                    {
                                        name: '文章',
                                        icon: 'circle'
                                    },
                                    {
                                        name: '最近充值',
                                        icon: 'circle'
                                    },
                                ],
                            },
                            series: [
                                {
                                    name: '帖子',
                                    data: talk.data.count,
                                    type: 'bar',
                                },
                                {
                                    name: '文章',
                                    data: post.data.count,
                                    type: 'bar',
                                    itemStyle: {
                                        color: '#0594fa',
                                    }
                                },
                                {
                                    name: '最近充值',
                                    data: response.data.count,
                                    type: 'line',
                                    itemStyle: {
                                        color: '#000',
                                    }
                                }
                            ]
                        };
                        echarts.init(document.getElementById('echarts')).setOption(option);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
                })
                .catch(function (error) {
                    console.log(error);
                })
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    }
</script>

<style scoped>
    .card {
        background:var(--td-brand-color);
    }
    .card .t-card__body,.text .t-card__body {
        font-size: 36px;
    }
    .card .t-card__header,.card .t-card__body {
        color:#fff;
    }
</style>