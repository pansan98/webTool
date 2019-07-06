<?php

namespace App\Library\File;

use Exception;
use App\Library\File\FileFactory\FileIsFactory;

class FileClient {
    private $_useArray = false;
    
    protected $_filePath;
    protected $_fileFactory;
    
    protected $_errors;
    
    public function __construct()
    {
        $this->_fileFactory = new FileIsFactory();
    }
    
    public function createFile($file, $key)
    {
        if($this->_useArray) {
            $this->setArrayFile($file, $key);
        } else {
            $this->setIsFile($file, $key);
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
    
    /**
     * @param $dir
     */
    public function setFileDir($dir)
    {
        $this->_fileFactory->setUploadFileDir($dir);
    }
    
    /**
     * @param $file
     * @param $key
     */
    protected function setIsFile($file, $key)
    {
        $this->_fileFactory->deleteCurrentFile($key);
        $this->_fileFactory->setFactory($file, $key);
    }
    
    protected function setArrayFile($files, $key)
    {
    
    }
    
    /**
     * @param bool $status
     */
    public function setUseArray(bool $status)
    {
        $this->_useArray = $status;
    }
    
    /**
     * secret method
     * @param callable $callback
     * @param $parameter
     */
    public function setCall(callable $callback, $parameter)
    {
        if(!method_exists($this, $callback)) {
            throw new Exception(
                'There is no method on the object.'
            );
        }
        
        $this->$callback($parameter);
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