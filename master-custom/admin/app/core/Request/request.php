<?php

class Request {

    protected $form_name;
    protected $name;
    protected $price;
    protected $_value = array();
    protected $_key = array();
    private $request = array();
    private $response = array();
    private $_domain = '';


    //ユーザー系
    protected $_user = array();
    protected $_userId;
    protected $_userValue;
    protected $_userMatchId;

    //暗号化型
    private $_password;
    private $_iv;
    private $_aliases;

    //ポストデータ
    protected $_post = array();

    public function __construct()
    {
        $this->_domain = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://').$_SERVER['HTTP_HOST'];
    }

    public function getPost($posts, $update = null)
    {
        if ( is_array($posts) ) {
            foreach ($posts as $post) {
                if($this->sqlInjection($post) !== false) {
                    if($posts['submit'] != $post) {
                        $this->request[] = htmlspecialchars(strip_tags($this->trimSpace($post)));
                    }
                } else {
                    return false;
                }
            }
            //新規か更新の振り分け
            if(!is_null($update) && $update == 'update') {
                return $this->setPostUpdate($this->request);
            } elseif(!is_null($update) && $update == 'user') {
                return $this->setPostUser($this->request);
            } else {
                return $this->setPost($this->request);
            }
        } else {
            if( $this->sqlInjection($posts) !== false) {
                return $this->setPost($posts);
            } else {
                return false;
            }
        }
    }

    public function setPostData($post)
    {
        if(is_array($post)) {
            foreach ($post as $key => $val) {
                $this->_key = $key;
                $this->_value = $val;
                //フォームネームをセットしておく
                if($key == 'form_name') {
                    $this->_formname = $val;
                }
            }
        }
    }

    public function getPostKey()
    {
        return $this->_key;
    }

    public function getPostVal()
    {
        return $this->_value;
    }

    public function getFormName()
    {
        return $this->form_name;
    }


    public function getPostLogin($post)
    {
        if(!empty($post) && is_array($post)) {
            foreach ($post as $val) {
                if($this->sqlInjection($val) !== false) {
                    $this->request[] = htmlspecialchars(strip_tags($this->trimSpace($val)));
                } else {
                    return false;
                }
            }
            return $this->setPostLogin($this->request);
        }
    }

    public function setPost($req)
    {
        if  (is_array($req) ) {
            $row = array();
            foreach ($req as $val) {
                $row[] = $val;
            }
            $this->response[] = array(
                'user_id' => $row[0],
                'name' => $row[1],
                'price' => $row[2],
                'is_recommend' => $row[3],
                'description' => $row[4],
                'is_secret' => $row[5]
            );
            return $this->response;
        } else {
            return $req;
        }
    }

    public function setPostUpdate($req)
    {
        if  (is_array($req) ) {
            $row = array();
            foreach ($req as $val) {
                $row[] = $val;
            }
            $this->response[] = array(
                'form_name' => @$row[0],
                'id' => @$row[1],
                'name' => @$row[2],
                'price' => @$row[3],
                'file' => @$row[4]
            );
            return $this->response;
        } else {
            return $req;
        }
    }

    protected function setPostUser($req)
    {
        if (is_array($req)) {
            $row = array();
            foreach ($req as $key => $val) {
                $row[] = $val;
            }
            $this->response = array(
                'form_name' => $row[0],
                'name' => $row[1],
                'password' => $row[2],
                'nickname' => $row[3],
                'comment' => $row[4]
            );
            return $this->response;
        } else {
            return $req;
        }
    }

    private function setPostLogin($req)
    {
        if(is_array($req)) {
            $row = array();
            foreach ($req as $val) {
                $row[] = $val;
            }
            $this->response = array(
                'form_name' => $row[0],
                'login' => $row[1],
                'pass' => $row[2]
            );
            return $this->response;
        } else {
            return false;
        }
    }


    public function getGet($param)
    {
        if ( is_numeric($param)) {
           return $this->setGet($param);
        } else {
            return false;
        }
    }


    public function setGet($param)
    {
        return $param;
    }

    public function setGetRecommend($userId)
    {
        if (is_array($userId)) {
            foreach ($userId as $key => $val) {
                $this->_user[$key] = htmlspecialchars(strip_tags($this->trimSpace($val)));
            }
            $this->_userId = $this->_user['recommend_user_id'];
            $this->_userValue = $this->_user['is_value'];
            $this->_userMatchId = $this->_user['whenIdMatched'];
        }
    }


    public function getGetRecommend()
    {
        return array(
            'user_id' => $this->_userId,
            'is_value' => $this->_userValue,
            'whenIdMatched' => $this->_userMatchId
        );
    }


    public function setFile($file, $userId)
    {
        if(!file_exists(LOCATION_FRONT.'/upload/'.$userId)) {
            //ユーザーIDでディレクトリを作成
            @mkdir(LOCATION_FRONT.'/upload/'.$userId);
        }
        if ($file['file']['name'] != '') {
            $fileTmpData = $file['file']['tmp_name'];
            $fileDataName = $file['file']['name'];
            //ユーザーIDでディレクトリ指定
            $img = dirname(__FILE__).'/../../../../../upload/'.$userId.'/'.basename($fileDataName);
            if( move_uploaded_file($fileTmpData, $img) !== false ) {
                $fileDataSerialize = $this->encData();
                $mergedData = LOCATION_FRONT.'/upload/'.$userId.'/'.$fileDataSerialize;
                //暗号化前の画像データをチェック
                return $this->getFile($fileDataName,$img, $mergedData, $fileDataSerialize);
            } else {
                $msg = 'ファイルのアップロードに失敗しました。';
                return $msg;
            }
        }
    }


    public function getFile($filename,$img, $randomStringPath, $fileData)
    {
        if( isset($filename) && isset($img) ) {
            $type = substr($filename,-3);
            switch($type) {
                case 'jpg':
                    return $this->fileCheck($filename, $img, $type, $randomStringPath, $fileData);
                    break;
                case 'png':
                    return $this->fileCheck($filename, $img, $type, $randomStringPath, $fileData);
                    break;
                case 'gif':
                    return $this->fileCheck($filename, $img, $type, $randomStringPath, $fileData);
                    break;
                default:
                    return false;
                    break;
            }
        } else {
            $msg = '画像がアップロードされていません。';
            return $msg;
        }
    }

    private function fileCheck($filename, $img, $type, $randomStringPath, $fileData)
    {
        if (preg_match("/^[a-zA-Z0-9ぁ-ん_-]+$/", $this->trimSpace($filename))  !== false) {
            chmod($img, 0666);
            rename($img, $randomStringPath.'.'.$type);
            return array(
                'filename' => serialize($fileData.'.'.$type),
                'path' => $img,
                'type' => $type
            );
        } else {
            return false;
        }
    }


    private function trimSpace($str)
    {
        $trimstr = preg_replace("/(| )/","", $str);
        return trim($trimstr);
    }

    private function sqlInjection($str)
    {
        if( strpos($str, '\'') !== false) {
            return $str;
        } elseif(strpos($str, ' ') !== false) {
            return $str;
        } elseif(strpos($str, 'or') !== false) {
            return $str;
        } else {
            return $str;
        }
    }


    private function encData()
    {
        if ( ($this->_password == '') && ($this->_iv == '') ) {
            $this->_password = 'abcdefghijklmopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $this->_iv = '1234567890123456';
        }

        //パラメータの設定
        $password = $this->_password;
        $method = 'aes-128-cbc';
        $options = OPENSSL_RAW_DATA;
        $iv = $this->_iv;
        $randomString = $this->_password.$this->_iv;

        $randomStringLeng = mb_strlen($randomString);
        $createRandomString = 20;
        for ($i = 1; $i<=$createRandomString; $i++) {
            $index = mt_rand(0, $randomStringLeng - 1);
            $result .= mb_substr($randomString, $index, 1);
        }

        return $result;

//        $this->_aliases = openssl_get_cipher_methods(true);

        //暗号化実装
//        $encryptedData = openssl_encrypt($dataName, $method, $password, $options, $iv);
//        return $encryptedData;
    }


    public function setPostInsertData($post)
    {
        if (!empty($post)) {
            foreach ($post as $key => $val) {
                $this->_post[$key] = $val;
            }
        }
    }

    public function getPostInsertData()
    {
        return $this->_post;
    }

    //リダイレクトするURL保持
    public function setHoldRequestUrl()
    {
        $url = $this->getCurrentRequestUrl();
        if (!empty($url) ) {
            $baseUrl = basename($url);
            $replaceUrl = str_replace($baseUrl, '', $url);
            if (!empty($_SESSION['url'])) {
                $_SESSION['url'] = '';
            }
            $_SESSION['url'] = $this->_domain.$replaceUrl;
        }
    }

    public function getHoldRequestUrl()
    {
        return $_SESSION['url'];
    }

    protected function getCurrentRequestUrl()
    {
        return $_SERVER['SCRIPT_NAME'];
    }

}
?>