<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-23
 * Time: 下午4:42
 * 文章分类模型
 */

class Article_cat_model extends HP_Model
{
    public function select_tree($select = 0)
    {
        $result = $this->order_by('orderid')->find_all();
        $this->load->library('tree');
        $array = array();
        foreach ($result as $r) {
            $r['selected'] = $r['cid'] == $select ? 'selected' : '';
            $r['tree_id'] = $r['cid'];
            $array[] = $r;
        }
        $str = "<option value='\$cid' \$selected>\$spacer \$name</option>";
        $this->tree->init($array);
        return $this->tree->get_tree(0, $str);
    }

    /**
     * 获取分类path
     * @param $pid
     * @return int|string
     */
    public function get_parent_path($parent_id)
    {
        if (!$parent_id) {
            return 0;
        }
        $result = $this->select('parent_path')->where(array('cid'=>$parent_id))->find();
        $parent_path = $result['parent_path'];
        if ($parent_path) {
            $parent_path = $parent_path . $parent_id . '|';
        } else {
            $parent_path = $parent_id . '|';
        }
        return $parent_path;
    }
}