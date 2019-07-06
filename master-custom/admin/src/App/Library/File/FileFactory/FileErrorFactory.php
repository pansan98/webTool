<?php
namespace App\Library\File\FileFactory;

use App\Library\File\FileInterface\FileErrorsInterface;
use App\Library\File\Factory\Factory;
use \Exception;

class FileErrorFactory implements FileErrorsInterface {
    
    protected $_isError = false;
    
    protected $_filePath;
    protected $_fileMaxBytes = 30720000;
    
    protected $_errors;
    
    // there error property
    protected $_tempError;
    protected $_sizeError;
    protected $_typeError;
    protected $_extensionsError;
    protected $_alreadyError;
    
    protected $_validExtensions = ["jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF", "tiff", "TIFF", "tif", "TIF", "bmp", "BMP", "pdf", "PDF"];
    
    public function __construct()
    {
    }
    
    public function isError($file)
    {
        $temporary = explode(".", $file['name']);
        $fileExtension = end($temporary);
        // 3MB以上はアウト
        if(($obj->getFileType() == 'image/png') || ($obj->getFileType() == 'image/jpg') || ($obj->getFileType() == 'image/jpeg') || ($obj->getFileType() == 'image/tiff') || ($obj->getFileType() == 'image/gif') || ($obj->getFileType() == 'image/x-bmp') || ($obj->getFileType() == 'x-MS-bmp') || ($obj->getFileType() == 'image/bmp') || ($obj->getFileType() == 'application/pdf') && ($file['size'] < 30720000) && in_array($fileExtension, $this->_validExtensions)) {
            if($file['error'] > 0) {
                $this->setIsError(true);
                $this->setTemplateError($file['error']);
            } else {
                if(file_exists($this->_filePath.$file['name'])) {
                    $this->setIsError(true);
                    $this->setAlreadyError($file['name'] . '<span id="invalid"><b>already exists.</b></span>');
                } else {
                    $fileName = time().'_'.$temporary[0].'.'.$temporary[1];
                    $sourcePath = $file['tmp_name'];
                    $ret = $this->uploadFile($sourcePath, $this->getFilePath().$fileName);
                }
            }
        }
    }
    
    /**
     * @param Factory $obj
     * @return Factory|FileErrorFactory
     */
    public function isFileSizeType(Factory $obj)
    {
        $temporary = explode(".", $obj->getFileName());
        $fileExtension = end($temporary);
        // 3MB以上はアウト
        if(($obj->getFileType() == 'image/png') || ($obj->getFileType() == 'image/jpg') || ($obj->getFileType() == 'image/jpeg') || ($obj->getFileType() == 'image/tiff') || ($obj->getFileType() == 'image/gif') || ($obj->getFileType() == 'image/x-bmp') || ($obj->getFileType() == 'x-MS-bmp') || ($obj->getFileType() == 'image/bmp') || ($obj->getFileType() == 'application/pdf')) {
            if($obj->getFileSize() < $this->_fileMaxBytes) {
                if(in_array($obj->getFileExtension(), $this->_validExtensions)) {
                    return $obj;
                } else {
                    $this->setIsError(true)->setExtensionsError($obj->getFIleName().'は有効なファイルではありません。');
                }
            } else {
                $this->setIsError(true)->setFileMaxBytes('アップロードファイル容量：'.$obj->getFileSize().PHP_EOL.$this->_fileMaxBytes.'以内の画像をアップロードしてください。');
            }
        } else {
            $this->setIsError(true)->setTypeError('アップロードファイルタイプ：'.$obj->getFileType().PHP_EOL.'ファイルタイプを確認してください。');
        }
        
        return $this->getErrors();
    }
    
    /**
     * @param Factory $obj
     * @return FileErrorFactory|bool
     */
    public function isFileTemplate(Factory $obj)
    {
        if($obj->getFileError() > 0) {
            $this->setIsError(true)->setTemplateError($obj->getFileError());
            
            return $this->getErrors();
        }
        
        return true;
    }
    
    /**
     * @param Factory $obj
     * @param $movePath
     * @return FileErrorFactory|bool
     */
    public function isAlreadyFile(Factory $obj, $movePath)
    {
        if(file_exists($movePath.$obj->getFileName())) {
            $this->setIsError(true)->setAlreadyError($obj->getFIleName() . '<span id="invalid"><b>already exists.</b></span>');
            
            return $this->getErrors();
        }
        
        return true;
    }
    
    
    public function setUploadPath($path)
    {
        $this->_filePath = $path;
    }
    
    /**
     * @return $this
     */
    public function getErrors()
    {
        return $this;
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
     * @param $template
     * @return $this
     */
    private function setTemplateError($template)
    {
        $this->_tempError = $template;
        
        return $this;
    }
    
    /**
     * @param $error
     * @return $this
     */
    private function setAlreadyError($error)
    {
        $this->_alreadyError = $error;
        
        return $this;
    }
    
    /**
     * @param $type
     * @return $this
     */
    private function setTypeError($type)
    {
        $this->_typeError = $type;
        
        return $this;
    }
    
    /**
     * @param $extensions
     * @return $this
     */
    private function setExtensionsError($extensions)
    {
        $this->_extensionsError = $extensions;
        
        return $this;
    }
    
    /**
     * @param $status
     * @return $this
     */
    protected function setIsError($status)
    {
        if(!$this->_isError) {
            $this->_isError = $status;
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