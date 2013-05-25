<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-31
 * Time: 下午5:18
 * 邮件队列模型
 */

class Mail_queue_model extends HP_Model
{

    public function send($limit = 5)
    {
        $this->clear();

        $mails = $this->where('lock_expiry <=', time())->order_by('priority DESC,id,err_num')->limit($limit)->find_all();
        if (!$mails) return false;
        //增加一次发送错误并且把锁定时间延长避免多个发送请求冲突
        $queue_ids = array();
        foreach ($mails as $_mail) {
            $queue_ids[] = $_mail['id'];
        }
        $lock_expiry = time() + 30;
        $this->db->set('err_num', 'err_num+1', FALSE)->set('lock_expiry', $lock_expiry)->update($this->table);
        //发送
        $this->load->model('setting_model');
        $mail_config = $this->setting_model->get_cache('mail');
        $this->load->library('email', array(
            'protocol' => $mail_config['method'],
            'smtp_host' => $mail_config['smtp']['host'],
            'smtp_user' => $mail_config['smtp']['user'],
            'smtp_pass' => $mail_config['smtp']['pass'],
            'smtp_port' => $mail_config['smtp']['port'],
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
        ));
        foreach ($mails as $_mail) {
            $this->email->from($mail_config['from'], $mail_config['name']);
            $this->email->to($_mail['mail_to']);
            $this->email->subject($_mail['mail_subject']);
            $this->email->message($_mail['mail_body']);
            if ($this->email->send()) {
                $this->delete($_mail['id']);
            }
        }
    }

    public function clear()
    {
        $this->where('err_num >', 3)->delete();
    }
}