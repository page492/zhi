<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-4
 * Time: 下午7:21
 * SEO模型
 */

class Seo_model extends HP_Model
{
    public function get_default()
    {
       return $this->where(array('param'=>0))->find_all();
    }

    public function sets($data)
    {
        foreach ($data as $val) {
            $this->where(array('alias'=>$val['alias']))->edit($val);
        }
    }

    public function get_page($alias, $param = 0)
    {
        return $this->where(array('alias'=>$alias, 'param'=>$param))->find();
    }
}