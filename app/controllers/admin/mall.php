<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-3
 * Time: 下午9:59
 * 商家管理
 */

class Mall extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('mall_cat_model');
        $result_cats = $this->mall_cat_model->find_all();
        $list_cat = array();
        foreach ($result_cats as $_cat) {
            $list_cat[$_cat['cid']] = $_cat['name'];
        }
        $this->data['list_cat'] = $list_cat;
    }

    public function upload_logo()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/mall/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        //生成缩略图
        $this->load->library('image_lib', array(
            'source_image' => $result['full_path'],
            'quality' => 100,
            'width' => 160,
            'height' => 80
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