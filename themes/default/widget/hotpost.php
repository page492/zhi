<section class="hot-sale aside-mod">
    <h5 class="hd"><span>热门宝贝</span></h5>
    <div class="bd carousel" id="J_HotSale">
        <ul class="carousel-inner">
            <?php foreach ($list as $val) :?>
            <li>
                <a href="<?php echo site_url('post/'.$val['id']);?>" target="_blank">
                    <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>">
                    <div><?php echo $val['title'];?></div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <a class="carousel-control prev" href="#">‹</a>
        <a class="carousel-control next" href="#">›</a>
        <div class="carousel-indicators">
            <?php foreach ($list as $val) :?>
            <span></span>
            <?php endforeach;?>
        </div>
    </div>
</section>