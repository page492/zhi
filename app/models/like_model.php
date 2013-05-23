<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 下午3:19
 * 收藏模型
 */

class Like_model extends HP_Model
{

    protected function _before_insert(&$data)
    {
        $data['like_time'] = time();
    }

    protected function _after_insert($data)
    {
        $this->db->set('likes', 'likes+1', FALSE)->where('id', $data['post_id'])->update('post');
    }

}