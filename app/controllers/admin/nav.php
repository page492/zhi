<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-30
 * Time: 下午5:00
 * 导航管理
 */

class Nav extends Admin_Controller
{
    public function index($type = 'main')
    {
        $result = $this->model->where('type', $type)->find_all();
        $this->load->library('tree');
        $this->tree->icon = array('│ ', '├─ ', '└─ ');
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $array = array();
        foreach ($result as $r) {
            $r['str_manage'] = '<a class="mr5" href="' . site_url('admin/nav/add/' . $type . '/' . $r['id']) . '" data-toggle="dialog" data-title="添加导航" data-id="add"><i class="icon-plus"></i> 添加下级导航</a>
                                <a class="mr5" href="' . site_url('admin/nav/edit/' . $r['id']) . '" data-toggle="dialog" data-title="编辑导航" data-id="edit"><i class="icon-edit"></i> 编辑</a>
                                <a href="' . site_url('admin/nav/delete/' . $r['id']) . '" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除菜单？"><i class="icon-trash"></i> 删除</a>';
            $r['tree_id'] = $r['id'];
            $array[] = $r;
        }
        $str = "<tr>
                    <td><input class='J_checkitem' type='checkbox' name='id[]' value='\$id'></td>
                    <td class='tl'>\$spacer\$name</td>
                    <td class='tl'>\$link</td>
                    <td>\$orderid</td>
                    <td>\$str_manage</td>
                 </tr>";
        $this->tree->init($array);
        $this->data['list_html'] = $this->tree->get_tree(0, $str);
        $this->data['type'] = $type;
        $this->load->view('admin/nav/index', $this->data);
    }

    protected function _before_add($type = 'mian', $pid = '')
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写导航名称', 0);
        } else {
            $this->data['type'] = $type;
            $this->data['list_select'] = $this->model->select_tree($pid);
        }
    }

    protected function _before_edit($id = '')
    {
        if ($data = $this->input->post()) {
            trim($data['name']) == '' && $this->show_message('请填写导航名称', 0);
        } else {
            $this->data['info'] = $this->model->find($id);
            $this->data['list_select'] = $this->model->select_tree($this->data['info']['parent_id']);
        }
    }
}