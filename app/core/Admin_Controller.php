<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-3
 * Time: 下午11:28
 * 后台控制器扩展
 */
class Admin_Controller extends HP_Controller
{
    //自动加载模型
    protected $auto_load_model = TRUE;
    //列表排序方式
    protected $order_by = 'orderid';

    public function __construct()
    {
        parent::__construct();
        $this->_check_priv();
    }

    private  function _check_priv()
    {
        if (!$this->visitor->logged_in && !in_array($this->router->fetch_method(), array('login'))) {
            redirect('admin/welcome/login');
        }
    }

    protected function _init_view()
    {
        parent::_init_view();
        $this->data['controller'] = $this->router->fetch_class();
    }

    /**
     * 初始化访问者
     */
    protected  function _init_visitor()
    {
        $this->visitor = new Admin_Visitor();
    }

    /**
     * 首页显示数据列表
     */
    public function index()
    {
        $options = $this->_search();
        $this->_list($this->model, $options);
        $this->load->view($this->dcm, $this->data);
    }

    protected function _search()
    {
        $options = array();
        return $options;
    }

    /**
     * 数据列表
     * @param $model
     * @param array $options
     * @param string $order_by
     * @param string $select
     * @param array $pageconf
     */
    protected function _list($model, $options = array(), $order_by = '', $select = '', $pageconf = array())
    {
        $total_rows = $model->count($options);
        $pager = $this->_pager($total_rows);

        $select && $model->select($select);
        $order_by = $order_by ? $order_by : $this->order_by;
        $this->data['list'] = $model->order_by($order_by)->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all($options);
        $this->data['page'] = $pager['links'];
    }

    /**
     * 新增数据
     */
    public function add()
    {
        if ($data = $this->input->post()) {
            //插入前置
            if (method_exists($this, '_before_insert')) {
                $data = $this->_before_insert($data);
            }
            if ($r = $this->model->add($data)) {
                return $this->show_message('操作成功');
            } else {
                return $this->show_message('操作失败', 0);
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $resp = $this->load->view($this->dcm, $this->data, TRUE);
                $this->ajax_return(array(
                    'status' => 1,
                    'html' => $resp,
                ));
            } else {
                $this->load->view($this->dcm, $this->data);
            }
        }
    }

    /**
     * 编辑数据
     */
    public function edit($id = '')
    {
        if ($data = $this->input->post()) {
            //更新前置
            if (method_exists($this, '_before_update')) {
                $data = $this->_before_update($data);
            }
            $pk_val = $data[$this->model->get_primary()];
            unset($data[$this->model->get_primary()]);
            if ($this->model->edit($data, array('where'=>array($this->model->get_primary(), $pk_val)))) {
                return $this->show_message('操作成功');
            } else {
                return $this->show_message('操作失败');
            }
        } else {
            $this->data['info'] = $this->model->find($id);
            if ($this->input->is_ajax_request()) {
                $resp = $this->load->view($this->dcm, $this->data, TRUE);
                $this->ajax_return(array(
                    'status' => 1,
                    'html' => $resp,
                ));
            } else {
                $this->load->view($this->dcm, $this->data);
            }
        }
    }

    /**
     * 删除数据
     */
    public function delete($id = '')
    {
        if ($id_arr = $this->input->post($this->model->get_primary())) {
            $id = implode(',', $id_arr);
        }
        !$id && $this->show_message('请选择需要删除的数据', 0);
        if ($this->model->delete(trim($id, ','))) {
            return $this->show_message('操作成功');
        } else {
            return $this->show_message('操作失败', 0);
        }
    }

    /**
     * 后台分页
     * @param $total_rows
     * @param array $config
     * @return array
     */
    protected function _pager($total_rows, $config = array())
    {
        $this->load->library('pagination');
        $default_config['base_url'] = site_url($this->uri->uri_string().'?');
        $default_config['total_rows'] = $total_rows;
        $default_config['per_page'] = 20;
        $default_config['num_links'] = 9;
        $default_config['use_page_numbers'] = TRUE;
        $default_config['full_tag_open'] = '<ul>';
        $default_config['full_tag_close'] = '</ul>';
        $default_config['first_tag_open'] = $default_config['last_tag_open'] = $default_config['next_tag_open'] = $default_config['prev_tag_open'] = $default_config['num_tag_open'] = '<li>';
        $default_config['first_tag_close'] = $default_config['last_tag_close'] = $default_config['next_tag_close'] = $default_config['prev_tag_close'] = $default_config['num_tag_close'] = '</li>';
        $default_config['cur_tag_open'] = '<li class="active"><span>';
        $default_config['cur_tag_close'] = '</span></li>';
        $default_config['first_link'] = '首页';
        $default_config['last_link'] = '尾页';
        $default_config['prev_link'] = '上一页';
        $default_config['next_link'] = '下一页';
        $default_config['page_query_string'] = TRUE;
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
