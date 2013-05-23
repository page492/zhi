<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-17
 * Time: 下午5:54
 * 热门标签
 */

class Tag_model extends HP_Model
{
    public function get_top_list($num)
    {
        return $this->order_by('hits DESC')->limit($num)->find_all();
    }
}