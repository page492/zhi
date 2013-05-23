<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-8
 * Time: 下午7:41
 * 商品分类挂件
 */

class Category_Widget extends Widget
{
    public function render()
    {
        $parent_id = $this->_extract('parent_id', '0');
        $this->load->model('category_model');
        $cat_list = $this->category_model->get_list();
        $top_cat = $cat_list[$parent_id];
        $category_level_list = $this->category_model->get_level_list();
        if ($parent_id == '0') {
            $list = $category_level_list;
        } else {
            $list = array(
                't' => $top_cat,
                'p' => $category_level_list['s'][$parent_id],
                's' => $category_level_list['s'],
            );
        }
        $data['list'] = $list;
        $this->load->view('widget/category', $data);
    }
}