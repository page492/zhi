define(function (require) {
    $(function(){
        $('#J_loginform').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'alert');
                } else {
                    window.location.href = HG.URL.PERSON;
                }
            }
        });
    });
});