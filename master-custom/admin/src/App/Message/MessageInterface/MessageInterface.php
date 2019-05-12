<?php
namespace src\App\Message\MessageInterface;


interface MessageInterface {

    public static function getFactory();

    public function createMessageFactory();

}
?>