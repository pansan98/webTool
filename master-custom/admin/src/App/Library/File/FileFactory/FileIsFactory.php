<?php
namespace App\Library\File\FileFactory;

use App\Library\File\FileInterface\FileClientInterface;

class FileIsFactory implements FileClientInterface {
    
    protected $_file;
    
    protected $_errorObj;
    protected $_errors = [];
    
    public function setFile($file, $key)
    {
        if(isset($this->_file[$key]['type'])) {
            $this->_file[$key] = $file;
        }
    }
    
    public function getFile($key)
    {
        return $this->_file[$key];
    }
    
    public function getErrors()
    {
        return $this->_errorObj;
    }
    
    public function getError($key)
    {
        return $this->_errors[$key];
    }
    
    public function deleteCurrentFile($key)
    {
        if(isset($this->_file[$key])) {
            unset($this->_file[$key]);
        }
    }
}
?>