<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/nav/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="parent_id">上级菜单：</label>
        <div class="controls">
            <select class="input-medium" name="parent_id">
                <option value='0'>—顶级导航—</option>
                <?php echo $list_select;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">导航名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name" value="<?php echo $info['name'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="link">链接地址：</label>
        <div class="controls">
            <input type="text" id="link" name="link" value="<?php echo $info['link'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="<?php echo $info['orderid'];?>">
        </div>
    </div>
</form>