<?php

class Req {
    protected $_domain;
    protected $_formname;
    protected $_value = array();
    protected $_key = array();

    private $_db;

    public function __construct()
    {
        $this->_domain = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'].'/';
        if( !empty($this->_formname) ) {
            require_once dirname(__FILE__) . './dbassign.php';
            $this->_db = new Dbassign();
        }
    }

    public function setPost($post)
    {
        if( is_array($post) ) {
            foreach ($post as $key => $val) {
                $this->_key = $key;
                $this->_value = $val;
                if ( $key == 'form_name') {
                    $this->_formname = $val;
                }
            }
        }
    }

    protected function getPostKey()
    {
        return $this->_key;
    }

    protected function getPostVal()
    {
        return $this->_value;
    }

    protected function getFormName()
    {
        return $this->_formname;
    }

    protected function dbAssign()
    {
        $postKey = array();
        $postVal = array();
        $postKey[] = $this->getPostKey();
        $postVal[] = $this->getPostVal();
        if (!empty($postKey) && !empty($postVal)) {
            $tmpSqlKey = array();
            $tmpSqlVal = array();
            foreach ($postKey as $key => $val) {
                $tmpSqlKey[$key] = $val;
            }
            foreach ($postVal as $key => $val) {
                $tmpSqlVal[$key] = $val;
            }
            $data = array();
            $data['data'] = $this->_db->$this->_formname.QueryUser();
        }
        return $data;
    }
}
?>