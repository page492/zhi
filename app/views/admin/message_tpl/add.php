<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <form class="form-horizontal block-form" method="post" action="<?php echo site_url('admin/message_tpl/add');?>">
        <div class="control-group">
            <label class="control-label" for="title">标题：</label>
            <div class="controls">
                <input type="text" class="input-xxlarge" id="title" name="title">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="code">标识：</label>
            <div class="controls">
                <input type="text" id="code" name="code">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="message">内容：</label>
            <div class="controls"><textarea class="hide" name="message" id="message"></textarea></div>
        </div>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary ml20" id="J_publish" data-toggle="ajaxfrom" data-loading-textdddd="提交中...">提交</button>
        </div>
    </form>
</div>
<script>
var UPLOAD_URL = '<?php echo site_url('admin/post/upload_editor');?>';
</script>
<?php echo $this->load->view('admin/common/footer'); ?>
</body>
</html>