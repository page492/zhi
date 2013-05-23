<?php echo $this->load->view('admin/common/header'); ?>

<body>
<div class="page-wrap">

    <div class="bottom-line block-title">搜索</div>
    <form class="form-inline mb10 p10 bottom-line">
        <label>标题：</label>
        <input type="text" class="input-medium mr20" name="keyword" value="<?php echo element('keyword', $search) && element('keyword', $search);?>">
        <button type="submit" class="btn">搜索</button>
    </form>

    <form action="<?php echo site_url('admin/post/delete'); ?>" method="post">
    <table class="table table-hover table-list">
        <thead>
        <tr>
            <th class="span1"><input type="checkbox" data-toggle='chackall' data-target=".J_checkitem"></th>
            <th class="tl">推荐信息</th>
            <th class="tl">分类</th>
            <th class="span1">访问</th>
            <th class="span1">评论</th>
            <th class="span1">收藏</th>
            <th class="span1">喜欢</th>
            <th class="span1">排序</th>
            <th class="span2">发布时间</th>
            <th class="span2">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($list as $val): ?>
            <tr>
                <td><input type="checkbox" class="J_checkitem" name="id[]" value="<?php echo $val['id'] ?>"></td>
                <td class="tl">
                    <img src="<?php echo $val['img'];?>" width="40" height="40" class="img-polaroid pull-left mr10">
                    <div style="padding-left: 60px;">
                        <a href="<?php echo site_url('post/'.$val['id']);?>" target="_blank"><?php echo $val['title']?></a>
                        <div class="muted">
                            <span class="mr10">商城：<?php echo $val['mall_name']?></span>
                            <span>推荐人：<?php echo $val['author']?></span>
                        </div>
                    </div>
                </td>
                <td class="tl">
                    <?php foreach ($val['categorys'] as $_cat) :?>
                        <?php echo $_cat['name'];?>&nbsp;&nbsp;
                    <?php endforeach;?>
                </td>
                <td><?php echo $val['hits']?></td>
                <td><?php echo $val['comments']?></td>
                <td><?php echo $val['favorites']?></td>
                <td><?php echo $val['likes']?></td>
                <td><?php echo $val['orderid']?></td>
                <td><?php echo date('Y-m-d H:i', $val['post_time']);?></td>
                <td>
                    <a href="<?php echo site_url('admin/post/edit/'.$val['id']);?>" class="mr5"><i class="icon-edit"></i>编辑</a>
                    <a href="<?php echo site_url('admin/post/delete/'.$val['id']);?>" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除文章？"><i class="icon-trash"></i>删除</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <div class="form-actions" id="J_actbar">
        <label class="checkbox pull-left ml20 mr10">
            <input type="checkbox" data-toggle='chackall' data-target=".J_checkitem">全选/反选
        </label>
        <button type="submit" class="btn" data-toggle="ajaxfrom" data-msg="确认要删除所选商品吗？" data-loading-text="删除中...">删除</button>
        <div class="pagination pagination-small pull-right">
            <?php echo $page?>
        </div>
    </div>
    </form>
</div>

<?php echo $this->load->view('admin/common/footer'); ?>