<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <ul class="nav mb15 clearfix bottom-line nav-line">
        <li class="active"><a href="<?php echo site_url('admin/credit/setting');?>">积分规则</a></li>
        <li><a href="<?php echo site_url('admin/credit');?>">积分记录</a></li>
    </ul>

    <form class="form-inline block-form" method="post">
        <table class="table table-hover table-list">
            <thead>
            <tr>
                <th class="tl">用户行为</th>
                <th class="tl">积分</th>
                <th class="tl">每日奖惩上限次数</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tl">注册</td>
                    <td class="tl"><input type="number" class="input-mini" name="register[credit]" value="<?php echo $setting['credit']['rule']['register']['credit'];?>"></td>
                    <td class="tl"></td>
                </tr>
                <tr>
                    <td class="tl">登陆</td>
                    <td class="tl"><input type="number" class="input-mini" name="login[credit]" value="<?php echo $setting['credit']['rule']['login']['credit'];?>"></td>
                    <td class="tl"><input type="number" class="input-mini" name="login[limit]" value="<?php echo $setting['credit']['rule']['login']['limit'];?>"></td>
                </tr>
                <tr>
                    <td class="tl">收藏</td>
                    <td class="tl"><input type="number" class="input-mini" name="favorite[credit]" value="<?php echo $setting['credit']['rule']['favorite']['credit'];?>"></td>
                    <td class="tl"><input type="number" class="input-mini" name="favorite[limit]" value="<?php echo $setting['credit']['rule']['favorite']['limit'];?>"></td>
                </tr>
                <tr>
                    <td class="tl">评论</td>
                    <td class="tl"><input type="number" class="input-mini" name="comment[credit]" value="<?php echo $setting['credit']['rule']['comment']['credit'];?>"></td>
                    <td class="tl"><input type="number" class="input-mini" name="comment[limit]" value="<?php echo $setting['credit']['rule']['comment']['limit'];?>"></td>
                </tr>
                <tr>
                    <td class="tl">有效爆料</td>
                    <td class="tl"><input type="number" class="input-mini" name="validsubmit[credit]" value="<?php echo $setting['credit']['rule']['validsubmit']['credit'];?>"></td>
                    <td class="tl"><input type="number" class="input-mini" name="validsubmit[limit]" value="<?php echo $setting['credit']['rule']['validsubmit']['limit'];?>"></td>
                </tr>
                <tr>
                    <td class="tl">违规爆料</td>
                    <td class="tl"><input type="number" class="input-mini" name="badsubmit[credit]" value="<?php echo $setting['credit']['rule']['badsubmit']['credit'];?>"></td>
                    <td class="tl"></td>
                </tr>
            </tbody>
        </table>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary" data-toggle="ajaxfrom" data-loading-text="提交中...">提交</button>
        </div>
    </form>

</div>

<?php echo $this->load->view('admin/common/footer'); ?>