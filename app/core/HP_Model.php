<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-10
 * Time: 下午11:52
 * 模型扩展
 */
class HP_Model extends CI_Model
{

    //字段
    protected $fields = array();
    //主键
    protected $primary = 'id';
    //表名
    protected $table = NULL;
    //对象数据
    protected $data = array();
    //链操作
    private $methods = array('from', 'select', 'select_max', 'select_min', 'select_avg', 'select_sum', 'join', 'where', 'or_where', 'where_in', 'or_where_in', 'where_not_in', 'or_where_not_in', 'like', 'or_like', 'not_like', 'or_not_like', 'group_by', 'distinct', 'having', 'or_having', 'order_by', 'limit');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        if (get_class($this) != 'HP_Model') {
            if (empty($this->table)) {
                $this->table = strtolower(substr(get_class($this), 0, -6));
            }
            //设置字段和主键
            $this->fields = $this->get_fields();
            $this->primary = $this->db->primary($this->table);
        }
        $this->load->driver('cache');
    }

    /**
     * 设置数据对象的值
     */
    public function __set($name, $value)
    {
        $this->db->set($name, $value);
    }

    /**
     * 魔术方法实现链式方法
     */
    public function __call($method, $args)
    {
        if (in_array($method, $this->methods, true)) {
            call_user_func_array(array($this->db, $method), $args);
            return $this;
        }
    }

    protected function _parse_options($options)
    {
        if (!empty($options)) {
            foreach ($options as $key => $val) {
                call_user_func_array(array($this->db, $key), $val);
            }
        }
    }

    public function count($options = array())
    {
        $this->_parse_options($options);
        return $this->db->from($this->table)->count_all_results();
    }

    /**
     * 查询第一行记录
     */
    public function find($options = array())
    {
        if (is_string($options) || is_numeric($options)) {
            if (strpos($options, ',')) {
                $this->db->where_in($this->primary, explode(',', $options));
            } else {
                $this->db->where(array($this->primary => $options));
            }
        } else {
            $this->_parse_options($options);
        }
        return $this->db->get($this->table)->row_array();
    }

    /**
     * 查询记录
     */
    public function find_all($options = array())
    {
        $this->_parse_options($options);
        return $this->db->get($this->table)->result_array();
    }

    /**
     * 数据过滤
     */
    protected function _facade($data) {
        // 检查非数据字段
        if(!empty($this->fields)) {
            foreach ($data as $key=>$val){
                if(!in_array($key,$this->fields,true)){
                    unset($data[$key]);
                }
            }
        }
        return $data;
    }

    /**
     *  添加数据
     */
    public function add($data = array())
    {
        if (empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if (!empty($this->data)) {
                $data = $this->data;
                $this->data = array();
            } else {
                return false;
            }
        }
        if (isset($data[0]) && is_array($data[0])) {
            //批量添加
            $batch_data = array();
            foreach ($data as $key=>$_data){
                $this->_before_insert($_data);
                $batch_data[$key] = $this->_facade($_data);
            }
            $result = $this->db->insert_batch($this->table, $batch_data);
        } else {
            $this->_before_insert($data);
            $data = $this->_facade($data);
            $result = $this->db->insert($this->table, $data);
        }
        if (false !== $result) {
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                $data[$this->primary] = $insert_id;
                $this->_after_insert($data);
                return $insert_id;
            }
            $this->_after_insert($data);
        }
        return $result;
    }

    protected function _before_insert(&$data) {}

    protected function _after_insert($data) {}

    /**
     * 修改数据
     */
    public function edit($data = array(), $options = array(), $primary = '')
    {
        if (empty($data)) {
            // 没有传递数据，获取当前数据对象的值
            if (!empty($this->data)) {
                $data = $this->data;
                $this->data = array();
            } else {
                return false;
            }
        }
        $this->_parse_options($options);
        if (isset($data[0]) && is_array($data[0]) && $primary) {
            $batch_data = array();
            foreach ($data as $key=>$_data){
                $this->_before_update($_data, $options);
                $batch_data[$key] = $this->_facade($_data);
            }
            $result = $this->db->update_batch($this->table, $batch_data, $primary);
        } else {
            $this->_before_update($data, $options);
            $data = $this->_facade($data);
            $result = $this->db->update($this->table, $data);
        }
        if (false !== $result) {
            $this->_after_update($data, $options);
        }
        return $result;
    }

    protected function _before_update(&$data, $options) {}

    protected function _after_update($data, $options) {}

    public function set_field($data, $options = array())
    {
        $this->_parse_options($options);
        $result = $this->db->update($this->table, $data);
        if (false !== $result) {
            //TODO
        }
        return $result;
    }

    /**
     * 删除数据
     */
    public function delete($options = array())
    {
        if(is_numeric($options)  || is_string($options)) {
            $primary = $this->primary;
            if(strpos($options, ',')) {
                $this->db->where_in($primary, explode(',', $options));
            }else{
                $this->db->where(array($primary => $options));
            }
        } else {
            $this->_parse_options($options);
        }
        $result = $this->db->delete($this->table);
        if(false !== $result) {
            $this->_after_delete($options);
        }
        return $result;
    }

    protected function _after_delete($options) {}

    /**
     * 获取主键
     */
    public function get_primary()
    {
        return $this->primary;
    }

    /**
     * 获取表字段
     */
    public function get_fields($table = '')
    {
        return $this->db->list_fields($table ? $table : $this->table);
    }

}
