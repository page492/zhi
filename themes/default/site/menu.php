<div class="i-left">
    <section class="aside-nav" id="J_Collapse">
        <dl class="accordion">
            <dt class="accordion-hd">
                <a href="javascript:void(0);">帮助中心<i></i></a>
            </dt>
            <dd class="accordion-bd">
                <ol>
                    <?php foreach ($helps as $val) :?>
                    <li<?php if (isset($info) && $val['id'] == $info['id']) :?> class="selected"<?php endif;?>><span>·</span><?php echo anchor('help/'.$val['id'], $val['title']);?></a></li>
                    <?php endforeach;?>
                </ol>
            </dd>
        </dl>
        <dl class="accordion">
            <dt class="accordion-hd">
                <a href="javascript:void(0);">关于我们<i></i></a>
            </dt>
            <dd class="accordion-bd">
                <ol>
                    <?php foreach ($abouts as $val) :?>
                    <li<?php if (isset($info) && $val['id'] == $info['id']) :?> class="selected"<?php endif;?>><span>·</span><?php echo anchor('about/'.$val['id'], $val['title']);?></a></li>
                    <?php endforeach;?>
                </ol>
            </dd>
        </dl>
        <dl class="selected">
            <dt><a href="<?php echo site_url('link');?>">友情链接<i></i></a></dt>
        </dl>
    </section>
</div>