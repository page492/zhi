<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="bucket-page">
    <?php $this->load->view('common/header');?>

    <?php $this->widget('category', array('parent_id'=>'1')) ;?>

    <div class="main">
        <div class="inner-wrap">

            <div class="cat-nav">
                <span class="cat-name"><?php echo $parent_info['name'];?>：</span>
                <a class="cat-item <?php if ($parent_info['cid'] == $current_cid) :?>cat-on<?php endif;?>" href="<?php echo site_url('c/'.$parent_info['alias']);?>">全部</a>
                <?php foreach ($nav_cat as $key => $val) :?>
                <a class="cat-item <?php if ($val['cid'] == $current_cid) :?>cat-on<?php endif;?>" href="<?php echo site_url('c/'.$val['alias']);?>"><?php echo $val['name'];?></a>
                <?php endforeach;?>
            </div>

            <div class="content">

                <?php $this->load->view('common/posts');?>

            </div>

            <?php $this->load->view('common/sidebar');?>

        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
    seajs.use('hold', function (router) {
        router.load('pages/front/global');
        router.load(HG.THEME_JS+'carousel.js,'+HG.THEME_JS+'holdscroll.js,'+HG.THEME_JS+'poppic.js');
        $(function(){
            $('#J_Slide').carousel();
            $('#J_HotSale').carousel({interval: 10000});
            $('#J_ShowPic').popPic();
        });
    });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>