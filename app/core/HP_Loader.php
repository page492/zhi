<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-6
 * Time: 下午12:44
 * 装载器扩展
 */

class HP_Loader extends CI_Loader
{
    public function set_theme($theme = 'default')
    {
        $this->_ci_view_paths = array(FCPATH . 'themes/' . $theme . '/' => TRUE) + $this->_ci_view_paths;
    }

    public  function widget($widget, $args = array())
    {
        if (is_file(APPPATH . 'widget/'.$widget.'.php')) {
            require_once(APPPATH.'widget/'.$widget.'.php');
            $widget = ucfirst($widget) . '_Widget';
            $widget_obj = new $widget($args);
            $widget_obj->render();
        } else {
            show_error('Unable to locate the widget you have specified: '.$widget);
        }
    }
}