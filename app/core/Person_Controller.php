<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-18
 * Time: 下午6:58
 * 个人中心基类
 */

class Person_Controller extends Front_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->visitor->logged_in) {
            redirect('user/login');
        }
        $this->data['menu'] = $this->_get_menu();
        $this->data['expand_menu'] = $this->router->fetch_class();
        $this->data['curr_menu'] = $this->router->fetch_method();
    }

    private function _get_menu()
    {
        return array(
            'welcome' => array(
                'text' => '个人信息',
                'url' => site_url('person'),
                'sublist' => array(
                    'index' => array('text'=>'个人资料', 'url'=>site_url('person')),
                    'bind' => array('text'=>'同步绑定', 'url'=>site_url('person/welcome/bind')),
                    'avatar' => array('text'=>'修改头像', 'url'=>site_url('person/welcome/avatar')),
                )
            ),
            'comment' => array(
                'text' => '我的评论',
                'url' => site_url('person/comment'),
            ),
            'like' => array(
                'text' => '喜欢&收藏',
                'url' => site_url('person/like'),
                'sublist' => array(
                    'like' => array('text'=>'我的喜欢', 'url'=>site_url('person/like')),
                    'favorite' => array('text'=>'我的收藏', 'url'=>site_url('person/favorite')),
                )
            ),
            'submit' => array(
                'text' => '我的爆料',
                'url' => site_url('person/submit'),
            ),
            'credit' => array(
                'text' => '积分专区',
                'url' => site_url('person/credit'),
            )
        );
    }

}