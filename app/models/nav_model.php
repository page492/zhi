<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-30
 * Time: 下午5:07
 * 导航模型
 */

class Nav_model extends HP_Model
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

    /**
     * 分组形式返回
     */
    public function get_group()
    {
        if (FALSE === $result = $this->cache->get('nav')) {
            $result = $this->order_by('orderid')->find_all();
            $this->cache->save('nav', $result);
        }
        $list = array();
        foreach ($result as $val) {
            $list[$val['type']][] = $val;
        }
        return $list;
    }

    /**
     * 获取分级下拉菜单
     * @param int $select
     * @return mixed
     */
    public function select_tree($select = 0)
    {
        if (FALSE === $result = $this->cache->get('nav')) {
            $result = $this->order_by('orderid')->find_all();
            $this->cache->save('nav', $result);
        }
        $this->load->library('tree');
        $array = array();
        foreach ($result as $r) {
            $r['selected'] = $r['id'] == $select ? 'selected' : '';
            $r['tree_id'] = $r['id'];
            $array[] = $r;
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $this->tree->init($array);
        return $this->tree->get_tree(0, $str);
    }

    /**
     * 清理配置缓存
     */
    public function clear_cache()
    {
        $this->cache->delete('nav');
    }
}