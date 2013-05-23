define(function (require) {

    $(function () {
        //编辑器
        if ($('textarea[name="content"]')[0]) {
            require('ckeditor');
            CKEDITOR.replace('content', {height:250, width:778, filebrowserUploadUrl:UPLOAD_URL});
            $('#J_publish').on('click.hold', function(e){
                $('#content').val(CKEDITOR.instances.content.getData());
                e.preventDefault();
            });
        }
    });

});