<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-31
 * Time: 下午5:18
 * 用户模型
 */

class User_bind_model extends HP_Model
{
    public function get_binded($uid)
    {
        $binded = array();
        $list = $this->where('uid', $uid)->find_all();
        foreach ($list as $val) {
            $binded[] = $val['type'];
        }
        return $binded;
    }
}