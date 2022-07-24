let Header = new Vue({
    data: {
        // 全屏加载
        loading:false,
        Mode:false,
        ModeCookie: document.cookie.replace(/(?:(?:^|.*;\s*)darkmode\s*\=\s*([^;]*).*$)|^.*$/, "$1"),
        // 搜索
        TDSearchVisible: false,
        TDSearchInput:'',
        // 登录
        TDLoginVisible: false,
        TDUserName: '',
        TDPassWord: '',
        TDLoginButtonLoading:false,
        // 注册
        TDRegisterVisible: false,
        TDRegisterUserName: '',
        TDRegisterPassWord: '',
        TDRegisterEmail: '',
        TDRegisterPassWordRe:'',
        TDRegisterPassWordReStatus: '',
        TDRegisterPassWordReTips: '',
        TDRegisterButton:true,
        TDRegisterButtonLoading:false,
            // 邮箱验证码
            count: '',
		    timer: null,
		    TDRegisterSendEmailButton: false,
            TDRegisterSendEmail:'发送验证码',
            VarietyCode: '',
            TDRegisterCode:'',
            TDRegisterEmailLoading:false,
            TDRegisterCodeStatus:'',
            TDRegisterCodeTips:'',
        // 侧边栏
        TDSideVisible: false,
        TDLoggout: false,
        //充值
        TDAddMoney: false,
        TDAddMoneyNumber: 1,
        TDAddMoneyWxDrawer: false,
        gczWxIframe:'',
    },
    mounted() {
        let that = this;
        $(document).ready(function() {
            $("pre").addClass("prettyprint linenums gcz-radius");
            $("figcaption").addClass("gcz-radius");
            $("img").addClass("gcz-radius");
            $("#charts .t-list-item__meta-avatar").addClass("gcz-radius");
            $("blockquote").addClass("gcz-radius");
            
            if (that.ModeCookie == 'true') {
                that.Mode = true;
                document.documentElement.setAttribute('theme-mode', 'dark');
                $("body").addClass("dark");
            }
        });
    },
    methods: {
        // 暗黑模式切换
        TDDarkMode:function() {
            if (this.Mode === true) {
                document.documentElement.setAttribute('theme-mode','dark');
                $('#td-header').addClass('dark');
                $('body').addClass('dark');
                document.cookie = "darkmode=true";
            } else if (this.Mode === false) {
                document.documentElement.removeAttribute('theme-mode');
                $('#td-header').removeClass('dark');
                $('body').removeClass('dark');
                document.cookie = "darkmode=false";
            }
        },
        // 退出登录
        TDLoggoutWindow:function() {
            this.TDLoggout = false;
        },
        TDLoggoutAction:function() {
            this.TDLoggout = false;
            axios.get('/wp-admin/admin-ajax.php',{
                params: {
                    action: 'gcz_logout'
                }
            })
            .then(function (response) {
                console.log(response);
                location.reload();
                
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        // 侧边栏
        TDSide:function() {
            this.TDSideVisible = true;
        },
        // 搜索
        TDSearch:function() {
            this.TDSearchVisible = true;
        },
        // 注册
        TDRegister:function() {
            this.TDRegisterVisible = true;
        },
        // 注册效验
        TDRegisterRe:function() {
            if (this.TDRegisterUserName === '' || this.TDRegisterPassWord === '' || this.TDRegisterEmail === '' || this.TDRegisterPassWordRe === '' || this.TDRegisterCode === '') {
                this.TDRegisterButton = true;
            } else if (this.TDRegisterPassWord != this.TDRegisterPassWordRe) {
                this.TDRegisterPassWordReStatus = 'error';
                this.TDRegisterPassWordReTips = '请检查密码是否正确';
                this.TDRegisterButton = true;
            } else if (this.TDRegisterCode != this.VarietyCode) {
                this.TDRegisterCodeStatus = 'error';
                this.TDRegisterCodeTips = '请检查验证码是否正确';
                this.TDRegisterButton = true;
            } else if (this.TDRegisterPassWord == this.TDRegisterPassWordRe && this.TDRegisterCode === this.VarietyCode) {
                this.TDRegisterPassWordReStatus = '';
                this.TDRegisterPassWordReTips = '';
                this.TDRegisterCodeStatus = '';
                this.TDRegisterCodeTips = '';
                this.TDRegisterButton = false;
            }
        },
        TDRegisterAction:function() {
            let that = this;
            this.TDRegisterButtonLoading = true;
            setTimeout(() => {
	           this.TDRegisterButtonLoading = false;
	        },300);
            axios.get(ajax_login_object.ajaxurl, {
                params: {
                    action: 'register_user_front_end',
                    new_user_name: that.TDRegisterUserName,
                    new_user_email: that.TDRegisterEmail,
                    new_user_password: that.TDRegisterPassWord
                }
            })
            .then(function (response) {
                // console.log(response);
                that.$message('warning',response.data.message);
                if (response.data.code === 340) {
                    location.reload();
                }
            })
            .catch(function (error) {
                console.log(error);
                that.$message('warning','网络错误，请稍后再试');
            });
        },
        // 邮箱验证核心代码
        TDRegisterEmailAction:function() {
            let that = this;
            this.TDRegisterEmailLoading = true;
            axios.get(ajax_login_object.ajaxurl,{
                params: {
                    action: 'td_variety',
                    to: that.TDRegisterEmail
                }
            })
            .then(function (response) {
                // console.log(response);
                that.VarietyCode = response.data.code;
                const TIME_COUNT = 60;
                if (!that.timer) {
                    that.count = TIME_COUNT;
                    that.TDRegisterSendEmailButton = true;
                    that.$message('success','发送成功');
                    that.timer = setInterval(() => {
                        if (that.count > 0 && that.count <= TIME_COUNT) {
                            that.count--;
                        } else {
                            that.TDRegisterSendEmailButton = false;
                            clearInterval(that.timer);
                            that.timer = null;
                            that.count = null;
                            that.TDRegisterSendEmail = '重新发送';
                        }
                    }, 1000)
                }
                that.TDRegisterSendEmail = 's后重新获取';
                that.TDRegisterEmailLoading = false;
            });
        },
        // 登录
        TDLogin:function() {
            this.TDLoginVisible = true;
        },
        TDLoginAction:function() {
            let that = this;
            this.TDLoginButtonLoading = true;
            setTimeout(() => {
	           this.TDLoginButtonLoading = false;
	        },300);
            axios.get(ajax_login_object.ajaxurl, {
                params: {
                    action:     'ajax_login',
                    username:   that.TDUserName,
                    password:   that.TDPassWord,
                }
            })
            .then(function (response) {
                // console.log(response);
                that.$message('warning',response.data.message);
                if (response.data.code === 500) {
                    location.reload();
                }
            })
            .catch(function (error) {
                console.log(error);
                that.$message('warning','网络错误，请稍后再试');
            });
        },
        // 充值
        TDAddMoneyVisible:function() {
            this.TDAddMoney = true;
        },
        TDAddMoneyWx:function() {
            this.loading = true;
            this.TDAddMoney = false;
            this.TDAddMoneyWxDrawer = true;
            let that = this;
            axios.get('/wp-content/themes/GCZ%20TD/Core/Library/XunhuPay/pay.php', {
                params: {
                    money: that.TDAddMoneyNumber,
                    name: '充值',
                    gcz_credit:true,
                }
            })
            .then(function (response) {
                that.gczWxIframe = response.request.responseURL;
                that.gczMoneyDrawerLoading = false;
                that.loading = false;
            })
            .catch(function (error) {
                console.log(error);
                that.$message('warning','网络错误，请稍后再试');
                that.loading = false;
            })
        },
        TDAddMoneyAli:function() {
            this.loading = true;
            this.TDAddMoney = false;
            this.TDAddMoneyWxDrawer = true;
            let that = this;
            axios.get('/wp-content/themes/GCZ%20TD/Core/Library/XunhuAli/pay.php', {
                params: {
                    money: that.TDAddMoneyNumber,
                    name: '充值',
                    gcz_credit:true,
                }
            })
            .then(function (response) {
                that.gczWxIframe = response.request.responseURL;
                that.gczMoneyDrawerLoading = false;
                that.loading = false;
            })
            .catch(function (error) {
                console.log(error);
                that.$message('warning','网络错误，请稍后再试');
                that.loading = false;
            });
        },
    },
}).$mount('#gcz-pc-header');