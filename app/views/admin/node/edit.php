<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/node/edit'); ?>" method="post">
    <input type="hidden" name="node_id" value="<?php echo $info['node_id'];?>">
    <div class="control-group">
        <label class="control-label" for="parent_id">上级菜单：</label>
        <div class="controls">
            <select class="input-medium" name="parent_id">
                <option value='0'>—顶级菜单—</option>
                <?php echo $list_select;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">菜单名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name" value="<?php echo $info['name'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="controller">控制器：</label>
        <div class="controls">
            <input type="text" id="controller" name="controller" value="<?php echo $info['controller'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="method">方法：</label>
        <div class="controls">
            <input type="text" id="method" name="method" value="<?php echo $info['method'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="<?php echo $info['orderid'];?>">
        </div>
    </div>
</form>