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
                        <h4 class="tit"><span>友情链接</span></h4>
                        <div class="cont">
                            <div class="link-list">
                                <?php foreach ($cats as $key => $val) :?>
                                <h5><?php echo $val?></h5>
                                <ul class="clearfix">
                                    <?php foreach ($list[$key] as $_link) :?>
                                    <li><?php echo anchor($_link['link'], $_link['title'], 'target="_blank"');?></li>
                                    <?php endforeach;?>
                                </ul>
                                <?php endforeach;?>
                            </div>
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
                $('#J_Collapse').collapse({index: 2,expand: true,multiple: true});
            });
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>