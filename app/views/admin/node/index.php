<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/node/add');?>" data-toggle="dialog" data-title="添加菜单" data-id="add"><i class="icon-plus"></i> 添加菜单</a>
    </div>

    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">节点名称</th>
            <th class="span1">排序</th>
            <th class="span3">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php echo $list_html;?>
        </tbody>
    </table>
</div>
<?php echo $this->load->view('admin/common/footer'); ?>