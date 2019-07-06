<?php
namespace App\Library\File\Factory;

class Factory {
    
    protected $file_name;
    
    protected $file_type;
    
    protected $file_size;
    
    protected $file_tmp_name;
    
    protected $file_extension;
    
    protected $file_error;
    
    /**
     * @param $fileName
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->file_name = $fileName;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->file_name;
    }
    
    /**
     * @param $fileType
     * @return $this
     */
    public function setFileType($fileType)
    {
        $this->file_type = $fileType;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileType()
    {
        return $this->file_type;
    }
    
    /**
     * @param $fileSize
     * @return $this
     */
    public function setFileSize($fileSize)
    {
        $this->file_size = $fileSize;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileSize()
    {
        return $this->file_size;
    }
    
    /**
     * @param $fileTmpName
     * @return $this
     */
    public function setFileTmpName($fileTmpName)
    {
        $this->file_tmp_name = $fileTmpName;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileTmpName()
    {
        return $this->file_tmp_name;
    }
    
    /**
     * @param $fileExtension
     * @return $this
     */
    public function setFileExtension($fileExtension)
    {
        $this->file_extension = $fileExtension;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileExtension()
    {
        return $this->file_extension;
    }
    
    /**
     * @param $fileError
     * @return $this
     */
    public function setFileError($fileError)
    {
        $this->file_error = $fileError;
        
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getFileError()
    {
        return $this->file_error;
    }
}
?>