<footer>
    <div class="footer-wrap">
        <div class="f-about">
            <ul class="clearfix">
                <?php $this->widget('nav', array('type'=>'bottom')) ;?>
                <li>
                    <p class="tit">新手入门</p>
                    <?php foreach ($helps as $val) :?>
                    <p><?php echo anchor('help/'.$val['id'], $val['title']);?></p>
                    <?php endforeach;?>
                </li>
                <li class="about-us">
                    <p class="tit">关注我们</p>
                    <?php if ($setting['follow']['weibo']) :?>
                    <p><a class="sina" target="_blank" href="<?php echo $setting['follow']['weibo'];?>">新浪微博</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['tqq']) :?>
                    <p><a class="tenx" target="_blank" href="<?php echo $setting['follow']['tqq'];?>">腾讯微博</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['sohu']) :?>
                    <p><a class="sohu" target="_blank" href="<?php echo $setting['follow']['sohu'];?>">腾讯微博</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['renren']) :?>
                    <p><a class="renren" target="_blank" href="<?php echo $setting['follow']['renren'];?>">人人主页</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['diandian']) :?>
                    <p><a class="diandian" target="_blank" href="<?php echo $setting['follow']['diandian'];?>">点点</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['lofter']) :?>
                    <p><a class="lofter" target="_blank" href="<?php echo $setting['follow']['lofter'];?>">Lofter</a></p>
                    <?php endif;?>
                    <?php if ($setting['follow']['douban']) :?>
                    <p><a class="douban" target="_blank" href="<?php echo $setting['follow']['douban'];?>">豆瓣</a></p>
                    <?php endif;?>
                </li>
                <li class="weix">
                    <p class="tit">微信二维码</p>
                    <p><img src="<?php echo base_url('data/upload/qrcode.jpg');?>"></p>
                </li>
            </ul>
            <div class="hold-logo">
                <a href="http://www.holdphp.com" title="Powered by HoldPHP"><img src="<?php echo base_url('assets/img/logo-footer.png');?>" /></a>
            </div>
        </div>
        <?php if (isset($flink_list)) :?>
        <div class="f-link clearfix">
            <p class="fl">
                <span>友情链接：</span>
                <?php foreach ($flink_list as $val) :
                echo anchor($val['link'], $val['title'], 'target="_blank"');
                endforeach;?>
            </p>
            <p class="fr">
                <?php echo anchor('link', '更多&gt;&gt;', 'target="_blank"');?>
            </p>
        </div>
        <?php endif;?>
        <div class="f-botm clearfix">
            <div class="clearfix">
                <p class="fl">
                    <?php foreach ($abouts as $val) :?>
                    <?php echo anchor('about/'.$val['id'], $val['title'], 'target="_blank"');?><span>|</span>
                    <?php endforeach;?>
                    <?php echo anchor('link', '友情链接', 'target="_blank"');?>
                </p>
                <p class="fr">
                    Powered by <?php echo anchor('http://www.holdphp.com', 'HoldPHP', 'target="_blank"') . $hp_version;?> © 2013-2014
                    <?php echo anchor('http://www.miitbeian.gov.cn', $setting['site']['icp_info'], 'target="_blank"');?>
                </p>
            </div>
        </div>
    </div>
</footer>   <!--Footer End-->

<div id="J_GoTop" class="gotop"><a href="#">回顶部</a></div>
<?php echo script_tag('assets/js/sea.js', 'seajsnode');?>