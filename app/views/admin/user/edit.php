<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/user/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="parent_id">用户组：</label>
        <div class="controls">
            <select class="input-medium" name="role_id">
                <?php foreach($list_role as $key=>$val):?>
                <option value="<?php echo $key;?>" <?php if ($key == $info['role_id']):?>selected<?php endif;?>><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="username">用户名：</label>
        <div class="controls">
            <input type="text" id="username" name="username" value="<?php echo $info['username'];?>">
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
            <input type="text" id="email" name="email" value="<?php echo $info['email'];?>">
        </div>
    </div>
</form>