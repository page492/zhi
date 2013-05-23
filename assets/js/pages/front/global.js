define(function (require) {

    (function ($) {
        $.extend($.hold, {

            tip: function(content, icon){
                var icon = icon ? icon : 'success';
                $.dialog({id:'tip', title:false, content:'<div class="d-tip"><div class="d-tip-'+icon+'"></div><div class="d-tip-c">'+content+'</div><div class="d-tip-r"></div></div>', fixed:true, padding:0, time:1000});
            },

            checkLogin: function(){
                return "" == HG.UID ? ($.hold.dialogLogin(), !1) : !0;
            },

            dialogLogin: function(){
                $.getJSON(HG.URL.LOGIN, function(result){
                    if(result.status == 0){
                        $.hold.tip('系统错误！', 'error');
                    }else{
                        $.dialog({id:'login', title:"用户登录", content:result.html, padding:'', fixed:true, lock:true});
                        $.hold.listen.dlogin_form();
                    }
                });
            }
        });

        $.extend($.hold, {listen:{
            init: function(){
                this.like();
                this.favorite();
                this.captcha();
            },
            //dialog登陆
            dlogin_form: function() {
                var form = $('#J_DialogForm'),
                    btn = form.find(':submit');
                form.ajaxForm({
                    dataType: 'json',
                    beforeSubmit: function(){
                        var username = form.find('#J_username').val(),
                            password = form.find('#J_password').val();
                        if(username == ''){
                            form.find('#J_LoginTips').html('请输入用户名！').css("visibility", 'visible');
                            return !1;
                        }
                        if(password == ''){
                            form.find('#J_LoginTips').html('请输入密码！').css("visibility", 'visible');
                            return !1;
                        }
                        btn.attr('disabled', 'disabled').html('登录中...');
                    },
                    success: function(result){
                        btn.removeAttr('disabled').html('登 录');
                        if(result.status == 1){
                            $.dialog.get('login').title(false).content('<div class="d_loading">'+result.msg+'</div>').time(2000);
                            window.location.reload();
                        } else {
                            form.find('#J_LoginTips').html(result.msg).css("visibility", 'visible');
                        }
                    }
                });
            },
            //喜欢
            like: function() {
                $(document).on('click.hold', '.J_like', function() {
                    if(!$.hold.checkLogin()) return !1;
                    var self = $(this),
                        post_id = self.attr('data-post-id');
                    $.getJSON(HG.URL.LIKE, {post_id:post_id}, function(result) {
                        if (result.status == 1) {
                            self.addClass('liked');
                            $.hold.tip(result.msg);
                        } else {
                            $.hold.tip(result.msg, 'alert');
                        }
                    });
                });
            },
            //收藏
            favorite: function() {
                $(document).on('click.hold', '.J_favorite', function() {
                    if(!$.hold.checkLogin()) return !1;
                    var self = $(this),
                        post_id = self.attr('data-post-id');
                    $.getJSON(HG.URL.FAVORITE, {post_id:post_id}, function(result) {
                        if (result.status == 1) {
                            self.addClass('collected');
                            $.hold.tip(result.msg);
                        } else {
                            $.hold.tip(result.msg, 'alert');
                        }
                    });
                });
            },
            //验证码
            captcha: function() {
                $('#J_refresh_captcha').click(function(){
                    $('#J_captcha').attr('src', HG.URL.CAPTCHA+'/'+Math.random());
                });
            }
        }})
        $.hold.listen.init();

        $.extend($.hold, {ui:{
            init: function(){
                this.search();
                this.leftMenu();
                this.showAllFeed();
                this.goTop();
            },
            //搜索
            search: function(){
                var $el = $('#J_Search'),
                    $label = $el.find('label');

                $el.on('focus', '.search-text', function(e){
                    $el.addClass('active');
                    $label.addClass('hidden');
                });

                $el.on('blur', '.search-text', function(e){
                    $el.removeClass('active');
                    if($(this).val() ==''){
                        $label.removeClass('hidden');
                    }
                });
            },

            //左侧Menu
            leftMenu: function(){
                var $el = $('#J_Menu');

                if(!$el) return false;

                //固定顶部
                $(window).bind('scroll',function(){
                    var pos = 0;
                    pos = parseInt(window.scrollY);
                    if(pos>=182){
                        $el.css({'top': '0','position': 'fixed'});
                    }else{
                        $el.removeAttr('style');
                    }
                });

                //显示子类
                $el.on('mouseover', '.menu-item', function(e){
                    $(this).addClass('menu-cur');
                    var sub = $(this).find('.sub-menu');
                    sub.css({'visibility':'visible'});
                });

                //隐藏子类
                $el.on('mouseout', '.menu-item', function(e){
                    $(this).removeClass('menu-cur');
                    var sub = $(this).find('.sub-menu');
                    sub.css({'visibility':'hidden'});
                });
            },


            //更多文本
            showAllFeed: function(){
                var $el = $('#J_Feeds');

                $el.on('click', '.down', function(e){
                    e.preventDefault();
                    var attr = $(this).parents('.item-drawer').siblings('.item-attr');
                    attr.removeClass('excerpt').addClass('total');

                    $(this).addClass('none').siblings('.up').removeClass('none');
                });

                $el.on('click', '.up', function(e){
                    e.preventDefault();
                    var attr = $(this).parents('.item-drawer').siblings('.item-attr');
                    attr.removeClass('total').addClass('excerpt');

                    $(this).addClass('none').siblings('.down').removeClass('none');

                    var offsetTop = $(this).parents('.feed-item').offset().top;
                    window.scrollTo(0,offsetTop);
                });
            },

            //回到顶部
            goTop: function(){
                var $el = $('#J_GoTop');

                $(window).bind('scroll',function(){
                    var pos = 0;
                    pos = parseInt(window.scrollY);
                    if(pos>50){
                        $el.fadeIn();
                    }else{
                        $el.fadeOut();
                    }
                });

                $el.bind('click',function(e){
                    e.preventDefault();
                    $('html,body').animate({
                        scrollTop: 0
                    }, 400);
                });
            }
        }});
        $.hold.ui.init();
    })(jQuery);
});