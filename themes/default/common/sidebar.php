<div class="right-aside" id="J_Aside">
<section class="login  aside-mod">
    <?php if (element('id', $visitor)) :?>
    <div class="hi">
        <p class="name">
            <a href="<?php echo site_url('person');?>"><img width="40" height="40" alt="<?php echo $visitor['username'];?>" src="<?php echo avatar($visitor['id']);?>" /></a>
            您好，<?php echo $visitor['username'];?>！
        </p>
        <p>
            会员级别:<span><?php echo $role[$visitor['role_id']];?></span>
            积分:<span><?php echo $visitor['credit'];?></span>
        </p>
    </div>
    <?php else :?>
    <ul>
        <li class="local">
            <a href="<?php echo site_url('user/login');?>" class="btn btn-blue">登录领取积分</a>
        </li>
        <li class="outside">
            推荐登录方式:
            <?php foreach ($bind_list as $key => $val) :?>
            <a href="<?php echo site_url('user/clogin/'.$key)?>" class="<?php echo $key;?>" title="<?php echo $val['name'];?>">
                <img src="<?php echo base_url('assets/img/oauth/'.$key.'/icon.png');?>">
            </a>
            <?php endforeach;?>
        </li>
    </ul>
    <?php endif;?>
</section>

<?php $this->widget('hotact');?>

<?php $this->widget('hotpost');?>

<?php $this->widget('hottag');?>

<?php $this->widget('rcdpost');?>

<?php $this->widget('rcdmall');?>

<section class="banner aside-mod">
    <?php $this->widget('advert', array('id'=>'3')) ;?>
</section>
</div>