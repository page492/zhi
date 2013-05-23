<?php $this->load->view('install/header'); ?>

<div class="content clearfix">
    <div class="main finish">
        <h4>恭喜您！您的HoldPHP已经安装成功。</h4>
        <p>接下来您可以：</p>
        <a href="<?php echo site_url();?>" class="btn btn-success" type="button">访问网站</a>
        <a href="<?php echo site_url('admin');?>" class="btn btn-primary" type="button">管理网站</a>
    </div>
</div>

<?php $this->load->view('install/footer'); ?>