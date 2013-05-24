<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="home-page">
    <?php $this->load->view('common/header');?>

    <?php $this->widget('category', array('parent_id'=>'1')) ;?>

    <div class="main">
        <div class="inner-wrap">
            <div class="content">

                <?php $this->widget('advert', array('id'=>'1')) ;?>

                <?php $this->widget('advert', array('id'=>'2')) ;?>

                <?php $this->load->view('common/posts');?>

            </div>

            <?php $this->load->view('common/sidebar');?>

        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('pages/front/global');
            router.load(HG.THEME_JS+'carousel.js,'+HG.THEME_JS+'holdscroll.js,'+HG.THEME_JS+'poppic.js,'+HG.THEME_JS+'dropdown.js');
            $(function(){
                $('#J_Slide').carousel();
                $('#J_HotSale').carousel({interval: 10000});
                $('#J_ShowPic').popPic();
                $('#J_Feeds .item-buy').dropdown({inner: 'ul'});
            });
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>