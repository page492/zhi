<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <div class="bottom-line block-title">邮件设置</div>

    <form class="form-horizontal block-form" method="post">
        <div class="control-group">
            <label class="control-label">发送模式</label>
            <div id="J_mail_method" class="controls">
                <label class="radio inline">
                    <input type="radio" name="method" value="mail" <?php if ($setting['mail']['method'] == 'mail') :?>checked<?php endif;?>> Mail
                </label>
                <label class="radio inline">
                    <input type="radio" name="method" value="sendmail" <?php if ($setting['mail']['method'] == 'sendmail') :?>checked<?php endif;?>> Sendmail
                </label>
                <label class="radio inline">
                    <input type="radio" name="method" value="smtp" <?php if ($setting['mail']['method'] == 'smtp') :?>checked<?php endif;?>> SMTP
                </label>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mail_from">发信人地址</label>
            <div class="controls">
                <input type="text" class="input-large" id="mail_from" name="from" value="<?php echo $setting['mail']['from'];?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="mail_name">发信人</label>
            <div class="controls">
                <input type="text" class="input-large" id="mail_name" name="name" value="<?php echo $setting['mail']['name'];?>">
            </div>
        </div>
        <div id="J_smtp" class="hide">
            <div class="control-group">
                <label class="control-label" for="smtp_host">SMTP服务器</label>
                <div class="controls">
                    <input type="text" class="input-large" id="smtp_host" name="smtp[host]" value="<?php echo $setting['mail']['smtp']['host'];?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="smtp_port">SMTP端口</label>
                <div class="controls">
                    <input type="text" class="input-large" id="smtp_port" name="smtp[port]" value="<?php echo $setting['mail']['smtp']['port'];?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="smtp_user">SMTP帐号</label>
                <div class="controls">
                    <input type="text" class="input-large" id="smtp_user" name="smtp[user]" value="<?php echo $setting['mail']['smtp']['user'];?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="smtp_pass">SMTP密码</label>
                <div class="controls">
                    <input type="password" class="input-large" id="smtp_pass" name="smtp[pass]" value="<?php echo $setting['mail']['smtp']['pass'];?>">
                </div>
            </div>
        </div>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>

</div>

<?php echo $this->load->view('admin/common/footer'); ?>