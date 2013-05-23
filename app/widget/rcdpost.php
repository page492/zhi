<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-16
 * Time: 下午11:41
 * 推荐商品
 */

class Rcdpost_Widget extends Widget
{
    public function render()
    {
        $this->load->driver('cache');
        if (FALSE === $list = $this->cache->get('rcdpost')) {
            $this->load->model('post_model');
            $list = $this->post_model->get_rcd_list(1, 9);
            $this->cache->save('rcdpost', $list);
        }
        $data['list'] = $list;
        $this->load->view('widget/rcdpost', $data);
    }
}