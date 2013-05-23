<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-6
 * Time: 下午11:44
 * To change this template use File | Settings | File Templates.
 */
class Node_model extends HP_Model
{

    /**
     * 获取分级下拉菜单
     * @param int $select
     * @return mixed
     */
    public function select_tree($select = 0)
    {
        $result = $this->find_all();
        $this->load->library('tree');
        $array = array();
        foreach ($result as $r) {
            $r['selected'] = $r['node_id'] == $select ? 'selected' : '';
            $r['tree_id'] = $r['node_id'];
            $array[] = $r;
        }
        $str = "<option value='\$node_id' \$selected>\$spacer \$name</option>";
        $this->tree->init($array);
        return $this->tree->get_tree(0, $str);
    }
}
