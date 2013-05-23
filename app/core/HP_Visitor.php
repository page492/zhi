<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-18
 * Time: 下午10:07
 * 访问者基础类，集合了当前访问用户的操作
 */

class HP_Visitor {

    // 登陆状态
    public $logged_in = FALSE;
    // 访问者信息
    public $info = NULL;
    // 授权角色
    protected $role_allow = NULL;

    public function __construct()
    {
        $user_info = $this->session->userdata('user_info');
        if ($user_info && ($this->role_allow == 'all' || in_array($user_info['role_id'], $this->role_allow))) {
            $this->info = $user_info;
            $this->logged_in = TRUE;
        }
    }

    public function assign($user_info)
    {
        $this->session->set_userdata('user_info', $user_info);
    }

    public function logout()
    {
        $this->session->unset_userdata('user_info');
    }

    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }

}