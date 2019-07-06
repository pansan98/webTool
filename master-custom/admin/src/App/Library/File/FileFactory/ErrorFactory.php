<?php

namespace App\Library\File\FileFactory;

class ErrorFactory {
    
    // there error property
    protected $_tempError;
    protected $_sizeError;
    protected $_typeError;
    protected $_extensionsError;
    protected $_alreadyError;
    
    /**
     * @param $template
     * @return $this
     */
    public function setTemplateError($template)
    {
        $this->_tempError = $template;
        
        return $this;
    }
    
    /**
     * @param $already
     * @return $this
     */
    public function setAlreadyError($already)
    {
        $this->_alreadyError = $already;
        
        return $this;
    }
    
    /**
     * @param $size
     * @return $this
     */
    public function setSizeError($size)
    {
        $this->_sizeError = $size;
        
        return $this;
    }
    
    /**
     * @param $type
     * @return $this
     */
    public function setTypeError($type)
    {
        $this->_typeError = $type;
        
        return $this;
    }
    
    /**
     * @param $extensions
     * @return $this
     */
    public function setExtensionsError($extensions)
    {
        $this->_extensionsError = $extensions;
        
        return $this;
    }
}

?>