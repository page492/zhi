<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-4-5
 * Time: 上午2:29
 * 数据库工具
 */

class Database extends Admin_Controller
{

    protected $auto_load_model = FALSE;

    public function __construct()
    {
        parent::__construct();
        $this->load->dbutil();
        $this->load->helper('file');
    }

    /**
     * 数据库备份
     */
    public function index()
    {
        $query = $this->db->query("SHOW TABLE STATUS LIKE '{$this->db->dbprefix}%'");
        $this->load->helper('number');
        $tables = array();
        foreach ($query->result_array() as $val) {
            $val['Data_length'] = byte_format($val['Data_length']);
            $tables[] = $val;
        }
        $this->data['tables'] = $tables;
        $this->load->view($this->dcm, $this->data);
    }

    public function pl_backup()
    {
        if ($data = $this->input->post()) {
            $this->load->helper('string');
            $file_name = date('YmdHis') . '_' . random_string('alnum', 5);
            $backup = $this->dbutil->backup(array(
                'tables' => $data['name'],
                'format' => 'zip',
                'filename' => $file_name . '.sql',
            ));
            write_file('data/backup/' . $file_name . '.zip', $backup);
            $this->show_message('备份完成');
        } else {
            return $this->show_message('请选择数据表', 0);
        }
    }

    /**
     * 数据库修复
     */
    public function pl_repair()
    {
        if ($data = $this->input->post()) {
            foreach ($data['name'] as $val) {
                $this->dbutil->repair_table($val);
            }
            $this->show_message('修复完成');
        } else {
            return $this->show_message('请选择数据表', 0);
        }
    }

    /**
     * 数据库优化
     */
    public function pl_optimize()
    {
        if ($data = $this->input->post()) {
            foreach ($data['name'] as $val) {
                $this->dbutil->optimize_table($val);
                $this->show_message('优化完成');
            }
        } else {
            return $this->show_message('请选择数据表', 0);
        }
    }

    /**
     * 数据库恢复
     */
    public function restore($file = '')
    {
        if ($file) {
            $this->load->library('PclZip', 'data/backup/' . $file);
            $this->pclzip->extract(PCLZIP_OPT_PATH, 'data/backup/', PCLZIP_OPT_REPLACE_NEWER);
            $sql_file = 'data/backup/' . str_replace('.zip', '.sql', $file);
            $sql = read_file($sql_file);
            @unlink($sql_file);
            if ($this->db->query($sql)) {
                $this->show_message('导入成功');
            } else {
                $this->show_message('导入失败');
            }
        } else {
            $this->load->helper('directory');
            $files = directory_map('data/backup/');
            foreach ($files as $key => $_file) {
                $files[$key] = array(
                    'name' => $_file,
                    'ctime' => date('Y-m-d H:i:s', filectime('data/backup/' . $_file))
                );
            }
            $this->data['files'] = $files;
            $this->load->view($this->dcm, $this->data);
        }
    }

    public function delete()
    {
        $files = $this->input->post('files');
        empty($files) && $this->show_message('请选择需要删除的文件', 0);
        foreach ($files as $_file) {
            @unlink('data/backup/' . $_file);
        }
        return $this->show_message('操作成功');
    }

}