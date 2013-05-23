<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-9
 * Time: 上午1:39
 * 广告位模型
 */

class Advert_pt_model extends HP_Model
{
    /**
     * 广告模板列表
     */
    public function get_tpl_list()
    {
        return include_once APPPATH . 'config/advert_tpl.php';
    }

    /**
     * 获取ID=>NAME 数据
     */
    public function get_kv_list()
    {
        $result = $this->find_all();
        $list = array();
        foreach ($result as $val) {
            $list[$val['id']] = $val['name'];
        }
        return $list;
    }
}