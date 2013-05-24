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
            <section class="crumb">
                <div>当前位置:</div>
                <div><a href="/">首页 </a>&gt;&gt;<span class="cur">“<?php echo $s;?>”的搜索结果</div>
            </section>
            <div class="content">
                <?php if ($post_list) :?>

                <?php $this->load->view('common/posts');?>

                <?php else :?>
                <div class="filter-mod">
                    <p class="tips-box">
                        <span class="attention"><i class="caret"></i>抱歉，没有符合您搜索条件的结果!</span>
                    </p>
                    <div class="filter-suggest">
                        <p>建议您：</p>
                        <p>1、看看输入的文字是否有误</p>
                        <p>2、调整关键字，如：“anokian97”改成“nokia n97”</p>
                        <p>3、重新搜索</p>
                        <p>
                        <form action="<?php echo site_url('search');?>" class="clearfix" method="get">
                            <input class="search-text" type="text" name="s" placeholder="搜索 折扣商品" />
                            <input class="btn btn-blue" type="submit" value="搜索" />
                        </form>
                        </p>
                    </div>
                </div>
                <?php endif;?>
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