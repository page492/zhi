define(function (require) {

    $(function () {

        //编辑器
        if ($('textarea[name="message"]')[0]) {
            require('ckeditor');
            CKEDITOR.replace('message', {height:300});
            $('#J_publish').on('click.hold', function(e){
                $('#message').val(CKEDITOR.instances.message.getData());
                e.preventDefault();
            });
        }

    });

});