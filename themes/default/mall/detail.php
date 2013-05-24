<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="mall-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">

            <section class="mall-intro">
                <div class="fl">
                    <a class="mall-logo" target="_blank" title="" href="">
                        <img width="184" height="92" src="<?php echo base_url('data/upload/mall/'.$info['logo']);?>" />
                    </a>
                </div>
                <duv class="fr">
                    <h3 class="mall-name"><?php echo $info['name'];?></h3>
                    <div class="mall-url">商城地址：<?php echo anchor($info['link'], $info['link'], 'target="_blank"');?></div>
                    <div class="mall-desc"><?php echo $info['intro'];?></div>
                </duv>
            </section>

            <section class="hot-sale" id="J_HotSale">
                <h3 class="hd">精选商品 <span class="more"><a href="<?php echo site_url('post/mall/'.$info['id']);?>">更多></a></span></h3>
                <div class="bd" id="J_ShowPic">
                    <ul class="recom-list clearfix">
                        <?php foreach ($post_list as $val) :?>
                        <li>
                            <a href="<?php echo site_url('post/'.$val['id']); ?>" class="recom-pic">
                                <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>" />
                            </a>
                            <div class="recom-name">
                                <a href="<?php echo site_url('post/'.$val['id']); ?>"><?php echo $val['title'];?></a>
                            </div>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </section>

        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
    seajs.use('hold', function (router) {
        router.load('pages/front/global');
    });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>