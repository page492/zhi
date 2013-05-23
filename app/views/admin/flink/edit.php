<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/flink/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="parent_id">链接分类：</label>
        <div class="controls">
            <select class="input-medium" name="cid">
                <?php foreach($list_cat as $key=>$val):?>
                <option value="<?php echo $key;?>" <?php if ($info['cid'] == $key) :?>selected<?php endif;?>><?php echo $val;?></option>
                <?php endforeach;?>
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="title">链接标题：</label>
        <div class="controls">
            <input type="text" id="name" name="title" value="<?php echo $info['title']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="link">链接地址：</label>
        <div class="controls">
            <input type="text" id="link" name="link" value="<?php echo $info['link']; ?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="orderid">显示顺序：</label>
        <div class="controls">
            <input type="number" id="orderid" name="orderid" min="1" max="255" value="<?php echo $info['orderid'];?>">
        </div>
    </div>
</form>