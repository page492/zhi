<?php $this->load->view('install/header'); ?>

<div class="content clearfix">
    <div class="step clearfix">
        <ul>
            <li><i>1</i>环境检测</li>
            <li><i>2</i>网站配置</li>
            <li class="active"><i>3</i>安装系统</li>
        </ul>
    </div>
    <div class="main install">
        <span id="J_log" class="pg-log">创建数据表：hp_post</span>
        <div class="progress progress-striped active">
            <div id="J_bar" class="bar" style="width: 0%;"></div>
        </div>
    </div>
    <div class="act text-center">
        <a href="javascript:void(0);" class="btn btn-primary disabled" type="submit"><i class="icon-refresh icon-white"></i> 正在安装...</a>
    </div>
    <iframe src="<?php echo site_url('install/do_progress');?>" style="width:500px; height:300px;display:none;"></iframe>
</div>

<script>
function show_process(msg, rate) {
    document.getElementById('J_log').innerHTML = msg;
    document.getElementById('J_bar').style.width = rate + '%';
}
function install_successed() {
    window.location.href = "<?php echo site_url('install/finish');?>";
}
</script>

<?php $this->load->view('install/footer'); ?>