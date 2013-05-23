<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-24
 * Time: 上午12:35
 * 网站信息
 */

class Site extends Front_Controller
{
    public function help($id)
    {
        $this->load->model('article_model');
        $this->data['info'] = $this->article_model->find($id);
        $this->data['open_menu'] = 0;
        $this->load->view('site/index', $this->data);
    }

    public function about($id)
    {
        $this->load->model('article_model');
        $this->data['info'] = $this->article_model->find($id);
        $this->data['open_menu'] = 1;
        $this->load->view('site/index', $this->data);
    }

    public function link()
    {
        $this->load->model('flink_cat_model');
        $this->load->model('flink_model');
        $this->data['cats'] = $this->flink_cat_model->get_kv_list();
        $this->data['list'] = $this->flink_model->get_list_of_cat();
        $this->load->view($this->cm, $this->data);
    }
}