<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="mall-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
    <div class="inner-wrap">
    <nav class="mall-nav">
        <h3 class="nav-tit fl">商家导航</h3>
        <div class="nav-cat fr">
            <?php $i = 0; foreach ($cat_malls as $key => $val) :?>
            <?php if ($i > 0):?><span>|</span><?php endif;?>
            <a href="<?php echo site_url('mall#'.$key);?>"><?php echo $val['name'];?></a>
            <?php $i++; endforeach;?>
        </div>
    </nav>

    <section class="mall-list" id="J_Mall">
    <?php foreach ($cat_malls as $val) :?>
    <div class="mall-item" id="<?php echo $val['cid'];?>">
        <h5 class="item-hd"><img src="<?php echo $val['icon'] ? base_url('data/upload/mall_cat/'.$val['icon']) : base_url('assets/img/mallcat-icon.png');?>" /><span><?php echo $val['name'];?></span></h5>
        <ul class="item-bd clearfix">
            <?php if (isset($val['mall_list'])) : foreach ($val['mall_list'] as $mall) :?>
            <li>
                <div class="item-pic">
                    <a class="item-logo" href="<?php echo site_url('mall/'.$mall['alias']);?>"><img src="<?php echo base_url('data/upload/mall/'.$mall['logo']);?>" /></a>
                    <a class="item-name" href="<?php echo site_url('mall/'.$mall['alias']);?>"><?php echo $mall['name'];?></a>
                </div>
                <div class="item-bar">
                    <a class="detail" href="<?php echo site_url('mall/'.$mall['alias']);?>"><i class="icon-detail"></i>商家详情</a>
                    <a class="shopping" href="<?php echo site_url('mall/tgo/'.$mall['id']);?>" target="_blank"><i class="icon-shopping"></i>直达商城</a>
                </div>
            </li>
            <?php endforeach;endif;?>
        </ul>
    </div>
    <?php endforeach;?>
    </section>

    </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

<script>
seajs.use('hold', function (router) {
    router.load('pages/front/global');
});
</script>

<script id="bdshare_js" data="type=tools&amp;uid=6620384" ></script>
<script id="bdshell_js"></script>
<script>
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
</body>
</html>