<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/advert_pt/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="name">位置名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="view">广告模板：</label>
        <div class="controls">
            <select id="view" name="view">
                <?php foreach ($tpl_list as $key => $val) :?>
                <option value="<?php echo $key;?>"><?php echo $val['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description">描述：</label>
        <div class="controls">
            <textarea class="span4" rows="3" id="description" name="description"></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">是否显示：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="isshow" value="1" checked> 显示
            </label>
            <label class="radio inline">
                <input type="radio" name="isshow" value="0"> 隐藏
            </label>
        </div>
    </div>
</form>