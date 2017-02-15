<?php
    
    define('ADMIN_EMAIL', 'admin@admin');
    define('ADMIN_PASSWORD', 'admin');
    
    define('QUIZ_SET_SIZE', 10);
    define('QUIZ_POOL_SIZE', 2 * QUIZ_SET_SIZE);
    define('QUIZ_PASS_CRITERIA', 8);
    
    define('IMAGE_DIR', '../images');
    define('CATEGORY_IMAGES_DIR', IMAGE_DIR.DIRECTORY_SEPARATOR.'categories');
    define('CATEGORY_DEFAULT_IMAGE', 
        CATEGORY_IMAGES_DIR.DIRECTORY_SEPARATOR.'category_default.jpg');
    
    /*
     * User Table Status Definitions:
     */
    define('USER_STAT_OFFLINE', 0);   // User is off-line
    define('USER_STAT_ONLINE', 1);   // User is currently online but not writing any quiz(test)
    define('USER_STAT_TESTING', 2);  // User is currently writing a quiz(test)
    
    /*
     * Category Table Status
     */
    define('CATEGORY_STAT_ENABLED', 0); 
    define('CATEGORY_STAT_DISABLED', 1); 
    
    class SessionVariable {
        private $name; // Session variable name
        
        public function __construct($name) {
            $this->name = $name;
        }
        public function get_value() {
            if (isset($_SESSION[$this->name])) {
                return $_SESSION[$this->name];
            } else {
                return NULL;
            }
        }
        public function set_value($value) {
            $_SESSION[$this->name] = $value;
        }
        public function clear() {
            unset($_SESSION[$this->name]);
        }
        public function has_value() {
            return isset($_SESSION[$this->name]);
        }
    }
    /*
     * Session Variables
     */
    
    if (!isset($CATEGORY)) {
        $CATEGORY = new SessionVariable('category');
    }
 ?>