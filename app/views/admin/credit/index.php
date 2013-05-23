<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/credit/setting'); ?>">积分规则</a></li>
        <li class="active"><a href="<?php echo site_url('admin/credit'); ?>">积分记录</a></li>
    </ul>

    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="tl">用户</th>
            <th class="tl">操作</th>
            <th class="tl">积分</th>
            <th class="span2">时间</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td class="tl"><?php echo $val['uname'];?></td>
                <td class="tl"><?php echo $val['action'];?></td>
                <td class="tl"><?php echo $val['credit'];?></td>
                <td class="tl"><?php echo date('Y-m-d H:i:s', $val['log_time']);?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-actions" id="J_actbar">
        <div class="pagination pagination-small pull-right">
            <?php echo $page;?>
        </div>
    </div>

</div>

<?php echo $this->load->view('admin/common/footer'); ?>