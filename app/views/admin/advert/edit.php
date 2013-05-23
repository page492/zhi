<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/advert/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="title">广告标题：</label>
        <div class="controls">
            <input type="text" id="title" name="title" value="<?php echo $info['title'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="link">广告链接：</label>
        <div class="controls">
            <input type="text" class="input-xlarge" id="link" name="link" value="<?php echo $info['link'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="pt_id">广告位置：</label>
        <div class="controls">
            <select id="pt_id" name="pt_id">
                <?php foreach ($pt_list as $key => $val) :?>
                <option value="<?php echo $key;?>" <?php if ($key == $info['pt_id']) :?>selected<?php endif;?>><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="J_type">广告类型：</label>
        <div class="controls">
            <select class="span2" id="J_type" name="type">
                <?php foreach ($advert_type as $key => $val) :?>
                    <option value="<?php echo $key;?>" <?php if ($info['type'] == $key) :?>selected<?php endif;?>><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div id="J_text_b" class="control-group advert_content <?php if ($info['type'] != 'text') :?>hide<?php endif;?>">
        <label class="control-label" for="text">文字：</label>
        <div class="controls">
            <textarea class="span4" rows="3" id="text" name="text"><?php echo $info['content'];?></textarea>
        </div>
    </div>
    <div id="J_code_b" class="control-group advert_content <?php if ($info['type'] != 'code') :?>hide<?php endif;?>">
        <label class="control-label" for="code">代码：</label>
        <div class="controls">
            <textarea class="span4" rows="3" id="code" name="code"><?php echo $info['content'];?></textarea>
        </div>
    </div>
    <div id="J_img_b" class="control-group advert_content <?php if ($info['type'] != 'img') :?>hide<?php endif;?>">
        <label class="control-label" for="J_img">图片：</label>
        <div class="controls">
            <div class="input-append">
                <input type="text" id="J_img" name="img" value="<?php echo $info['content'];?>">
                <button class="btn" type="button" id="J_upload_img" data-uri="<?php echo site_url('admin/advert/upload_img')?>">上传</button>
            </div>
        </div>
    </div>
    <div id="J_flash_b" class="control-group advert_content <?php if ($info['type'] != 'flash') :?>hide<?php endif;?>">
        <label class="control-label">动画：</label>
        <div class="controls">
            <div class="input-append">
                <input type="text" id="J_flash" name="flash" value="<?php echo $info['content'];?>">
                <button class="btn" type="button" id="J_upload_flash" data-uri="<?php echo site_url('admin/advert/upload_flash')?>">上传</button>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="intro">广告描述：</label>
        <div class="controls">
            <input type="text" class="input-xlarge" id="intro" name="intro" value="<?php echo $info['intro'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="start_time">有效时间：</label>
        <div class="controls">
            <div id="J_start_time" class="input-append">
                <input name="start_time" class="input-small" data-format="yyyy-MM-dd" type="text" value="<?php echo date('Y-m-d', $info['start_time']);?>">
                <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
            </div>
            <div id="J_end_time" class="input-append">
                <input name="end_time" class="input-small" data-format="yyyy-MM-dd" type="text" value="<?php echo date('Y-m-d', $info['end_time']);?>">
                <span class="add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="<?php echo $info['orderid'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">是否显示：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="isshow" value="1" <?php if ($info['isshow']) :?>checked<?php endif;?>> 显示
            </label>
            <label class="radio inline">
                <input type="radio" name="isshow" value="0" <?php if (!$info['isshow']) :?>checked<?php endif;?>> 隐藏
            </label>
        </div>
    </div>
</form>
<script>
    $(function(){
        $('#J_start_time').datetimepicker({
            pickTime: false
        });
        $('#J_end_time').datetimepicker({
            pickTime: false
        });
    });
</script>