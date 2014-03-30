<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'core/database/ActiveRecord.php';

/**
 * Common Model
 * 
 * @author BobbyPeng<pengbotao@vip.qq.com>
 *
 */
class MY_Model extends ActiveRecord 
{
    public function __construct($group_name = '')
    {
        parent::__construct();
        $this->initDb($group_name);
    }

    private function initDb($group_name = '')
    {
        $db_conn_name = $this->getDbName($group_name);
        $CI = & get_instance();
        if(isset($CI->{$db_conn_name}) && is_object($CI->{$db_conn_name})) {
            $this->db = $CI->{$db_conn_name};
        } else {
            $CI->{$db_conn_name} = $this->db = $this->load->database($group_name, TRUE);
        }
    }

    private function getDbName($group_name = '')
    {
        if($group_name == '') {
            $db_conn_name = 'db';
        } else {
            $db_conn_name = 'db_'.$group_name;
        }
        return $db_conn_name;
    }
}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */