<?php
/**
 * 根据当前加载的group以及查询类型获取是否使用主从
 * 使用主从则返回一个db配置数组
 */
function load_db_proxy_setting($group_name, $is_write_query, $force_master = false)
{
    if ( ! defined('ENVIRONMENT') OR ! file_exists($file_path = APPPATH.'config/'.ENVIRONMENT.'/database.php')) {
        if ( ! file_exists($file_path = APPPATH.'config/database.php')) {
            return false;
        }
    }
    include($file_path);
    if(! isset($_master_slave_relation) || ! is_array($_master_slave_relation)) {
        return false;
    }
    $db_proxy = false;$db_master_group = '';
    foreach($_master_slave_relation as $key => $val) {
        if($key == $group_name) {
            $db_proxy = true;
            $db_master_group = $group_name;
            break;
        }
        foreach($val as $v) {
            if($v == $group_name) {
                $db_proxy = true;
                $db_master_group = $key;
                break;
            }
        }
        if($db_proxy == true) {
            break;
        }
    }
    if(! $db_proxy) {
        return false;
    }
    if($is_write_query || $force_master) {
        return isset($db[$db_master_group]) ? array($db_master_group => $db[$db_master_group]) : false;
    } else {
        $CI = & get_instance();
        foreach($_master_slave_relation[$db_master_group] as $val) {
            if(isset($CI->{'conn_'.$val}) && is_resource($CI->{'conn_'.$val})) {
                return array($val => $db[$val]);
            }
        }
        $rand_slave_id = array_rand($_master_slave_relation[$db_master_group]);
        $db_slave_group_name = $_master_slave_relation[$db_master_group][$rand_slave_id];
        return isset($db[$db_slave_group_name]) ? array($db_slave_group_name => $db[$db_slave_group_name]) : false;
    }
}
