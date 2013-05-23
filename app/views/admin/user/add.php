<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/user/add'); ?>" method="post">
    <div class="control-group">
        <label class="control-label" for="parent_id">用户组：</label>
        <div class="controls">
            <select class="input-medium" name="role_id">
                <?php foreach($list_role as $key=>$val):?>
                <option value="<?php echo $key;?>"><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="username">用户名：</label>
        <div class="controls">
            <input type="text" id="username" name="username">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">密码：</label>
        <div class="controls">
            <input type="text" id="password" name="password">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="email">电子邮件：</label>
        <div class="controls">
            <input type="text" id="email" name="email">
        </div>
    </div>
</form>