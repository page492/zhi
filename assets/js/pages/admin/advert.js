define(function(require) {

    require('uploader');
    require('datetimepicker');

    $(function() {

        $(document).on('change.hold', '#J_type', function(){
            var type = $(this).val();
            $('.advert_content').addClass('hide');
            $('#J_'+type+'_b').removeClass('hide');
        });

        //上传图片
        $(document).on('mouseenter.hold', '#J_upload_img', function(){
            $('#J_upload_img').uploader({action_url:$(this).attr('data-uri'), input_id:'J_img'});
        });

        //上传动画
        $(document).on('mouseenter.hold', '#J_upload_flash', function(){
            $('#J_upload_flash').uploader({action_url:$(this).attr('data-uri'), input_id:'J_flash'});
        });
    })
});