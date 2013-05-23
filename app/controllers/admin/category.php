<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-29
 * Time: 下午11:12
 * 商品分类控制器
 */
class Category extends Admin_Controller
{
    public function index()
    {
        $result = $this->model->find_all();
        $this->load->library('tree');
        $this->tree->icon = array('│ ', '├─ ', '└─ ');
        $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $array = array();
        foreach ($result as $r) {
            $r['str_manage'] = '<a class="mr5" href="' . site_url('admin/category/add/' . $r['cid']) . '" data-toggle="dialog" data-title="添加分类" data-id="add"><i class="icon-plus"></i> 添加子分类</a>
                                <a class="mr5" href="' . site_url('admin/category/edit/' . $r['cid']) . '" data-toggle="dialog" data-title="添加分类" data-id="add"><i class="icon-edit"></i> 编辑</a>
                                <a href="' . site_url('admin/category/delete/' . $r['cid']) . '" data-toggle="confirmurl" data-acttype="ajax" data-msg="确认要删除分类？"><i class="icon-trash"></i> 删除</a>';
            $r['tree_id'] = $r['cid'];
            $r['icon_img'] = $r['icon'] ? '<img src="'.base_url('data/upload/category/'.$r['icon']).'">' : '';
            $array[] = $r;
        }
        $str = "<tr>
                    <td><input class='J_checkitem' type='checkbox' name='cid[]' value='\$cid'></td>
                    <td class='tl'>\$spacer\$name</td>
                    <td class='tl'>\$alias</td>
                    <td>\$icon_img</td>
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

    public function upload_icon()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/category/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        //生成缩略图
        $this->load->library('image_lib', array(
            'source_image' => $result['full_path'],
            'quality' => 100,
            'width' => 15,
            'height' => 15
        ));
        if (!$this->image_lib->resize()) {
            return $this->show_message($this->image_lib->display_errors(), 0);
        } else {
            $this->ajax_return(array(
                'status' => '1',
                'data' => array(
                    'file_name' => $result['file_name'],
                )
            ));
        }
    }

}
