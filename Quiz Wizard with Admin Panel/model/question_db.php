<?php

    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once("database.php");
    
    function get_questions_by_category($category_id) {
        try {
            global $db;
            $query = "SELECT * FROM ".QUESTION_TABLENAME." WHERE categoryID = :categoryID";
            $statement = $db->prepare($query);
            $statement->bindValue('categoryID', $category_id);
            $statement->execute();
            $categories = $statement->fetchAll();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('database_error.php');
            exit();
        } finally {
            $statement->closeCursor();
        }
        return $categories;
    }
 
?>
