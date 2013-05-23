<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 上午12:10
 * 后台访问者
 */

class Admin_Visitor extends HP_Visitor
{
    public function __construct()
    {
        $this->role_allow = array();
        $this->load->model('role_model');
        $this->role_allow = $this->role_model->get_system_idarr();
        parent::__construct();
    }
}