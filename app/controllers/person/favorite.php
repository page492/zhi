<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 下午3:20
 * 我的收藏
 */

class Favorite extends Person_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('favorite_model');
    }

    public function index()
    {
        $total_rows = $this->favorite_model->where('uid', $this->visitor->info['id'])->count();
        $pager = $this->_pager($total_rows);
        $this->data['list'] = $this->favorite_model->select('favorite.*,post.title as post_title,post.img as post_img')->join('post', 'favorite.post_id = post.id')->where('uid', $this->visitor->info['id'])->order_by('favorite_time DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page_bar'] = $pager['links'];
        $this->data['expand_menu'] = 'like';
        $this->data['curr_menu'] = 'favorite';
        $this->load->view($this->dcm, $this->data);
    }

    public function delete($post_id)
    {
        $post_id = intval($post_id);
        if ($this->favorite_model->where(array('post_id'=>$post_id, 'uid'=>$this->visitor->info['id']))->delete()) {
            $this->show_message('删除成功');
        } else {
            $this->show_message('删除失败', 0);
        }
    }
}