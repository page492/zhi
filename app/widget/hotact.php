<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-15
 * Time: 上午2:35
 * 热门商品
 */

class Hotact_Widget extends Widget
{
    public function render()
    {
        $this->load->driver('cache');
        if (FALSE === $list = $this->cache->get('hotact')) {
            $this->load->model('post_model');
            $list = $this->post_model->get_hot_list(2, 3);
            $this->cache->save('hotact', $list);
        }
        $data['list'] = $list;
        $this->load->view('widget/hotact', $data);
    }
}