<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-03
 * Time: 下午10:42
 * 商城分类控制器
 */
class Mall_cat extends Admin_Controller {

    public function upload_icon()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/mall_cat/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        //生成缩略图
        $this->load->library('image_lib', array(
            'source_image' => $result['full_path'],
            'quality' => 100,
            'width' => 18,
            'height' => 18
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