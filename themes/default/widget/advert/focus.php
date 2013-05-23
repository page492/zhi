<!--首页焦点图-->
<section class="carousel" id="J_Slide">
    <ul class="carousel-inner">
        <?php foreach ($list as $val) :?>
        <li><?php echo $val['html'];?></li>
        <?php endforeach;?>
    </ul>
    <a class="carousel-control prev" href="#">‹</a>
    <a class="carousel-control next" href="#">›</a>
    <div class="carousel-indicators">
        <?php foreach ($list as $val) :?>
        <span></span>
        <?php endforeach;?>
    </div>
</section>