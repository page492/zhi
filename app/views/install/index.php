<?php $this->load->view('install/header'); ?>
<div class="content clearfix">
    <pre class="pact"><?php echo $hold_license;?></pre>
    <div class="act text-center">
        <a href="<?php echo site_url('install/check'); ?>" class="btn btn-primary">接 受</a>
    </div>
</div>
<?php $this->load->view('install/footer'); ?>