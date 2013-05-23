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

<script id="bdshare_js" data="type=tools&amp;uid=6620384" ></script>
<script id="bdshell_js"></script>
<script>
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
</body>
</html>