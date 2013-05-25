<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">
    <form class="post-form" method="post" action="<?php echo site_url('admin/post/add');?>">
        <div class="post-body clearfix">
            <div class="post-main-left">
                <div class="controls-row mb10">
                    <div class="pull-left">
                        <label class="control-label-title" for="J_title">标题：</label>
                        <input class="span7 mr10 input-post-title" type="text" name="title" id="J_title">
                    </div>
                    <div class="pull-right">
                        <label class="control-label-price" for="price">价格：</label>
                        <input class="span3" type="text" name="price" id="price">
                    </div>
                </div>
                <textarea class="hide" name="content" id="content"></textarea>
                <div class="form-horizontal mt20">
                    <div class="control-group">
                        <label class="control-label">商品链接：</label>
                        <div id="J_linkdiv" class="controls controls-row">
                            <div class="J_link pull-left mb10">
                                <select class="input-medium pull-left mr10" name="link_mid[]">
                                    <?php foreach($mall_list as $val):?>
                                        <option value="<?php echo $val['id'];?>"><?php echo $val['name'];?></option>
                                    <?php endforeach;?>
                                </select>
                                <input class="span2" type="text" name="link_title[]" placeholder="链接标题">
                                <input class="span4" type="text" name="link_url[]" placeholder="链接地址">
                            </div>
                            <button class="J_addlink btn btn-small ml10" type="button"><i class="icon-plus-sign"></i>
                                增加链接
                            </button>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="seo_keywords">SEO关键字：</label>
                        <div class="controls">
                            <input name="seo_keywords" class="span8" type="text" id="seo_keywords">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="seo_description">SEO描述文字：</label>
                        <div class="controls">
                            <textarea name="seo_description" class="span8" rows="3" id="seo_description"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="post-main-right">
                <div class="post-block">
                    <h3>商品图片</h3>
                    <div class="inside">
                        <div class="text-center hide mb10" id="J_preview"><img src="" /></div>
                        <div class="post-image text-center">
                            <button class="btn btn-small" type="button" id="J_upload_img" data-uri="<?php echo site_url('admin/post/upload_img');?>">上传图片</button>
                        </div>
                        <input type="hidden" name="img" id="J_img">
                    </div>
                </div>
                <div class="post-block">
                    <h3>选择分类</h3>
                    <div class="inside">
                        <div class="post-check-cat">
                            <ul class="unstyled check-cat-tree">
                                <?php echo $list_html;?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="post-block">
                    <h3>标签</h3>
                    <div class="inside">
                        <div id="J_tagsdiv" class="post-tag">
                            <input name="tags" class="J_tags" type="hidden" name="tags" value="">
                            <div class="J_taglist post-tag-list mb5"></div>
                            <div class="input-append post-tag-add">
                                <input class="J_newtag input-medium" type="text">
                                <button class="J_addtag btn" type="button">添加</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-block">
                    <h3>其他</h3>
                    <div class="inside">
                        <label class="control-label" for="author">推荐人：</label>
                        <input name="author" class="input-medium" type="text" id="author">
                        <label class="control-label" for="post_time">发布时间：</label>
                        <div id="J_post_time" class="input-append">
                            <input name="post_time" class="input-medium" data-format="yyyy-MM-dd hh:mm" type="text" value="<?php echo date('Y-m-d H:i');?>">
                            <span class="add-on">
                                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                            </span>
                        </div>
                        <label class="control-label" for="orderid">排序：</label>
                        <input class="input-medium" type="number" id="orderid" name="orderid" min="1" max="255" value="255">
                        <label class="control-label" for="author">属性：</label>
                        <label class="checkbox inline">
                            <input type="checkbox" name="topped" value="1"> 置顶
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" name="isrcd" value="1"> 推荐
                        </label>
                        <label class="checkbox inline">
                            <input type="checkbox" name="ishot" value="1"> 热门
                        </label>
                    </div>
                </div>
            </div>

        </div>
        <div class="form-actions" id="J_actbar">
            <button type="submit" class="btn btn-primary ml20" id="J_publish" data-toggle="ajaxfrom" data-loading-textdddd="发布中...">发布</button>
        </div>
    </form>
</div>
<script>
var GET_TAG_URL = '<?php echo site_url('admin/post/ajax_gettags');?>',
    UPLOAD_URL = '<?php echo site_url('admin/post/upload_editor');?>';
</script>
<?php echo $this->load->view('admin/common/footer'); ?>
</body>
</html>