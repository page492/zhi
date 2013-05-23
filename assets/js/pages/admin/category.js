define(function(require) {

    require('uploader');

    $(function () {

        //上传图片
        $(document).on('mouseenter.hold', '#J_upload_icon', function(){
            $('#J_upload_icon').uploader({action_url:$(this).attr('data-uri'), input_id:'J_icon'});
        });

    });
});