<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/article');?>">文章列表</a></li>
        <li class="active"><a href="<?php echo site_url('admin/article/edit');?>">编辑文章</a></li>
    </ul>

    <form class="form-horizontal block-form" method="post">
        <input type="hidden" name="id" value="<?php echo $info['id'];?>">
        <div class="control-group">
            <label class="control-label" for="title">标题：</label>
            <div class="controls">
                <input class="span10" type="text" name="title" id="title" value="<?php echo $info['title'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="cid">分类：</label>
            <div class="controls">
                <select class="input-medium" name="cid" id="cid">
                    <?php echo $cat_select;?>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="content">内容：</label>
            <div class="controls">
                <textarea class="hide" name="content" id="content"><?php echo $info['content'];?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="seo_keywords">SEO关键字：</label>
            <div class="controls">
                <input name="seo_keywords" class="span10" type="text" id="seo_keywords" value="<?php echo $info['seo_keywords'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="seo_description">SEO描述文字：</label>
            <div class="controls">
                <textarea name="seo_description" class="span10" rows="3" id="seo_description"><?php echo $info['seo_description'];?></textarea>
            </div>
        </div>
        <div class="form-actions form-actions-fixed">
            <button type="submit" class="btn btn-primary ml20" id="J_publish" data-toggle="ajaxfrom" data-loading-text="发布中...">发布</button>
        </div>
    </form>
</div>
<script>
    var UPLOAD_URL = '<?php echo site_url('admin/article/upload_editor');?>';
</script>
<?php echo $this->load->view('admin/common/footer'); ?>
</body>
</html>