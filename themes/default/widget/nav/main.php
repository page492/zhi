<ul>
<?php foreach ($nav as $val) : ?>
    <li <?php if ($val['link'] == $current_nav) : ?>class="nav-on"<?php endif; ?>>
        <a href="<?php echo $val['link']; ?>"><span><?php echo $val['name']; ?></span></a>
    </li>
<?php endforeach; ?>
</ul>