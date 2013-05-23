<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-5
 * Time: 下午6:23
 * 前台首页
 */

class Welcome extends Front_Controller
{

    public function index()
    {
        //推荐到首页的商品
        $this->load->model('post_model');
        $total_rows = $this->post_model->count();
        $pager = $this->_pager($total_rows, array(
            'base_url' => site_url('page'),
            'page_query_string'=>FALSE,
            'uri_segment' => 2,
        ));
        $this->data['post_list'] = $this->post_model->home_list($pager['limit']['value'], $pager['limit']['offset']);
        $this->data['page_bar'] = $pager['links'];
        //友情链接
        $this->load->model('flink_model');
        $this->data['flink_list'] = $this->flink_model->home_list();
        //SEO
        $this->load->model('seo_model');
        $page_seo = $this->seo_model->get_page('welcome');
        $this->_set_seo(elements(array('title', 'keywords', 'description'), $page_seo));
        $this->load->view($this->cm, $this->data);
    }

    public function submit()
    {
        if (!$this->visitor->logged_in) {
            redirect('user/login');
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('title', '标题', 'trim|required');
            $this->form_validation->set_rules('link', '链接', 'trim|required');
            $this->form_validation->set_rules('origin', '来源', 'intval|required');
            $this->form_validation->set_rules('origin_link', '来源网址', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                return $this->show_message($this->form_validation->error_string(), 0);
            } else {
                $data = elements(array('title', 'link', 'origin', 'origin_link', 'reason'), $this->input->post(NULL, TRUE));
                $data['uid'] = $this->visitor->info['id'];
                $this->load->model('submit_model');
                if ($this->submit_model->add($data)) {
                    return $this->show_message('爆料成功！');
                } else {
                    return $this->show_message('爆料失败！', 0);
                }
            }
        } else {
            $this->_set_seo(array('title'=>'我要爆料 | 网友优惠促销信息提交页面_{sitename}'));
            $this->load->view($this->cm, $this->data);
        }
    }

}