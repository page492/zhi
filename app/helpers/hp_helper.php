<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-19
 * Time: 上午11:23
 * HoldPHP辅助函数
 */

function avatar($uid, $size = 'm')
{
    $size = in_array($size, array('b', 'm', 's')) ? $size : 'm';
    $avatar_dir = avatar_dir($uid);
    $file_name = $avatar_dir . substr($uid, -2)."_$size.jpg";
    if (is_file($file_name)) {
        return base_url($file_name);
    } else {
        return base_url('assets/img/avatar/none_'.$size.'.jpg');
    }
}

function avatar_dir($uid)
{
    $uid = abs(intval($uid));
    $uid = sprintf("%09d", $uid);
    $dir1 = substr($uid, 0, 3);
    $dir2 = substr($uid, 3, 2);
    $dir3 = substr($uid, 5, 2);
    return 'data/upload/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/';
}