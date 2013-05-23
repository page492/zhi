<?php $this->load->view('install/header'); ?>

<div class="content clearfix">
    <div class="step clearfix">
        <ul>
            <li><i>1</i>环境检测</li>
            <li class="active"><i>2</i>网站配置</li>
            <li><i>3</i>安装系统</li>
        </ul>
    </div>
    <form class="form-horizontal" action="<?php echo site_url('install/config');?>" method="post">
        <div class="main config">
            <?php echo isset($error) ? $error : '';?>
            <h4>数据库信息</h4>
            <div class="control-group">
                <label class="control-label" for="dbhost">数据库地址</label>
                <div class="controls">
                    <input type="text" name="dbhost" id="dbhost" value="<?php echo element('dbhost', $conf, 'localhost');?>">
                    <span class="help-inline">本机请填写localhost</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbuser">数据库用户名</label>
                <div class="controls">
                    <input type="text" name="dbuser" id="dbuser" value="<?php echo element('dbuser', $conf, 'root');?>">
                    <span class="help-inline">用于数据库连接验证的用户名</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbpass">数据库密码</label>
                <div class="controls">
                    <input type="text" name="dbpass" id="dbpass" value="<?php echo element('dbpass', $conf);?>">
                    <span class="help-inline">用于数据库连接验证的密码</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbname">数据库名</label>
                <div class="controls">
                    <input type="text" name="dbname" id="dbname" value="<?php echo element('dbname', $conf);?>">
                    <span class="help-inline">安装HoldPHP的数据库，若不存在将尝试创建</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbprefix">数据库表前缀</label>
                <div class="controls">
                    <input type="text" name="dbprefix" id="dbprefix" value="<?php echo element('dbprefix', $conf, 'hp_');?>">
                    <span class="help-inline">同一个数据库运行多个HoldPHP时需修改</span>
                </div>
            </div>
            <h4>管理员信息</h4>
            <div class="control-group">
                <label class="control-label" for="username">帐号</label>
                <div class="controls">
                    <input type="text" name="username" id="username" value="<?php echo element('username', $conf);?>">
                    <span class="help-inline">初始管理员账号</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="password">密码</label>
                <div class="controls">
                    <input type="text" name="password" id="password" value="<?php echo element('password', $conf);?>">
                    <span class="help-inline">管理员密码</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="passconf">重复密码</label>
                <div class="controls">
                    <input type="text" name="passconf" id="passconf" value="<?php echo element('passconf', $conf);?>">
                    <span class="help-inline">重复输入上面的管理员密码</span>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="<?php echo element('email', $conf);?>">
                    <span class="help-inline">请填写管理员Email</span>
                </div>
            </div>
        </div>
        <div class="act text-center">
            <a href="<?php echo site_url('install/check'); ?>" class="btn">上一步</a>
            <button class="btn btn-primary" type="submit">下一步</button>
        </div>
    </form>
</div>

<?php $this->load->view('install/footer'); ?>