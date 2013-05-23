<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-3
 * Time: 下午10:11
 * 商城模型
 */

class Mall_model extends HP_Model
{
    public function get_name_by_id($id)
    {
        $result = $this->select('name')->find($id);
        if (!$result) {
            return NULL;
        }
        return $result['name'];
    }

    /**
     * 获取有效商城数据
     */
    public function get_list()
    {
        return $this->where('isshow', '1')->order_by('orderid, id DESC')->find_all();
    }

    /**
     * 获取推荐商家
     * @param $num
     */
    public function get_rcd_list($num)
    {
        return $this->where('isrcd', '1')->order_by('orderid, id DESC')->limit($num)->find_all();
    }
}