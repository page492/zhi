<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-5
 * Time: 下午6:24
 * 前台基类
 */

class Front_Controller extends HP_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->_switch_theme();//模板
        $this->load->helper('datetime');
    }

    /**
     * 初始视图数据
     */
    private  function _switch_theme()
    {
        $this->load->set_theme();
        $current_theme = $this->setting['site']['current_theme'];
        if ($current_theme != 'default') {
            $this->load->set_theme($current_theme);
        }
        $this->data['theme_url'] = base_url('themes/'.$current_theme);
    }

    protected  function _init_view()
    {
        parent::_init_view();
        $this->_set_seo();
        $this->load->model('article_model');
        $this->data['helps'] = $this->article_model->get_helps();//帮助中心
        $this->data['abouts'] = $this->article_model->get_abouts();//网站信息
        $this->config->load('oauth2');
        $this->data['bind_list'] = $this->config->item('oauth2');
    }

    /**
     * 初始化访问者
     */
    protected  function _init_visitor()
    {
        $this->visitor = new User_Visitor();
        if ($this->setting['site']['visit_status'] == '0') {
            show_error($this->setting['site']['visit_explain'], 500, '暂时关闭');
        }
    }

    protected function _set_seo($page_seo = array(), $data = array())
    {
        $default_seo = array(
            'title' => '{sitename}',
            'description' => '{sitename}',
            'keywords' => '{sitename}',
        );
        $page_seo = array_merge($default_seo, $page_seo);
        $searchs = array('{sitename}');
        $replaces = array($this->setting['site']['site_name']);
        preg_match_all("/\{([a-z0-9_-]+?)\}/", implode(' ', array_values($page_seo)), $pageparams);
        if ($pageparams) {
            foreach ($pageparams[1] as $var) {
                $searchs[] = '{' . $var . '}';
                $replaces[] = element($var, $data) ? $data[$var] : '';
            }
            $searchspace = array('((\s*\-\s*)+)', '((\s*\,\s*)+)', '((\s*\|\s*)+)', '((\s*\t\s*)+)', '((\s*_\s*)+)');
            $replacespace = array('-', ',', '|', ' ', '_');
            foreach ($page_seo as $key => $val) {
                $page_seo[$key] = trim(preg_replace($searchspace, $replacespace, str_replace($searchs, $replaces, $val)), ' ,-|_');
            }
        }
        $this->data['page_seo'] = $page_seo;
    }

    /**
     * 分页
     * @param $total_rows
     * @param array $config
     * @return array
     */
    protected function _pager($total_rows, $config = array())
    {
        $this->load->library('pagination');
        $default_config['base_url'] = site_url($this->uri->uri_string().'?');
        $default_config['total_rows'] = $total_rows;
        $default_config['per_page'] = 1;
        $default_config['num_links'] = 3;
        $default_config['use_page_numbers'] = TRUE;
        $default_config['first_tag_open'] = $default_config['last_tag_open'] = $default_config['next_tag_open'] = $default_config['prev_tag_open'] = $default_config['num_tag_open'] = ' ';
        $default_config['first_tag_close'] = $default_config['last_tag_close'] = $default_config['next_tag_close'] = $default_config['prev_tag_close'] = $default_config['num_tag_close'] = ' ';
        $default_config['cur_tag_open'] = '<span class="current">';
        $default_config['cur_tag_close'] = '</span>';
        $default_config['first_link'] = '首页';
        $default_config['last_link'] = '尾页';
        $default_config['prev_link'] = '上一页';
        $default_config['next_link'] = '下一页';
        $default_config['page_query_string'] = TRUE;
        $default_config['query_string_segment'] = 'page';
        $config = array_merge($default_config, $config);
        $this->pagination->initialize($config);
        $links = $this->pagination->create_links();
        $cur_page = $this->pagination->cur_page ? $this->pagination->cur_page : 1;
        $limit_offset = ($cur_page - 1) * $config['per_page'];
        return array(
            'links' => $links,
            'limit' => array('value' => $config['per_page'], 'offset' => $limit_offset),
        );
    }
}