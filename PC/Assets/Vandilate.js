let vandilate = new Vue({
    data() {
        return {
            price: 0,
            count: 0,
            maindata: vand,
            disabled: false,
            columns: [
                {
                    colKey: "id",
                    title: "商品id",
                },
                {
                    colKey: "title",
                    title: "商品名称",
                },
                {
                    colKey: "count",
                    title: "商品数量",
                },
                {
                    colKey: "price",
                    title: "价格",
                },
            ],
            fixedTopAndBottomRows: false,
            tableLayout: "fixed",
            pay: false,
            password:''
        };
    },
    methods: {
        securityAction:function() {
            let that = this;
            axios.get('/wp-admin/admin-ajax.php',{
                params: {
                    action: 'td_buy_security',
                    password: that.password,
                    price: that.price
                }
            })
            .then(function(response) {
                if (response.data.code === 200) {
                    that.$message('success',response.data.message);
                    that.$message.loading('正在支付中');
                } else if (response.data.code === 600) {
                    that.$message('warning',response.data.message);
                } else {
                    that.$message('error',response.data.message);
                }
            })
        }
    }
}).$mount("#vandilate");
