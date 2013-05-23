<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <div class="bottom-line block-title">搜索</div>
    <form class="form-inline mb10 p10 bottom-line">
        <label>用户名：</label>
        <input type="text" class="input-medium mr20" name="username" value="<?php echo $search['username'];?>">
        <button type="submit" class="btn">搜索</button>
    </form>

    <div class="mb10">
        <a class="btn btn-small" href="<?php echo site_url('admin/user/add/'); ?>" data-toggle="dialog" data-title="添加用户" data-id="add"><i class="icon-plus"></i> 添加用户</a>
    </div>

    <form action="<?php echo site_url('admin/user/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="span1 tl">ID</th>
            <th class="tl">用户名</th>
            <th class="tl">电子邮箱</th>
            <th class="tl">用户组</th>
            <th class="tl">注册时间</th>
            <th class="tl">登陆时间</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'];?>"></td>
                <td class="tl"><?php echo $val['id'];?></td>
                <td class="tl"><?php echo $val['username'];?></td>
                <td class="tl"><?php echo $val['email'];?></td>
                <td class="tl"><?php echo $list_role[$val['role_id']];?></td>
                <td class="tl"><?php echo date('Y-m-d H:i:s', $val['create_time']);?></td>
                <td class="tl">
                    <?php if ($val['last_time']) :?>
                    <?php echo date('Y-m-d H:i:s', $val['last_time']);?></td>
                    <?php endif;?>
                <td>
                    <a class="mr5" href="<?php echo site_url('admin/user/edit/'.$val['id']);?>" data-toggle="dialog" data-title="编辑用户" data-id="edit"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/user/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除？"><i class="icon-trash"></i>删除</a>
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