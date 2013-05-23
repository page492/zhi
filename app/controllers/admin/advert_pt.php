<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午11:57
 * 广告位置
 */

class Advert_pt extends Admin_Controller
{
    protected $order_by = 'id DESC';

    public function __construct()
    {
        parent::__construct();
        //广告模板
        $this->data['tpl_list'] = $this->model->get_tpl_list();
    }

}