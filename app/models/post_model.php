<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-10
 * Time: 下午9:01
 * 商品模型
 */
class Post_model extends HP_Model
{

    public function count($valid = FALSE)
    {
        return parent::count();
    }

    /**
     * 首页列表数据
     */
    public function home_list($limit, $offset)
    {
        $post_list = $this->where('post_time <= ', time())->order_by('topped DESC,orderid,id DESC')->limit($limit, $offset)->find_all();
        return $this->arrange_list($post_list);
    }

    /**
     * 热门商品
     * @param $num
     */
    public function get_hot_list($cid, $num)
    {
        $this->load->model('category_model');
        $cids = $this->category_model->get_posterity_cids($cid, TRUE);
        $post_list = $this->db->group_by('post_id')->join('post', 'post_cat.post_id = post.id', 'left')->where('post_time <= ', time())->where_in('cid', $cids)->order_by('ishot DESC,orderid,id DESC')->limit($num)->get('post_cat')->result_array();
        return $this->arrange_list($post_list);
    }

    /**
     * 推荐商品
     * @param $num
     * @return mixed
     */
    public function get_rcd_list($cid, $num)
    {
        $this->load->model('category_model');
        $cids = $this->category_model->get_posterity_cids($cid, TRUE);
        $post_list = $this->db->group_by('post_id')->join('post', 'post_cat.post_id = post.id', 'left')->where('post_time <= ', time())->where_in('cid', $cids)->order_by('isrcd DESC,orderid,id DESC')->limit($num)->get('post_cat')->result_array();
        return $this->arrange_list($post_list);
    }

    /**
     * 分类商品总数
     * @param $cid
     * @param bool $valid 是否有效数据
     */
    public function get_count_by_cat($cid, $valid = FALSE)
    {
        $this->load->model('category_model');
        $posterity_cids = $this->category_model->get_posterity_cids($cid, TRUE);
        $query = $this->db->query("SELECT COUNT(distinct post_id) AS numrows FROM ".$this->db->dbprefix."post_cat as post_cat LEFT JOIN ".$this->db->dbprefix."post as post ON post.id = post_cat.post_id WHERE post_time <= ".time()." AND cid IN (".implode(',', $posterity_cids).")");
        $result = $query->result_array();
        return $result[0]['numrows'];
    }

    /**
     * 分类商品列表
     * @param $cid
     */
    public function get_list_by_cat($cid, $limit, $offset)
    {
        $this->load->model('category_model');
        $posterity_cids = $this->category_model->get_posterity_cids($cid, TRUE);
        $post_list = $this->db->group_by('post_id')->join('post', 'post.id = post_cat.post_id', 'left')->where('post_time <= ', time())->where_in('cid', $posterity_cids)->limit($limit, $offset)->order_by('topped DESC,orderid,id DESC')->get('post_cat')->result_array();
        return $this->arrange_list($post_list);
    }

    public function get_count_by_tag($tid)
    {
        return $this->db->from('post_tag')->join('post', 'post.id = post_tag.post_id')->where(array('tag_id' => $tid, 'post_time <= ' => time()))->count_all_results();
    }

    /**
     * 标签商品列表
     * @param $tid
     * @param $limit
     * @param $offset
     * @return array|mixed
     */
    public function get_list_by_tag($tid, $limit, $offset)
    {
        $post_list = $this->db->join('post', 'post.id = post_tag.post_id')->where(array('tag_id' => $tid, 'post_time <= ' => time()))->order_by('orderid, id DESC')->limit($limit, $offset)->get('post_tag')->result_array();
        return $this->arrange_list($post_list);
    }

    public function get_count_by_mall($mid)
    {
        return $this->db->from('post_mall')->join('post', 'post.id = post_mall.post_id')->where(array('mall_id' => $mid, 'post_time <= ' => time()))->count_all_results();
    }

    public function get_list_by_mall($mid, $limit, $offset)
    {
        $post_list = $this->db->join('post', 'post.id = post_mall.post_id')->where(array('mall_id' => $mid, 'post_time <= ' => time()))->order_by('orderid, id DESC')->limit($limit, $offset)->get('post_mall')->result_array();
        return $this->arrange_list($post_list);
    }

    /**
     * 关联商品
     * @param $id
     * @param string $num
     */
    public function get_relation_list($id, $num = 4)
    {
        $tags = $this->get_tags($id);
        $tag_id_arr = array();
        foreach ($tags as $val) {
            $tag_id_arr[] = $val['tag_id'];
        }
        if (!$tag_id_arr) {
            return array();
        }
        $re_tag = $this->from('post_tag')->select('post_id')->where_in('tag_id', $tag_id_arr)->order_by('post_id DESC')->limit($num)->find_all();
        $post_id_arr = array();
        foreach ($re_tag as $val) {
            $post_id_arr[] = $val['post_id'];
        }
        if (!$post_id_arr) {
            return array();
        }
        $post_list = $this->where_in('id', $post_id_arr)->order_by('topped DESC,orderid,id DESC')->find_all();
        return $this->arrange_list($post_list);
    }

    /**
     * 整理列表数据
     * @param $post_list
     * @return mixed
     */
    public function arrange_list($post_list)
    {
        foreach ($post_list as $key => $val) {
            $post_list[$key]['categorys'] = $this->get_post_categorys($val['id']);
            $post_list[$key]['link_list'] = unserialize($val['links']);
            $post_list[$key]['img'] = $post_list[$key]['img'] ? base_url('data/upload/post/cover/'.$val['img']) : base_url('assets/img/no-pic.png');
        }
        return $post_list;
    }

    /**
     * 获取文章所属所有分类
     */
    public function get_post_categorys($post_id)
    {
        $res_arr = $this->db->select('cid')->where(array('post_id'=>$post_id))->get('post_cat')->result_array();
        $cid_arr = array();
        foreach ($res_arr as $val) {
            $cid_arr[] = $val['cid'];
        }
        $this->load->model('category_model');
        $categorys = $this->category_model->where_in('cid', $cid_arr)->find_all();
        return $categorys;
    }

    /**
     * 上一篇，下一篇
     * @param $id
     * @return array
     */
    public function get_context_nav($id)
    {
        return array(
            'pre' => $this->select('id,title')->where(array('id <'=>$id))->find(),
            'next' => $this->select('id,title')->where(array('id >'=>$id))->find()
        );
    }

    /**
     * 商品关联标签
     * @param $id
     * @param string $num
     */
    public function get_tags($id, $num = 5)
    {
        return $this->from('post_tag')->where('post_id', $id)->order_by('weight DESC')->limit($num)->find_all();
    }

    /**
     * 添加商品
     */
    public function add($data)
    {
        $data['links'] = array();
        foreach ($data['link_title'] as $key => $val) {
            $data['links'][] = array('mid'=>$data['link_mid'][$key], 'title' => $val, 'url' => $data['link_url'][$key]);
        }
        $data['links'] = serialize($data['links']);
        //获取第一个商家名称
        $this->load->model('mall_model');
        $data['mall_name'] = $this->mall_model->get_name_by_id($data['link_mid'][0]);
        //发布时间
        $data['post_time'] = strtotime($data['post_time']);
        $data['create_time'] = time();
        if ($post_id = parent::add($data)) {
            //处理商城关系
            $this->add_post_mall($post_id, $data['link_mid']);
            //处理分类关系
            $this->add_post_cat($post_id, $data['cids']);
            //标签
            if ($data['tags']) {
                $this->load->model('tag_model');
                $tags_arr = explode(',', $data['tags']);
                $post_tag = $tag_cache = array();
                foreach ($tags_arr as $_tag) {
                    $taged = $this->tag_model->select('id')->where('name', $_tag)->find();
                    $tag_id = element('id', $taged);
                    !$tag_id && $tag_id = $this->tag_model->add(array('name'=>$_tag));
                    $post_tag[] = array('post_id'=>$post_id, 'tag_id'=>$tag_id);
                    $tag_cache[$tag_id] = $_tag;
                }
                if ($post_tag) {
                    $this->db->insert_batch('post_tag', $post_tag);
                    $this->clear_tag_cache($post_id, $tag_cache);
                }
            }
            return $post_id;
        } else {
            return FALSE;
        }
    }

    public function edit($data)
    {
        $id = $data['id'];
        $data['links'] = array();
        foreach ($data['link_title'] as $key => $val) {
            $data['links'][] = array('mid'=>$data['link_mid'][$key], 'title' => $val, 'url' => $data['link_url'][$key]);
        }
        $data['links'] = serialize($data['links']);
        //获取第一个商家名称
        $this->load->model('mall_model');
        $data['mall_name'] = $this->mall_model->get_name_by_id($data['link_mid'][0]);
        //发布时间
        $data['post_time'] = strtotime($data['post_time']);
        !element('topped', $data) && $data['topped'] = 0;
        !element('isrcd', $data) && $data['isrcd'] = 0;
        !element('ishot', $data) && $data['ishot'] = 0;
        if (parent::edit($data, array('where' => array('id', $id)))) {
            $this->db->where('post_id', $id)->delete('post_mall');
            $this->db->where('post_id', $id)->delete('post_cat');
            $this->db->where('post_id', $id)->delete('post_tag');
            //处理商城关系
            $this->add_post_mall($id, $data['link_mid']);
            //处理分类关系
            $this->add_post_cat($id, $data['cids']);
            //标签
            if ($data['tags']) {
                $this->load->model('tag_model');
                $tags_arr = explode(',', $data['tags']);
                $post_tag = $tag_cache = array();
                foreach ($tags_arr as $_tag) {
                    $taged = $this->tag_model->select('id')->where('name', $_tag)->find();
                    $tag_id = element('id', $taged);
                    !$tag_id && $tag_id = $this->tag_model->add(array('name'=>$_tag));
                    $post_tag[] = array('post_id'=>$id, 'tag_id'=>$tag_id);
                    $tag_cache[$tag_id] = $_tag;
                }
                if ($post_tag) {
                    $this->db->insert_batch('post_tag', $post_tag);
                    $this->clear_tag_cache($id, $tag_cache);
                }
            }
            return $id;
        } else {
            return FALSE;
        }
    }

    /**
     * 添加商品和商城关系记录
     * @param $post_id
     * @param $mall_ids
     */
    public function add_post_mall($post_id, $mall_ids)
    {
        $mall_ids = array_unique($mall_ids);
        foreach ($mall_ids as $val) {
            $post_mall[] = array('post_id'=>$post_id, 'mall_id'=>$val);
        }
        $this->db->insert_batch('post_mall', $post_mall);
    }

    /**
     * 添加商品和分类关系记录
     * @param $post_id
     * @param $cids
     */
    public function add_post_cat($post_id, $cids)
    {
        $cids = array_unique($cids);
        foreach ($cids as $val) {
            $post_cat[] = array('post_id'=>$post_id, 'cid'=>$val);
        }
        $this->db->insert_batch('post_cat', $post_cat);
    }

    public function _after_delete($options)
    {
        if(is_numeric($options)  || is_string($options)) {
            if(strpos($options, ',')) {
                $this->db->where_in('post_id', explode(',', $options))->delete('post_mall');
                $this->db->where_in('post_id', explode(',', $options))->delete('post_cat');
                $this->db->where_in('post_id', explode(',', $options))->delete('post_tag');
            }else{
                $this->db->where('post_id', $options)->delete('post_mall');
                $this->db->where('post_id', $options)->delete('post_cat');
                $this->db->where('post_id', $options)->delete('post_tag');
            }
        }
    }

    /**
     * @param $id
     * @param string $tag_cache
     * @return mixed
     * 更新推荐标签
     */
    public function clear_tag_cache($id, $tag_cache = '') {
        if (!is_array($tag_cache)) {
            $post_tags = $this->db->select('id')->where('post_id')->get('post_tag');
            $tag_ids = array();
            foreach ($post_tags as $pt) {
                $tag_ids[] = $pt['id'];
            }
            $tag_res = $this->db->where_in('id', $tag_ids)->get('tag');
            $tag_cache = array();
            foreach ($tag_res as $val) {
                $tag_cache[$val['id']] = $val['name'];
            }
        }
        return $this->db->where('id', $id)->update('post', array('tag_cache'=>serialize($tag_cache)));
    }

}
