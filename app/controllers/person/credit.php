<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 下午3:24
 * 我的积分
 */

class Credit extends Person_Controller
{
    public function index()
    {
        $this->load->model('credit_model');
        $total_rows = $this->credit_model->where('uid', $this->visitor->info['id'])->count();
        $pager = $this->_pager($total_rows);
        $this->data['list'] = $this->credit_model->where('uid', $this->visitor->info['id'])->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page_bar'] = $pager['links'];
        $this->load->view($this->dcm, $this->data);
    }
}