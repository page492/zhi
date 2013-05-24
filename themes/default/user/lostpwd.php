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
                    <h3 class="tit">找回密码</h3>

                    <div class="avatar fl">
                        <img width="120" height="120"src="<?php echo $theme_url;?>/assets/img/email.png" />
                    </div><!--avatar End-->

                    <div class="improve fr">
                        <form class="J_ValidForm form-mod" action="" method="post">
                            <div class="control">
                                请输入您的登录/注册邮箱地址，帮助您找回密码！
                            </div>
                            <div class="control">
                                <label class="label" for="email">电子邮箱：</label>
                                <div class="focus">
                                    <input type="text" class="txt" id="email" name="email" datatype="e" nullmsg="请填写电子邮箱" />
                                    <span class="tips"></span>
                                </div>
                            </div>
                            <div class="control">
                                <label class="label" for="verific">验证码：</label>
                                <div class="focus">
                                    <input type="text" id="captcha" name="captcha" size="8" datatype="*" />
                                    <img id="J_captcha" src="<?php echo site_url('welcome/captcha');?>" />
                                    <span>看不清楚？<a href="javascript:void(0);" id="J_refresh_captcha">换一张</a></span>
                                </div>
                            </div>
                            <p class="submit">
                                <button class="btn btn-green btn-max"> 获取新密码 </button>
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