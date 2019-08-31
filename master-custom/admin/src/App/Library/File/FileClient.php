<?php

namespace App\Library\File;

use App\Library\File\FileFactory\FileIsFactory;
use App\Library\File\Factory\Factory;
use App\Library\File\FileFactory\FileErrorFactory;
use App\Library\File\FileFactory\ErrorFactory;
use Exception;

class FileClient {
    public static $instance;
    public static $_fileType = 'single';
    
    protected $_filePath;
    protected $_fileFactory;
    protected $_fileErrorFactory;
    
    protected $_errors;
    
    /**
     * FileClient constructor.
     */
    public function __construct()
    {
        if((string)self::$_fileType === 'single') {
            $this->_fileFactory = new FileIsFactory();
        } elseif((string)self::$_fileType === 'multi') {
            $this->_fileFactory = new FileIsFactory();
        }
        
        $this->_fileErrorFactory = new FileErrorFactory();
    }
    
    /**
     * @return FileClient
     */
    public static function getInstance()
    {
        if(!self::$instance instanceof FileClient) {
            self::$instance = new static();
        }
        
        return self::$instance;
    }
    
    /**
     * @param $type
     */
    public static function registerType($type = 'single')
    {
        self::$_fileType = $type;
    }
    
    /**
     * @param $attr
     * @return false|mixed|string
     * @throws Exception
     */
    public function registerClient($attr)
    {
        $ret = $this->_fileFactory->registerUploadFile($attr);
        if(!$this->_fileErrorFactory->getIsError()) {
            if($ret instanceof Factory) {
                $data = $this->_fileFactory->moveUpload($ret, $this->_fileFactory->getUploadFileDir());
                return $data;
            }
        }
        
        return $ret;
    }
    
    /**
     * @param $dir
     */
    public function setFileDirClient($dir)
    {
        $this->_fileFactory->setUploadFileDir($dir);
    }
    
    /**
     * @param $file
     * @param $key
     */
    public function setSingleFileClient($file, $key)
    {
        $this->_fileFactory->deleteCurrentFile($key);
        $this->_fileFactory->setFactory($file, $key);
    }
    
    public function setMultiFileClient($files, $key)
    {
        //TODO 未実装
    }
    
    
    /**
     * sample code
     */
    protected function ajaxFileUpload()
    {
        $result = array();
        if(isset($_FILES["pic"]["type"])) {
            $validextensions = array("jpeg", "jpg", "JPEG", "JPG", "png", "PNG", "gif", "GIF", "tiff", "TIFF", "tif", "TIF", "bmp", "BMP", "pdf", "PDF");
            $temporary = explode(".", $_FILES["pic"]["name"]);
            $file_extension = end($temporary);
            //Approx. 100kb files can be uploaded.
            if ((($_FILES["pic"]["type"] == "image/png") || ($_FILES["pic"]["type"] == "image/jpg") || ($_FILES["pic"]["type"] == "image/jpeg") || ($_FILES["pic"]["type"] == "image/tiff") || ($_FILES["pic"]["type"] == "image/gif") || ($_FILES["pic"]["type"] == "image/x-bmp") || ($_FILES["pic"]["type"] == "image/x-MS-bmp") || ($_FILES["pic"]["type"] == "image/bmp") || ($_FILES["pic"]["type"] == "application/pdf")) && ($_FILES["pic"]["size"] < 30720000) && in_array($file_extension, $validextensions)) {
                    if ($_FILES["pic"]["error"] > 0) {
                        $result["error"] = "true";
                    } else {
                        if (file_exists("../temp/ajax/" . $_FILES["pic"]["name"])) {
                            echo $_FILES["pic"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
                            $result["error"] = "true";
                        } else {
                            $temp = explode(".", $_FILES['pic']['name']);
                            $name = time()."_".$temp[0].".".$temp[1];
                            $sourcePath = $_FILES['pic']['tmp_name']; // Storing source path of the file in a variable
                            $targetPath = "../temp/ajax/".$name; // Target path where file is to be stored
                            move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
                            $result["name"] = $name;
                            $result["error"] = "false";
                            $result["extension"] = $file_extension;
                        }
                    }
            } else {
                $result["error"] = "true";
            }
        }
        echo json_encode($result);
    }
    
}
?>