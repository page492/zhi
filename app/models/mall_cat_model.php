<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-3
 * Time: 下午10:08
 * 商城分类模型
 */

class Mall_cat_model extends HP_Model
{
    public function get_list()
    {
        return $this->where('isshow', '1')->order_by('orderid,cid DESC')->find_all();
    }
}