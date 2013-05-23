<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-18
 * Time: 下午6:00
 * 爆料管理
 */

class Submit extends Person_Controller
{

    public function index()
    {
        $this->load->model('submit_model');
        $total_rows = $this->submit_model->where('uid', $this->visitor->info['id'])->count();
        $pager = $this->_pager($total_rows);
        $this->data['list'] = $this->submit_model->where('uid', $this->visitor->info['id'])->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page_bar'] = $pager['links'];
        $this->load->view($this->dcm, $this->data);
    }

}