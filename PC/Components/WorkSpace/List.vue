<template>
    <div style="padding:24px">
        <h1>查询订单</h1>
        <t-table
        row-key="index"
        table-layout="auto"
        :data="data"
        stripe
        hover
        resizable
        bordered
        :loading="TableLoading"
        :columns="columns"
      >
            <template #empty>
                <span>暂无数据</span>
            </template>
        </t-table>
    </div>
</template>

<script>
    module.exports = {
        data() {
            return {
                data: [],
                columns: [
                    {
                      align: 'center',
                      colKey: 'gcz_id',
                      title: '序号',
                      fixed: 'left',
                      width: '10'
                    },
                    {
                      colKey: 'gcz_name',
                      title: '名称',
                      width: '100'
                    },
                    {
                      colKey: 'gcz_time',
                      title: '时间',
                      width: '100'
                    },
                    {
                      colKey: 'gcz_order',
                      title: '网站订单号',
                      width: '100'
                    },
                    {
                      colKey: 'gcz_xunhuid',
                      title: '商户平台订单号',
                      width: '100'
                    }
                ],
                TableLoading: true
            }
        },
        mounted() {
            let that = this;
            axios.get(wordpressajax, {
                params: {
                  action:'gcz_credit',
                  user: userid
                }
            })
            .then(function (response) {
                console.log(response);
                that.data = response.data;
                that.TableLoading = false
            })
            .catch(function (error) {
                console.log(error);
            })
        }
    }
</script>