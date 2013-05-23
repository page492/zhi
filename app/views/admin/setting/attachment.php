<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/setting');?>">基本设置</a></li>
        <li class="active"><a href="<?php echo site_url('admin/setting/attachment');?>">附件设置</a></li>
        <li><a href="<?php echo site_url('admin/setting/follow');?>">关注我们</a></li>
    </ul>

    <div class="bottom-line block-title">基本设置</div>

    <form class="form-horizontal block-form" action="<?php echo site_url('admin/setting/attachment'); ?>" method="post">
        <div class="control-group">
            <label class="control-label" for="max_size">允许上传附件大小</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="max_size" name="max_size" value="<?php echo $setting['attachment']['max_size'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="allow_type">允许上传附件类型</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="allow_type" name="allow_type" value="<?php echo $setting['attachment']['allow_type'];?>">
            </div>
        </div>
        <!--
        <div class="control-group">
            <label class="control-label" for="path">附件储存路劲</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="path" name="path" value="<?php echo $setting['attachment']['path'];?>">
            </div>
        </div>
        -->
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>