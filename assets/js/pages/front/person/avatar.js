define(function (require) {

    require('uploader');
    require('imgareaselect');

    $(function(){

        $('#J_avatarform').ajaxForm({
            dataType: 'json',
            success: function (result) {
                if (result.status == '0') {
                    $.hold.tip(result.msg, 'alert');
                } else {
                    window.location.reload();
                }
            }
        });

        $('#J_cancelbtn').on('click.hold', function(){
            window.location.reload();
        });

        //上传图片
        $('#J_upload_btn').uploader({
            onComplete: function(id, fileName, result){
                if(result.status == '1'){
                    var img = result.data,iw,ih,scale;
                    if (img.width >= img.height) {
                        iw = img.width > 240 ? 240 : img.width;
                        ih = iw * img.height / img.width;
                    } else {
                        ih = img.height > 240 ? 240 : img.height;
                        iw = ih * img.width / img.height;
                    }
                    scale = img.width / iw;
                    $('#J_scale').val(scale);
                    $('#J_upload').hide();
                    $('<img id="J_show_img" src="'+img.viewfile+'" width="'+iw+'" height="'+ih+'" />').appendTo('#J_show');
                    $('#J_show').show();
                    $('#J_avatarb img').attr('src', img.viewfile);
                    $('#J_avatarm img').attr('src', img.viewfile);
                    $('#J_avatars img').attr('src', img.viewfile);
                    $('#J_file').val(img.file_name);
                    var x1,y1,x2,y2,sw,sh;
                    if (iw == ih) {
                        x1 = y1 = 0;
                        sw = sh = x2 = y2 = iw;
                    } else if (iw > ih) {
                        x1 = (iw - ih)/2;
                        x2 = x1 + ih;
                        y1 = 0;
                        sw = sh = y2 = ih;
                    } else {
                        x1 = 0
                        sw = sh = x2 = iw;
                        y1 = (ih - iw)/2;
                        y2 = x1 + iw;
                    }
                    $('#J_show_img').imgAreaSelect({
                        x1: x1, y1: y1, x2: x2, y2: y2,
                        aspectRatio: '1:1',
                        handles: true,
                        onSelectChange: preview
                    });
                    change_preview(iw, ih, sw, sh, x1, y1, x2, y2);
                }else if (result.status == '0'){
                    alert(result.msg);
                }
            }
        });

        //缩略图预览
        var preview = function(img, selection) {
            if (!selection.width || !selection.height)
                return;
            change_preview(img.width, img.height, selection.width, selection.height, selection.x1, selection.y1, selection.x2, selection.y2);
        }

        var change_preview = function(iw, ih, sw, sh, x1, y1, x2, y2) {
            var scaleBX = 180 / sw,
                scaleBY = 180 / sh,
                scaleMX = 80 / sw,
                scaleMY = 80 / sh,
                scaleSX = 40 / sw,
                scaleSY = 40 / sh;

            $('#J_avatarb img').css({
                width: Math.round(scaleBX * iw),
                height: Math.round(scaleBY * ih),
                marginLeft: -Math.round(scaleBX * x1),
                marginTop: -Math.round(scaleBY * y1)
            });
            $('#J_avatarm img').css({
                width: Math.round(scaleMX * iw),
                height: Math.round(scaleMY * ih),
                marginLeft: -Math.round(scaleMX * x1),
                marginTop: -Math.round(scaleMY * y1)
            });
            $('#J_avatars img').css({
                width: Math.round(scaleSX * iw),
                height: Math.round(scaleSY * ih),
                marginLeft: -Math.round(scaleSX * x1),
                marginTop: -Math.round(scaleSY * y1)
            });
            $('#J_xs').val(x1);
            $('#J_xe').val(x2);
            $('#J_ys').val(y1);
            $('#J_ye').val(y2);
        }

    });
});