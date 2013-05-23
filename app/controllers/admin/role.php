<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-30
 * Time: 下午10:25
 * 用户组
 */

class Role extends Admin_Controller
{
    protected $order_by = 'role_id';

    public function index($type = 'member')
    {
        $options = array('where'=>array('type', $type));
        $this->_list($this->model, $options);
        $this->data['type'] = $type;
        $this->load->view($this->dcm, $this->data);
    }

    protected function _before_add($type = 'member')
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写用户组名称', 0);
        } else {
            $this->data['type'] = $type;
        }
    }

    protected function _before_edit()
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写用户组名称', 0);
        }
    }
}