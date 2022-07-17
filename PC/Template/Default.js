new Vue({
    data: {
        likesmessage: "",
        likescount: "",
        likesbool: false,
        likesloading: true,
    },
    mounted() {
        let that = this;
        axios.get(wordpressajax, {
                params: {
                    action: "likes",
                    user: userid,
                    post: postid,
                    echo: false,
                },
            })
            .then(function (response) {
                that.likescount = Object.keys(response.data.post_meta).length;
                if (response.data.in_array === true) {
                    that.likesbool = true;
                } else {
                    that.likesbool = false;
                }
                that.likesloading = false;
                console.log(response);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    methods: {
        // 点赞
        likes: function () {
            this.likesloading = true;
            let that = this;
            axios.get(wordpressajax, {
                    params: {
                        action: "likes",
                        user: userid,
                        post: postid,
                        echo: true,
                    },
                })
                .then(function (response) {
                    that.likesmessage = response.data.message;
                    that.$message("warning", that.likesmessage);
                    that.likescount = Object.keys(
                        response.data.post_meta
                    ).length;
                    if (response.data.in_array === true) {
                        that.likesbool = true;
                    } else {
                        that.likesbool = false;
                    }
                    that.likesloading = false;
                    console.log(response);
                })
                .catch(function (error) {
                    that.likesmessage = response.data.message;
                    that.$message("warning", that.likesmessage);
                    that.likescount = Object.keys(
                        response.data.post_meta
                    ).length;
                    that.likesloading = false;
                    console.log(response);
                });
        },
    },
}).$mount("#gcz-article");