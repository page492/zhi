<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理中心</title>
    <?php echo link_tag('assets/css/bootstrap.min.css');?>

    <?php echo link_tag('assets/admin/css/login.css');?>

</head>
<body>
    <form class="form-login" method="post">
        <h2 class="form-signin-heading">HoldPHP 管理后台</h2>
        <input type="text" class="input-block-level" name="username" placeholder="帐号">
        <input type="password" class="input-block-level" name="password" placeholder="密码">
        <button type="submit" class="btn btn-large btn-block btn-primary" data-toggle="ajaxfrom" data-loading-text="正在登陆...">登陆</button>
    </form>
<?php echo $this->load->view('admin/common/footer'); ?>