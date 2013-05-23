define(function (require) {

    $(function () {
        //检查最新版本
        function check_version() {
            $.getJSON(CHECK_PATCH_URL, function (result) {
                if (result.status == '-1') {
                    $('#J_check_version').removeClass('alert-info').addClass('alert-error').html(result.msg);
                } else if (result.status == '0') {
                    $('#J_check_version').removeClass('alert-info').addClass('alert-success').html(result.msg);
                } else {
                    $('#J_check_version').hide();
                    $('#J_upgrade_info').show();
                    $.each(result.patch_list, function (key, patch_name) {
                        $('#J_patch_list').show().find('tbody').append('<tr>' +
                            '<td class="J_patch_name tl"><span class="pull-left mr20">' + patch_name + '</span>' +
                            '<div class="J_process text-success hide"></div></td>' +
                            '<td><button class="J_patch_btn btn btn-small btn-success" type="button" data-patch-name="' + patch_name + '" data-loading-text="正在安装...">安装</button></td>' +
                            '</tr>');
                    });

                }
            });
        }
        check_version()

        //开始安装
        $('#J_patch_list').on('click.hold', '.J_patch_btn', function () {
            var self = $(this),
                patch_name = self.attr('data-patch-name');
            self.parents('tr').find('.J_process').show().html('<span class="icon-loading mr5"></span>正在下载程序升级包...');
            $.getJSON(INSTALL_PATCH_URL, {patch_name:patch_name, step:'download'}, function(result){
                if (result.status == '0') {
                    self.parents('tr').find('.J_process').removeClass('text-success').addClass('text-error');
                }
                self.parents('tr').find('.J_process').text(result.msg);
                if (result.status == '1') {
                    $.getJSON(INSTALL_PATCH_URL, {patch_name:patch_name, step:'coverfile'}, function(result){
                        if (result.status == '0') {
                            self.parents('tr').find('.J_process').removeClass('text-success').addClass('text-error');
                        }
                        self.parents('tr').find('.J_process').text(result.msg);
                        if (result.status == '1') {
                            $.getJSON(INSTALL_PATCH_URL, {patch_name:patch_name, step:'extract'}, function(result){
                                if (result.status == '0') {
                                    self.parents('tr').find('.J_process').removeClass('text-success').addClass('text-error');
                                }
                                self.parents('tr').find('.J_process').text(result.msg);
                                if (result.status == '1') {
                                    window.location.reload();
                                }
                            });
                        }
                    });
                }
            });
        });
    })
});