<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="detail-page">
    <?php $this->load->view('common/header');?>

    <?php $this->widget('category', array('parent_id'=>'1')) ;?>

    <div class="main">
        <div class="inner-wrap">
            <div class="crumb">
                <div>当前位置:</div>
                <div>
                    <?php echo anchor('', '首页');?>&gt;&gt;
                    <?php foreach ($post['categorys'] as $_cat) {
                        echo anchor('category/'.$_cat['cid'], $_cat['name'], 'title='.$_cat['name']);
                    }?>
                    &gt;&gt;<span class="cur">日志详情</span>
                </div>
            </div>

            <div class="content">
                <section class="feed-detail" id="J_Feeds">
                    <div class="feed-item">
                        <h3 class="item-tit">
                            <?php echo $post['title'];?><span class="item-price"><?php echo $post['price'];?></span>
                        </h3>
                        <div class="item-pic">
                            <div class="item-img"><img src="<?php echo $post['img'];?>" /></div>
                            <div class="item-like">
                                <a href="javascript:void(0);" class="J_like worth" data-post-id="<?php echo $post['id'];?>"><i class="icon-heart"></i>物有所值</a>
                                <a href="javascript:void(0);" class="J_favorite collect" data-post-id="<?php echo $post['id'];?>"><i class="icon-star"></i>收藏该宝贝</a>
                            </div>
                        </div>
                        <div class="item-buy">
                            <?php if (count($post['link_list']) > 1) :?>
                            <a href="javascript:void(0);" class="btn-buy">点击直接购买</a>
                            <ul>
                                <?php foreach ($post['link_list'] as $_link) :?>
                                <li><a href="<?php echo site_url('post/tgo?url='.base64_encode($_link['url']));?>" target="_blank"><?php echo $_link['title'];?></a></li>
                                <?php endforeach;?>
                            </ul>
                            <?php else :?>
                            <a href="<?php echo site_url('post/tgo?url='.base64_encode($post['link_list'][0]['url']));?>" class="btn-buy" target="_blank">点击直接购买</a>
                            <?php endif;?>
                        </div>
                        <div class="item-attr">
                            <div class="item-info">
                                <span class="item-cate">分类:
                                    <?php foreach ($post['categorys'] as $_cat) {
                                        echo anchor('c/'.$_cat['alias'], $_cat['name'], 'title='.$_cat['name']);
                                    }?>
                                </span>
                                <span class="item-origin">商城: <?php echo $post['mall_name']?></span>
                                <span class="item-referee">推荐人: <?php echo $post['author'];?></span>
                            </div>
                            <div class="item-intro">
                                <?php echo $post['content'];?>
                            </div>
                        </div>

                        <div class="item-bar">
                            <div class="times"><i class="icon-time"></i><?php echo friendly_date($post['post_time']);?></div>
                            <div class="shares"><?php $this->widget('share', array('des'=>$post['title'], 'text'=>$post['title'], 'pic'=>$post['img'])) ;?></div>
                        </div>

                        <div class="item-tags">
                            标签：
                            <?php foreach ($post['tag_list'] as $key => $tag) :?>
                            <?php echo anchor('post/tag/'.$key, $tag, 'rel="tag"');?>
                            <?php endforeach; ?>
                        </div>

                        <div class="item-page">
                            <?php if ($context_nav['pre']) :?>
                            <p>上一篇： <?php echo anchor('post/'.$context_nav['pre']['id'], $context_nav['pre']['title']);?><p/>
                            <?php endif;?>
                            <?php if ($context_nav['next']) :?>
                            <p>下一篇： <?php echo anchor('post/'.$context_nav['next']['id'], $context_nav['next']['title']);?><p/>
                            <?php endif;?>
                        </div>
                    </div>
                </section>

                <?php if ($relation_list) :?>
                <section class="recom-mod">
                    <h5 class="hd"><span>你可能还喜欢</span></h5>
                    <div class="bd">
                        <ul class="recom-list clearfix">
                            <?php foreach ($relation_list as $val) :?>
                            <li>
                                <a href="<?php echo site_url('post/'.$val['id']);?>" title="<?php echo $val['title'];?>" class="recom-pic">
                                    <img src="<?php echo $val['img'];?>" alt="<?php echo $val['title'];?>"/>
                                </a>
                                <div class="recom-name"><?php echo anchor('post/'.$val['id'], $val['title']);?></div>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </section>
                <?php endif;?>

                <section class="comment-mod">
                    <h5 class="hd"><span>你想说点什么...</span></h5>
                    <div id="J_PostComment" class="bd">

                        <form id="J_CommentForm" class="comment-form" action="<?php echo site_url('post/comment');?>" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post['id'];?>" />
                            <p>
                                <textarea id="J_CommentContent" name="content" cols="70" rows="4" datatype="*" sucmsg=" " errormsg="请输入评论内容！" nullmsg="请输入评论内容！"></textarea>
                            </p>
                            <p>
                                <input class="btn btn-oran" type="submit" value="发布">
                            </p>
                        </form>

                        <?php if (!empty($comment_list)) :?>
                        <div class="comment-list">
                            <div id="J_CommentList">
                                <?php foreach ($comment_list as $comment) :?>
                                <dl class="comment-item">
                                    <dt class="item-pic">
                                        <img width="50" height="50" alt="<?php echo $comment['username'];?>" src="<?php echo avatar($comment['uid'], 's');?>" class="avatar"/>
                                    </dt>
                                    <dd class="item-intro">
                                        <a><?php echo $comment['username'];?></a>：<?php echo $comment['content'];?> (<?php echo friendly_date($comment['comment_time']);?>)
                                        <div class="item-reply">
                                            <a href="">举报</a>
                                            <span>|</span>
                                            <a href="" title="">回复</a>
                                        </div>
                                    </dd>
                                </dl>
                                <?php endforeach;?>
                            </div>
                            <div id="J_CommentPager" class="pagination fr">
                                <?php echo $page_bar;?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </section>

                <?php if (!element('id', $visitor)) :?>
                <section class="login-mod">
                    <div class="login-method">
                        <?php foreach ($bind_list as $key => $val) :?>
                        <a class="l-<?php echo $key;?>" href="<?php echo site_url('user/clogin/'.$key)?>" title="<?php echo $val['name'];?>">
                            <img src="<?php echo base_url('assets/img/oauth/'.$key.'/login.png');?>" />
                        </a>
                        <?php endforeach;?>
                    </div>
                    <div class="login-desc">您需要登录后才可以留言，请用什么值得买帐号 <?php echo anchor('user/login', '登陆');?> 或 <?php echo anchor('user/register', '免费注册');?></div>
                </section>
                <?php endif;?>
            </div>

            <?php $this->load->view('common/sidebar');?>

        </div>
    </div>
    <!--Main End-->

    <?php $this->load->view('common/footer');?>

<script>
    seajs.use('hold', function (router) {
        router.load('validform,pages/front/global,pages/front/post');
        router.load(HG.THEME_JS + 'poppic.js,'+ HG.THEME_JS +'dropdown.js');
        $(function () {
            $('#J_ShowPic').popPic();
            $('#J_Feeds .item-buy').dropdown({inner: 'ul'});
        });
    });
</script>

<script id="bdshare_js" data="type=tools&amp;uid=6620384"></script>
<script id="bdshell_js"></script>
<script>
    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date() / 3600000)
</script>
</body>
</html>