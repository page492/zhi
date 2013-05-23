<?php foreach ($side_nav as $val):?>
<li><a href="" data-toggle="tab" data-hold-toggle="sidenav" data-uri="<?php echo site_url('admin/'.$val['controller'].'/'.$val['method']);?>" data-id="<?php echo $val['node_id'];?>"><i class="icon-chevron-right"></i><?php echo $val['name'];?></a></li>
<?php endforeach;?>