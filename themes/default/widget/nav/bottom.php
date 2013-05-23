<li>
    <p class="tit">网站导航</p>
    <?php foreach ($nav as $val) : ?>
    <p><a href="<?php echo $val['link']; ?>"><?php echo $val['name']; ?></a></p>
    <?php endforeach; ?>
</li>