<?php
/**
 * Created by JetBrains PhpStorm.
 * User: nimo
 * Date: 13-3-4
 * Time: 上午1:29
 * 网站设置模型
 */
class Setting_model extends HP_Model
{

    private  $_namespace = 'site';
    private  $_data = array();

    /**
     * 申明命名空间
     * @param string $namespace
     * @return $this
     */
    public function set_namespace($namespace = '')
    {
        $namespace && $this->_namespace = $namespace;
        return $this;
    }

    /**
     * 批量设置
     * @param $data
     * @return $this
     */
    public function sets($data)
    {
        foreach ($data as $key=>$val) {
            $this->set($key, $val);
        }
        return $this;
    }

    /**
     * 设置配置项
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        is_array($value) && $value = serialize($value);
        $this->_data[$name] = array('data'=>$value);
        return $this;
    }

    /**
     * 保存配置到数据库
     */
    public function save()
    {
        foreach ($this->_data as $key=>$val) {
            $this->where(array('name'=>$key, 'namespace'=>$this->_namespace))->edit($val);
        }
        $this->clear_cache();
    }

    /**
     * 读取站点配置写入缓存
     */
    public function get_cache()
    {
        if (FALSE === $setting = $this->cache->get('setting')) {
            $setting = array();
            $result = $this->find_all();
            foreach ($result as $val) {
                $setting[$val['namespace']][$val['name']] = @unserialize($val['data']) ? unserialize($val['data']) : $val['data'];
            }
            $this->cache->save('setting', $setting);
        }
        return $setting;
    }

    /**
     * 清理配置缓存
     */
    public function clear_cache()
    {
        $this->cache->delete('setting');
    }
}
