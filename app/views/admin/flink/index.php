<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li class="active"><a href="<?php echo site_url('admin/flink'); ?>">链接列表</a></li>
        <li><a href="<?php echo site_url('admin/flink_cat'); ?>">链接分类</a></li>
    </ul>

    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/flink/add/'); ?>" data-toggle="dialog" data-title="添加友链" data-id="add"><i class="icon-plus"></i> 添加友链</a>
    </div>

    <form action="<?php echo site_url('admin/flink/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="span1 tl">ID</th>
            <th class="tl">标题</th>
            <th class="tl">地址</th>
            <th class="span3">分类</th>
            <th class="span1">排序</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['id'];?></td>
                <td class="tl"><?php echo $val['title'];?></td>
                <td class="tl"><?php echo $val['link'];?></td>
                <td><?php echo $list_cat[$val['cid']];?></td>
                <td><?php echo $val['orderid'];?></td>
                <td>
                    <a class="mr5" href="<?php echo site_url('admin/flink/edit/'.$val['id']);?>" data-toggle="dialog" data-title="编辑链接" data-id="edit"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/flink/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除？"><i class="icon-trash"></i>删除</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-actions" id="J_actbar">
        <label class="checkbox pull-left ml20 mr10">
            <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem">全选/反选
        </label>
        <button type="submit" class="btn" data-toggle="ajaxfrom" data-msg="确认要删除吗？" data-loading-text="删除中...">删除</button>
        <div class="pagination pagination-small pull-right">
            <?php echo $page;?>
        </div>
    </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>