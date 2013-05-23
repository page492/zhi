<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-15
 * Time: 上午2:46
 * To change this template use File | Settings | File Templates.
 */

class Hottag_Widget extends Widget
{
    public function render()
    {
        $this->load->driver('cache');
        if (FALSE === $list = $this->cache->get('hottag')) {
            $this->load->model('tag_model');
            $list = $this->tag_model->get_top_list(12);
            $this->cache->save('hottag', $list);
        }
        $data['list'] = $list;
        $this->load->view('widget/hottag', $data);
    }
}