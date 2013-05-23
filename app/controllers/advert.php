<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-24
 * Time: 上午12:35
 * 广告
 */

class Advert extends Front_Controller
{
    public function tgo($id)
    {
        $this->load->model('advert_model');
        $ad = $this->advert_model->find($id);
        redirect($ad['link']);
    }
}