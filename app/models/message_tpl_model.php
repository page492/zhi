<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-31
 * Time: 下午5:18
 * 通知模板
 */

class Message_tpl_model extends HP_Model
{

    public function get_info($code, $data = array())
    {
        $info = $this->where('code', $code)->find();
        $this->load->library('parser');
        $info['title'] = $this->parser->parse_string($info['title'], $data, TRUE);
        $info['message'] = $this->parser->parse_string($info['message'], $data, TRUE);
        return $info;
    }

}