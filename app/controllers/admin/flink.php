<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午10:00
 * 友情链接
 */

class Flink extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('flink_cat_model');
        $this->data['list_cat'] = $this->flink_cat_model->get_kv_list();
    }
}