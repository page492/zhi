<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-9
 * Time: 上午1:34
 * 广告显示挂件
 */

class Advert_Widget extends Widget
{

    private $_pt_info = NULL;

    public function render()
    {
        $pt_id = $this->_extract('id');
        if (!$pt_id) {
            return FALSE;
        }
        $this->load->model('advert_pt_model');
        $this->_pt_info = $this->advert_pt_model->where(array('id' => $pt_id, 'isshow' => '1'))->find();
        if (!$this->_pt_info) {
            return FALSE; //无效广告位
        }
        $this->load->model('advert_model');
        $list = $this->advert_model->get_bypt($pt_id);
        foreach ($list as $key => $val) {
            $list[$key]['html'] = $this->_get_html($val);
        }
        $data['list'] = $list;
        $this->load->view('widget/advert/' . $this->_pt_info['view'], $data);
    }

    private function _get_html($ad)
    {
        $html = $ad['content'];
        switch ($ad['type']) {
            case 'img':
                $html = '<a title="' . $ad['title'] . '" href="' . site_url('advert/tgo/'.$ad['id']) . '" target="_blank">';
                $html .= '<img alt="' . $ad['title'] . '" src="' . base_url('/data/upload/advert/' . $ad['content']) . '">';
                $html .= '</a>';
                break;
            case 'flash':
                $html = '<a title="' . $ad['title'] . '" href="' . site_url('advert/tgo/'.$ad['id']) . '" target="_blank">';
                $html .= '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0">';
                $html .= '<param name="movie" value="' . __ROOT__ . 'data/upload/advert/' . $ad['content'] . '" />';
                $html .= '<param name="quality" value="autohigh" />';
                $html .= '<param name="wmode" value="opaque" />';
                $html .= '<embed src="' . __ROOT__ . '/data/upload/advert/' . $ad['content'] . '" quality="autohigh" wmode="opaque" name="flashad" swliveconnect="TRUE" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash"></embed>';
                $html .= '</object>';
                $html .= '</a>';
                break;
        }
        return $html;
    }

}