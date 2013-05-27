<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <form action="<?php echo site_url('admin/submit/delete'); ?>" method="post">
    <table class="table table-hover table-list" data-tbh="tablehold" data-uri="<?php echo site_url('admin/submit/ajax_edit');?>">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">标题</th>
            <th class="tl">链接</th>
            <th class="span2 tl">爆料人</th>
            <th class="span2">爆料时间</th>
            <th class="span1">状态</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'];?>"></td>
                <td class="tl"><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="title"><?php echo $val['title'];?></span></td>
                <td class="tl"><span class="modify" data-action="modify" data-find="{id:'<?php echo $val['id'];?>'}" data-field="link"><?php echo $val['link'];?></span></td>
                <td class="tl"><?php echo $val['username'];?></td>
                <td><?php echo date('Y-m-d H:i:s', $val['submit_time']);?></td>
                <td><span class="toggle-<?php echo $val['status'] ? 'on' : 'off'?>" data-action="toggle" data-find="{id:'<?php echo $val['id'];?>'}" data-field="status" data-value="<?php echo $val['status'];?>"></span></td>
                <td>
                    <a class="mr5" href="<?php echo site_url('admin/submit/edit/'.$val['id']);?>" data-toggle="dialog" data-title="查看详细" data-id="view"><i class="icon-zoom-in"></i>详细</a>
                    <a href="<?php echo site_url('admin/submit/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除？"><i class="icon-trash"></i>删除</a>
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