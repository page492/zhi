<section class="hot_post aside-mod">
    <h5 class="hd"><span>热门活动</span></h5>
    <div class="bd">
        <ul class="text-list clearfix">
            <?php foreach ($list as $val) :?>
            <li>
                <?php echo anchor('post/'.$val['id'], $val['title'], 'target="_blank"');?>
                <span class="time"><?php echo date('Y-m-d', $val['post_time']);?></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="ft"><?php echo anchor('c/cuxiao', '更多活动');?></div>
</section>