<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/mall/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="parent_id">商城分类：</label>
        <div class="controls">
            <select class="input-medium" name="cid">
                <?php foreach($list_cat as $key=>$val):?>
                <option value="<?php echo $key;?>" <?php if ($info['cid'] == $key) :?>selected<?php endif;?>><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">商城名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name" value="<?php echo $info['name']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="alias">英文名称：</label>
        <div class="controls">
            <input type="text" id="alias" name="alias" value="<?php echo $info['alias']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="link">商城地址：</label>
        <div class="controls">
            <input type="text" id="link" name="link" value="<?php echo $info['link']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="J_logo">商城LOGO：</label>
        <div class="controls">
            <div class="input-append">
                <input type="text" id="J_logo" name="logo" value="<?php echo $info['logo']; ?>">
                <button class="btn" type="button" id="J_upload_logo" data-uri="<?php echo site_url('admin/mall/upload_logo')?>">上传</button>
            </div>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="code">商城介绍：</label>
        <div class="controls">
            <textarea class="span4" rows="3" id="intro" name="intro"><?php echo $info['intro']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">是否显示：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="isshow" value="1" <?php if ($info['isshow']) :?>checked<?php endif;?>> 显示
            </label>
            <label class="radio inline">
                <input type="radio" name="isshow" value="0" <?php if (!$info['isshow']) :?>checked<?php endif;?>> 隐藏
            </label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">推荐：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="isrcd" value="1" <?php if ($info['isrcd']) :?>checked<?php endif;?>> 是
            </label>
            <label class="radio inline">
                <input type="radio" name="isrcd" value="0" <?php if (!$info['isrcd']) :?>checked<?php endif;?>> 否
            </label>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="<?php echo $info['orderid'];?>">
        </div>
    </div>
</form>