<?php
namespace App\Library\File\FileFactory;

use App\Library\File\FileInterface\FileErrorsInterface;
use App\Library\File\Factory\Factory;
use App\Library\File\FileFactory\ErrorFactory;
use \Exception;

class FileErrorFactory implements FileErrorsInterface {
    
    public $_errorFactory;
    protected $_isError = false;
    
    protected $_filePath;
    protected $_fileMaxBytes = 30720000;
    
    protected $_errors;
    
    protected $_validExtensions = ["jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF", "tiff", "TIFF", "tif", "TIF", "bmp", "BMP", "pdf", "PDF"];
    
    public function __construct()
    {
        $this->_errorFactory = new ErrorFactory;
    }
    
    /**
     * @param Factory $obj
     * @return Factory|\App\Library\File\FileFactory\ErrorFactory
     */
    public function isFileSizeType(Factory $obj)
    {
        // 3MB以上はアウト
        if(($obj->getFileType() == 'image/png') || ($obj->getFileType() == 'image/jpg') || ($obj->getFileType() == 'image/jpeg') || ($obj->getFileType() == 'image/tiff') || ($obj->getFileType() == 'image/gif') || ($obj->getFileType() == 'image/x-bmp') || ($obj->getFileType() == 'x-MS-bmp') || ($obj->getFileType() == 'image/bmp') || ($obj->getFileType() == 'application/pdf')) {
            if($obj->getFileSize() < $this->_fileMaxBytes) {
                if(in_array($obj->getFileExtension(), $this->_validExtensions)) {
                    return $obj;
                } else {
                    $this->setIsError(true);
                    $this->_errorFactory->setExtensionsError($obj->getFileName().'は有効なファイルではありません。');
                }
            } else {
                $this->setIsError(true);
                $this->_errorFactory->setSizeError('アップロードファイル容量：'.$obj->getFileSize().PHP_EOL.$this->_fileMaxBytes.'以内の画像をアップロードしてください。');
            }
        } else {
            $this->setIsError(true);
            $this->_errorFactory->setTypeError('アップロードファイルタイプ：'.$obj->getFileType().PHP_EOL.'ファイルタイプを確認してください。');
        }
        
        return $this->getErrors();
    }
    
    /**
     * @param Factory $obj
     * @return \App\Library\File\FileFactory\ErrorFactory|bool
     */
    public function isFileTemplate(Factory $obj)
    {
        if($obj->getFileError() > 0) {
            $this->setIsError(true)->_errorFactory->setTemplateError($obj->getFileError());
            
            return $this->getErrors();
        }
        
        return true;
    }
    
    /**
     * @param Factory $obj
     * @param $movePath
     * @return \App\Library\File\FileFactory\ErrorFactory|bool
     */
    public function isAlreadyFile(Factory $obj, $movePath)
    {
        if(file_exists($movePath.$obj->getFileName())) {
            $this->setIsError(true);
            $this->_errorFactory->setAlreadyError($obj->getFileName() . '<span id="invalid"><b>already exists.</b></span>');
            
            return $this->getErrors();
        }
        
        return true;
    }
    
    /**
     * @param $path
     */
    public function setUploadPath($path)
    {
        $this->_filePath = $path;
    }
    
    
    /**
     * @return \App\Library\File\FileFactory\ErrorFactory
     */
    public function getErrors()
    {
        return $this->_errorFactory;
    }
    
    /**
     * @param callable $callback
     * @param $parameter
     * @throws Exception
     */
    protected function setCall(callable $callback, $parameter)
    {
        if(!method_exists($this, $callback)) {
            throw new Exception(
                'Method does not exist.'
            );
        }
        
        $this->$callback($parameter);
    }
    
    /**
     * @param $status
     * @return $this
     */
    protected function setIsError($status)
    {
        if(is_bool($status)) {
            if(!$this->_isError) {
                $this->_isError = $status;
            }
        }
        
        return $this;
    }
    
    /**
     * @return bool
     */
    public function getIsError()
    {
        return $this->_isError;
    }
    
    /**
     * @param $bytes
     */
    public function setFileMaxBytes($bytes)
    {
        if(is_int($bytes)) {
            $this->_fileMaxBytes = $bytes;
        }
    }
    
}
?>