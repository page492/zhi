<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-4
 * Time: 上午11:51
 * 积分管理
 */

class Credit extends Admin_Controller
{

    protected $model_name = 'credit';
    protected $order_by = 'id DESC';


    public function setting()
    {
        if ($data = $this->input->post()) {
            $this->load->model('setting_model');
            $this->setting_model->set_namespace('credit')->set('rule', $data)->save();
            $this->show_message('操作成功');
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

}