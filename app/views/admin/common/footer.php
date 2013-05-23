<?php echo script_tag('assets/js/sea.js', 'seajsnode');?>
<script>
    seajs.use('hold', function (router) {
        router.load('pages/admin/global,pages/admin/<?php echo $controller;?>');
    });
</script>
</body>
</html>