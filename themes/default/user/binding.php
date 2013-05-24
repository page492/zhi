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
                <div class="inbox">
                    <h3 class="tit">完善信息</h3>

                    <div class="avatar fl">
                        <img width="85" height="85" alt="<?php echo $oauth_user['name']?>" src="<?php echo $oauth_user['image']?>">
                    </div><!--avatar End-->

                    <div class="improve fr">
                        <div class="tab-tit" id="J_Tab">
                            <ul>
                                <li class="active"><a href="#new">注册新帐号</a></li>
                                <li><a href="#old">绑定已有帐号</a></li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="new">
                                <form id="J_bindform" class="J_ValidForm form-mod" action="<?php echo site_url('user/bind');?>" method="post">
                                    <input type="hidden" name="type" value="0">
                                    <div class="control">
                                        <label class="label" for="username">用户名：</label>
                                        <div class="focus">
                                            <input type="text" class="txt" id="username" name="username" value="<?php echo $oauth_user['name']?>" datatype="*1-18" nullmsg="请填写用户名" />
                                            <span class="tips"></span>
                                        </div>
                                    </div>
                                    <div class="control">
                                        <label class="label" for="username">电子邮箱：</label>
                                        <div class="focus">
                                            <input type="text" class="txt" id="email" name="email" datatype="e" nullmsg="请填写电子邮箱" />
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
                                        <label class="label" for="password">确认密码：</label>
                                        <div class="focus">
                                            <input type="password" class="txt" id="passconf" name="passconf" recheck="password"  datatype="*6-18" nullmsg="请确认密码！" errormsg="两次输入的密码不一致！" />
                                            <span class="tips"></span>
                                        </div>
                                    </div>
                                    <p class="submit">
                                        <button class="btn btn-oran btn-max">完 成</button>
                                    </p>
                                </form>
                            </div>
                            <div class="tab-pane" id="old">
                                <form id="J_bindform_old" class="J_validform form-mod" action="<?php echo site_url('user/bind');?>" method="post">
                                    <input type="hidden" name="type" value="1">
                                    <div class="control">
                                        <label class="label" for="username">用户名：</label>
                                        <div class="focus">
                                            <input type="text" class="txt" id="username" name="username" value="" datatype="*" nullmsg="请填写用户名" />
                                            <span class="tips"></span>
                                        </div>
                                    </div>
                                    <div class="control">
                                        <label class="label" for="password">密码：</label>
                                        <div class="focus">
                                            <input type="password" class="txt" id="password" name="password" datatype="*" nullmsg="请输入密码！"/>
                                            <span class="tips"></span>
                                        </div>
                                    </div>
                                    <p class="submit">
                                        <button class="btn btn-oran btn-max">绑 定</button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div><!--improve End-->
                </div>
            </div>
        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('validform,pages/front/global,pages/front/bind');
            router.load(HG.THEME_JS+'tab.js');
            $(function () {
                $('#J_Tab a').mouseover(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>