<?php
namespace App\Library\File\FileInterface;

interface FileClientInterface {
    
    /**
     * @param $file
     * @param $key
     * @return mixed
     */
    public function setFile($file, $key);
    
    /**
     * @param $key
     * @return mixed
     */
    public function getFIle($key);
    
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
}
?>