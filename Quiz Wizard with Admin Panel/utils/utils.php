<?php
    require_once('../model/user_db.php');
    
    define('SCRIPT_START', '<script>');
    define('SCRIPT_END', '</script>');

    /**
     * Starts a JavaScript block
     */
    function start_script() {
        echo SCRIPT_START;
    }

    /**
     * Ends a JavaScript block
     */
    function end_script() {
        echo SCRIPT_END;
    }

    /**
     * Shows non-blocking error message 
     * @param string $message
     * @param string $title
     * @warning <em>toastr</em> JS library must be included!<br>
     *     - //cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js
     *     - //cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css
     */
    function show_error($message, $title = 'Error') {
        start_script();
        echo "toastr.options.preventDuplicates = true; ";
        /* echo "toastr.options.closeButton = true; ";
          echo "toastr.options.timeOut = 3; ";
          echo "toastr.options.extendedTimeOut = 5; "; */
        echo "toastr.error('$message', '$title');";
        end_script();
    }

    function show_warning($message, $title = 'Warning') {
        start_script();
        echo "toastr.options.preventDuplicates = true;";
        echo "toastr.warning('$message', '$title');";
        end_script();
    }

    function show_success($message, $title = 'Success') {
        start_script();
        echo "toastr.options.preventDuplicates = true;";
        echo "toastr.success('$message', '$title');";
        end_script();
    }

    function show_info($message) {
        start_script();
        echo "toastr.options.preventDuplicates = true;";
        echo "toastr.info('$message');";
        end_script();
    }

    function did_logged() {
        return isset($_SESSION['email']);
    }
    
    function check_login() {
        if (!did_logged()) {
            header('Location: ../login');
        }
    }

    function is_admin() {
        if (isset($_SESSION['is_admin'])) {
            return $_SESSION['is_admin'];
        } else {
            return FALSE;
        }
    }
    
    function logout() {
        if (did_logged()) {
            // Mark user as off-line:
            set_user_status($_SESSION['user_id'], USER_STAT_OFFLINE);
        
            session_destroy();
            header('Location: ../login');
        }
    }
    
    function make_printable($text) {
        return htmlspecialchars($text, ENT_IGNORE);
    }
?>