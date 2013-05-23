<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li><a href="<?php echo site_url('admin/setting');?>">基本设置</a></li>
        <li><a href="<?php echo site_url('admin/setting/attachment');?>">附件设置</a></li>
        <li class="active"><a href="<?php echo site_url('admin/setting/follow');?>">关注我们</a></li>
    </ul>

    <div class="bottom-line block-title">关注我们</div>

    <form class="form-horizontal block-form" action="<?php echo site_url('admin/setting/follow'); ?>" method="post">
        <div class="control-group">
            <label class="control-label" for="weibo">新浪微薄</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="weibo" name="weibo" value="<?php echo $setting['follow']['weibo'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="tqq">腾讯微薄</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="tqq" name="tqq" value="<?php echo $setting['follow']['tqq'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="sohu">搜狐微薄</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="sohu" name="sohu" value="<?php echo $setting['follow']['sohu'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="renren">人人</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="renren" name="renren" value="<?php echo $setting['follow']['renren'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="diandian">点点</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="diandian" name="diandian" value="<?php echo $setting['follow']['diandian'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="lofter">Lofter</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="lofter" name="lofter" value="<?php echo $setting['follow']['lofter'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="douban">豆瓣</label>
            <div class="controls">
                <input class="input-xlarge" type="text" id="douban" name="douban" value="<?php echo $setting['follow']['douban'];?>">
            </div>
        </div>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>