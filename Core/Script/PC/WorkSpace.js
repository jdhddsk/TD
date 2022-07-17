const router = new VueRouter({
    mode: 'hash',
    routes: 
    [
        {
            path: '/',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/Profile.vue'),
        },
        {
            path: '/write',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/Write.vue'),
        },
        {
            path: '/settings',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/Settings.vue'),
        },
        {
            path: '/list',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/List.vue'),
        },
        {
            path: '/message',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/Message.vue'),
        },
        {
            path: '/post',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/Post.vue'),
        },
        {
            path: '/404',
            component: httpVueLoader(GCZ+'/PC/Components/WorkSpace/404.vue'),
        },
        {
            path: '*',
            redirect: '/404'
        },
    ]
});

let WorkSpace = new Vue({
    router,
    data: {
        Collapsed:false
    },
    mounted() {
        if (userid === 0 || userid ==='0') {
            this.$message('warning','您未登录，请先登录');
            Header.TDLoginVisible = true;
        }
    },
    methods: {
        changeCollapsed:function() {
            this.Collapsed = !this.Collapsed;
        }
    }
}).$mount('#WorkSpace')