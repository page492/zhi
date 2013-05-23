<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-21
 * Time: 下午11:43
 * 分词
 */

require('pscws4/pscws4.class.php');

class HP_Cscw extends PSCWS4 {

    public function __construct($config)
    {
        parent::__construct($config['charset']);
        $this->set_dict(APPPATH.'libraries/segm/etc/dict.utf8.xdb');
        $this->set_rule(APPPATH.'libraries/segm/etc/rules.ini');
    }
}

/*-------------------------用例-------------------------
$this->load->library('segm/cscw', array(
    'charset' => 'utf8',
));
$this->cscw->send_text('没有共产党就没有新中国');
$some = $this->cscw->get_result();
$some = $this->cscw->get_tops(10, 'n,v');
------------------------------------------------------*/