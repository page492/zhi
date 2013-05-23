<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/article_cat/add');?>" data-toggle="dialog" data-title="添加分类" data-id="add"><i class="icon-plus"></i> 添加分类</a>
    </div>
    <form action="<?php echo site_url('admin/article_cat/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">分类名称</th>
            <th class="span1">排序</th>
            <th class="span3">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $list_html;?>
        </tbody>
    </table>
    <div class="form-actions" id="J_actbar">
        <label class="checkbox pull-left ml20 mr10">
            <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem">全选/反选
        </label>
        <button type="submit" class="btn" data-toggle="ajaxfrom" data-msg="确认要删除所选分类吗？" data-loading-text="删除中...">删除</button>
    </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>