<header>
    <div class="hd-bar">
        <div class="inner-wrap">
            <div class="login">
                <?php if (element('id', $visitor)) :?>
                <?php echo anchor('person', '个人中心');?>|
                <?php echo anchor('baoliao', '我要爆料');?>|
                <?php echo anchor('user/logout', '注销');?>
                <?php else :?>
                <?php echo anchor('user/login', '登陆');?>|
                <?php echo anchor('user/register', '注册');?>
                <?php endif;?>
            </div>
        </div>
    </div>
    <div class="hd-wrap">
        <h1 class="logo">
            <a href="<?php echo site_url();?>"><img src="<?php echo base_url('assets/img/logo.png');?>" alt="<?php echo $setting['site']['site_name'];?>" /></a>
            <span><?php echo $setting['site']['site_name'];?></span>
        </h1>
        <div class="search">
            <div class="search-bd" id="J_Search">
                <form action="<?php echo site_url('search');?>" method="get">
                    <input class="search-text" type="text" name="s" id="mq" accesskey="s" autocomplete="off" autofocus="true" value="<?php echo isset($s) ? $s : '';?>" />
                    <input class="search-btn" type="submit" value="" />
                </form>
            </div>
        </div>
    </div>
    <nav class="hd-nav">
        <div class="nav-bd">
            <?php $this->widget('nav'); ?>
        </div>
    </nav>
</header>   <!--Header End-->