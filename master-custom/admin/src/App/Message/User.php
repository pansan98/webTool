<?php
namespace src\App\Message;


use src\App\Message\MessageInterface\MessageInterface;
// TODO: Implement getFactory() method.

class User implements MessageInterface {
    protected static $userFactory;
    protected $_messageFactory = [];

    public static function getFactory()
    {
        if(!self::$userFactory instanceof User) {
            self::$userFactory = new static();
        }

        return self::$userFactory;
    }

    public function createMessageFactory()
    {
        $this->_messageFactory = [
            'require' => '入力をしてください。',
            'length' => '文字以内で入力してください。',
            'character' => '半角英数字で入力してください。',
            'numeric' => '半角数字で入力してください。'
        ];
    }

    public function getMessageFactory($message)
    {
        return $this->_messageFactory[$message];
    }

}
?>