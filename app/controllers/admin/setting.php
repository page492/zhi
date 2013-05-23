<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-7
 * Time: 下午12:42
 * 网站配置模型
 */
class Setting extends Admin_Controller
{

    /**
     * 网站设置
     */
    public function index()
    {
        if ($data = $this->input->post()) {
            $this->model->sets($data)->save();
            $this->show_message('操作成功');
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function upload_qrcode()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/',
            'file_name' => 'qrcode.jpg',
            'overwrite' => TRUE,
        ));
        !$result && $this->show_message('上传失败', 0);
        $this->ajax_return(array(
            'status' => '1',
            'data' => array(
                'file_url' => base_url('data/upload/qrcode.jpg')
            )
        ));
    }

    /**
     * 附件设置
     */
    public function attachment()
    {
        if ($data = $this->input->post(NULL, TRUE)) {
            $this->model->set_namespace('attachment')->sets($data)->save();
            $this->show_message('操作成功');
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function follow()
    {
        if ($data = $this->input->post(NULL, TRUE)) {
            $this->model->set_namespace('follow')->sets($data)->save();
            $this->show_message('操作成功');
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

    /**
     * 邮件设置
     */
    public function mail()
    {
        if ($data = $this->input->post(NULL, TRUE)) {
            $this->model->set_namespace('mail')->sets($data)->save();
            $this->show_message('操作成功');
        } else {
            $this->load->view($this->dcm, $this->data);
        }
    }

}