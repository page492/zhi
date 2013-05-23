<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-18
 * Time: 下午5:58
 * 我的评论
 */

class Comment extends Person_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('comment_model');
    }

    public function index()
    {
        $total_rows = $this->comment_model->where('uid', $this->visitor->info['id'])->count();
        $pager = $this->_pager($total_rows, array('per_page'=>10));
        $this->data['list'] = $this->comment_model->select('comment.*,post.title as post_title,post.img as post_img')->join('post', 'comment.post_id = post.id')->where('uid', $this->visitor->info['id'])->order_by('id DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page_bar'] = $pager['links'];
        $this->load->view($this->dcm, $this->data);
    }

    public function delete($id)
    {
        $id = intval($id);
        if ($this->comment_model->where(array('id'=>$id, 'uid'=>$this->visitor->info['id']))->delete()) {
            $this->show_message('删除成功');
        } else {
            $this->show_message('删除失败', 0);
        }
    }
}