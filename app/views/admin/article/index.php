<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/article/add');?>"><i class="icon-plus"></i> 添加文章</a>
    </div>
    <form action="<?php echo site_url('admin/article/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">标题</th>
            <th class="span1">排序</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'] ?>"></td>
                <td class="tl"><?php echo $val['title']?></td>
                <td><?php echo $val['orderid']?></td>
                <td>
                    <a href="<?php echo site_url('admin/article/edit/'.$val['id']);?>" class="mr5"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/article/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除文章？"><i class="icon-trash"></i>删除</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-actions" id="J_actbar">
        <label class="checkbox pull-left ml20 mr10">
            <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem">全选/反选
        </label>
        <button type="submit" class="btn" data-toggle="ajaxfrom" data-msg="确认要删除所选文章吗？" data-loading-text="删除中...">删除</button>
        <div class="pagination pagination-small pull-right">
            <?php echo $page?>
        </div>
    </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>