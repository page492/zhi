<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-3
 * Time: 下午11:28
 * 控制器扩展
 */
class HP_Controller extends CI_Controller
{
    //是否自动加载模型
    protected $auto_load_model = FALSE;
    //模型名称
    protected $model_name = NULL;
    //模型对象
    protected $model = NULL;
    //页面路径
    protected $dcm = NULL;
    //网站配置
    protected $setting = array();
    //视图数据
    protected $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->dcm = $this->router->fetch_directory() . $this->router->fetch_class() . '/' . $this->router->fetch_method();
        $this->cm = $this->router->fetch_class() . '/' . $this->router->fetch_method();
        //自动加载相对应的数据模型
        if ($this->auto_load_model) {
            $model_name = $this->model_name ? $this->model_name . '_model' : $this->router->fetch_class() . '_model';
            $this->load->model($model_name);
            $this->model = $this->$model_name;
        }
        //加载系统配置文件
        $this->config->load('system', TRUE);
        //网站设置
        $this->load->model('setting_model');
        $this->setting = $this->setting_model->get_cache();
        //加载语言
        //$this->_load_langs();
        $this->_init_visitor(); //初始化访问者
        $this->_init_view(); //初始视图
    }

    /**
     * 初始化语言项(公共语言已经设置自动加载)
     * 以分组/控制器为空间
     */
    private function _load_lang()
    {
        $this->lang->load($this->router->fetch_directory() . 'common');
        $this->lang->load($this->dcm);
    }

    protected function _init_view(){
        $this->data['setting'] = $this->setting;
        $this->load->model('role_model');
        $this->data['role'] = $this->role_model->get_cache();
        $this->data['visitor'] = $this->visitor->info;
        $this->data['hp_version'] = $this->config->item('version', 'system') . ' ' . $this->config->item('release', 'system');
    }

    protected function _upload($field, $config = array())
    {
        $default_config['upload_path'] = 'data/upload/';
        $default_config['allowed_types'] = 'gif|jpg|png';
        $default_config['max_size'] = '2000';
        $config = array_merge($default_config, $config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload($field)) {
            return $this->upload->data();
        } else {
            return FALSE;
        }
    }

    /**
     * ajax返回数据
     */
    protected function ajax_return($data, $type='json')
    {
        if(strtoupper($type)=='JSON') {
            echo $this->output->set_content_type('application/json')->set_output(json_encode($data))->get_output();
        }else{
            // TODO 增加其它格式
        }
        exit;
    }

    /**
     * 消息处理
     */
    protected function show_message($message, $status=1)
    {
        if ($this->input->is_ajax_request()) {
            $this->ajax_return(array(
                'status' => $status,
                'msg' => $message,
            ));
        } else {
            $this->data['message'] = $message;
            $this->data['icon'] = $status ? 'success' : 'error';
            $this->load->view('admin/common/message', $this->data);
            return FALSE;
        }
    }

    /**
     * 字符串提取关键词
     */
    public function ajax_gettags()
    {
        $str = $this->input->get('str');
        $this->load->library('segm/cscw', array(
            'charset' => 'utf8',
        ));
        $this->cscw->send_text($str);
        $result = $this->cscw->get_tops(5);
        $tag_arr = array();
        foreach ($result as $val) {
            $tag_arr[] = $val['word'];
        }
        $this->ajax_return(implode(',', $tag_arr));
    }

    public function captcha()
    {
        $this->load->library('captcha/captcha');
        $this->captcha->resourcesPath = APPPATH . 'libraries/captcha/resources';
        $captcha = $this->captcha->CreateImage();
        $this->session->set_userdata('captcha', $captcha);
        $this->captcha->WriteImage();
        $this->captcha->Cleanup();

    }

    public function check_captcha($input)
    {
        if ($this->session->userdata('captcha') == $input) {
            return TRUE;
        } else {
            $this->form_validation->set_message('check_captcha', '%s 不正确');
            return FALSE;
        }
    }

    /**
     * 调整会员积分
     * @param $action
     * @param $uid
     */
    protected function _alter_credit($action, $uid)
    {
        $credit_rule = $this->setting['credit']['rule'];
        if (!in_array($action, array_keys($credit_rule))) {
            return FALASE;
        }
        $this->load->model('credit_model');
        if (!element('limit', $credit_rule[$action]) || $this->credit_model->check_num($action, $uid, $credit_rule[$action]['limit'])) {
            $this->load->model('user_model');
            $this->user_model->edit_credit($uid, $credit_rule[$action]['credit']);
            $user = $this->user_model->select('username')->find($uid);
            $this->credit_model->add(array(
                'credit' => $credit_rule[$action]['credit'],
                'action' => $action,
                'uid' => $uid,
                'uname' => $user['username'],
                'log_time' => time(),
            ));
        }

    }

    /**
     * _remap实现前置后置操作
     * @param $method
     * @param array $params
     */
    public function _remap($method, $params = array())
    {
        if (method_exists($this, $method)) {
            if (method_exists($this, '_before_'.$method)) {
                if (call_user_func_array(array($this, '_before_'.$method), $params) === FALSE) {
                    return FALSE;
                }
            }
            call_user_func_array(array($this, $method), $params);
            if (method_exists($this, '_after_'.$method)) {
                if (call_user_func_array(array($this, '_after_'.$method), $params) === FALSE) {
                    return FALSE;
                }
            }
        } else {
            show_404();
        }
    }
}