<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-23
 * Time: 下午4:53
 * 文章模型
 */

class Article_model extends HP_Model
{
    protected function _before_insert(&$data)
    {
        $data['create_time'] = time();
    }

    public function get_helps()
    {
        return $this->where(array('cid'=>3))->find_all();
    }

    public function get_abouts()
    {
        return $this->where(array('cid'=>2))->find_all();
    }
}