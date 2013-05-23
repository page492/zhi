<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/flink_cat/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="name">分类名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="255">
        </div>
    </div>
</form>