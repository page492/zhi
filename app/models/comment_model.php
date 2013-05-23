<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 下午3:17
 * 评论模型
 */

class Comment_model extends HP_Model
{

    protected function _before_insert(&$data)
    {
        $data['comment_time'] = time();
    }

    protected function _after_insert($data)
    {
        $this->db->set('comments', 'comments+1', FALSE)->where('id', $data['post_id'])->update('post');
    }

}