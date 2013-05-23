<section class="hot-tags aside-mod">
    <h5 class="hd"><span>热门搜索</span></h5>
    <div class="bd">
        <ul class="tag-list clearfix">
            <?php foreach ($list as $val) :?>
            <li><?php echo anchor('post/tag/'.$val['id'], $val['name']);?></li>
            <?php endforeach;?>
        </ul>
    </div>
</section>