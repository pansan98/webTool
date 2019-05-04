<?php

class MypageUpdate extends Request {

    //送信ネーム
    protected $_sendName;

    //マイページ系
    protected $_id;
    protected $_is_value;
    protected $_name;
    protected $_status;

    //ユーザーフォロー系
    protected $_userId;
    protected $_requestUserId;

    public function setPostData($postData)
    {
        if (is_array($postData)) {
            $this->_sendName = $postData['nameWhenSend'];
            if ($this->_sendName == "checkbox") {
                $this->_id = $postData['id'];
                $this->_is_value = $postData['is_value'];
                $this->_name = $postData['name'];
            } elseif ($this->_sendName == "actionWhenFollowed") {
                $this->_userId = $postData['userId'];
                $this->_requestUserId = $postData['requestUserId'];
                $this->_status = $postData['followStatus'];
            }
        }
    }

    public function getPostData()
    {
        if ($this->_sendName == "checkbox") {
            return array(
                'id' => $this->_id,
                'is_value' => $this->_is_value,
                'name' => $this->_name,
                'sendName' => $this->_sendName
            );
        } elseif ($this->_sendName == "actionWhenFollowed") {
            return array(
                'userId' => $this->_userId,
                'requestUserId' => $this->_requestUserId,
                'sendName' => $this->_sendName,
                'status' => $this->_status
            );
        }
    }
}