<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-9
 * Time: 下午3:12
 * 商品控制器
 */

class Post extends Front_Controller
{

    /**
     * 分类列表
     * @param $cid
     */
    public function index($alias)
    {
        $this->load->model('post_model');
        $this->load->model('category_model');
        $cat_info = $this->category_model->where('alias', $alias)->find();
        !$cat_info && show_404();
        $total_rows = $this->post_model->get_count_by_cat($cat_info['cid']);
        $pager = $this->_pager($total_rows, array(
            'base_url' => site_url('c/'.$alias.'/page'),
            'page_query_string'=>FALSE,
            'uri_segment' => 4,
        ));
        $this->data['post_list'] = $this->post_model->get_list_by_cat($cat_info['cid'], $pager['limit']['value'], $pager['limit']['offset']);
        $this->data['page_bar'] = $pager['links'];
        $this->data['current_cid'] = $cat_info['cid'];
        $cat_list = $this->category_model->get_list();
        $cat_level_list = $this->category_model->get_level_list();
        $this->data['nav_cat'] = array();
        if (isset($cat_level_list['s'][$cat_info['cid']])) {
            $this->data['nav_cat'] = $cat_level_list['s'][$cat_info['cid']];
            $this->data['parent_info'] = $cat_list[$cat_info['cid']];
        } elseif ($cat_info['parent_id'] != '1') {
            $this->data['nav_cat'] = $cat_level_list['s'][$cat_info['parent_id']];
            $this->data['parent_info'] = $cat_list[$cat_info['parent_id']];
        }
        $this->data['cat_info'] = $cat_info;
        $view = (substr($cat_info['parent_path'], 0, 2) == '2|' || $cat_info['cid'] == '2') ? 'post/active' : $this->cm;

        $this->load->model('seo_model');
        $page_seo = $this->seo_model->get_page('category');
        $this->_set_seo(elements(array('title', 'keywords', 'description'), $page_seo), array('catname' => $cat_info['name']));
        $this->load->view($view, $this->data);
    }

    /**
     * 标签列表
     */
    public function tag($tid)
    {
        $this->load->model('post_model');
        $this->load->model('tag_model');
        $total_rows = $this->post_model->get_count_by_tag($tid);
        $pager = $this->_pager($total_rows);
        $this->data['post_list'] = $this->post_model->get_list_by_tag($tid, $pager['limit']['value'], $pager['limit']['offset']);
        $this->data['page_bar'] = $pager['links'];
        $this->data['tag'] = $this->tag_model->find($tid);
        $this->load->view($this->cm, $this->data);
    }

    public function mall($mid)
    {
        $this->load->model('post_model');
        $this->load->model('mall_model');
        $total_rows = $this->post_model->get_count_by_mall($mid);
        $pager = $this->_pager($total_rows);
        $this->data['post_list'] = $this->post_model->get_list_by_mall($mid, $pager['limit']['value'], $pager['limit']['offset']);
        $this->data['page_bar'] = $pager['links'];
        $this->data['mall'] = $this->mall_model->find($mid);
        $this->load->view($this->cm, $this->data);
    }

    public function search()
    {
        $s = $this->input->get('s', TRUE);
        $this->load->model('post_model');
        $total_rows = $this->post_model->like('title', $s)->count();
        $pager = $this->_pager($total_rows);
        $post_list = $this->post_model->like('title', $s)->order_by('orderid,id DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['post_list'] = $this->post_model->arrange_list($post_list);
        $this->data['page_bar'] = $pager['links'];
        $this->data['s'] = $s;
        $this->load->view($this->cm, $this->data);
    }

    /**
     * 商品详细页
     * @param $id
     */
    public function detail($id)
    {
        $this->load->model('post_model');
        $post = $this->post_model->find($id);
        $post = $this->post_model->arrange($post);
        $post['tag_list'] = unserialize($post['tag_cache']);
        $this->data['post'] = $post;
        $this->data['context_nav'] = $this->post_model->get_context_nav($id); //上下文

        //推荐相关
        $this->data['relation_list'] = $this->post_model->get_relation_list($id);

        //评论列表
        $this->load->model('comment_model');
        $total_comments = $this->comment_model->where(array('post_id'=>$id))->count();
        $pager = $this->_pager($total_comments, array('base_url'=>site_url('post/comment_list/'.$id.'?'), 'per_page'=>2));
        $this->data['comment_list'] = $this->comment_model->where(array('post_id'=>$id))->order_by('id DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $this->data['page_bar'] = $pager['links'];

        $this->load->view($this->cm, $this->data);
    }

    public function tgo($url)
    {
        $url = $this->input->get('url', TRUE);
        redirect(base64_decode($url));
    }

    /**
     * AJAX获取评论
     */
    public function comment_list($post_id)
    {
        $post_id = intval($post_id);
        $this->load->model('comment_model');
        $total_comments = $this->comment_model->where(array('post_id'=>$post_id))->count();
        $pager = $this->_pager($total_comments, array('base_url'=>site_url('post/comment_list/'.$post_id.'?'), 'per_page'=>2));
        $this->data['comment_list'] = $this->comment_model->where(array('post_id'=>$post_id))->order_by('id DESC')->limit($pager['limit']['value'], $pager['limit']['offset'])->find_all();
        $data['list_html'] = $this->load->view($this->cm, $this->data, TRUE);
        $data['page_html'] = $pager['links'];
        $this->ajax_return(array(
            'status' => 1,
            'data' => $data,
        ));
    }

    /**
     * AJAX发布评论
     */
    public function comment()
    {
        if (!$this->visitor->logged_in) {
            return $this->show_message('请登陆后再发表评论！', 0);
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('post_id', '评论对象', 'intval|required');
            $this->form_validation->set_rules('content', '评论内容', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                return $this->show_message($this->form_validation->error_string(), 0);
            }
            $data = elements(array('post_id', 'content'), $_POST);
            $data['uid'] = $this->visitor->info['id'];
            $data['username'] = $this->visitor->info['username'];
            $this->load->model('comment_model');
            if ($this->comment_model->add($data)) {
                $this->_alter_credit('comment', $this->visitor->info['id']);
                $this->data['comment_list'] = array(array(
                    'uid' => $data['uid'],
                    'username' => $data['username'],
                    'content' => $data['content'],
                    'comment_time' => time(),
                ));
                $resp = $this->load->view('post/comment_list', $this->data, TRUE);
                $this->ajax_return(array(
                    'status' => 1,
                    'html' => $resp,
                ));
            }
            return $this->show_message('评论失败', 0);
        }
    }

    /**
     * AJAX喜欢
     */
    public function like()
    {
        if (!$this->visitor->logged_in) {
            return $this->show_message('请登陆后再喜欢！', 0);
        }
        $post_id = intval($this->input->get('post_id', TRUE));
        if (!$post_id) {
            return $this->show_message('参数错误', 0);
        }
        $this->load->model('like_model');
        $is_favorited = $this->like_model->where(array('post_id'=>$post_id, 'uid'=>$this->visitor->info['id']))->count();
        if ($is_favorited) {
            return $this->show_message('已经喜欢过了', 0);
        }
        $data = array(
            'post_id' => $post_id,
            'uid' => $this->visitor->info['id']
        );
        $this->like_model->add($data);
        return $this->show_message('喜欢成功', 1);
    }

    /**
     * AJAX收藏
     */
    public function favorite()
    {
        if (!$this->visitor->logged_in) {
            return $this->show_message('请登陆后再收藏！', 0);
        }
        $post_id = intval($this->input->get('post_id', TRUE));
        if (!$post_id) {
            return $this->show_message('参数错误', 0);
        }
        $this->load->model('favorite_model');
        $is_favorited = $this->favorite_model->where(array('post_id'=>$post_id, 'uid'=>$this->visitor->info['id']))->count();
        if ($is_favorited) {
            return $this->show_message('已经收藏过了', 0);
        }
        $data = array(
            'post_id' => $post_id,
            'uid' => $this->visitor->info['id']
        );
        if ($this->favorite_model->add($data)) {
            $this->_alter_credit('favorite', $this->visitor->info['id']);
            return $this->show_message('收藏成功', 1);
        }
    }
}