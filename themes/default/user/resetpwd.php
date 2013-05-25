<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="user-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">
            <div class="uc-form clearfix">
                <div class="inbox email">
                    <h3 class="tit">重设密码</h3>

                    <div class="improve fr">
                        <form class="J_ValidForm form-mod" action="<?php echo site_url('user/resetpwd');?>" method="post">
                            <input type="hidden" name="uid" value="<?php echo $uid;?>">
                            <input type="hidden" name="activation" value="<?php echo $activation;?>">
                            <div class="control">
                                <label class="label" for="password">新密码：</label>
                                <div class="focus">
                                    <input type="password" class="txt" id="password" name="password" datatype="*6-18" nullmsg="请输入您的新密码" errormsg="密码至少6个字符,最多18个字符！" />
                                    <span class="tips"></span>
                                </div>
                            </div>
                            <div class="control">
                                <label class="label" for="passconf">确认密码：</label>
                                <div class="focus">
                                    <input type="password" class="txt" id="passconf" name="passconf" datatype="*6-18" recheck="password" nullmsg="请确认您的新密码" errormsg="两次输入的密码不一致！" />
                                    <span class="tips"></span>
                                </div>
                            </div>
                            <p class="submit">
                                <button class="btn btn-green btn-max"> 重设密码 </button>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('validform,pages/front/global,pages/front/login');
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>