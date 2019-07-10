
<?php

class Application {
    public function __construct() {
        $this->_set_reporting();
        $this->_unregister_globals();
    }


    private function _set_reporting(){
        if(DEBUG) {
            error_reporting(E_ALL);                      //quick and easy way to display all the errors                           
            ini_set('display_errors', 1);                   
            
        } else {
            error_reporting(0);
            ini_set('display_errors', 0);
            ini_set('log_errors',1);
            ini_set('error_log', ROOT . DS . 'tmp' . DS .'logs' . DS . 'errors.log');
        }
    }

    /**
     * for security 
     * global variable can be accessed by using get or post method 
     * user can use our config info
     * 
     */
    private function _unregister_globals() {
        if(ini_get('register_globals')) {
            $globalsAry =['_SESSION', '_COOKIE', '_POST', '_GET', '_REQUEST', '_SERVER', '_ENV', '_FILES'];
            foreach( $globalsAry as $g) {
                foreach($GLOBALS[$g] as $k => $v) {                   // GLOBAL[$g] has a key, value pair
                    if($GLOBALS[$k] === $v) {
                        unset($GLOBALS[$k]);
                    }
                }
            }
        }
    }
}