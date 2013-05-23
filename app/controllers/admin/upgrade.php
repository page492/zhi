<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-2
 * Time: 下午1:39
 * 在线升级
 */

class Upgrade extends Admin_Controller {

    protected $auto_load_model = FALSE;
    //获取补丁地址
    private $_api_url = 'http://api.holdphp.com/patch/';
    //本地保存地址
    private $_upgrade_dir = '';
    //更新文件错误信息
    private $_copy_error = FALSE;

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('http');

        $cache_path = $this->config->item('cache_path');
        $this->_upgrade_dir = ($cache_path == '') ? APPPATH.'cache/upgrade/' : $cache_path . 'upgrade/';
    }

    /**
     * 获取适用的补丁包
     */
    public function index()
    {
        $this->load->view('admin/upgrade/index', $this->data);
    }

    /**
     * 检测最新版
     */
    public function pl_check_patch()
    {
        $curr_version = $this->config->item('version', 'system');
        $curr_release = $this->config->item('release', 'system');
        $result = get_url_contents($this->_api_url . '?v='.$curr_version.'&r='.$curr_release);
        $result = json_decode($result, TRUE);
        if ($result['code'] == '0') {
            $this->ajax_return(array(
                'status' => -1,
                'msg' => '<strong>错误：</strong> 无法链接云服务器，请检查您的网络设置，或者授权码是否正确。'
            ));
        }
        if (empty($result['patch_list'])) {
            $this->ajax_return(array(
                'status' => 0,
                'msg' => '您使用的 HoldPHP 是最新版本。',
            ));
        } else {
            $this->ajax_return(array(
                'status' => 1,
                'patch_list' =>$result['patch_list']
            ));
        }
    }

    /**
     * 安装补丁包
     */
    public function pl_install_patch()
    {
        $patch_name = $this->input->get('patch_name');
        $step = $this->input->get('step');
        $method = $step ? '_patch_'.$step : '_patch_download';
        $this->$method($patch_name);
    }

    private function _patch_download($patch_name)
    {
        //$remote_patch = get_url_contents($this->_api_url . 'download/?patch_name='.$patch_name);

        $remote_patch = $this->_api_url . 'download/V1.0.0.20130400.zip';
        $local_patch = $this->_upgrade_dir . $patch_name . '.zip';
        //$patch_dir = $this->_upgrade_dir . $patch_name;
        //创建缓存文件夹
        if(!is_dir($this->_upgrade_dir)) {
            @mkdir($this->_upgrade_dir);
        }
        curl_download($remote_patch, $local_patch);
        //解压缩
        $this->load->library('PclZip', $local_patch);
        if(!$this->pclzip->extract(PCLZIP_OPT_PATH, $this->_upgrade_dir, PCLZIP_OPT_REPLACE_NEWER)) {
            $this->ajax_return(array(
                'status' => 0,
                'msg' => $this->pclzip->errorInfo(true)
            ));
        } else {
            $this->ajax_return(array(
                'status' => 1,
                'msg' => '下载程序升级包完成，正在更新系统文件...'
            ));
        }
    }

    private function _patch_coverfile($patch_name)
    {
        $this->_copydir($this->_upgrade_dir . $patch_name.'/upload/', '.');
        if (!$this->_copy_error) {
            $this->ajax_return(array(
                'status' => 1,
                'msg' => '系统文件更新成功，开始执行安装程序...'
            ));
        } else {
            $this->ajax_return(array(
                'status' => 0,
                'msg' => '系统文件更新失败，请重试...'
            ));
        }
    }

    private function _patch_extract($patch_name)
    {
        $extract_path = $this->_upgrade_dir . '/upgrade/extract/';
        $file_list = glob($extract_path.'*');
        if (!empty($file_list)) {
            foreach ($file_list as $file) {
                $extension = pathinfo($file, PATHINFO_EXTENSION);
                if(!in_array(strtolower($extension), array('php', 'sql'))) {
                    continue;
                }
                if ($extension == 'php') {
                    include $file;
                } else {
                    $file_content = file_get_contents($file);
                    $sqls = explode(';', $file_content);
                    foreach ($sqls as $sql) {
                        if (empty($sql)) continue;
                        $this->db->query($sql);
                    }
                }
            }
        }
        //更新版本号

        //删除升级文件

        $this->ajax_return(array(
            'status' => 1,
            'msg' => '系统升级完成！'
        ));
    }

    private function _copydir($dirfrom, $dirto)
    {
        !is_dir($dirto) && mkdir($dirto);
        $handle = opendir($dirfrom);
        //循环读取文件
        while(false !== ($file = readdir($handle))) {
            if($file != '.' && $file != '..'){
                //生成源文件名
                $filefrom = $dirfrom.'/'.$file;
                //生成目标文件名
                $fileto = $dirto.DIRECTORY_SEPARATOR.$file;
                if(is_dir($filefrom)){ //如果是子目录，则进行递归操作
                    $this->_copydir($filefrom, $fileto);
                } else { //如果是文件，则直接用copy函数复制
                    if(!copy($filefrom, $fileto)) {
                        $this->_copy_error = TRUE;
                    }
                }
            }
        }
    }

}