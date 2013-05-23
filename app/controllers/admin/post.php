<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Post extends Admin_Controller
{

    protected function _before_index()
    {
        $this->order_by = 'orderid,id DESC';

        //商品分类
        $this->load->model('category_model');
        $this->data['list_select'] = $this->category_model->select_tree();

        //商城
        $this->load->model('mall_model');
        $mall_list = $this->mall_model->find_all();
        $this->data['mall_list'] = $mall_list;
    }

    protected function _list($model, $options = array(), $order_by = '', $select = '', $pageconf = array())
    {
        $total_rows = $model->count($options);
        $pager = $this->_pager($total_rows);

        $select && $model->select($select);
        $order_by = $order_by ? $order_by : $this->order_by;
        $list = $model->order_by($order_by)->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all($options);
        $this->data['list'] = $this->model->arrange_list($list);
        $this->data['page'] = $pager['links'];
    }

    protected function _search()
    {
        $options = array();
        ($keyword = $this->input->get('keyword')) && $options['like'] = array('title', $keyword);
        $this->data['search'] = $this->input->get();
        return $options;
    }

    protected  function _before_add()
    {
        if ($data = $this->input->post()) {
            if (trim($data['title']) == '') {
                return $this->show_message('请填写文章标题', 0);
            }
            if (trim($data['price']) == '') {
                return $this->show_message('请填写价格', 0);
            }
            if (empty($data['link_title'][0]) || empty($data['link_url'][0])) {
                return $this->show_message('请填写链接地址', 0);
            }
            if (!isset($data['cids'])) {
                return $this->show_message('请至少选择一个分类', 0);
            }
            if (!isset($data['link_mid'])) {
                return $this->show_message('请选择商城', 0);
            }
        } else {
            //商品分类
            $this->load->model('category_model');
            $result = $this->category_model->find_all();
            $this->load->library('tree');
            $this->tree->icon = array('│ ', '├─ ', '└─ ');
            $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
            foreach ($result as $r) {
                $r['tree_id'] = $r['cid'];
                $array[] = $r;
            }
            $str = "<li><label>\$spacer<input type='checkbox' name='cids[]' value='\$cid'>\$name</label></li>";
            $this->tree->init($array);
            $this->data['list_html'] = $this->tree->get_tree(0, $str);
            //商城
            $this->load->model('mall_model');
            $mall_list = $this->mall_model->find_all();
            $this->data['mall_list'] = $mall_list;
        }
    }

    public  function edit($id = '')
    {
        if ($data = $this->input->post()) {
            if ($this->model->edit($data)) {
                return $this->show_message('操作成功');
            } else {
                return $this->show_message('操作失败');
            }
        } else {
            //详细信息
            $info = $this->model->find($id);
            $info['links'] = unserialize($info['links']);
            $tag_cache = unserialize($info['tag_cache']);
            $info['tags'] = $tag_cache ? implode(',', $tag_cache) : '';
            $this->data['info'] = $info;
            $post_cats = $this->model->get_post_categorys($id);
            $post_cids = array();
            foreach ($post_cats as $val) {
                $post_cids[] = $val['cid'];
            }
            //商品分类
            $this->load->model('category_model');
            $result = $this->category_model->find_all();
            $this->load->library('tree');
            $this->tree->icon = array('│ ', '├─ ', '└─ ');
            $this->tree->nbsp = '&nbsp;&nbsp;&nbsp;';
            foreach ($result as $r) {
                $r['tree_id'] = $r['cid'];
                $r['checked'] = in_array($r['cid'], $post_cids) ? 'checked' : '';
                $array[] = $r;
            }
            $str = "<li><label>\$spacer<input type='checkbox' name='cids[]' value='\$cid' \$checked>\$name</label></li>";
            $this->tree->init($array);
            $this->data['list_html'] = $this->tree->get_tree(0, $str);
            //商城
            $this->load->model('mall_model');
            $mall_list = $this->mall_model->find_all();
            $this->data['mall_list'] = $mall_list;
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function upload_img()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/post/cover/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        //生成缩略图
        $this->load->library('image_lib', array(
            'source_image' => $result['full_path'],
            'quality' => 100,
            'width' => 220,
            'height' => 220
        ));
        if (!$this->image_lib->resize()) {
            return $this->show_message($this->image_lib->display_errors(), 0);
        } else {
            $this->ajax_return(array(
                'status' => '1',
                'data' => array(
                    'file_path' => base_url('data/upload/post/cover'),
                    'file_name' => $result['file_name'],
                )
            ));
        }
    }

    public function upload_editor()
    {
        $upload_path = 'data/upload/post/detail/' . date('ymd/');
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
