<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="iHome-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">
            <div class="i-info">

                <?php $this->load->view('person/common/menu');?>

                <div class="i-right">
                    <section class="crumb">
                        <div>当前位置:</div>
                        <div><a href="/">首页 </a>&gt;&gt;<a href="">个人中心</a>&gt;&gt;<span class="cur">个人资料</span></div>
                    </section>

                    <section class="i-box">
                        <h4 class="tit"><span>联合登录绑定</span></h4>
                        <div class="cont">
                            <ul class="bind-list">
                                <?php foreach ($bind_list as $key => $val) :?>
                                <li <?php if (in_array($key, $binded)) :?>class="ok"<?php endif;?>>
                                    <img src="<?php echo base_url('assets/img/oauth/'.$key.'/bind.png');?>" />
                                    <div>
                                        <?php if (!in_array($key, $binded)) :?>
                                        <p>你还未绑定<?php echo $val['name'];?></p>
                                        <?php echo anchor('user/bind/'.$key, '立即绑定');?>
                                        <?php else:?>
                                        <p>你已经绑定了<?php echo $val['name'];?>，可以直接微博帐号登录</p>
                                        <?php echo anchor('person/welcome/unbind/'.$key, '解除绑定');?>
                                        <?php endif;?>
                                    </div>
                                </li>
                                <?php endforeach;?>
                            </ul>
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
        });
    </script>

</body>
</html>