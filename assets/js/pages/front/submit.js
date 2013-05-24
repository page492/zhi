define(function (require) {
    $(function(){
        $('#J_SubmitForm').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'error');
                } else {
                    window.location.href = PERSON_SUBMIT_URL;
                }
            }
        });
    });
});