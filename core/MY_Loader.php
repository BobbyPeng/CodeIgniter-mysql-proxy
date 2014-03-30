<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Loader extends CI_Loader
{
    public function database($params = '', $return = FALSE, $active_record = NULL)
    {
        $CI =& get_instance();
        if (class_exists('CI_DB') AND $return == FALSE AND $active_record == NULL AND isset($CI->db) AND is_object($CI->db)) {
            return FALSE;
        }
        if(file_exists(APPPATH.'core/database/DB.php')) {
            require_once(APPPATH.'core/database/DB.php');
        } else {
            require_once(BASEPATH.'database/DB.php');
        }
        if ($return === TRUE) {
            return DB($params, $active_record);
        }
        $CI->db = '';
        $CI->db =& DB($params, $active_record);
    }
}

/* End of file MY_Loader.php */
/* Location: ./application/core/MY_Loader.php */