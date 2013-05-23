<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午10:46
 * To change this template use File | Settings | File Templates.
 */

class Flink_cat_model extends HP_Model
{
    /**
     * 获取ID=>NAME 数据
     */
    public function get_kv_list()
    {
        if (FALSE === $list = $this->cache->get('flink_cat')) {
            $result = $this->find_all();
            $list = array();
            foreach ($result as $val) {
                $list[$val['cid']] = $val['name'];
            }
            $this->cache->save('flink_cat', $list);
        }
        return $list;
    }
}