<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li class="active"><a href="<?php echo site_url('admin/setting');?>">基本设置</a></li>
        <li><a href="<?php echo site_url('admin/setting/attachment');?>">附件设置</a></li>
        <li><a href="<?php echo site_url('admin/setting/follow');?>">关注我们</a></li>
    </ul>

    <div class="bottom-line block-title">站点信息设置</div>

    <form class="form-horizontal block-form" method="post">
        <div class="control-group">
            <label class="control-label" for="site_name">网站名称</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="site_name" name="site_name" value="<?php echo $setting['site']['site_name'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="icp_info">ICP 备案信息</label>
            <div class="controls">
                <input type="text" class="input-xlarge" id="icp_info" name="icp_info" value="<?php echo $setting['site']['icp_info'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="site_name">微信二维码</label>
            <div class="controls">
                <img id="J_qrcode" src="<?php echo base_url('data/upload/qrcode.jpg');?>" width="200" height="200">
                <button class="btn" type="button" id="J_upload_qrcode" data-uri="<?php echo site_url('admin/setting/upload_qrcode')?>">上传</button>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="stat_code">第三方统计代码</label>
            <div class="controls">
                <textarea class="span6" rows="3" id="stat_code" name="stat_code"><?php echo $setting['site']['stat_code'];?></textarea>
            </div>
        </div>
        <div class="bottom-line block-title">站点状态设置</div>
        <div class="control-group">
            <label class="control-label" for="stat_code">站点状态</label>
            <div id="J_visit_status" class="controls">
                <label class="radio inline">
                    <input type="radio" name="visit_status" value="1" <?php if ($setting['site']['visit_status'] == '1') :?>checked<?php endif;?>> 开放
                </label>
                <label class="radio inline">
                    <input type="radio" name="visit_status" value="0" <?php if ($setting['site']['visit_status'] == '0') :?>checked<?php endif;?>> 关闭
                </label>
            </div>
        </div>
        <div id="J_visit_explain" class="control-group <?php if ($setting['site']['visit_status'] == '1') :?>hide<?php endif;?>">
            <label class="control-label" for="stat_code">关闭说明</label>
            <div class="controls">
                <textarea class="span6" rows="3" id="visit_explain" name="visit_explain"><?php echo $setting['site']['visit_explain'];?></textarea>
            </div>
        </div>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>

</div>

<?php echo $this->load->view('admin/common/footer'); ?>