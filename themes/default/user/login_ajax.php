<div class="dialog-login clearfix">
    <div class="login-form">
        <form id="J_DialogForm" action="<?php echo site_url('user/login');?>" class="form-mod" method="post">
            <p id="J_LoginTips" class="login-tips">请输入用户名！</p>
            <div class="control">
                <label class="label" for="username">用户名：</label>
                <div class="focus">
                    <input type="text" class="txt" id="J_username" name="username"/>
                </div>
            </div>
            <div class="control">
                <label class="label" for="password">密码：</label>
                <div class="focus">
                    <input type="password" class="txt" id="J_password" name="password"/>
                </div>
            </div>
            <p class="xieyi">
                <input type="checkbox" name="cache" value="1">
                <span>两周内自动登录</span>
            </p>
            <p class="submit">
                <button class="btn btn-oran">登 录</button>
                <a class="" href="">忘记密码？</a>
            </p>
        </form>
    </div>
    <div class="other-login">
        <div class="other-hd">使用合作账号登录:</div>
        <div class="other-bd clearfix">
            <?php foreach ($bind_list as $key => $val) :?>
            <p>
                <a href="<?php echo site_url('user/clogin/'.$key)?>" class="<?php echo $key;?>">
                    <img src="<?php echo base_url('assets/img/oauth/'.$key.'/icon.png');?>"/><?php echo $val['name'];?>
                </a>
            </p>
            <?php endforeach;?>
        </div>
        <p><a href="">轻松注册帐号</a></p>
    </div>
</div>