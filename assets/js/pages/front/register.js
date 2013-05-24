define(function (require) {
    $(function(){
        $('#J_regform').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'error');
                } else {
                    window.location.href = HG.URL.PERSON;
                }
            }
        });
    });
});