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

    protected function getModel()
    {
        return $this;
    }


    protected function setId($id)
    {
        $this->_id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    protected function setUserId($userId)
    {
        $this->_user_id = $userId;

        return $this;
    }

    public function getUserId()
    {
        return $this->_user_id;
    }

    protected function setCaptureCreated($captureCreated)
    {
        $this->_capture_created = $captureCreated;

        return $this;
    }

    public function getCaptureCreated()
    {
        return $this->_capture_created;
    }

    protected function setCaptureUrl($captureUrl)
    {
        $this->_capture_url = $captureUrl;

        return $this;
    }

    public function getCaptureUrl()
    {
        return $this->_capture_url;
    }

    protected function setCaptureFilename($captureFilename)
    {
        $this->_capture_filename = $captureFilename;

        return $this;
    }

    public function getCaptureFilename()
    {
        $this->_capture_filename;
    }

    protected function setCaptureDeleted($captureDeleted)
    {
        $this->_capture_deleted = $captureDeleted;

        return $this;
    }

    public function getCaptureDeleted()
    {
        return $this->_capture_deleted;
    }


    protected function setCaptureCopy($captureCopy)
    {
        $this->_capture_copy = $captureCopy;

        return $this;
    }

    public function getCaptureCopy()
    {
        return $this->_capture_copy;
    }
}
?>