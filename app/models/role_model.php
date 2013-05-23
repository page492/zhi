<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-30
 * Time: 下午10:34
 * 用户组模型
 */

class Role_model extends HP_Model
{

    public function get_cache()
    {
        if (FALSE === $role = $this->cache->get('role')) {
            $role = array();
            $result = $this->find_all();
            foreach ($result as $val) {
                $role[$val['role_id']] = $val['name'];
            }
            $this->cache->save('role', $role);
        }
        return $role;
    }

    public function get_system_idarr()
    {
        $array = array();
        $result = $this->role_model->where('type', 'system')->find_all();
        foreach ($result as $val) {
            $array[] = $val['role_id'];
        }
        return $array;
    }
}