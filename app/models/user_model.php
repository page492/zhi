<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-31
 * Time: 下午5:18
 * 用户模型
 */

class User_model extends HP_Model
{

    protected function _before_insert(&$data)
    {
        $data['create_time'] = time();
        $data['last_time'] = time();
        $data['password'] = md5($data['password']);
        $data['role_id'] = 2;
    }

    public function is_unique($field, $value)
    {
        return $this->where($field, $value)->count();
    }

    public function edit_credit($uid, $credit)
    {
        $this->db->set('credit', 'credit+'.$credit, FALSE)->where('id', $uid)->update('user');
    }

    public function get_avatar_dir($uid)
    {
        $uid = abs(intval($uid));
        $uid = sprintf("%09d", $uid);
        $dir1 = substr($uid, 0, 3);
        $dir2 = substr($uid, 3, 2);
        $dir3 = substr($uid, 5, 2);
        return $dir1.'/'.$dir2.'/'.$dir3.'/';
    }

}