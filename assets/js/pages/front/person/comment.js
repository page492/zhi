define(function (require) {
    $(function(){
        $('#J_CommentList').on('click.hold', '.J_del', function(e) {
            if(!confirm('确定要删除吗？')) return !1;
            var self = $(this),
                url = self.attr('href');
            $.getJSON(url, function(result) {
                if (result.status == 1) {
                    self.parents('li').fadeOut('slow');
                } else {
                    $.hold.tip(result.msg, 'error');
                }
            });
            e.preventDefault();
        });
    });
});