<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ActiveRecord extends CI_Model
{
    /**
     * Save Data
     *
     * @param array $data
     * @return boolean
     */
    public function save($data)
    {
        if($this->db->set($data)->insert($this->tableName())) {
            return $this->db->insert_id();
        }
        return FALSE;
    }
    
    /**
     * Update Record By Primary Key
     *
     * @param string $pk
     * @param array $attributes
     * @param array $where
     * @return boolean true for success, false for failure
     */
    public function updateByPk($pk, $attributes, $where = array())
    {
        $where[$this->primaryKey()] = $pk;
        return $this->updateAll($attributes, $where);
    }
    
    
    /**
     * Update Record
     *
     * @param array $attributes eg.updateAll(array('price' => array('price + 1', false)), array('id > ' => 2)))
     * @param array $where
     * @return bollean true for success, false for failure
     */
    public function updateAll($attributes, $where = array())
    {
        foreach($attributes as $key => $val) {
            if(is_array($val)) {
                $field_val = isset($val[0]) ? $val[0] : NULL;
                $escape = isset($val[1]) && !$val[1] ? false : true;
                $this->db->set($key, $field_val, $escape);
                unset($attributes[$key]);
            }
        }
        return $this->db->where($where)->update($this->tableName(), $attributes);
    }
    
    /**
     * Delete Record By Primary Key
     *
     * @param string $pk
     * @param array $where
     * @return boolean true for success, false for failure
     */
    public function deleteByPk($pk, $where = array())
    {
        $where[$this->primaryKey()] = $pk;
        return $this->deleteAll($where);
    }
    
    /**
     * Delete Record
     *
     * @param array $where
     * @return boolean true for success, false for failure
     */
    public function deleteAll($where = array(), $limit = NULL)
    {
        return $this->db->delete($this->tableName(), $where, $limit);
    }
    
    /**
     * Find Data By Primary Key
     *
     * @param string $pk
     * @param array $where
     * @return array
     */
    public function findByPk($pk, $where = array())
    {
        $where[$this->primaryKey()] = $pk;
        $query = $this->db->from($this->tableName())->where($where)->get();
        return $query->row_array();
    }
    
    /**
     * Find Record By Attributes
     *
     * @param array $where
     * @return array
     */
    public function findByAttributes($where = array())
    {
        $query = $this->db->from($this->tableName())->where($where)->limit(1)->get();
        return $query->row_array();
    }
    
    /**
     * Find Record
     *
     * @param array $where fuzzy query eg.array('name LIKE' => "pp%") array('stat >' => '1')
     * @param int $limit
     * @param int $offset
     * @param string $sort
     * @return array
     */
    public function findAll($where = array(), $limit = 0, $offset = 0, $sort = NULL)
    {
        $this->db->from($this->tableName())->where($where);
        if($sort !== NULL) {
            $this->db->order_by($sort);
        }
        if($limit > 0) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
    
        return $query->result_array();
    }
    
    /**
     * Count
     *
     * @param array $where
     * @return int
     */
    public function count($where = array())
    {
        return $this->db->from($this->tableName())->where($where)->count_all_results();
    }
    
    /**
     * Query SQL
     *
     * @param string $sql eg.SELECT * FROM tbl_name WHERE id = ? AND status = ? AND author = ?
     * @param array $param array(3, 'live', 'Rick')
     * @return array
     */
    public function query($sql, $param = array())
    {
        $query = $this->db->query($sql, $param);
        return $query->result_array();
    }
    
    /**
     * execute SQL
     *
     * @param string $sql eg. UPDATE `test` SET `stat` = 3 WHERE WHERE id = ?
     * @param array $param array(3)
     * @return boolean|int
     */
    public function execute($sql, $param = array())
    {
        if($this->db->query($sql, $param)) {
            return $this->db->affected_rows() ? $this->db->affected_rows() : true;
        }
        return false;
    }
    
    /**
     * Insert Batch
     *
     * @param array $data
     */
    public function insertData($data)
    {
        if(is_array(current($data))) {
            return $this->db->insert_batch($this->tableName(), $data);
        } else {
            return $this->db->insert($this->tableName(), $data);
        }
    }
    
    /**
     * Upate Data
     *
     * @param array $data
     */
    public function updateData($data, $key = 'id')
    {
        return $this->db->update_batch($this->tableName(), $data, $key);
    }

    /**
     * force master
     */
    public function force_master()
    {
        if(method_exists($this->db, 'force_master')){
            $this->db->force_master();
        }
        return $this;
    }
}

/* End of file ActiveRecord.php */
/* Location: ./application/core/database/ActiveRecord.php */