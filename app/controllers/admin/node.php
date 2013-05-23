<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-29
 * Time: 下午11:52
 * 菜单控制器
 */
class Node extends Admin_Controller {

	public function index()
	{
        $result = $this->model->find_all();
        $this->load->library('tree');
        $this->tree->icon = array('│ ', '├─ ', '└─ ');
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $array = array();
        foreach ($result as $r) {
            $r['str_manage'] = '<a class="mr5" href="' . site_url('admin/node/add/' . $r['node_id']) . '" data-toggle="dialog" data-title="添加菜单" data-id="add"><i class="icon-plus"></i> 添加子菜单</a>
                                <a class="mr5" href="' . site_url('admin/node/edit/' . $r['node_id']) . '" data-toggle="dialog" data-title="添加菜单" data-id="add"><i class="icon-edit"></i> 编辑</a>
                                <a href="' . site_url('admin/node/delete/' . $r['node_id']) . '" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除菜单？"><i class="icon-trash"></i> 删除</a>';
            $r['tree_id'] = $r['node_id'];
            $array[] = $r;
        }
        $str = "<tr>
                    <td><input class='J_checkitem' type='checkbox' name='node_id[]' value='\$node_id'></td>
                    <td class='tl'>\$spacer\$name</td>
                    <td>\$orderid</td>
                    <td>\$str_manage</td>
                 </tr>";
        $this->tree->init($array);
        $this->data['list_html'] = $this->tree->get_tree(0, $str);
		$this->load->view('admin/node/index', $this->data);
	}

    protected function _before_add($pid = '')
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写菜单名称', 0);
        } else {
            $this->data['list_select'] = $this->model->select_tree($pid);
        }
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
}