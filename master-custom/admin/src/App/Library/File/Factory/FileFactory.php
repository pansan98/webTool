<?php
namespace App\Library\File\Factory;

use App\Library\File\FileInterface\FileClientInterface;
use App\Library\File\FileFactory\FileErrorFactory;
use App\Library\File\Factory\Factory;

class FileFactory implements FileClientInterface {
    
    protected $_fileObj = [];
    protected $_file = [];
    protected $_uploadFileDir;
    
    protected $_errorObj;
    public $_errors = [];
    
    public function __construct()
    {
        $this->_errorObj = new FileErrorFactory;
    }
    
    /**
     * @param $file
     * @param $key
     * @return mixed|void
     */
    public function setFactory($file, $key)
    {
        if(!$this->_fileObj[$key] instanceof Factory) {
            $this->_fileObj[$key] = new Factory();
        }
        
        $this->_fileObj[$key]->setFileName($file[$key]['name'])->setFileType($file[$key]['type'])->setFileSize($file[$key]['size'])->setFileTmpName($file[$key]['tmp_name'])->setFileExtension(end(explode('.', $this->_fileObj->getFileName())))->setFileError($file[$key]['error']);
    }
    
    /**
     * @param $key
     * @return mixed
     */
    public function getFactory($key)
    {
        if($this->_fileObj[$key] instanceof Factory) {
            return $this->_file[$key];
        }
        
        return null;
    }
    
    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->_errorObj;
    }
    
    /**
     * @param $key
     * @return mixed
     */
    public function getError($key)
    {
        return $this->_errors[$key];
    }
    
    /**
     * @param $key
     * @return mixed|void
     */
    public function deleteCurrentFile($key)
    {
        if(isset($this->_file[$key]) AND $this->_fileObj instanceof Factory) {
            unset($this->_file[$key]);
            unset($this->_fileObj[$key]);
        }
    }
    
    /**
     * @param $dir
     * @return mixed|void
     */
    public function setUploadFileDir($dir)
    {
        $this->_uploadFileDir = $dir;
    }
    
    /**
     * @return mixed
     */
    public function getUploadFileDIr()
    {
        return $this->_uploadFileDir;
    }
}
?>