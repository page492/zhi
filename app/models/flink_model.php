<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午10:46
 * To change this template use File | Settings | File Templates.
 */

class Flink_model extends HP_Model
{
    public function home_list()
    {
        if (FALSE === $list = $this->cache->get('index_flink')) {
            $list = $this->order_by('orderid,id DESC')->limit(10)->find_all();
            $this->cache->file->save('index_flink', $list);
        }
        return $list;
    }

    public function get_list_of_cat()
    {
        if (FALSE === $list = $this->cache->get('flink')) {
            $result = $this->order_by('orderid')->find_all();
            $list = array();
            foreach ($result as $val) {
                $list[$val['cid']][] = $val;
            }
            $this->cache->file->save('flink', $list);
        }
        return $list;
    }

    /**
     * 清理缓存
     */
    public function clear_cache()
    {
        $this->cache->delete('flink');
        $this->cache->delete('index_flink');
    }
}