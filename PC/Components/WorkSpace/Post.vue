<template>
    <div style="padding:24px">
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
            TableLoading: false,
            columns: [
                {
                    colKey: 'id',
                    title: '序号',
                    fixed: 'left',
                    width: '10'
                },
                {
                    colKey: 'title.rendered',
                    title: '名称',
                    width: '100'
                },
                {
                    colKey: 'date',
                    title: '时间',
                    width: '100'
                },
                {
                    colKey: 'comment_status',
                    title: '评论区状态',
                    width: '100'
                },
                {
                    colKey: 'status',
                    title: '文章状态',
                    width: '100'
                }
            ],
        }
    },
    mounted() {
        let that = this;
        axios.get('/wp-json/wp/v2/posts', {
            params: {
                author:userid,
            }
        })
        .then(function (response) {
            console.log(response);
            that.data = response.data;
        })
        .catch(function (error) {
            console.log(error);
        })
    }
}
</script>