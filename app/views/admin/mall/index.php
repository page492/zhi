<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/mall/add/'); ?>" data-toggle="dialog" data-title="添加商城" data-id="add"><i class="icon-plus"></i> 添加商城</a>
    </div>

    <form action="<?php echo site_url('admin/mall/delete'); ?>" method="post">
    <table class="table table-hover table-list" data-tbh="tablehold" data-uri="<?php echo site_url('admin/mall/ajax_edit');?>">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="span1">ID</th>
            <th class="span2">商城LOGO</th>
            <th>商城名称</th>
            <th>英文名称</th>
            <th class="tl">商城地址</th>
            <th class="span1">排序</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'];?>"></td>
                <td><?php echo $val['id'];?></td>
                <td><?php if (!empty($val['logo'])) :?><img src="<?php echo base_url('data/upload/mall/'.$val['logo']);?>" width="100" /><?php endif;?></td>
                <td><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="name"><?php echo $val['name'];?></span></td>
                <td><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="alias"><?php echo $val['alias'];?></span></td>
                <td class="tl"><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="link"><?php echo $val['link'];?></span></td>
                <td><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="orderid"><?php echo $val['orderid'];?></span></td>
                <td>
                    <a class="mr5" href="<?php echo site_url('admin/mall/edit/'.$val['id']);?>" data-toggle="dialog" data-title="编辑商城" data-id="edit"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/mall/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除？"><i class="icon-trash"></i>删除</a>
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