<?php
namespace App\Library\File\FileInterface;

interface FileClientInterface {
    
    /**
     * @param $file
     * @param $key
     * @return mixed
     */
    public function setFactory($file, $key);
    
    /**
     * @param $key
     * @return mixed
     */
    public function getFactory($key);
    
    /**
     * @param $key
     * @return mixed
     */
    public function getError($key);
    
    /**
     * @return mixed
     */
    public function getErrors();
    
    /**
     * @param $key
     * @return mixed
     */
    public function deleteCurrentFile($key);
    
    /**
     * @param $dir
     * @return mixed
     */
    public function setUploadFileDir($dir);
}
?>