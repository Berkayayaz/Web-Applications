<?php
    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once("database.php");
    
    function set_user_status($user_id, $status) {
        global $db; 
        
        $query = "UPDATE ".USER_TABLENAME." SET status = :status"
                . " WHERE userId = :user_id";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':status', $status);
        $statement->execute();
        $statement->closeCursor();
    }
?>

