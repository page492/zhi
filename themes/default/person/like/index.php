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
                        <div><a href="/">首页 </a>&gt;&gt;<a href="">个人中心</a>&gt;&gt;<span class="cur">我的喜欢</span></div>
                    </section>

                    <section class="i-box">
                        <h4 class="tit"><span>我的喜欢</span></h4>
                        <div class="cont">
                            <ul id="J_LikeList" class="mix-list clearfix">
                                <?php foreach ($list as $val) :?>
                                <li>
                                    <div class="pic"><img src="<?php echo base_url('data/upload/post/cover/'.$val['post_img']);?>" /></div>
                                    <div class="txt">
                                        <?php echo anchor('post/'.$val['post_id'], $val['post_title'], 'target="_blank"');?>
                                        <p><span class="gray"><?php echo friendly_date($val['like_time']);?></span></p>
                                    </div>
                                    <div class="handle"><a href="<?php echo site_url('person/like/delete/'.$val['post_id']);?>" class="J_del">删除</a></div>
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
            router.load('pages/front/global,pages/front/person/like');
        });
    </script>

</body>
</html>