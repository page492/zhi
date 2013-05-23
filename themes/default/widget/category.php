<div class="left-menu" id="J_Menu">
    <div class="menu-hd"><?php echo anchor('c/'.$list['t']['alias'], $list['t']['name']);?></div>
    <div class="menu-bd">
        <ul class="menu-list">
            <?php
            !isset($current_cid) && $current_cid = 0;
            foreach ($list['p'] as $val) :
            ?>
            <li class="menu-item <?php if ($val['cid'] == $current_cid):?>menu-on<?php endif;?>">
                <p><a href="<?php echo site_url('c/'.$val['alias']);?>"><img src="<?php echo $val['icon'] ? base_url('data/upload/category/'.$val['icon']) : base_url('assets/img/cat-icon.png');?>" /><span><?php echo $val['name'];?></span><i class="icon-play"></i></a></p>
                <?php if (isset($list['s'][$val['cid']])) :?>
                <ul class="sub-menu" style="visibility: hidden;">
                    <?php foreach ($list['s'][$val['cid']] as $sval) :?>
                    <li class="sub-item"><span>·</span><?php echo anchor('c/'.$sval['alias'], $sval['name']);?></li>
                    <?php endforeach; ?>
                </ul>
                <b class="caret"></b>
                <?php endif;?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>  <!--Menu End-->