                <section class="feed-list" id="J_Feeds">
                    <?php foreach ($post_list as $val) :?>
                    <?php if ($val['topped']) :?>
                    <article class="feed-item sign-hot">
                        <h3 class="item-tit">
                            <i class="item-sign"></i>
                            <a href="<?php echo site_url('post/'.$val['id']); ?>"><?php echo $val['title']; ?><span class="item-price"><?php echo $val['price']; ?></span></a>
                        </h3>
                    </article>
                    <?php else :?>
                    <article class="feed-item">
                        <h3 class="item-tit">
                            <a href="<?php echo site_url('post/'.$val['id']); ?>" target="_blank"><?php echo $val['title']; ?><span class="item-price"><?php echo $val['price']; ?></span></a>
                        </h3>
                        <div class="item-pic">
                            <a class="item-img" href="<?php echo site_url('post/'.$val['id']); ?>" target="_blank"><img src="<?php echo base_url('assets/img/dummy.png');?>" data-original="<?php echo $val['img'];?>" /></a>
                            <div class="item-like">
                                <a href="javascript:void(0);" class="J_like worth" data-post-id="<?php echo $val['id'];?>"><i class="icon-heart"></i>物有所值</a>
                                <a href="javascript:void(0);" class="J_favorite collect" data-post-id="<?php echo $val['id'];?>"><i class="icon-star"></i>收藏该宝贝</a>
                            </div>
                        </div>
                        <div class="item-attr excerpt">
                            <div class="item-info">
                                <span class="item-cate">分类:
                                    <?php foreach ($val['categorys'] as $_cat) :?>
                                        <?php echo anchor('category/'.$_cat['cid'], $_cat['name'], 'title='.$_cat['name']);?>
                                    <?php endforeach;?>
                                </span>
                                <span class="item-origin">商城: <?php echo $val['mall_name']?></span>
                                <span class="item-referee">推荐人: <?php echo $val['author']; ?></span>
                            </div>
                            <div class="item-intro">
                                <?php echo $val['content']; ?>
                            </div>
                        </div>
                        <div class="item-drawer">
                            <a href="" class="down">展开全文<i class="icon-chevron-down"></i></a>
                            <a href="" class="up none">向上收起<i class="icon-chevron-up"></i></a>
                        </div>
                        <div class="item-bar">
                            <div class="times"><i class="icon-time"></i><?php echo friendly_date($val['post_time']);?></div>
                            <div class="shares"><?php $this->widget('share', array('des'=>$val['title'], 'text'=>$val['title'], 'pic'=>$val['img'])) ;?></div>
                            <div class="item-buy">
                                <?php if (count($val['link_list']) > 1) :?>
                                <a href="javascript:void(0);" class="btn-buy">点击直接购买</a>
                                <ul>
                                    <?php foreach ($val['link_list'] as $_link) :?>
                                    <li><a href="<?php echo site_url('post/tgo?url='.base64_encode($_link['url']));?>" target="_blank"><?php echo $_link['title'];?></a></li>
                                    <?php endforeach;?>
                                </ul>
                                <?php else :?>
                                <a href="<?php echo site_url('post/tgo?url='.base64_encode($val['link_list'][0]['url']));?>" class="btn-buy" target="_blank">点击直接购买</a>
                                <?php endif;?>
                            </div>
                        </div>
                        <i class="item-sign"></i>
                    </article>
                    <?php endif;?>
                    <?php endforeach; ?>
                </section>

                <?php if ($page_bar) :?>
                <section class="pagination">
                <?php echo $page_bar;?>
                </section>
                <?php endif;?>