<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/flink/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="parent_id">链接分类：</label>
        <div class="controls">
            <select class="input-medium" name="cid">
                <?php foreach($list_cat as $key=>$val):?>
                <option value="<?php echo $key;?>"><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="title">链接标题：</label>
        <div class="controls">
            <input type="text" id="title" name="title">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="link">链接地址：</label>
        <div class="controls">
            <input type="text" id="link" name="link">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="255">
        </div>
    </div>
</form>