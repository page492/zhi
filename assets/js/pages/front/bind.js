define(function (require) {
    $(function(){
        $('#J_bindform').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'error');
                } else {
                    window.location.href = HG.URL.PERSON;
                }
            }
        });
        $('#J_bindform_old').ajaxForm({
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