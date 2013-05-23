<section class="hot_seller aside-mod">
    <h5 class="hd"><span>热门商家</span></h5>
    <div class="bd">
        <ul class="logo-list clearfix">
            <?php foreach ($list as $val) :?>
            <li>
                <a href="<?php echo site_url('mall/'.$val['alias']);?>" target="_blank">
                    <img src="<?php echo base_url('data/upload/mall/'.$val['logo']);?>" width="60" height="30" alt="天猫"/>
                </a>
                <p class="info"><a href="<?php echo site_url('mall/'.$val['alias']);?>" target="_blank"><?php echo $val['name'];?></a></p>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</section>