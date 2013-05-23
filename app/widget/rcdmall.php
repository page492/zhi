<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-16
 * Time: 下午11:53
 * 推荐商家
 */

class Rcdmall_Widget extends Widget
{
    public function render()
    {
        $this->load->driver('cache');
        if (FALSE === $list = $this->cache->get('rcdmall')) {
            $this->load->model('mall_model');
            $list = $this->mall_model->get_rcd_list(6);
            $this->cache->save('rcdmall', $list);
        }
        $data['list'] = $list;
        $this->load->view('widget/rcdmall', $data);
    }
}