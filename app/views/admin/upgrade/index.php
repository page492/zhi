<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <div class="alert alert-info" id="J_check_version"><span class="icon-loading mr5"></span>正在检测可升级版本，请稍候…</div>

    <div class="alert hide" id="J_upgrade_info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>注意：</strong> 升级程序有可能覆盖模版文件，请注意备份！linux服务器需检查文件所有者权限和组权限，确保 webserver 用户有文件写入权限。
    </div>

    <table class="table table-hover table-list hide" id="J_patch_list">
        <thead>
        <tr>
            <th class="tl">可用升级包</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody></tbody>
    </table>

</div>
<script>
var CHECK_PATCH_URL  = '<?php echo site_url('admin/upgrade/pl_check_patch'); ?>',
    INSTALL_PATCH_URL = '<?php echo site_url('admin/upgrade/pl_install_patch'); ?>';
</script>
<?php echo $this->load->view('admin/common/footer'); ?>