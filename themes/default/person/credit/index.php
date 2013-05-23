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
                        <div><a href="/">首页 </a>&gt;&gt;<a href="">个人中心</a>&gt;&gt;<span class="cur">我的积分</span></div>
                    </section>

                    <section class="i-box">
                        <h4 class="tit"><span>我的积分</span></h4>
                        <div class="cont">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th width="140">时间</th>
                                    <th>积分</th>
                                    <th width="80">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list as $val) :?>
                                    <tr>
                                        <td><?php echo date('Y-m-d H:i:s', $val['log_time']);?></td>
                                        <td><?php echo $val['credit'];?></td>
                                        <td><?php echo $val['action']?></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
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