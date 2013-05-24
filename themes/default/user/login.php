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
                <div class="fl">
                    <h3 class="tit">用户登录</h3>
                    <form id="J_loginform" class="J_ValidForm form-mod" action="<?php echo site_url('user/login');?>" method="post">
                        <div class="control">
                            <label class="label" for="username">登录名：</label>
                            <div class="focus">
                                <input type="text" class="txt" id="username" name="username" datatype="*" nullmsg="请填写用户名" />
                                <span class="tips"></span>
                            </div>
                        </div>
                        <div class="control">
                            <label class="label" for="password">登录密码：</label>
                            <div class="focus">
                                <input type="password" class="txt" id="password" name="password" datatype="*" nullmsg="请输入密码！" />
                                <span class="tips"></span>
                            </div>
                        </div>
                        <p class="xieyi">
                            <input type="checkbox" name="cache" value="1" />
                            <span>两周内自动登录</span>
                        </p>
                        <p class="submit">
                            <button class="btn btn-oran btn-max">登 录</button>
                            <?php echo anchor('user/lostpwd', '忘记密码？');?>
                        </p>
                    </form>
                    <div class="other-login">
                        <h4 class="other-hd">使用合作账号登录</h4>
                        <div class="other-bd clearfix">
                            <?php foreach ($bind_list as $key => $val) :?>
                            <a class="l-<?php echo $key;?>" href="<?php echo site_url('user/clogin/'.$key)?>" title="<?php echo $val['name'];?>">
                                <img src="<?php echo base_url('assets/img/oauth/'.$key.'/login.png');?>" />
                            </a>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
                <div class="fr">
                    <h4 class="tit">注册</h4>
                    <p class="no-key">还没有账号？</p>
                    <p class="sub-btn"><a class="btn btn-green btn-max" href="<?php echo site_url('user/register');?>"><i></i>免费注册</a></p>
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