new Vue({
        data: {
            TDWriteTitle:'',
            TDWriteLoading: false,
            value2: '',
            TDCategory:''
        },
        mounted() {
            let that = this;
            if (userid === '0') {
                this.$message('warning','您未登录 请先登录');
            }
            axios.get(wordpressajax, {
                params: {
                    action: 'gcz_write_category'
                }
            })
            .then(function (response) {
                that.TDCategory = response.data.category;
                console.log(response.data.category);
            })
            .catch(function (error) {
                console.log(error);
            })
        },
        methods: {
            TDWriteAction() {
                let that = this;
                this.TDWriteLoading = true;
                jQuery.ajax({
                    url:  wordpressajax,
                    type: "GET",
                    dataType: "json",
                    data: {
                        action   :  "gcz_write",
                        content  :  $("#gcz-content").val(),
                        title    :  that.TDWriteTitle,
                        category :  that.value2,
                        comment  :  'open',
                    },
                    success:function(data) {
                        console.log(data);
                        if (data.status === 'error') {
                            that.$message('error',data.message);
                        } else {
                            that.$message('success',data.message);
                        }
                        that.TDWriteLoading = false;
                    },
                    error:function(data) {
                        console.log(data);
                        that.TDWriteLoading = false;
                    }
                });
            }
        },
    }).$mount('#gcz-pc-write')