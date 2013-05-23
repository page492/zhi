<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-10
 * Time: 上午12:23
 * 商城控制器
 */

class Mall extends Front_Controller
{

    public function index()
    {
        $this->load->model('mall_cat_model');
        $this->load->model('mall_model');
        $cat_list = $this->mall_cat_model->get_list();
        $cat_malls = array();
        foreach ($cat_list as $val) {
            $cat_malls[$val['cid']] = $val;
        }
        $mall_list = $this->mall_model->get_list();
        foreach ($mall_list as $_mall) {
            $cat_malls[$_mall['cid']]['mall_list'][] = $_mall;
        }
        $this->data['cat_malls'] = $cat_malls;
        $this->load->view('mall/index', $this->data);
    }

    public function detail($alias)
    {
        $this->load->model('mall_model');
        $info = $this->mall_model->find(array('where'=>array('alias', $alias)));
        !$info && show_404();
        $this->data['info'] = $info;
        $this->load->model('post_model');
        $this->data['post_list'] = $this->post_model->get_list_by_mall($info['id'], 10, 0);
        $this->load->view('mall/detail', $this->data);
    }

    public function tgo($id)
    {
        $this->load->model('mall_model');
        $info = $this->mall_model->find($id);
        redirect($info['link']);
    }

}