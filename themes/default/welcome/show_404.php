<!DOCTYPE html>
<html>
<head>
    <?php $this->load->view('common/head');?>
</head>
<body id="home-page">
    <?php $this->load->view('common/header');?>

    <div class="main">
        <div class="inner-wrap">

        </div>
    </div>   <!--Main End-->

    <?php $this->load->view('common/footer');?>

    <script>
        seajs.use('hold', function (router) {
            router.load('pages/front/global');
        });
    </script>

    <?php $this->load->view('common/foot_js');?>

</body>
</html>