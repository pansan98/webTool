<?php
namespace src\App\AppHelper;

abstract class AppHelper {
    protected static $Helper;

    /**
     * @return mixed
     * get create instance
     */
    abstract public static function getInstance();

    /**
     * @return mixed
     * get query
     */
    abstract public function getQuery();

    /**
     * @param $key
     * @return mixed
     * get query parameter
     */
    abstract public function getQueryParam($key);

    /**
     * @return mixed
     * get GET all query
     */
    abstract public function getGetQuery();

    /**
     * @param $key
     * @return mixed
     * get GET query parameter
     */
    abstract public function getGetQueryParam($key);

    /**
     * @return mixed
     * get POST all query
     */
    abstract public function getPostQuery();

    /**
     * @param $key
     * @return mixed
     * get POST query parameter
     */
    abstract public function getPostQueryParam($key);
}
?>