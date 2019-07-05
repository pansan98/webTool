<?php

namespace App\Library\File;

class File {
    private $_useArray = false;
    
    protected $_filePath;
    protected $_file;
    
    protected $_errors;
    
    public function setFile($file, $key)
    {
        if(isset($file[$key]['type'])) {
            $this->_file = $file;
        }
    }
    
    public function getFile($key)
    {
        if(isset($this->_file[$key])) {
            return $this->_file[$key];
        }
        
        return null;
    }
    
    public function getError()
    {
        return $this->_errors;
    }
}
?>