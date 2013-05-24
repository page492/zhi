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
                <div><a href="/">首页 </a>&gt;&gt;<span class="cur"><?php echo $mall['name'];?></div>
            </section>
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