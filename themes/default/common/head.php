<meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="generator" content="HoldPHP <?php echo $hp_version;?>" />
    <title><?php echo $page_seo['title'];?></title>
    <meta name="keywords" content="<?php echo $page_seo['keywords'];?>" />
    <meta name="description" content="<?php echo $page_seo['description'];?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/ico" href="/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="<?php echo $theme_url;?>/assets/style.css" />

    <script>
    var HG = {
        // 程序版本号
        VS: '<?php echo $this->config->item('version', 'system');?>',
        // 模板JS路径
        THEME_JS: '<?php echo $theme_url;?>/assets/js/',
        // 当前用户ID
        UID: '<?php echo $visitor['id']?>',
        // JS中使用到的URL
        URL: {
            LOGIN: '<?php echo site_url('user/login');?>',
            PERSON: '<?php echo site_url('person');?>',
            CAPTCHA: '<?php echo site_url('welcome/captcha');?>',
            FAVORITE: '<?php echo site_url('post/favorite');?>',
            LIKE: '<?php echo site_url('post/like');?>'
        }
    }
    </script>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('assets/js/lib/html5shiv.js');?>"></script>
    <![endif]-->