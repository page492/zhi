<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-24
 * Time: 下午11:54
 * 安装程序
 */

class Install extends CI_Controller
{

    protected $data = array();

    public function index()
    {
        $this->load->helper('file');
        $this->data['hold_license'] = read_file(FCPATH . 'LICENSE');
        $this->load->view('install/index', $this->data);
    }

    public function check()
    {
        $check_env = $this->_check_env();
        $check_file = $this->_check_file();
        $compatible = TRUE;
        foreach ($check_env as $val) {
            if (FALSE === $val['compatible']) {
                $compatible = FALSE;
            }
        }
        foreach ($check_file as $val) {
            if (FALSE === $val['compatible']) {
                $compatible = FALSE;
            }
        }
        $this->data['check_env'] = $check_env;
        $this->data['check_file'] = $check_file;
        $this->data['compatible'] = $compatible;
        $this->load->view('install/check', $this->data);
    }

    public function config()
    {
        $conf = array();
        if ($this->input->post()) {
            $compatible = TRUE;
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
            $this->form_validation->set_rules('dbhost', '数据库地址', 'trim|required');
            $this->form_validation->set_rules('dbuser', '数据库用户名', 'trim|required');
            $this->form_validation->set_rules('dbpass', '数据库密码', 'trim|required');
            $this->form_validation->set_rules('dbname', '数据库名', 'trim|required');
            $this->form_validation->set_rules('dbprefix', '数据库表前缀', 'trim|required');
            $this->form_validation->set_rules('username', '帐号', 'trim|required');
            $this->form_validation->set_rules('password', '密码', 'trim|required|matches[passconf]|');
            $this->form_validation->set_rules('passconf', '重复密码', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->data['error'] = $this->form_validation->error_string();
                $compatible = FALSE;
            } else {
                $conf = elements(array('dbhost', 'dbuser', 'dbpass', 'dbname', 'dbprefix', 'username', 'password', 'passconf', 'email'), $_POST);
                $dsn = 'mysql://'.$conf['dbuser'].':'.$conf['dbpass'].'@'.$conf['dbhost'].'/'.$conf['dbname'];
                $this->load->database($dsn);
                if (!$this->db->conn_id) {
                    $this->data['error'] = '<div class="alert alert-error">连接数据库失败！</div>';
                    $compatible = FALSE;
                }
                $this->load->dbutil();
                if ($this->dbutil->database_exists($conf['dbname'])) {
                    $query = $this->db->query("SHOW TABLES LIKE '".$conf['dbprefix']."%'");
                    if ($query->result()) {
                        $this->data['error'] = '<div class="alert alert-error">数据库已经安装过HoldPHP？请修改数据表前缀或者清理数据库。</div>';
                        $compatible = FALSE;
                    }
                } else {
                    $this->load->dbforge();
                    if (!$this->dbforge->create_database($conf['dbname'])){
                        $this->data['error'] = '<div class="alert alert-error">创建数据库失败！</div>';
                        $compatible = FALSE;
                    }
                }
                //写入配置
                $this->load->helper('file');
                $file_data = read_file(APPPATH . 'config/database.sample.php');
                $file_data = str_replace(
                    array('{%HOSTNAME%}', '{%USERNAME%}', '{%PASSWORD%}', '{%DATABASE%}', '{%DBPREFIX%}'),
                    array($conf['dbhost'], $conf['dbuser'], $conf['dbpass'], $conf['dbname'], $conf['dbprefix']),
                    $file_data);
                if (!write_file(APPPATH . 'config/database.php', $file_data)) {
                    $this->data['error'] = '<div class="alert alert-error">配置信息写入失败！</div>';
                    $compatible = FALSE;
                }
                //管理员信息临时保存
                $admin_file = serialize(array('username'=>$conf['username'], 'password'=>$conf['password'], 'email'=>$conf['email']));
                if (!write_file(FCPATH . 'data/tmp/admin', $admin_file)) {
                    $this->data['error'] = '<div class="alert alert-error">管理员信息写入失败！</div>';
                    $compatible = FALSE;
                }
                if ($compatible) {
                    redirect('install/progress');
                }
            }
        }
        $this->data['conf'] = $conf;
        $this->load->view('install/config', $this->data);
    }

    public function progress()
    {
        $this->load->view('install/progress');
    }

    public function do_progress()
    {
        $rate = 0;
        $this->load->database();
        //创建数据表
        $this->_show_process('抽取：数据表结构文件...' ,$rate);
        $tables_sql = $this->_import_sql(FCPATH . 'data/tmp/tables.sql');
        $this->_show_process('开始创建数据表...', $rate += 5);
        $table_count = count($tables_sql);
        $table_rate_inc = 55 / $table_count * 2;
        foreach ($tables_sql as $sql) {
            $sql = str_replace('`hp_', '`' . $this->db->dbprefix, $sql); //替换前缀
            $this->db->query($sql);
            if (substr($sql, 0, 12) == 'CREATE TABLE') {
                $table_name = preg_replace("/CREATE TABLE `([a-z0-9_]+)` .*/is", "\\1", $sql);
                $this->_show_process("创建表：{$table_name} 成功...", $rate += $table_rate_inc);
            }
        }
        //添加初始数据
        $this->_show_process('抽取：初始数据文件...', $rate);
        $data_sql = $this->_import_sql(FCPATH . 'data/tmp/data.sql');
        $this->_show_process('开始导入初始数据...', $rate += 5);
        $data_count = count($data_sql);
        $data_rate_inc = 25 / $data_count;
        foreach ($data_sql as $sql) {
            $sql = str_replace('`hp_', '`' . $this->db->dbprefix, $sql);
            $this->db->query($sql);
            if (substr($sql, 0, 11) == 'INSERT INTO') {
                $table_name = preg_replace("/INSERT INTO `([a-z0-9_]+)` .*/is", "\\1", $sql);
                $this->_show_process("导入：{$table_name} 表初始数据...", $rate += $data_rate_inc);
            }
        }
        //添加管理员
        $this->_show_process('导入：管理员信息...', $rate += 5);
        $this->load->helper('file');
        $admin_data = read_file(FCPATH . 'data/tmp/admin');
        $admin_data = unserialize($admin_data);
        $this->load->model('user_model');
        $this->user_model->add(array(
            'role_id' => 1,
            'username' => $admin_data['username'],
            'password' => $admin_data['password'],
            'email' => $admin_data['email'],
        ));
        delete_files(FCPATH . 'data/tmp/', TRUE);
        $this->_show_process('安装完成！', 100, 'parent.install_successed();');
    }

    private function _show_process($msg, $rate = 0, $script = '')
    {
        header('Content-type:text/html;charset='.$this->config->item('charset'));
        echo '<script type="text/javascript">parent.show_process(\'' . $msg . '\', \'' . $rate . '\');' . $script . '</script>';
        flush();
        ob_flush();
    }

    public function finish()
    {
        touch(FCPATH . 'data/install.lock');
        $this->load->view('install/finish');
    }

    private  function _show_message($message)
    {
        $this->data['message'] = $message;
        $this->load->view('install/message', $this->data);
    }

    private function _check_env()
    {
        $env_item = array(
            'php_version' => array(
                'name' => 'PHP版本',
                'required' => '5.1.6',
            ),
            'gd_version' => array(
                'name' => 'GD库版本',
                'required' => '1.0',
            ),
        );
        foreach ($env_item as $key => $item) {
            switch ($key) {
                case 'php_version' :
                    $env_item[$key]['current'] = PHP_VERSION;
                    $env_item[$key]['compatible'] = (PHP_VERSION >= $item['required']);
                    break;
                case 'gd_version' :
                    $gd_info = function_exists('gd_info') ? gd_info() : array();
                    $env_item[$key]['current'] = empty($gd_info['GD Version']) ? '不支持' : $gd_info['GD Version'];
                    $env_item[$key]['compatible'] = empty($gd_info['GD Version']) ? FALSE : TRUE;
                    break;
            }
        }
        return $env_item;
    }

    private function _check_file()
    {
        $file_item = array(
            array(
                'file' => './data',
                'required' => '可写',
            ),
            array(
                'file' => './data/tmp',
                'required' => '可写',
            ),
            array(
                'file' => './data/upload',
                'required' => '可写',
            ),
            array(
                'file' => './data/backup',
                'required' => '可写',
            ),
            array(
                'file' => './app/config/database.php',
                'required' => '可写',
            ),
            array(
                'file' => './app/config',
                'required' => '可写',
            ),
            array(
                'file' => './app/cache',
                'required' => '可写',
            ),
        );
        foreach ($file_item as $key => $item) {
            $file_item[$key]['compatible'] = is_really_writable($item['file']);
            $file_item[$key]['current'] = $file_item[$key]['compatible'] === TRUE ? '可写' : '不可写';
        }
        return $file_item;
    }

    public function _import_sql($sql_file)
    {
        $contents = file_get_contents($sql_file);
        $contents = str_replace("\r\n", "\n", $contents);
        $contents = trim(str_replace("\r", "\n", $contents));
        $return_items = $items = array();
        $items = explode(";\n", $contents);

        foreach ($items as $item) {
            $return_item = '';
            $item = trim($item);
            $lines = explode("\n", $item);
            foreach ($lines as $line) {
                if (isset($line[1]) && $line[0] . $line[1] == '--') {
                    continue;
                }
                $return_item .= $line;
            }
            if ($return_item) {
                $return_items[] = $return_item; //.";";
            }
        }
        return $return_items;
    }

}