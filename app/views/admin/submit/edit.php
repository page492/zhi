<form class="form-horizontal block-form dialog-form" data-submit="dialog" action="<?php echo site_url('admin/submit/edit'); ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $info['id'];?>">
    <div class="control-group">
        <label class="control-label" for="name">标题：</label>
        <div class="controls"><span class="control-text"><?php echo $info['title'];?></span></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">链接：</label>
        <div class="controls"><span class="control-text"><a href="<?php echo $info['link'];?>" target="_blank"><?php echo $info['link'];?></a></span></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">信息来源：</label>
        <div class="controls"><span class="control-text"><?php echo $info['origin'];?></span></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">来源网址：</label>
        <div class="controls"><span class="control-text"><a href="<?php echo $info['origin_link'];?>" target="_blank"><?php echo $info['origin_link'];?></a></span></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">推荐理由：</label>
        <div class="controls"><span class="control-text"><?php echo $info['reason'];?></span></div>
    </div>
    <div class="control-group">
        <label class="control-label" for="name">审核：</label>
        <div class="controls">
            <label class="radio inline">
                <input type="radio" name="status" value="0" <?php if ($info['status'] == '0') :?>checked<?php endif;?>> 待审
            </label>
            <label class="radio inline">
                <input type="radio" name="status" value="1" <?php if ($info['status'] == '1') :?>checked<?php endif;?>> 有效
            </label>
        </div>
    </div>
</form>