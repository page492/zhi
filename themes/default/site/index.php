<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="about-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">
            <div class="i-info">

                <?php $this->load->view('site/menu');?>

                <div class="i-right">
                    <section class="i-box">
                        <h4 class="tit"><span><?php echo $info['title'];?></span></h4>
                        <div class="cont">
                            <?php echo $info['content'];?>
                        </div>
                    </section>
                </div>

            </div>
        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('pages/front/global');
            router.load(HG.THEME_JS+'collapse.js');
            $(function(){
                $('#J_Collapse').collapse({index: <?php echo $open_menu;?>,expand: true,multiple: true});
            });
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>