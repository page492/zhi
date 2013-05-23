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
                        <h4 class="tit"><span>个人资料</span></h4>
                        <div class="cont">
                            <form id="J_profileform" class="form-mod" action="<?php echo site_url('person');?>" method="post">
                                <div class="control">
                                    <label class="label">昵称： </label>
                                    <div class="focus">
                                        <p><?php echo $profile['username'];?></p>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label">电子邮件：</label>
                                    <div class="focus">
                                        <p><?php echo $profile['email'];?></p>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label">个人简介：</label>
                                    <div class="focus">
                                        <textarea name="intro" cols="50" rows="4"><?php echo $profile['intro'];?></textarea>
                                    </div>
                                </div>
                                <p class="submit">
                                    <button class="btn btn-oran btn-max" type="submit">保 存</button>
                                </p>
                            </form>
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
            $(function () {
                $('#J_profileform :submit').on('click.hold', function(e){
                    var submit_btn = $(this);
                    $('#J_profileform').ajaxSubmit({
                        dataType: 'json',
                        beforeSerialize: function () {
                            submit_btn.html('保存中...');
                        },
                        success: function (result) {
                            submit_btn.html('保 存');
                            if (result.status == '0') {
                                alert(result.msg);
                            } else {
                            }
                        }
                    });
                    e.preventDefault();
                });
            });
        });
    </script>

</body>
</html>