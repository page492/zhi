<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/article_cat/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="parent_id">上级分类：</label>
        <div class="controls">
            <select class="input-medium" name="parent_id">
                <option value='0'>—顶级分类—</option>
                <?php echo $list_select;?>
            </select>
        </div>
    </div>
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