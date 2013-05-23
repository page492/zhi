<?php $this->load->view('install/header'); ?>
<div class="content clearfix">
    <div class="step clearfix">
        <ul>
            <li class="active"><i>1</i>环境检测</li>
            <li><i>2</i>网站配置</li>
            <li><i>3</i>安装系统</li>
        </ul>
    </div>
    <div class="main check">
        <h4>服务器环境检查</h4>
        <table class="table">
            <thead>
            <tr>
                <th width="35%">项目名称</th>
                <th width="35%">所需环境</th>
                <th>当前服务器</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($check_env as $val) :?>
            <tr <?php if ($val['compatible'] === FALSE) :?>class="error"<?php endif;?>>
                <td><?php echo $val['name'];?></td>
                <td>>= <?php echo $val['required'];?></td>
                <td><i class="<?php if ($val['compatible'] === TRUE) :?>icon-pass<?php else:?>icon-failed<?php endif;?>"></i><?php echo $val['current'];?></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <h4>文件和目录权限检查</h4>
        <table class="table">
            <thead>
            <tr>
                <th width="35%">文件目录</th>
                <th width="35%">所需权限</th>
                <th>当前状态</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($check_file as $val) :?>
            <tr <?php if ($val['compatible'] === FALSE) :?>class="error"<?php endif;?>>
                <td><?php echo $val['file'];?></td>
                <td><?php echo $val['required'];?></td>
                <td><i class="<?php if ($val['compatible'] === TRUE) :?>icon-pass<?php else:?>icon-failed<?php endif;?>"></i><?php echo $val['current'];?></td>
            </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div class="act text-center">
        <a href="<?php echo current_url(); ?>" class="btn">重新检测</a>
        <a href="<?php echo $compatible ? site_url('install/config') : '';?>" class="btn btn-primary<?php if ($compatible !== TRUE) :?> disabled<?php endif;?>">下一步</a>
    </div>
</div>
<?php $this->load->view('install/footer'); ?>