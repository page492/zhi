<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/tag/edit'); ?>" method="post">
    <input type="hidden" name="cid" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="name">标签名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name" value="<?php echo $info['name'];?>">
        </div>
    </div>
</form>