define(function(require) {

    require('uploader');

    $(function(){

        $('#J_visit_status input[type="radio"]').on('click.hold', function() {
            var status = $(this).val();
            if (status == '0') {
                $('#J_visit_explain').show();
            } else {
                $('#J_visit_explain').hide();
            }
        })

        $('#J_mail_method input[type="radio"]').on('click.hold', function() {
            var method = $(this).val();
            if (method == 'smtp') {
                $('#J_smtp').show();
            } else {
                $('#J_smtp').hide();
            }
        });

        //上传图片
        $(document).on('mouseenter.hold', '#J_upload_qrcode', function(){
            console.log('test');
            $('#J_upload_qrcode').uploader({
                action_url:$(this).attr('data-uri'),
                onComplete: function (id, fileName, result) {
                    if (result.status == '1') {
                        $('#J_qrcode').attr('src', result.data.file_url);
                    } else {
                        alert(result.data);
                    }
                }
            });
        });
    });

});