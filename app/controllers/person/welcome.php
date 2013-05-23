<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-17
 * Time: 下午9:39
 * 用户
 */

class Welcome extends Person_Controller
{
    public function index()
    {
        $this->load->model('user_model');
        if ($post = $this->input->post(NULL, TRUE)) {
            $this->user_model->where('id', $this->visitor->info['id'])->edit(array(
                'intro' => $post['intro']
            ));
            return $this->show_message('保存成功');
        } else {
            $this->data['profile'] = $this->user_model->select('username,email,intro')->find($this->visitor->info['id']);
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function bind()
    {
        $this->load->model('user_bind_model');
        $this->data['binded'] = $this->user_bind_model->get_binded($this->visitor->info['id']);
        $this->load->view($this->dcm, $this->data);
    }

    /**
     * 解除绑定
     * @param string $provider
     */
    public function unbind($provider = '')
    {
        $this->load->model('user_bind_model');
        $this->user_bind_model->where(array('uid'=>$this->visitor->info['id'], 'type'=>$provider))->delete();
        redirect('person/welcome/bind');
    }

    public function avatar()
    {
        $this->load->view($this->dcm, $this->data);
    }

    /**
     * 上传图片到临时目录
     * @author andery
     */
    public function avatar_upload()
    {
        $result = $this->_upload('img', array(
            'upload_path'=>'data/upload/avatar/tmp/',
            'file_name' => uniqid(),
        ));
        !$result && $this->show_message('上传失败', 0);
        $this->ajax_return(array(
            'status' => 1,
            'data' => array(
                'viewfile' => base_url('data/upload/avatar/tmp/'.$result['file_name']),
                'file_name' => $result['file_name'],
                'width' => $result['image_width'],
                'height' => $result['image_height'],
            )
        ));
    }

    public function avatar_save()
    {
        $filename = $this->input->post('filename', TRUE);
        $scale = $this->input->post('scale', TRUE);
        $postion = $this->input->post('postion');
        if (!$filename) {
            return $this->show_message('请上传文件', 0);
        }
        $uid = $this->visitor->info['id'];
        $avatar_dir = avatar_dir($uid);
        !is_dir($avatar_dir) && mkdir($avatar_dir, 0777, true);
        $orig_file = 'data/upload/avatar/tmp/' . $filename;
        if (!is_file($orig_file)) {
            return $this->show_message('请上传文件', 0);
        }
        $new_width = $new_height = ($postion['xe'] - $postion['xs']) * $scale;
        //裁剪
        $this->load->library('image_lib');
        $this->image_lib->initialize(array(
            'source_image' => $orig_file,
            'quality' => 100,
            'maintain_ratio' => FALSE,
            'width' => $new_width,
            'height' => $new_height,
            'x_axis' => $postion['xs'] * $scale,
            'y_axis' => $postion['ys'] * $scale,
        ));
        $this->image_lib->crop();
        //生成缩略图
        $this->image_lib->initialize(array(
            'source_image' => $orig_file,
            'new_image' => $avatar_dir . substr($uid, -2) . '_b.jpg',
            'quality' => 100,
            'width' => 180,
            'height' => 180,
        ));
        $this->image_lib->resize();
        $this->image_lib->initialize(array(
            'source_image' => $orig_file,
            'new_image' => $avatar_dir . substr($uid, -2) . '_m.jpg',
            'quality' => 100,
            'width' => 80,
            'height' => 80,
        ));
        $this->image_lib->resize();
        $this->image_lib->initialize(array(
            'source_image' => $orig_file,
            'new_image' => $avatar_dir . substr($uid, -2) . '_s.jpg',
            'quality' => 100,
            'width' => 40,
            'height' => 40,
        ));
        $this->image_lib->resize();
        @unlink($orig_file);
        return $this->show_message('保存成功');
    }

}