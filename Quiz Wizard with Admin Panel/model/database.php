<?php
    include_once('dbdefs.php');
    
    $dsn = 'mysql:host=localhost;dbname='.DBNAME;
    $username = 'mgs_user';
    $password = 'pa55word';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>