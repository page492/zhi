<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/mall_cat/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="name">分类名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="J_icon">分类图标：</label>
        <div class="controls">
            <div class="input-append">
                <input type="text" id="J_icon" name="icon">
                <button class="btn" type="button" id="J_upload_icon" data-uri="<?php echo site_url('admin/mall_cat/upload_icon')?>">上传</button>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="255">
        </div>
    </div>
</form>