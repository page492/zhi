<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-17
 * Time: 下午9:39
 * 用户
 */

class User extends Front_Controller
{

    public function login()
    {
        if ($this->visitor->logged_in) {
            if ($this->input->is_ajax_request()) {
                return $this->show_message('已经登陆', 0);
            } else {
                redirect('person');
            }
        }
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username', '用户名', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', '密码', 'trim|required|md5');
            if ($this->form_validation->run() == FALSE) {
                return $this->show_message($this->form_validation->error_string(), 0);
            } else {
                $map = elements(array('username', 'password'), $_POST);
                $this->load->model('user_model');
                $user_info = $this->user_model->select('id,username,role_id,credit')->where($map)->find();
                if (!$user_info) {
                    return $this->show_message('帐号或者密码错误', 0);
                } else {
                    $this->visitor->assign($user_info);
                    $this->_alter_credit('login', $user_info['id']);
                    return $this->show_message('登陆成功！');
                }
            }
        } else {
            if ($this->input->is_ajax_request()) {
                $resp = $this->load->view($this->cm . '_ajax', $this->data, TRUE);
                $this->ajax_return(array(
                    'status' => 1,
                    'html' => $resp,
                ));
            } else {
                $this->_set_seo(array('title'=>'会员登陆 | {sitename}'));
                $this->load->view($this->cm, $this->data);
            }
        }
    }

    public function register()
    {
        if ($this->visitor->logged_in) {
            redirect('person');
        }

        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[1]|max_length[18]|is_unique[user.username]|xss_clean');
            $this->form_validation->set_rules('email', '电子邮箱', 'trim|required|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', '密码', 'trim|required|matches[passconf]');
            $this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
            $this->form_validation->set_rules('captcha', '验证码', 'callback_check_captcha');
            if ($this->form_validation->run() == FALSE) {
                return $this->show_message($this->form_validation->error_string(), 0);
            } else {
                $data = elements(array('username', 'email', 'password'), $_POST);
                $this->load->model('user_model');
                if ($uid = $this->user_model->add($data)) {
                    //自动登陆
                    $user_info = $this->user_model->select('id,username,role_id,credit')->where('id', $uid)->find();
                    $this->visitor->assign($user_info);
                    //调整积分
                    $this->_alter_credit('register', $uid);
                    return $this->show_message('注册成功！');
                } else {
                    return $this->show_message('注册失败！', 0);
                }
            }
        } else {
            $this->_set_seo(array('title'=>'会员注册 | {sitename}'));
            $this->load->view($this->cm, $this->data);
        }
    }

    public function binding()
    {
        $this->load->model('user_model');
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('', '');
            if ($this->input->post('type') == 0) {
                $this->form_validation->set_rules('username', '用户名', 'trim|required|min_length[1]|max_length[18]|is_unique[user.username]|xss_clean');
                $this->form_validation->set_rules('email', '电子邮箱', 'trim|required|valid_email|is_unique[user.email]');
                $this->form_validation->set_rules('password', '密码', 'trim|required|matches[passconf]');
                $this->form_validation->set_rules('passconf', '确认密码', 'trim|required');
                if ($this->form_validation->run() == FALSE) {
                    return $this->show_message($this->form_validation->error_string(), 0);
                } else {
                    $data = elements(array('username', 'email', 'password'), $_POST);
                    if ($uid = $this->user_model->add($data)) {
                        $this->_alter_credit('register', $uid);//注册积分
                        //绑定
                        $this->load->model('user_bind_model');
                        $oauth_user = $this->session->userdata('oauth_user');
                        $this->user_bind_model->add(array(
                            'uid' => $uid,
                            'type' => $oauth_user['via'],
                            'keyid' => $oauth_user['via'] . '_' . $oauth_user['uid'],
                            'info' => serialize(array(
                                'access_token'=>$oauth_user['access_token'],
                                'expire_at'=>$oauth_user['expire_at'],
                                'refresh_token'=>$oauth_user['refresh_token'],
                            )),
                        ));
                        //自动登陆
                        $user_info = $this->user_model->select('id,username,role_id,credit')->where('id', $uid)->find();
                        $this->visitor->assign($user_info);
                        return $this->show_message('登陆成功！');
                    } else {
                        return $this->show_message('登陆失败！', 0);
                    }
                }
            } else {
                $this->form_validation->set_rules('username', '用户名', 'trim|required|xss_clean');
                $this->form_validation->set_rules('password', '密码', 'trim|required|md5');
                if ($this->form_validation->run() == FALSE) {
                    return $this->show_message($this->form_validation->error_string(), 0);
                } else {
                    $where = elements(array('username', 'password'), $_POST);
                    $user_info = $this->user_model->select('id,username,role_id,credit')->where($where)->find();
                    if ($user_info) {
                        //绑定
                        $this->load->model('user_bind_model');
                        $oauth_user = $this->session->userdata('oauth_user');
                        $this->user_bind_model->add(array(
                            'uid' => $user_info['id'],
                            'type' => $oauth_user['via'],
                            'keyid' => $oauth_user['via'] . '_' . $oauth_user['uid'],
                            'info' => serialize(array(
                                'access_token'=>$oauth_user['access_token'],
                                'expire_at'=>$oauth_user['expire_at'],
                                'refresh_token'=>$oauth_user['refresh_token'],
                            )),
                        ));
                        //$this->_alter_credit('register', $uid);//绑定积分
                        $this->visitor->assign($user_info);
                        return $this->show_message('登陆成功！');
                    } else {
                        return $this->show_message('登陆失败！', 0);
                    }
                }
            }
        } else {
            $oauth_user = $this->session->userdata('oauth_user');
            if ($this->user_model->is_unique('username', $oauth_user['name'])) {
                $oauth_user['name'] = $oauth_user['name'] . '_' . mt_rand(99, 9999);
            }
            $this->data['oauth_user'] = $oauth_user;
            $this->_set_seo(array('title'=>'完善信息 | {sitename}'));
            $this->load->view($this->cm, $this->data);
        }
    }

    public function clogin($provider = '')
    {
        if ($this->visitor->logged_in) {
            redirect('person');
        }
        $this->config->load('oauth2');
        $allowed_providers = $this->config->item('oauth2');
        if ( ! $provider OR ! isset($allowed_providers[$provider]))
        {
            return $this->show_message('暂不支持'.$provider.'方式登录.', 0);
        }
        $this->load->library('oauth2');
        $provider = $this->oauth2->provider($provider, $allowed_providers[$provider]);
        $args = $this->input->get();
        if ($args AND !isset($args['code']))
        {
            return $this->show_message('授权失败了,可能由于应用设置问题或者用户拒绝授权.<br />具体原因:<br />'.json_encode($args), 0);
        }
        $code = $this->input->get('code', TRUE);
        if ( ! $code)
        {
            try
            {
                $provider->authorize();
            }
            catch (OAuth2_Exception $e)
            {
                return $this->show_message('操作失败<pre>'.$e.'</pre>', 0);
            }
        }
        else
        {
            try
            {
                $token = $provider->access($code);
                $oauth_user = $provider->get_user_info($token);
                if (is_array($oauth_user))
                {
                    //已经绑定直接登陆
                    $this->load->model('user_bind_model');
                    $bind_info = $this->user_bind_model->where('keyid', $oauth_user['via'] . '_' . $oauth_user['uid'])->find();
                    if ($bind_info) {
                        $this->load->model('user_model');
                        $user_info = $this->user_model->select('id,username,role_id,credit')->where('id', $bind_info['uid'])->find();
                        $this->visitor->assign($user_info);
                        redirect('person');
                    }
                    $this->session->set_userdata('oauth_user', $oauth_user);
                }
                else
                {
                    return $this->show_message('获取用户信息失败', 0);
                }
            }
            catch (OAuth2_Exception $e)
            {
                return $this->show_message('操作失败<pre>'.$e.'</pre>', 0);
            }
        }
        redirect('user/binding');
    }

    public function bind($provider = '')
    {
        if (!$this->visitor->logged_in) {
            redirect();
        }
        $this->config->load('oauth2');
        $allowed_providers = $this->config->item('oauth2');
        if ( ! $provider OR ! isset($allowed_providers[$provider]))
        {
            return $this->show_message('暂不支持'.$provider.'方式登录.', 0);
        }
        $this->load->library('oauth2');
        $provider = $this->oauth2->provider($provider, $allowed_providers[$provider]);
        $args = $this->input->get();
        if ($args AND !isset($args['code']))
        {
            return $this->show_message('授权失败了,可能由于应用设置问题或者用户拒绝授权.<br />具体原因:<br />'.json_encode($args), 0);
        }
        $code = $this->input->get('code', TRUE);
        if ( ! $code)
        {
            try
            {
                $provider->authorize();
            }
            catch (OAuth2_Exception $e)
            {
                return $this->show_message('操作失败<pre>'.$e.'</pre>', 0);
            }
        }
        else
        {
            try
            {
                $token = $provider->access($code);
                $oauth_user = $provider->get_user_info($token);
                if (is_array($oauth_user))
                {
                    $this->load->model('user_bind_model');
                    $bind_info = $this->user_bind_model->where('keyid', $oauth_user['via'] . '_' . $oauth_user['uid'])->find();
                    if (!$bind_info) {
                        $this->user_bind_model->add(array(
                            'uid' => $this->visitor->info['id'],
                            'type' => $oauth_user['via'],
                            'keyid' => $oauth_user['via'] . '_' . $oauth_user['uid'],
                            'info' => serialize(array(
                                'access_token'=>$oauth_user['access_token'],
                                'expire_at'=>$oauth_user['expire_at'],
                                'refresh_token'=>$oauth_user['refresh_token'],
                            )),
                        ));
                    }
                }
                else
                {
                    return $this->show_message('获取用户信息失败', 0);
                }
            }
            catch (OAuth2_Exception $e)
            {
                return $this->show_message('操作失败<pre>'.$e.'</pre>', 0);
            }
        }
        redirect('person/welcome/bind');
    }

    public function lostpwd()
    {
        $this->load->view($this->cm, $this->data);
    }

    public function logout()
    {
        $this->visitor->logout();
        redirect('user/login');
    }

    /**
     * 检测用户名是否合法
     */
    public function check_unique($field = '')
    {
        $username = $this->input->post('param', TRUE);
        $this->load->model('user_model');
        if (!$this->user_model->is_unique($field, $username)) {
            $this->ajax_return(array(
                'status' => 'y',
            ));
        }
        $this->ajax_return(array(
            'status' => 'n',
            'info' => '已经被使用',
        ));
    }

}