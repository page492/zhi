<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/database'); ?>">数据库备份</a></li>
        <li class="active"><a href="<?php echo site_url('admin/database/restore'); ?>">数据库恢复</a></li>
    </ul>

    <form action="<?php echo site_url('admin/database/delete'); ?>" method="post">
        <table class="table table-hover table-list">
            <thead>
            <tr>
                <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
                <th class="tl">备份文件</th>
                <th>备份时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($files as $val) :; ?>
                <tr>
                    <td><input type="checkbox" class="J_checkitem" name="files[]" value="<?php echo $val['name']; ?>"></td>
                    <td class="tl"><?php echo $val['name']; ?></td>
                    <td><?php echo $val['ctime'] ?></td>
                    <td><a href="<?php echo site_url('admin/database/restore/'.$val['name']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要导入备份？"><i class="icon-upload"></i> 导入</a></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="form-actions" id="J_actbar">
            <label class="checkbox pull-left ml20 mr10">
                <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem">全选/反选
            </label>
            <button type="submit" class="btn btn-primary mr10" data-toggle="ajaxfrom" data-loading-text="删除中...">删除</button>
        </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>