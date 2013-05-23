<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-3
 * Time: 下午11:49
 * 爆料管理
 */

class Submit extends Admin_Controller
{

    public function index()
    {
        $total_rows = $this->model->count();
        $pager = $this->_pager($total_rows);
        $this->data['list'] = $this->model->select('submit.*,user.username')->join('user', 'submit.uid = user.id')->order_by('id DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page'] = $pager['links'];
        $this->load->view($this->dcm, $this->data);
    }

}