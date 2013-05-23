<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="iHome-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">
            <div class="iHome-info">

                <?php $this->load->view('person/common/menu');?>

                <div class="i-right">
                    <section class="crumb">
                        <div>当前位置:</div>
                        <div><a href="/">首页 </a>&gt;&gt;<a href="">个人中心</a>&gt;&gt;<span class="cur">我的信箱</span></div>
                    </section>

                    <section class="i-box">
                        <h4 class="tit"><span>我的信箱</span></h4>
                        <div class="cont">
                            <ul class="mix-list clearfix">
                                <?php foreach ($list as $val) :?>
                                <li>
                                    <div class="pic"><img src="materials/apps/home/feeds-3.jpg" alt="图片" /></div>
                                    <div class="txt">
                                        <a href="">HAWKS 鹰牌 D-21MC 民谣吉他（41寸）　350元包邮</a>
                                        <p><span class="gray">我在文中评论道：</span> 看起了很划算啊</p>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                    </section>

                    <section class="pagination"><?php echo $page_bar;?></section>

                </div>
            </div>
        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('pages/front/global');
        });
    </script>

</body>
</html>