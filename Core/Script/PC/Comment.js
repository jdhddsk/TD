new Vue({
    data: {
        // 用户评论
        gczComments:'',
        gczCommentsName:'',
        gczCommentsEmail:''
    },
    methods: {
        // 未登录用户评论
        NoLoginComment:function() {
            let that = this;
            axios.get(wordpressajax, {
                params: {
                    action: 'gcz_comments',
                    post: postid,
                    user: userid,
                    user_name:that.gczCommentsName,
                    user_email:that.gczregisteremail,
                    content:that.gczComments,
                }
            })
            .then(function (response) {
                console.log(response);
                that.$message('success',response.data.message);
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
                that.$message('error',response.data.message);
            });
        },
        // 用户评论
        postComment:function() {
            let that = this;
            axios.get(wordpressajax, {
                params: {
                    action: 'gcz_comments',
                    post: postid,
                    user: userid,
                    content:that.gczComments,
                }
            })
            .then(function (response) {
                console.log(response);
                that.$message('success',response.data.message);
                location.reload();
            })
            .catch(function (error) {
                console.log(error);
                that.$message('error',response.data.message);
            });
        },
    }
}).$mount('#gcz-comments')