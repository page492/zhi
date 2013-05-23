<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-4
 * Time: 下午7:23
 * SEO设置
 */

class Seo extends Admin_Controller
{

    public function index()
    {
        if ($data = $this->input->post()) {
            $this->model->sets($data['seo']);
            $this->show_message('操作成功');
        } else {
            $this->data['list'] = $this->model->get_default();
            $this->load->view($this->dcm, $this->data);
        }
    }
}