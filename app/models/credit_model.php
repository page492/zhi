<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-28
 * Time: 下午1:51
 * 积分
 */

class Credit_model extends HP_Model
{
    protected $table = 'credit_log';

    public function check_num($action, $uid, $limit)
    {
        $stat = $this->db->where(array('uid'=>$uid, 'action'=>$action))->get('credit_stat')->result_array();
        $stat = element('0', $stat);
        !$stat && $this->db->insert('credit_stat', array('uid'=>$uid, 'action'=>$action));
        if ($limit == 0 || !$stat) {
            $new_num = 1;
            $return = TRUE;
        } else {
            $new_num = $stat['num'] + 1;
            if ($stat['last_time'] < mktime(0, 0, 0, date('m'), date('d'), date('Y'))) {
                $new_num = 1;
                $return = TRUE;
            } else {
                $return = $stat['num'] >= $limit ? FALSE : TRUE;
            }
        }
        $this->db->where(array('uid'=>$uid, 'action'=>$action))->update('credit_stat', array('num'=>$new_num, 'last_time'=>time()));
        return $return;
    }

}