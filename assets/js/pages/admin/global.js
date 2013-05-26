define(function (require) {

    require('bootstrap');
    require('tablehold');

    (function ($) {

        $.hold.admin = {
            fixed_act: function () {
                if (!$("#J_actbar")[0]) return !1;
                if (document.documentElement.clientHeight < $(document).height()) {
                    $('#J_actbar').addClass('form-actions-fixed');
                } else {
                    $('#J_actbar').removeClass('form-actions-fixed');
                }
            }
        };

        //操作条位置
        $.hold.admin.fixed_act();
        $(window).resize(function () {
            $.hold.admin.fixed_act();
        });

        //按钮状态
        $(document).on('click.hold', '[data-loading-text]', function () {
            $(this).button('loading');
        });

        //确认操作
        $(document).on('click.hold', '[data-toggle="confirmurl"]', function (e) {
            var self = $(this),
                uri = (self.attr('data-uri') != undefined) ? self.attr('data-uri') : self.attr('href'),
                acttype = self.attr('data-acttype'),
                title = (self.attr('data-title') != undefined) ? self.attr('data-title') : false,
                msg = self.attr('data-msg'),
                callback = self.attr('data-callback');
            $.dialog({
                title: title,
                content: msg,
                padding: '10px 20px',
                lock: true,
                ok: function () {
                    if (acttype == 'ajax') {
                        $.getJSON(uri, function (result) {
                            if (result.status == 1) {
                                if (callback != undefined) {
                                    eval(callback + '(self)');
                                } else {
                                    window.location.reload();
                                }
                            } else {

                            }
                        });
                    } else {
                        location.href = uri;
                    }
                },
                cancel: function () {
                }
            });
            e.preventDefault();
        });

        //弹窗
        $(document).on('click.hold', '[data-toggle="dialog"]', function (e) {
            var self = $(this),
                dtitle = self.attr('data-title'),
                did = self.attr('data-id'),
                duri = (self.attr('data-uri') != undefined) ? self.attr('data-uri') : self.attr('href'),
                dwidth = parseInt(self.attr('data-width')),
                dheight = parseInt(self.attr('data-height')),
                dpadding = (self.attr('data-padding') != undefined) ? self.attr('data-padding') : '10px 15px';
            $.dialog({id: did}).close();
            $.dialog({
                id: did,
                title: dtitle,
                width: dwidth ? dwidth : 'auto',
                height: dheight ? dheight : 'auto',
                padding: dpadding,
                lock: true,
                ok: function () {
                    var form = this.dom.content.find('form[data-submit="dialog"]'),
                        tip_con = this.dom.buttons;
                    tip_con.find('.J_tip').remove();
                    if (form[0] != undefined) {
                        form.ajaxSubmit({
                            dataType: 'json',
                            success: function (result) {
                                if (result.status == 1) {
                                    $('<span class="J_tip tip tip-success pull-left">' + result.msg + '</span>').prependTo(tip_con).fadeIn('slow').delay(500).fadeOut(function () {
                                        window.location.reload();
                                    });
                                } else {
                                    $('<span class="J_tip tip tip-error pull-left">' + result.msg + '</span>').prependTo(tip_con).fadeIn('fast');
                                }
                            }
                        });
                        return false;
                    }
                },
                cancel: function () {
                }
            });
            $.getJSON(duri, function (result) {
                if (result.status == 1) {
                    $.dialog.get(did).content(result.html);
                }
            });
            e.preventDefault();
        });

        //ajaxForm处理
        $(document).on('click.hold', '[data-toggle="ajaxfrom"]', function (e) {
            var btn = $(this),
                action = btn.attr('data-action'),
                title = (btn.attr('data-title') != undefined) ? btn.attr('data-title') : false,
                msg = btn.attr('data-msg'),
                form = btn.parents('form');
            form.find('.J_tip').remove();
            //需要确认
            if (msg != undefined) {
                $.dialog({
                    id: 'confirm',
                    title: title,
                    padding: '10px 20px',
                    lock: true,
                    fixed: true,
                    content: msg,
                    follow: btn[0],
                    ok: function () {
                        doaction();
                    },
                    cancel: function () {
                        btn.button('reset');
                    }
                });
            } else {
                doaction();
            }
            function doaction() {
                form.ajaxSubmit({
                    dataType: 'json',
                    url: action,
                    success: function (result) {
                        btn.button('reset');
                        if (result.status == 1) {
                            $('<span class="J_tip tip tip-success">' + result.msg + '</span>').appendTo(btn.parent()).fadeIn('slow').delay(500).fadeOut(function () {
                                window.location.reload();
                            });
                        } else {
                            $('<span class="J_tip tip tip-error">' + result.msg + '</span>').appendTo(btn.parent()).fadeIn('fast');
                        }
                    }
                });
            }
            e.preventDefault();
        });

    })(jQuery);
});