define(function (require) {

    require('dialog');
    require('ajaxForm');

    (function ($) {
        $.hold = $.hold || {version: "v1.0.0"};

        //全选反选
        $(document).on('click.hold', '[data-toggle="chackall"]', function () {
            var target = $($(this).attr('data-target'));
            target.prop('checked', this.checked);
            $(this).prop('checked', this.checked);
        });

        //上传文件
        $.fn.uploader = function (options) {
            var settings = {
                btnid: $(this).attr('id'),
                action_url: $(this).attr('data-uri'),
                input_id: 'J_img',
                input_name: 'img',
                showMessage: function (message) {
                    alert(message);
                },
                onSubmit: function (id, fileName) {
                },
                onComplete: function (id, fileName, result) {
                    if (result.status == '1') {
                        $('#' + settings.input_id).val(result.data.file_name);
                    } else {
                        alert(result.data);
                    }
                }
            };
            if (options) {
                $.extend(settings, options);
            }
            new qq.FileUploaderBasic({
                allowedExtensions: ['jpg', 'gif', 'jpeg', 'png', 'bmp', 'pdg', 'swf'],
                button: document.getElementById(settings.btnid),
                multiple: false,
                action: settings.action_url,
                inputName: settings.input_name,
                forceMultipart: true, //用$_FILES
                messages: {
                    typeError: '不允许上传的文件类型！',
                    sizeError: '文件大小不能超过{sizeLimit}！',
                    minSizeError: '文件大小不能小于{minSizeLimit}！',
                    emptyError: '文件为空，请重新选择！',
                    noFilesError: '没有选择要上传的文件！',
                    onLeave: '正在上传文件，离开此页将取消上传！'
                },
                showMessage: settings.showMessage,
                onSubmit: settings.onSubmit,
                onComplete: settings.onComplete
            });
        }

    })(jQuery);
});