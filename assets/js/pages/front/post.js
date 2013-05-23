define(function (require) {
    $(function(){
        $('#J_CommentForm').Validform({
            tiptype:2
        });

        $('#J_CommentForm').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'error');
                } else {
                    $('#J_CommentContent').val('');
                    $('#J_CommentList').prepend(result.html);
                }
            }
        });

        $('#J_PostComment').on('click.hold', '#J_CommentPager a', function(e) {
            var url = $(this).attr('href');
            $.getJSON(url, function(result){
                if(result.status == 1){
                    $('#J_CommentList').html(result.data.list_html);
                    $('#J_CommentPager').html(result.data.page_html);
                }else{
                    $.pinphp.tip({content:result.msg, icon:'error'});
                }
            });
            e.preventDefault();
        })
    });
});