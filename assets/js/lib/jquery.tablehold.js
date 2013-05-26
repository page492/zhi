/**
 * Created with JetBrains PhpStorm.
 * User: nimo
 * Date: 13-5-26
 * Time: 上午11:51
 * To change this template use File | Settings | File Templates.
 */

!function ($) {

    "use strict";

    var TableHold = function (element, options) {
        this.options = $.extend({}, $.fn.tablehold.defaults, options);
        this.$element = $(element)
            .delegate('[data-action="modify"]', 'click.modify.tablehold', $.proxy(this.modify, this))
            .delegate('[data-action="toggle"]', 'click.toggle.tablehold', $.proxy(this.toggle, this));
        this.uri = this.$element.attr('data-uri');
    }

    TableHold.prototype = {
        modify: function (e) {
            var self = this
                , $el = $(e.target).hide()
                , pdata = eval("("+$el.attr('data-find')+")")
                , pfield = $el.attr('data-field')
                , ov = $el.text();
            $('<input type="text" value="'+ov+'" />').width($el.width()).on('blur.modify.tablehold', function (e) {
                var $input = $(e.target)
                    , nv = $input.val()
                    , psave = '{"'+pfield+'" : "'+nv+'"}';
                $.extend(true, pdata, eval("("+psave+")"));
                $.post(self.uri, pdata, function (result) {
                    if (result.status == 1) {
                        $input.remove();
                        $el.show().text(nv);
                    } else {
                        alert(result.msg);
                    }
                }, 'json');
            }).insertAfter($el).focus().select();
        }
        , toggle: function (e) {
            var $el = $(e.target)
                , pdata = eval("("+$el.attr('data-find')+")")
                , nv = Math.abs(parseInt($el.attr('data-value')) - 1)
                , psave = '{"'+$el.attr('data-field')+'" : "'+nv+'"}';
            $.extend(true, pdata, eval("("+psave+")"));
            $.post(this.uri, pdata, function (result) {
                if (result.status == 1) {
                    $el.attr('data-value', nv);
                    $el.hasClass('toggle-on') ?
                        $el.removeClass('toggle-on').addClass('toggle-off') :
                        $el.removeClass('toggle-off').addClass('toggle-on');
                } else {
                    alert(result.msg);
                }
            }, 'json');
        }
    }


    /* TABLEHOLD PLUGIN DEFINITION
     * ======================== */

    $.fn.tablehold = function (option) {
        return this.each(function () {
            var $this = $(this)
                , data = $this.data('tablehold')
                , options = typeof option == 'object' && option;
            if (!data) $this.data('tablehold', (data = new TableHold(this, options)));
            if (typeof option == 'string') data[option]();
        })
    }

    $.fn.tablehold.Constructor = TableHold

    $.fn.tablehold.defaults = {}


    /* SCROLLSPY DATA-API
     * ================== */

    $(window).on('load', function () {
        $('[data-tbh="tablehold"]').each(function () {
            var $tbh = $(this);
            $tbh.tablehold($tbh.data());
        })
    })

}(window.jQuery);