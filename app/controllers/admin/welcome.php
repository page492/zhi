<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-4
 * Time: 下午12:14
 * 管理后台首页
 */
class Welcome extends Admin_Controller
{

    protected $auto_load_model = FALSE;

	public function index()
	{
        $this->load->model('node_model');
        $this->data['top_nav'] = $this->node_model->where('parent_id', 0)->order_by('orderid')->find_all();
		$this->load->view($this->dcm, $this->data);
	}

    public function login()
    {
        if ($this->visitor->logged_in) {
            redirect('admin');
        }
        if ($data = $this->input->post(NULL, TRUE)) {
            $data = elements(array('username', 'password'), $data);
            $this->load->model('role_model');
            $role_allow = $this->role_model->get_system_idarr();
            $this->load->model('user_model');
            $admin_info = $this->user_model->select('id,username,role_id,credit')->where(array('username'=>$data['username'], 'password'=>md5($data['password'])))->where_in('role_id', $role_allow)->find();
            if ($admin_info) {
                $this->visitor->assign($admin_info);
                return $this->show_message('登陆成功', 1);
            } else {
                return $this->show_message('登陆失败，请检查用户名和密码是否正确。', 0);
            }
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function logout()
    {
        $this->visitor->logout();
        redirect('admin/welcome/login');
    }

    /**
     * 后台首页
     */
    public function panel()
    {
        $this->load->view($this->dcm, $this->data);
    }

    public function side_nav()
    {
        $id = $this->input->post('id');
        $this->load->model('node_model');
        $this->data['side_nav'] = $this->node_model->where('parent_id', $id)->order_by('orderid')->find_all();
        $this->load->view($this->dcm, $this->data);
    }
}