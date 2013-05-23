define(function (require) {

    require('uploader');
    require('datetimepicker');

    $(function () {

        //上传图片
        $(document).on('mouseenter.hold', '#J_upload_img', function(){
            $('#J_upload_img').uploader({onComplete: function (id, fileName, result) {
                if (result.status == '1') {
                    var _img = result.data;
                    $('#J_preview').show().find('img').attr('src', _img.file_path + '/' + _img.file_name);
                    $('#J_img').val(_img.file_name);
                } else {
                    alert(result.msg);
                }
            }});
        });

        //添加链接
        $.hold.postlink = {
            settings: {
                link_con: '#J_linkdiv',
                link_unit: '.J_link',
                link_mid: '.J_mid',
                add_btn: '.J_addlink',
                del_btn: '.J_dellink'
            },
            autotitle: function() {
                var s = $.hold.postlink.settings;
                $(s.link_con).on('change.hold', 'select[name="link_mid[]"]', function () {
                    $(this).siblings('input[name="link_title[]"]').val($(this).find('option:selected').text());
                });
            },
            add: function () {
                var s = $.hold.postlink.settings;
                $(s.link_con).on('click.hold', s.add_btn, function () {
                    $(this).before($(s.link_unit + ':first', s.link_con).clone().append('<button class="' + s.del_btn.substr(1) + ' btn btn-small ml10" type="button"><i class="icon-minus-sign"></i> 删除</button>'));
                });
            },
            del: function () {
                var s = $.hold.postlink.settings;
                $(s.link_con).on('click.hold', s.del_btn, function () {
                    $(this).parent().remove();
                });
            },
            init: function (options) {
                options && $.extend($.hold.postlink.settings, options);
                $.hold.postlink.add();
                $.hold.postlink.del();
                $.hold.postlink.autotitle();
            }
        }
        $.hold.postlink.init();

        //标签
        $.hold.tagbox = {
            settings: {
                tag_con: '#J_tagsdiv',
                tag_input: '.J_tags',
                tag_list: '.J_taglist',
                add_input: '.J_newtag',
                add_btn: '.J_addtag',
                del_btn: '.J_deltag'
            },
            //自动载入
            autotag: function () {
                var s = $.hold.tagbox.settings,
                    current_tags = $(s.tag_input, s.tag_con).val().split(',');
                $(s.tag_list, s.tag_con).html('');
                $.each(current_tags, function (key, val) {
                    $('<span>' + val + '<a class="' + s.del_btn.substr(1) + '" data-hold-tag="' + val + '">×</a></span>').appendTo(s.tag_list, s.tag_con);
                });
            },
            //添加标签
            add: function () {
                var s = $.hold.tagbox.settings,
                    tagsval = $(s.tag_input, s.tag_con).val(),
                    current_tags = tagsval.split(','),
                    newtag = $(s.add_input, s.tag_con).val().split(',');
                $.each(newtag, function (key, val) {
                    if (val && $.inArray(val, current_tags) == -1) {
                        $(s.tag_input, s.tag_con).val(tagsval + ',' + val);
                        $('<span>' + val + '<a class="' + s.del_btn.substr(1) + '" data-hold-tag="' + val + '">×</a></span>').appendTo(s.tag_list, s.tag_con);
                    }
                });
                $(s.add_input, s.tag_con).val('').focus();
            },
            //删除标签
            del: function (el) {
                var s = $.hold.tagbox.settings,
                    current_tags = $(s.tag_input, s.tag_con).val().split(','),
                    deltag = el.attr('data-hold-tag'),
                    new_tags = [];
                $.each(current_tags, function (key, val) {
                    if (val && val != deltag) {
                        new_tags.push(val);
                    }
                });
                $(s.tag_input, s.tag_con).val(new_tags.join(','));
                el.parent().remove();
            },
            //初始化
            init: function (options) {
                options && $.extend($.hold.tagbox.settings, options);
                var s = $.hold.tagbox.settings;
                if ($(s.tag_input, s.tag_con)[0] && $(s.tag_input, s.tag_con).val() != '') {
                    $.hold.tagbox.autotag();
                }
                $(s.tag_con).on('click.hold', s.del_btn, function () {
                    $.hold.tagbox.del($(this));
                });
                $(s.tag_con).on('click.hold', s.add_btn, function () {
                    $.hold.tagbox.add();
                });
            }
        }
        $.hold.tagbox.init();

        //自动获取标签
        $('#J_title').on('blur', function(){
            var title = $(this).val();
            if (title) {
                $.getJSON(GET_TAG_URL, {str: title}, function(result){
                    $($.hold.tagbox.settings.tag_input).val(result);
                    $.hold.tagbox.autotag();
                });
            }
        });

        //编辑器
        if ($('textarea[name="content"]')[0]) {
            require('ckeditor');
            CKEDITOR.replace('content', {height:350,filebrowserUploadUrl:UPLOAD_URL});
            $('#J_publish').on('click.hold', function(e){
                $('#content').val(CKEDITOR.instances.content.getData());
                e.preventDefault();
            });
        }

        $('#J_post_time').datetimepicker();

    });

});