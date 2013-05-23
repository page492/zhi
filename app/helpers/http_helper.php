<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-2
 * Time: 下午4:10
 * HTTP工具
 */

/**
 * 获取远程URL内容
 * @param $url
 * @return string
 */
function get_url_contents($url)
{
    if (ini_get("allow_url_fopen") == "1")
        return file_get_contents($url);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 * CURL方式下载远程文件到本地
 * @param $remote 远程文件名
 * @param $local 本地保存文件名
 */
function curl_download($remote, $local)
{
    $cp = curl_init($remote);
    $fp = fopen($local, "w");
    curl_setopt($cp, CURLOPT_FILE, $fp);
    curl_setopt($cp, CURLOPT_HEADER, 0);
    curl_exec($cp);
    curl_close($cp);
    fclose($fp);
}