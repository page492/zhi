<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-9
 * Time: 上午1:41
 * 广告模型
 */

class Advert_model extends HP_Model
{
    /**
     * 获取一个位置下面的广告列表
     * @param $pt_id
     */
    public function get_bypt($pt_id)
    {
        $time = time();
        $where = array(
            'pt_id' => $pt_id,
            'start_time <=' => $time,
            'end_time >=' => $time,
            'isshow' => '1'
        );
        return $this->where($where)->order_by('orderid')->find_all();
    }

    protected function _before_insert(&$data) {
        $data['content'] = $data[$data['type']];
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
    }

    protected function _before_update(&$data, $options) {
        $data['content'] = $data[$data['type']];
        $data['start_time'] = strtotime($data['start_time']);
        $data['end_time'] = strtotime($data['end_time']);
    }
}