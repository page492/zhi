define(function(require) {

    require('uploader');

    $(function() {

        //上传LOGO
        $(document).on('mouseenter.hold', '#J_upload_logo', function(){
            $('#J_upload_logo').uploader({action_url:$(this).attr('data-uri'), input_id:'J_logo'});
        });

    })
});