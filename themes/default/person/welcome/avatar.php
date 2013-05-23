<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/css/imgareaselect.css" />
</head>
<body id="iHome-page">
<?php $this->load->view('common/header');?>

<div class="main">
    <div class="inner-wrap">
        <div class="i-info">

            <?php $this->load->view('person/common/menu');?>

            <div class="i-right">
                <section class="crumb">
                    <div>当前位置:</div>
                    <div><a href="/">首页 </a>&gt;&gt;<a href="">个人中心</a>&gt;&gt;<span class="cur">个人资料</span></div>
                </section>

                <section class="i-box">
                    <h4 class="tit"><span>修改头像</span></h4>
                    <div class="cont">
                        <div class="upload-avatar">
                            <div class="mold fl">
                                <div id="J_upload">
                                    <p>请选择一张本地的图片编辑后上传为头像</p>
                                    <button id="J_upload_btn" class="btn btn-gray" data-uri="<?php echo site_url('person/welcome/avatar_upload');?>">头像上传</button>
                                </div>
                                <div id="J_show" style="display: none;"></div>
                            </div>
                            <div class="output fl">
                                <div id="J_avatarb" class="a180"><img src="<?php echo avatar($visitor['id'], 'b');?>" /></div>
                                <div id="J_avatarm" class="a80"><img src="<?php echo avatar($visitor['id'], 'm');?>" /></div>
                                <div id="J_avatars" class="a40"><img src="<?php echo avatar($visitor['id'], 's');?>" /></div>
                                <p>您上传的头像会自动生成三种尺寸，请注意中小尺寸的头像是否清晰</p>
                            </div>
                        </div>
                        <form id="J_avatarform" action="<?php echo site_url('person/welcome/avatar_save');?>" method="post">
                            <input id="J_file" type="hidden" name="filename" value="" />
                            <input id="J_xs" type="hidden" name="postion[xs]" value="0" />
                            <input id="J_xe" type="hidden" name="postion[xe]" value="300" />
                            <input id="J_ys" type="hidden" name="postion[ys]" value="0" />
                            <input id="J_ye" type="hidden" name="postion[ye]" value="300" />
                            <input id="J_scale" type="hidden" name="scale" value="1" />
                            <div class="save-avatar clearfix">
                                <button type="submit" id="J_savebtn" class="btn btn-oran btn-max fl">保 存</button>
                                <button type="button" id="J_cancelbtn" class="btn btn-gray btn-max fl">取 消</button>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>   <!--Main End-->

<?php $this->load->view('common/footer');?>

<script>
    seajs.use('hold', function (router) {
        router.load('pages/front/global,pages/front/person/avatar');
    });
</script>

</body>
</html>