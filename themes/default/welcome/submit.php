<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="suggest-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">
            <div class="content">

                <article class="suggest">
                    <h3 class="tit">我要爆料</h3>
                    <div class="info">
                        <p>Welcome！什么值得买不仅是信息发布平台，也是一个大家帮助大家的信息分享平台。什么值得买发布的绝大部分信息来自热心网友的爆料。</p>
                        <p>如果您发现了网购的特价信息，或者想要向本站投稿，亦或者提提意见，都可以通过本页面实现。您的信息越完整准确，将越容易被及时处理。编辑也会尽可能的回复爆料，给您以答复。</p>
                        <p>如果您是在其他来源看到了该信息，请务必准确填写“信息来源”项目，并避免直接抄袭他人文字。请尊重他人的劳动成果，勿进行“伪原创”。爆料平台不接受商家“王婆卖瓜”，也不希望网友批量爆料某些例行特价（例如易迅早市等），这会对编辑审核带来困扰，还望您的理解。请注意，本站有可能会对推荐产品、推荐语、链接进行调整，而不进行另行通知。</p>
                        <p>请尽量选择<span style="color:#bb3500;">好品牌、好质量、好价格</span>的产品进行爆料，推荐理由尽量做到言简意赅。根据爆料信息来源、及时程度、特价力度、推荐理由丰富程度的不同，被<span style="color:#bb3500;">成功采用</span>的爆料会获得5-100个金币的奖励，您可以通过什么值得买的<a href="">用户积分计划</a>，换取优惠券、礼品卡或其他实物礼品。</p>
                    </div>
                </article>

                <section class="suggest-operate">
                    <div class="tab-tit" id="J_Tab">
                        <ul>
                            <li class="active"><a href="#leaks">特价信息爆料</a></li>
                        </ul>
                    </div>     
                    <div class="tab-content">
                        <div class="tab-pane active" id="leaks">
                            <form id="J_SubmitForm" class="form-mod" action="<?php echo site_url('baoliao');?>" method="post">
                                <div class="control">
                                    <label class="label" for="title">标题：</label>
                                    <div class="focus">
                                        <input type="text" class="txt" id="title" name="title" datatype="*" nullmsg="请输入标题" />
                                        <span class="tips">请输入标题</span>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label" for="link">链接：</label>
                                    <div class="focus">
                                        <input type="text" class="txt" id="link" name="link" datatype="*" nullmsg="请输入链接" />
                                        <span class="tips">请输入链接</span>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label" for="origin">爆料信息来源：</label>
                                    <div class="focus">
                                        <input type="radio" class="radio" name="origin" value="0" checked="checked" datatype="*" nullmsg="请选择信息来源" />
                                        在其他网站、论坛等
                                        <input type="radio" class="radio" name="origin" value="1" />
                                        B2C商城网站
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label" for="origin_link">信息来源网址：</label>
                                    <div class="focus">
                                        <input type="text" class="txt" id="origin_link" name="origin_link" datatype="*" nullmsg="请输入信息来源网址" />
                                        <span class="tips">请填写信息来源网址</span>
                                    </div>
                                </div>
                                <div class="control">
                                    <label class="label" for="reason">推荐理由：</label>
                                    <div class="focus">
                                        <textarea name="reason" cols="60" rows="6"></textarea>
                                    </div>
                                </div>
                                <p class="submit">
                                    <button type="submit" class="btn btn-oran btn-max">提交爆料</button>
                                </p>
                            </form>
                        </div>
                        <div class="tab-pane" id="contribute">
                            <form class="form-mod" action="" method="post">
                                <p>如果您准备向我们投稿（500字以上），请在此提交申请。</p>
                                <div class="control">
                                    <label class="label" for="username">投稿申请：</label>
                                    <div class="focus">
                                        <textarea name="reason" cols="60" rows="6"></textarea>
                                    </div>
                                </div>
                                <p class="submit">
                                    <button class="btn btn-oran btn-max">提交爆料</button>
                                </p>
                            </form>
                        </div>
                        <div class="tab-pane" id="suggest">
                            <form class="form-mod" action="" method="post">
                                <div class="control">
                                    <label class="label" for="username">改进建议</label>
                                    <div class="focus">
                                        <textarea name="reason" cols="60" rows="6"></textarea>
                                    </div>
                                </div>
                                <p class="submit">
                                    <button class="btn btn-oran btn-max">提交爆料</button>
                                </p>
                            </form>
                        </div>
                    </div>

                </section>
            </div>

            <?php $this->load->view('common/sidebar');?>

        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        var PERSON_SUBMIT_URL = '<?php echo site_url('person/submit');?>';
        seajs.use('hold', function (router) {
            router.load('validform,pages/front/global,pages/front/submit');
            router.load(HG.THEME_JS+'carousel.js,'+HG.THEME_JS+'holdscroll.js,'+HG.THEME_JS+'poppic.js,'+HG.THEME_JS+'tab.js');
            $(function(){
                $('#J_Slide').carousel();
                $('#J_HotSale').carousel({interval: 10000});
                $('#J_ShowPic').popPic();
                $('#J_Tab a').mouseover(function (e) {
                    e.preventDefault();
                    $(this).tab('show');
                });
            });
        });
    </script>

    <script id="bdshare_js" data="type=tools&amp;uid=6620384" ></script>
    <script id="bdshell_js"></script>
    <script>
        document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
    </script>
</body>
</html>