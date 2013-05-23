<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-23
 * Time: 下午4:50
 * 文章管理
 */

class Article extends Admin_Controller
{
    protected  function _before_add()
    {
        if ($data = $this->input->post()) {
            if (trim($data['title']) == '') {
                return $this->show_message('请填写文章标题', 0);
            }
        } else {
            //分类
            $this->load->model('article_cat_model');
            $this->data['cat_select'] = $this->article_cat_model->select_tree();
        }
    }

    protected function _before_edit($id = '')
    {
        if ($data = $this->input->post()) {
            if (trim($data['title']) == '') {
                return $this->show_message('请填写文章标题', 0);
            }
        } else {
            $info = $this->model->select('cid')->find($id);
            //分类
            $this->load->model('article_cat_model');
            $this->data['cat_select'] = $this->article_cat_model->select_tree($info['cid']);
        }
    }

    public function upload_editor()
    {
        $upload_path = 'data/upload/article/' . date('ymd/');
        !is_dir($upload_path) && mkdir($upload_path);
        $result = $this->_upload('upload', array(
            'upload_path'=>$upload_path,
            'file_name' => uniqid(),
        ));
        $fn = $this->input->get('CKEditorFuncNum');
        $file = base_url($upload_path) . '/' . $result['file_name'];
        $str='<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction('.$fn.', \''.$file.'\', \'\');</script>';
        exit($str);
    }
}