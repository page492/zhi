define(function (require) {
    $(function(){
        $('#J_SubmitForm').Validform({
            tiptype:function(msg,o,cssctl){
                if(o.type == 2){
                    $(o.obj).parents('.control').removeClass('error').addClass('success');
                    $(o.obj).siblings('.tips').html('');
                }else if(o.type == 3){
                    $(o.obj).parents('.control').removeClass('success').addClass('error');
                    $(o.obj).siblings('.tips').html(msg);
                }
            }
        });

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