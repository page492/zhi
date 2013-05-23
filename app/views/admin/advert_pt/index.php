<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/advert'); ?>">广告列表</a></li>
        <li class="active"><a href="<?php echo site_url('admin/advert_pt'); ?>">广告位置</a></li>
    </ul>

    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/advert_pt/add/'); ?>" data-toggle="dialog" data-title="添加位置" data-id="add"><i class="icon-plus"></i> 添加位置</a>
    </div>

    <form action="<?php echo site_url('admin/advert_pt/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="span1">ID</th>
            <th class="tl">名称</th>
            <th class="tl">模板</th>
            <th class="span3">描述</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['id'];?></td>
                <td class="tl"><?php echo $val['name'];?></td>
                <td class="tl"><?php echo $tpl_list[$val['view']]['name'];?></td>
                <td class="tl"><?php echo $val['description'];?></td>
                <td>
                    <a class="mr5" href="<?php echo site_url('admin/advert_pt/edit/'.$val['id']);?>" data-toggle="dialog" data-title="编辑" data-id="edit"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/advert_pt/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除？"><i class="icon-trash"></i>删除</a>
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