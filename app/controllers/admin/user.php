<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-31
 * Time: 下午5:12
 * 用户管理
 */

class User extends Admin_Controller
{
    protected $order_by = 'id DESC';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('role_model');
        $result_roles = $this->role_model->find_all();
        $list_role = array();
        foreach ($result_roles as $_role) {
            $list_role[$_role['role_id']] = $_role['name'];
        }
        $this->data['list_role'] = $list_role;
    }

    protected function _search()
    {
        $options = array();
        ($username = $this->input->get('username')) && $options['like'] = array('username', $username);
        $this->data['search'] = $this->input->get();
        return $options;
    }

    protected function _before_add()
    {
        if ($data = $this->input->post()) {
            trim($data['username']) == '' && $this->show_message('请填写用户名', 0);
        }
    }

    protected function _before_edit()
    {
        if ($data = $this->input->post()) {
            trim($data['username']) == '' && $this->show_message('请填写用户名', 0);
        }
    }

}