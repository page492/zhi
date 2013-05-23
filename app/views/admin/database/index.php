<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li class="active"><a href="<?php echo site_url('admin/database'); ?>">数据库备份</a></li>
        <li><a href="<?php echo site_url('admin/database/restore'); ?>">数据库恢复</a></li>
    </ul>

    <form action="<?php echo site_url('admin/database/pl_backup'); ?>" method="post">
        <table class="table table-hover table-list">
            <thead>
            <tr>
                <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem" checked></th>
                <th class="tl">表名</th>
                <th class="tl">描述</th>
                <th>记录数</th>
                <th>大小</th>
                <th>更新时间</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tables as $val) :; ?>
                <tr>
                    <td><input type="checkbox" class="J_checkitem" name="name[]" value="<?php echo $val['Name'] ?>" checked></td>
                    <td class="tl"><?php echo $val['Name'] ?></td>
                    <td class="tl"><?php echo $val['Comment'] ?></td>
                    <td><?php echo $val['Rows'] ?></td>
                    <td><?php echo $val['Data_length'] ?></td>
                    <td><?php echo $val['Update_time'] ?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <div class="form-actions" id="J_actbar">
            <label class="checkbox pull-left ml20 mr10">
                <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem" checked>全选/反选
            </label>
            <button type="submit" class="btn btn-primary mr10" data-toggle="ajaxfrom" data-loading-text="备份中...">备份</button>
            <button type="submit" class="btn mr10" data-toggle="ajaxfrom" data-action="<?php echo site_url('admin/database/pl_repair'); ?>" data-loading-text="修复中...">修复</button>
            <button type="submit" class="btn" data-toggle="ajaxfrom" data-action="<?php echo site_url('admin/database/pl_optimize'); ?>" data-loading-text="优化中...">优化</button>
        </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>