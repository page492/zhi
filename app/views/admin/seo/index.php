<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <form class="form-horizontal block-form" method="post">
        <div class="bottom-line block-title">功能说明</div>
        <p class="bottom-line p10">
            SEO信息中可以直接输入文字，也可以使用代码。<br/>
            全局变量：{sitename} 站点名称
        </p>
        <?php foreach ($list as $key => $val) :?>
        <div class="bottom-line block-title"><?php echo $val['page'];?></div>
        <?php if (!empty($val['code_help'])):?>
        <p class="bottom-line p10"><?php echo $val['code_help'];?></p>
        <?php endif;?>
        <input type="hidden" name="seo[<?php echo $key;?>][alias]" value="<?php echo $val['alias'];?>">
        <div class="control-group">
            <label class="control-label">title [标题]</label>
            <div class="controls">
                <input type="text" class="span5" name="seo[<?php echo $key;?>][title]" value="<?php echo $val['title'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">keywords [关键字]</label>
            <div class="controls">
                <input type="text" class="span5" name="seo[<?php echo $key;?>][keywords]" value="<?php echo $val['keywords'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">description [描述]</label>
            <div class="controls">
                <input type="text" class="span5" name="seo[<?php echo $key;?>][description]" value="<?php echo $val['description'];?>">
            </div>
        </div>
        <?php endforeach;?>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>

</div>

<?php echo $this->load->view('admin/common/footer'); ?>