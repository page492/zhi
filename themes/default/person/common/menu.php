<div class="i-left">
    <section class="user-info">
        <div class="avatar">
            <div class="avatar-bg"></div>
            <img width="85" height="85" alt="<?php echo $visitor['username'];?>" src="<?php echo avatar($visitor['id']);?>" />
        </div>
        <div class="intro">
            <h5><?php echo $visitor['username'];?></h5>
            <p>
                积分 : <span>759</span><br />
                经验 : <span>75</span><br />
                金币 : <span>1200</span><br />
            </p>
        </div>
    </section>

    <section class="aside-nav">
        <?php foreach ($menu as $key=>$val) :?>
        <dl class="accordion <?php if ($key == $expand_menu) :?>expand<?php endif;?>">
            <dt <?php if (element('sublist', $val)) :?>class="accordion-hd"<?php endif;?>>
                <a href="<?php echo $val['url'];?>"><?php echo $val['text'];?><i></i></a>
            </dt>
            <?php if (element('sublist', $val)) :?>
            <dd class="accordion-bd">
                <ol>
                    <?php foreach ($val['sublist'] as $skey=>$sval) :?>
                    <li <?php if ($skey == $curr_menu) :?>class="selected"<?php endif;?>>
                        <span>·</span><a href="<?php echo $sval['url'];?>"><?php echo $sval['text'];?></a>
                    </li>
                    <?php endforeach;?>
                </ol>
            </dd>
            <?php endif;?>
        </dl>
        <?php endforeach;?>
    </section>

</div>