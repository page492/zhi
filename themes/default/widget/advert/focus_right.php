<section class="hot-banner">
    <ul class="hot-banner-list">
        <?php foreach ($list as $val) :?>
        <li>
            <a href="<?php echo site_url('advert/tgo/'.$val['id']);?>" class="clearfix" target="_blank">
                <div class="tit fl"><h4><?php echo $val['title'];?></h4><span><?php echo $val['intro'];?></span></div>
                <div class="pic fr"><img src="<?php echo base_url('/data/upload/advert/' . $val['content']);?>" alt="<?php echo $val['title'];?>"></div>
            </a>
        </li>
        <?php endforeach;?>
    </ul>
</section>