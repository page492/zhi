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
                    <h3 class="tit">新会员注册</h3>
                    <form id="J_regform" class="form-mod" action="<?php echo site_url('user/register');?>" method="post">
                        <div class="control">
                            <label class="label" for="username">用户名：</label>
                            <div class="focus">
                                <input type="text" class="txt" id="username" name="username" datatype="*1-18" nullmsg="请填写用户名" ajaxurl="<?php echo site_url('user/check_unique/username');?>" />
                                <span class="tips"></span>
                            </div>
                        </div>
                        <div class="control">
                            <label class="label" for="username">电子邮箱：</label>
                            <div class="focus">
                                <input type="text" class="txt" id="email" name="email" datatype="e" nullmsg="请填写电子邮箱" ajaxurl="<?php echo site_url('user/check_unique/email');?>" />
                                <span class="tips"></span>
                            </div>
                        </div>
                        <div class="control">
                            <label class="label" for="password">密码：</label>
                            <div class="focus">
                                <input type="password" class="txt" id="password" name="password" datatype="*6-18" nullmsg="请输入密码！" errormsg="密码至少6个字符,最多18个字符！"/>
                                <span class="tips">密码至少6个字符,最多18个字符！</span>
                            </div>
                        </div>
                        <div class="control">
                            <label class="label" for="passconf">确认密码：</label>
                            <div class="focus">
                                <input type="password" class="txt" id="passconf" name="passconf" recheck="password"  datatype="*6-18" nullmsg="请确认密码！" errormsg="两次输入的密码不一致！" />
                                <span class="tips"></span>
                            </div>
                        </div>
                        <div class="control">
                            <label class="label" for="verific">验证码：</label>
                            <div class="focus">
                                <input type="text" id="captcha" name="captcha" size="8" datatype="*" nullmsg="请填写验证码！" errormsg="请填写验证码！"/>
                                <img id="J_captcha" src="<?php echo site_url('welcome/captcha');?>" />
                                <span>看不清楚？<a href="javascript:void(0);" id="J_refresh_captcha">换一张</a></span>
                                <span class="tips"></span>
                            </div>
                        </div>
                        <p class="submit">
                            <button class="btn btn-oran btn-max">免费注册</button>
                        </p>
                    </form>
                </div>
                <div class="fr">
                    <div class="other-login">
                        <h4 class="other-hd">使用合作账号登录</h4>
                        <div class="other-bd clearfix">
                            <?php foreach ($bind_list as $key => $val) :?>
                            <p>
                                <a href="<?php echo site_url('user/clogin/weibo')?>" class="<?php echo $key;?>">
                                    <img src="<?php echo base_url('assets/img/oauth/'.$key.'/icon.png');?>"><?php echo $val['name'];?>
                                </a>
                            </p>
                            <?php endforeach;?>
                        </div>
                    </div>
                    <p class="in-login">已有账号，立即登录</p>
                    <p class="sub-btn"><a class="btn btn-green btn-max" href="<?php echo site_url('user/login');?>"><i></i>登录</a></p>
                </div>
            </div>
        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('validform,pages/front/global,pages/front/register');
        });
    </script>
</body>
</html>