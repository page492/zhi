<section class="hot-goods aside-mod">
    <h5 class="hd"><span>推荐宝贝</span></h5>

    <div class="bd" id="J_ShowPic">
        <ul class="pic-list clearfix">
            <?php foreach ($list as $val) :?>
            <li>
                <a href="<?php echo site_url('post/'.$val['id']);?>" target="_blank">
                    <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>"/>
                    <div><?php echo $val['title'];?></div>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <div class='pic-pop none'></div>
        <!--展示大图-->
    </div>
</section>