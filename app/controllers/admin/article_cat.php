<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-23
 * Time: 下午4:34
 * 文章分类控制器
 */

class Article_cat extends Admin_Controller
{

    public function index()
    {
        $result = $this->model->find_all();
        $this->load->library('tree');
        $this->tree->icon = array('│ ', '├─ ', '└─ ');
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $array = array();
        foreach ($result as $r) {
            $r['str_manage'] = '<a class="mr5" href="' . site_url('admin/article_cat/add/' . $r['cid']) . '" data-toggle="dialog" data-title="添加分类" data-id="add"><i class="icon-plus"></i> 添加子分类</a>
                                <a class="mr5" href="' . site_url('admin/article_cat/edit/' . $r['cid']) . '" data-toggle="dialog" data-title="添加分类" data-id="add"><i class="icon-edit"></i> 编辑</a>
                                <a href="' . site_url('admin/article_cat/delete/' . $r['cid']) . '" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除分类？"><i class="icon-trash"></i> 删除</a>';
            $r['tree_id'] = $r['cid'];
            $array[] = $r;
        }
        $str = "<tr>
                    <td><input class='J_checkitem' type='checkbox' name='cid[]' value='\$cid'></td>
                    <td class='tl'>\$spacer\$name</td>
                    <td>\$orderid</td>
                    <td>\$str_manage</td>
                 </tr>";
        $this->tree->init($array);
        $this->data['list_html'] = $this->tree->get_tree(0, $str);
        $this->load->view($this->dcm, $this->data);
    }

    protected function _before_add($pid = 0)
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写分类名称', 0);
        } else {
            $this->data['list_select'] = $this->model->select_tree($pid);
        }
    }

    protected function _before_insert($data)
    {
        $data['parent_path'] = $this->model->get_parent_path($data['parent_id']);
        return $data;
    }

    protected function _before_edit($id = '')
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写分类名称', 0);
        } else {
            $this->data['info'] = $this->model->find($id);
            $this->data['list_select'] = $this->model->select_tree($this->data['info']['parent_id']);
        }
    }

    protected function _before_update($data)
    {
        $data['parent_path'] = $this->model->get_parent_path($data['parent_id']);
        return $data;
    }

}