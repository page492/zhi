/**
 * Author: 张军 hbjszj@gmail.com
 * Apply: HoldPHP
 * Version: 0.1 
 * Date: 2013-3-11
 * Note: 
 */

!function ($) {

    var HoldPHP = window.HoldPHP = {
        //初始化
        init: function(){
            this.search();
            this.leftMenu();
            this.showAllFeed();
            this.goTop();
            //this.login();
        },


        login: function(){
            $.getJSON('JSON/login.json', function(result){
                if(result.status == 0){
                    alert(1);
                }else{
                    //$.dialog('artDialog: 加载数据失败！', function () {alert('Thank you!')});
                    $.dialog({id:'login', title:"用户登录", content:result.data, padding:'', fixed:true, lock:true});
                    //$.dialog({ title:"用户登录", content:'<div class="loading">加载数据失败！</div>', fixed:true, lock:true}).time(2000);
                }
            });
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

    };

}(window.jQuery);

$(document).ready(function() {
    HoldPHP.init();
});