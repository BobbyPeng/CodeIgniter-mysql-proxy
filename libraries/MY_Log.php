<?php if(! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Log extends CI_Log
{

    public $enable = true;

    public $filename = NULL;

    public function write($msg, $filename = NULL)
    {
        if(! $this->enable) {
            return false;
        }
        if(empty($filename)) {
            $filename = $this->filename;
        }
        $filename = trim($filename, "/");
        if(empty($filename)) {
            $filename = 'MY_log-' . date('Y-m-d') . '.php';
        } else {
            if(strpos($filename, '/') !== false) {
                $folder = $this->_log_path. substr($filename, 0, strrpos($filename, '/') + 1);
                if(! is_dir($folder)) {
                    mkdir($folder, 0777, true);
                }
            }
            if(strtolower(substr($filename, -4)) != '.php') {
                $filename .= '-' . date('Y-m-d') . '.php';
            }
        }

        $filepath = $this->_log_path . $filename;
        $message = '';

        if(! file_exists($filepath)) {
            $message .= "<" . "?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?" . ">\n\n";
        }
        
        if(! $fp = @fopen($filepath, FOPEN_WRITE_CREATE)) {
            return false;
        }
        $message .= date($this->_date_fmt) . ' --> ' . $msg . "\n";
        flock($fp, LOCK_EX);
        fwrite($fp, $message);
        flock($fp, LOCK_UN);
        fclose($fp);
        return true;
    }
}
// END MY_Log Class

/* End of file MY_Log.php */
/* Location: ./application/libraries/MY_Log.php */