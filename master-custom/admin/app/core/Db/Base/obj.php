<?php
require_once dirname(__FILE__) . '/../Controller/db.php';
require_once dirname(__FILE__) . '/../Controller/dbassign.php';
require_once dirname(__FILE__) . '/../../Request/request.php';
date_default_timezone_set('Asia/Tokyo');
?>


<?php
class ClassLoader {
    private $_dirs = array();

    public function register()
    {
        spl_autoload_register( array($this, 'loadClass'));
    }

    public function registerDir($dir)
    {
        $this->_dirs[] = $dir;
    }

    public function loadClass($class)
    {
        foreach ($this->_dirs as $key => $val) {
            $file = $val.'/'.$class.'Controller.php';
            if (is_readable($file)) {
                require_once $file;
            }
        }
        return;
    }
}
?>
