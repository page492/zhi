<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="bucket-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">

            <div class="sub-nav">
                <h2 class="sub-tit"><?php echo $cat_info['name'];?></h2>
                <h3 class="sub-desc"><?php echo $cat_info['intro'];?></h3>
                <div class="sub-cate">
                    <ul>
                        <?php foreach ($nav_cat as $key => $val) :?>
                            <li <?php if ($val['cid'] == $current_cid) :?>class="select"<?php endif;?>>
                                <?php echo anchor('c/'.$val['alias'], $val['name']);?><i></i>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
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