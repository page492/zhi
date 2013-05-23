<?php foreach ($comment_list as $comment) : ?>
    <dl class="comment-item">
        <dt class="item-pic">
            <img width="50" height="50" alt="<?php echo $comment['username']; ?>" src="<?php echo avatar($comment['uid'], 's'); ?>" class="avatar"/>
        </dt>
        <dd class="item-intro">
            <a><?php echo $comment['username'];?></a>：<?php echo $comment['content'];?>
            (<?php echo friendly_date($comment['comment_time']);?>)
            <div class="item-reply">
                <a href="">举报</a>
                <span>|</span>
                <a href="" title="">回复</a>
            </div>
        </dd>
    </dl>
<?php endforeach; ?>
