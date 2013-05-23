<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-3
 * Time: 下午11:47
 * 爆料模型
 */

class Submit_model extends HP_Model
{

    protected function _before_insert(&$data)
    {
        $data['submit_time'] = time();
    }

}