<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li<?php if ($type == 'main'): ?> class="active"<?php endif;?>><a href="<?php echo site_url('admin/nav'); ?>">主导航</a></li>
        <li<?php if ($type == 'bottom'): ?> class="active"<?php endif;?>><a href="<?php echo site_url('admin/nav/index/bottom'); ?>">底部导航</a></li>
    </ul>

    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/nav/add/' . $type); ?>" data-toggle="dialog"
           data-title="添加导航" data-id="add"><i class="icon-plus"></i> 添加导航</a>
    </div>

    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">导航名称</th>
            <th class="tl">链接地址</th>
            <th class="span1">排序</th>
            <th class="span4">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $list_html;?>
        </tbody>
    </table>
</div>
<?php echo $this->load->view('admin/common/footer'); ?>