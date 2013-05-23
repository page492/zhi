<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-6
 * Time: 下午11:44
 * 推荐分类模型
 */
class Category_model extends HP_Model
{
    protected function _after_insert($data)
    {
        $this->clear_cache();
    }

    protected function _after_update($data)
    {
        $this->clear_cache();
    }

    protected function _after_delete($data)
    {
        $this->clear_cache();
    }

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
     * 无层级的分类数据
     */
    public function get_list()
    {
        if (FALSE === $list = $this->cache->get('category_list')) {
            $result = $this->order_by('orderid')->find_all();
            foreach ($result as $val) {
                $list[$val['cid']] = $val;
            }
            $this->cache->file->save('category_list', $list);
        }
        return $list;
    }

    /**
     * 有层级的分类数据
     */
    public function get_level_list()
    {
        if (FALSE === $list = $this->cache->get('category_level_list')) {
            $result = $this->order_by('orderid')->find_all();
            foreach ($result as $val) {
                if ($val['parent_id'] == '0') {
                    $list['p'][$val['cid']] = $val;
                } else {
                    $list['s'][$val['parent_id']][$val['cid']] = $val;
                }
            }
            $this->cache->file->save('category_level_list', $list);
        }
        return $list;
    }

    /**
     * 获取所有子孙分类的ID
     *
     * @param $cid
     * @param bool $with_self
     * @return array
     */
    public function get_posterity_cids($cid, $with_self = FALSE)
    {
        $result = $this->select('parent_path')->where(array('cid'=>$cid))->find();
        $parent_path = $result['parent_path'];
        $parent_path = $parent_path ? $parent_path .= $cid .'|' : $cid .'|';
        $posterity = $this->select('cid')->like('parent_path', $parent_path, 'after')->find_all();
        $cid_arr = array();
        foreach ($posterity as $val) {
            $cid_arr[] = $val['cid'];
        }
        $with_self && $cid_arr[] = $cid;
        return $cid_arr;
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

    /**
     * 获取ID=>NAME 数据
     */
    public function get_kv_list()
    {
        if (FALSE === $list = $this->cache->get('category_kv_list')) {
            $list = array();
            $result = $this->find_all();
            foreach ($result as $val) {
                $list[$val['cid']] = $val['name'];
            }
            $this->cache->save('category_kv_list', $list);
        }
        return $list;
    }

    public function get_name_by_cid($cid) {
        $kv_list = $this->get_kv_list();
        return $kv_list[$cid];
    }

    /**
     * 清理配置缓存
     */
    public function clear_cache()
    {
        $this->cache->delete('category_list');
        $this->cache->delete('category_level_list');
        $this->cache->delete('category_kv_list');
    }
}
