<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_model Extends MY_Model
{
    /**
     * 主键
     */
    public function primaryKey()
    {
        return 'id';
    }

    /**
     * 表名称
     */
    public function tableName()
    {
        return 'test';
    }
}

/* End of file test_model.php */
/* Location: ./application/models/test_model.php */