<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午11:53
 * 广告管理
 */

class Advert extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        //广告位置
        $this->load->model('advert_pt_model');
        $this->data['pt_list'] = $this->advert_pt_model->get_kv_list();
        //广告类型
        $this->data['advert_type'] = array('text'=>'文字', 'img'=>'图片', 'code'=>'代码', 'flash'=>'Flash');
    }

    public function upload_img()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/advert/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        $this->ajax_return(array(
            'status' => 1,
            'data' => array(
                'file_name' => $result['file_name'],
            )
        ));
    }

    public function upload_flash()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/advert/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        $this->ajax_return(array(
            'status' => 1,
            'data' => array(
                'file_name' => $result['file_name'],
            )
        ));
    }
}