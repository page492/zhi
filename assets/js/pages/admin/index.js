define(function(require) {

  $(function(){
    var set_h = function(){
        var heights = document.documentElement.clientHeight-87;
        $("#J_rframe").height(heights);
    }
    $(window).resize(function(){
        set_h();
    });
    set_h();

    //点击顶部菜单
    $('a[data-hold-toggle="navbar"]').on('click.hold', function () {
        $('#J_sidenav').load($('#J_sidenav').attr('data-uri'), {id:$(this).attr('data-id')});
    });
    $('a[data-hold-toggle="navbar"]:first').trigger('click');

    //左侧菜单点击
    $('#J_sidenav').on('click.hold', 'a[data-hold-toggle="sidenav"]', function(){
        var data_name=$(this).text(),
            data_uri = $(this).attr('data-uri'),
            data_id = $(this).attr('data-id'),
            _li = $('#J_tabnav li[data-id='+data_id+']');
        if(_li[0]){
            _li.trigger('click');
        }else{
            //不存在新建frame和tab
            var rframe = $('<iframe/>', {
                id                : 'J_rframe_'+data_id,
                src               : data_uri,
                allowtransparency : true,
                frameborder       : 0,
                scrolling         : 'auto',
                width             : '100%',
                height            : '100%'
            }).appendTo('#J_rframe');
            $(rframe[0].contentWindow.document).ready(function(){
                rframe.siblings().hide();
                var _li = $('<li data-id="'+data_id+'"><a>'+data_name+'</a><a class="icon-remove" data-toggle="tabdel" title="关闭此页">关闭</a></li>');
                _li.appendTo('#J_tabnav');
                _li.trigger('click');
            });
        }
        $('#J_rframe_'+data_id).attr('src', $('#J_rframe_'+data_id).attr('src'));
    });

    //tab条
    $('#J_tabnav').on('click.hold', 'li', function(){
        if($('#J_tabnav').is(":animated")){
            return false;
        }
        var data_id  = $(this).attr('data-id'),
            _li_prev = $(this).prev(),
            _li_next = $(this).next(),
            _li_left = $(this).offset().left-5,
            _li_right = _li_left + $(this).outerWidth()+5,
            _next_left = $('#J_tabnav_next').offset().left,
            _prev_right = $('#J_tabnav_pre').offset().left + $('#J_tabnav_pre').outerWidth();

        if($(this).hasClass('active')){
            return false;
            $('#J_rframe_'+data_id).attr('src', $('#J_rframe_'+data_id).attr('src'));
        }
        $(this).addClass('active').siblings('li').removeClass('active');
        if(_li_right > _next_left){
            var distance = _li_right - _next_left;
            $('#J_tabnav').animate({left:'-='+distance}, 200, 'swing');
        }else if(_li_left < _prev_right){
            var distance = _prev_right - _li_left;
            $('#J_tabnav').animate({left:'+='+distance}, 200, 'swing');
        }
        if(_li_prev[0]){
            $('#J_tabnav_pre').removeClass('tab-nav-disabled');
        }else{
            $('#J_tabnav_pre').addClass('tab-nav-disabled');
        }
        if(_li_next[0]){
            $('#J_tabnav_next').removeClass('tab-nav-disabled');
        }else{
            $('#J_tabnav_next').addClass('tab-nav-disabled');
        }
        $('#J_rframe_'+data_id).show().siblings('iframe').hide();
    });

    //上一个
    $('#J_tabnav_pre').click(function(){
        $('#J_tabnav .active').prev().trigger('click');
    });

    //下一个
    $('#J_tabnav_next').click(function(){
        $('#J_tabnav .active').next().trigger('click');
    });

    //关闭
    $('#J_tabnav').on('click.hold', 'a[data-toggle="tabdel"]', function(){
        var _li = $(this).parents('li'),
            _prev_li = _li.prev('li'),
            data_id = _li.attr('data-id');
        _li.hide(60,function() {
            $(this).remove();
            $('#J_rframe_'+ data_id).remove();
            var _active_li = $('#J_tabnav li.active');
            if(!_active_li[0]){
                _prev_li.addClass('active').trigger('click');
                $('#J_rframe_'+_prev_li.attr('data-id')).show();
            }
        });
        return false;
    });
  });
});