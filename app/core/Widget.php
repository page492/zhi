<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-8
 * Time: 下午2:38
 * Widget类
 */

class Widget
{

    protected $_extract = array();

    public function __construct($args)
    {
        $this->_extract = $args;
    }

    /**
     * __get
     *
     * Allows models to access CI's loaded classes using the same
     * syntax as controllers.
     *
     * @param	string
     * @access private
     */
    function __get($key)
    {
        $CI =& get_instance();
        return $CI->$key;
    }

    /**
     * 渲染输出 render方法是Widget唯一的接口
     */
    public function render(){}

    /**
     * 获取调用参数
     * @param $name
     * @param null $default
     * @return null
     */
    protected  function _extract($name, $default = NULL)
    {
        return isset($this->_extract[$name]) ? $this->_extract[$name] : $default;
    }

}