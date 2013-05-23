<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-8
 * Time: 下午6:46
 * 分享
 */

class Share_Widget extends Widget
{

    public function render()
    {
        $config = $this->_extract;
        $data['config'] = '';
        if ($config) {
            foreach ($config as $key => $val) {
                $data['config'] .= "'{$key}':'{$val}',";
            }
        }
        $data['config'] = $data['config'] ? substr($data['config'], 0, -1) : '';
        $this->load->view('widget/share', $data);
    }
}