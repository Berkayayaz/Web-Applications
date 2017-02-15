<?php

    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once("database.php");

    function get_categories() {
        try {
            global $db;
            $query = "SELECT * FROM " . CATEGORY_TABLENAME;
            $statement = $db->prepare($query);
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

    function get_category_by_id($category_id) {
        global $db;

        $query = "SELECT * FROM " . CATEGORY_TABLENAME ." WHERE categoryID = :categoryID";
        $statement = $db->prepare($query);
        $statement->bindValue('categoryID', $category_id);
        $statement->execute();
        $category = $statement->fetch();
        $statement->closeCursor();
        return $category;
    }
?>

