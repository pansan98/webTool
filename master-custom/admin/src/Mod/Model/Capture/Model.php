<?php
namespace src\Mod\Model\Capture;

/**
 * Class Model
 * @package src\Mod\Model\Capture
 * コメントはDB参照
 */
class Model extends CaptureModel {

    /**
     * id
     */
    protected $_id;

    /**
     * user id
     */
    protected $_user_id;

    /**
     * capture created
     */
    protected $_capture_created;

    /**
     * capture url
     */
    protected $_capture_url;

    /**
     * capture filename
     */
    protected $_capture_filename;

    /**
     * capture deleted
     */
    protected $_capture_deleted;

    /**
     * capture copy
     */
    protected $_capture_copy;

    public function __toString()
    {
        return $this->_capture_filename;
    }
    
    /**
     * @return $this
     */
    protected function getModel()
    {
        return $this;
    }
    
    
    /**
     * @param $id
     * @return $this
     */
    protected function setId($id)
    {
        $this->_id = $id;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }
    
    /**
     * @param $userId
     * @return $this
     */
    protected function setUserId($userId)
    {
        $this->_user_id = $userId;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->_user_id;
    }
    
    /**
     * @param $captureCreated
     * @return $this
     */
    protected function setCaptureCreated($captureCreated)
    {
        $this->_capture_created = $captureCreated;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCaptureCreated()
    {
        return $this->_capture_created;
    }
    
    /**
     * @param $captureUrl
     * @return $this
     */
    protected function setCaptureUrl($captureUrl)
    {
        $this->_capture_url = $captureUrl;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCaptureUrl()
    {
        return $this->_capture_url;
    }
    
    /**
     * @param $captureFilename
     * @return $this
     */
    protected function setCaptureFilename($captureFilename)
    {
        $this->_capture_filename = $captureFilename;

        return $this;
    }
    
    /**
     *
     */
    public function getCaptureFilename()
    {
        $this->_capture_filename;
    }
    
    /**
     * @param $captureDeleted
     * @return $this
     */
    protected function setCaptureDeleted($captureDeleted)
    {
        $this->_capture_deleted = $captureDeleted;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCaptureDeleted()
    {
        return $this->_capture_deleted;
    }
    
    /**
     * @param $captureCopy
     * @return $this
     */
    protected function setCaptureCopy($captureCopy)
    {
        $this->_capture_copy = $captureCopy;

        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCaptureCopy()
    {
        return $this->_capture_copy;
    }
}
?>