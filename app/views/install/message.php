<?php $this->load->view('install/header'); ?>

<div class="content clearfix">
    <div class="main">
        <div class="alert alert-error">
            <strong>Oh snap!</strong> <?php echo $message;?>
        </div>
        <a href="<?php echo site_url();?>" class="btn btn-success" type="button">返 回</a>
    </div>
</div>

<?php $this->load->view('install/footer'); ?>