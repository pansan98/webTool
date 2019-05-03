<?php
namespace src\Mod\Model\User;

use src\Mod\Model\Base\BaseModel;
use src\Mod\Model\User\Model;
use src\App\AppHelper\Model\ModelHelper;

class UserModel extends BaseModel{
    protected $_modelHelper;
    protected $_userModel;

    protected $_db_table = 'applications_user';

    public function __construct()
    {
        $this->_modelHelper = ModelHelper::getInstance(SQL__STATEMENT_SELECT, $this->_db_table);
        $this->_userModel = new Model();
    }
}
?>