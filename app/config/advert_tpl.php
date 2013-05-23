<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-12
 * Time: 上午10:57
 * 广告模板配置文件
 */

return array(
    'banner' => array(
        'name' => '矩形横幅',
        'allow_type' => array('text','img','code','flash'),
    ),
    'focus' => array(
        'name' => '首页焦点图',
        'allow_type' => array('img'),
    ),
    'focus_right' => array(
        'name' => '首页焦点图右侧',
        'allow_type' => array('img'),
    ),
);