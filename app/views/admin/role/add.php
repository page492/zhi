<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/role/add'); ?>" method="post">
    <input type="hidden" name="type" value="<?php echo $type;?>">
    <div class="control-group">
        <label class="control-label" for="name">用户组名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name">
        </div>
    </div>
</form>