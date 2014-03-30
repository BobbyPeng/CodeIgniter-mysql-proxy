<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
    public function __construct() 
    {
        parent::__construct();
        register_shutdown_function(function(){
            foreach(get_object_vars($this) as $key => $val) {
                if(substr($key, 0, 3) == 'db_' && is_object($this->{$key}) && method_exists($this->{$key}, 'close')) {
                    $this->{$key}->close($key);
                }
                if(substr($key, 0, 5) == 'conn_'  && is_resource($this->{$key})) {
                    $this->db->_close($val);
                    unset($this->{$key});
                }
            }
        });
    }
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */