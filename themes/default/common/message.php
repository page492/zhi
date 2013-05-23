<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="user-page">
<?php $this->load->view('common/header');?>

<div class="main">
    <div class="inner-wrap">
        <div class="prompt">
            <div class="tips-box">
                <div class="<?php echo $icon;?>">
                    <i class="caret"></i> <?php echo $message;?>
                    <p><a href="<?php echo $target_url;?>">[ 如果您的浏览器没有自动跳转，请点击此链接 ]</a></p>
                </div>
            </div>
        </div>
    </div>
</div>   <!--Main End-->

<?php $this->load->view('common/footer');?>
<script type="text/javascript">
    setTimeout(function() {
        window.location = "<?php echo $target_url; ?>";
    }, 3000);
</script>
</body>
</html>