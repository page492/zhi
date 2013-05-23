<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-8
 * Time: 下午6:46
 * To change this template use File | Settings | File Templates.
 */

function cmp($a, $b)
{
    return(strLen($a) < strLen($b));
}

class Nav_Widget extends Widget
{

    public function render()
    {
        $type = $this->_extract('type', 'main');
        $this->load->model('nav_model');
        $list = $this->nav_model->get_group();
        $nav = $list[$type];
        if ($type == 'main') {
            $data['current_nav'] = '';
            $url_array = array();
            foreach ($nav as $key => $val) {
                $url_array[] = $nav[$key]['link'] = ( ! preg_match('!^\w+://! i', $val['link'])) ? site_url($val['link']) : $val['link'];
            }
            usort($url_array, 'cmp');
            $current_url = current_url();
            foreach ($url_array as $val) {
                if (strpos($current_url, $val) === 0) {
                    $data['current_nav'] =  $val;
                    break;
                }
            }
        }
        $data['nav'] = $nav;
        $this->load->view('widget/nav/'.$type, $data);
    }
}