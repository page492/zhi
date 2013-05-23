<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/advert_pt/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="name">位置名称：</label>
        <div class="controls">
            <input type="text" id="name" name="name" value="<?php echo $info['name'];?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="view">广告模板：</label>
        <div class="controls">
            <select id="view" name="view">
                <?php foreach ($tpl_list as $key => $val) :?>
                <option value="<?php echo $key;?>" <?php if ($info['view'] == $key) :?>selected<?php endif;?>><?php echo $val['name'];?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="description">描述：</label>
        <div class="controls">
            <textarea class="span4" rows="3" id="description" name="description"><?php echo $info['description'];?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">是否显示：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="isshow" value="1" <?php if ($info['isshow'] == '1') :?>checked<?php endif;?>> 显示
            </label>
            <label class="radio inline">
                <input type="radio" name="isshow" value="0" <?php if ($info['isshow'] == '0') :?>checked<?php endif;?>> 隐藏
            </label>
        </div>
    </div>
</form>