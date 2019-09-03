<?php
namespace src\App\Message;


use src\App\Message\MessageInterface\MessageInterface;
// TODO: Implement getFactory() method.

class Capture implements MessageInterface {
    protected static $captureFactory;
    protected $_messageFactory = [];

    public static function getFactory()
    {
        if(!self::$captureFactory instanceof Capture) {
            self::$captureFactory = new static();
        }

        return self::$captureFactory;
    }

    public function createMessageFactory()
    {
        $this->_messageFactory = [
            'require' => '入力をしてください。',
            'length' => '文字以内で入力してください。',
            'url' => 'URLは正しい形式で入力してください。',
            'capture_url' => 'URLは正しい形式で入力してください。'
        ];
    }

    public function getMessageFactory($message)
    {
        return $this->_messageFactory[$message];
    }

}
?>