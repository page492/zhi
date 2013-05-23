<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理中心</title>
    <meta name="description" content="">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/admin/css/layout.css') ?>" rel="stylesheet">
</head>

<body scroll="no">
    <div class="head clearfix">
        <a href="<?php echo site_url('admin');?>" class="logo pull-left">管理中心</a>
        <div class="navbar pull-left">
            <div class="navbar-inner">
                <div class="nav-collapse collapse clearfix">
                    <ul class="nav">
                        <?php foreach ($top_nav as $val): ?>
                        <li><a href="" data-toggle="tab" data-hold-toggle="navbar" data-id="<?php echo $val['node_id']; ?>"><?php echo $val['name'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-info pull-right">
            <a class="go-home" href="<?php echo site_url();?>" target="_blank"><i class="icon-home icon-white"></i> 网站首页</a>
            <span><?php echo $role[$visitor['role_id']];?>：<?php echo $visitor['username'];?></span>
            <a class="logout" href="<?php echo site_url('admin/welcome/logout');?>"><i class="icon-off icon-white"></i> 退出</a>
        </div>
    </div>

    <div class="tab clearfix">
        <div class="custom btn-group pull-left">
            <button class="btn btn-small dropdown-toggle" data-toggle="dropdown">常用菜单<span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="#">站点设置</a></li>
                <li><a href="#">导航设置</a></li>
                <li class="divider"></li>
                <li><a href="#">常用设置</a></li>
            </ul>
        </div>
        <div class="tab-nav">
            <a id="J_tabnav_pre" class="tab-nav-pre tab-nav-disabled icon-step-backward pull-left">上一页</a>
            <a id="J_tabnav_next" class="tab-nav-next tab-nav-disabled icon-step-forward pull-right">下一页</a>

            <div class="tab-nav-box">
                <div class="tab-nav-list">
                    <ul id="J_tabnav">
                        <li data-id="0" class="active"><a>后台首页</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="left-sidebar pull-left">
            <ul id="J_sidenav" class="nav nav-list side-nav"
                data-uri="<?php echo site_url('admin/welcome/side_nav'); ?>"></ul>
        </div>
        <div id="J_rframe" class="right-main">
            <iframe id="J_rframe_0" src="<?php echo site_url('admin/welcome/panel') ?>" frameborder="0"
                    scrolling="auto"></iframe>
        </div>
    </div>

<script src="<?php echo base_url('assets/js/sea.js') ?>" id="seajsnode"></script>
<script>
    seajs.use('hold', function (router) {
        router.load('pages/admin/global,pages/admin/index');
    });
</script>

</body>
</html>