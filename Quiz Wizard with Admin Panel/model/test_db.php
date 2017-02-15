<?php

    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    require_once("database.php");

    function write_quiz_score($user_id, $category_id, $score, $passed) {
        global $db;
        
        $query = "INSERT INTO " . TEST_TABLENAME .
            " (userID, categoryID, date_time, score, passed) " .
            "VALUES(:userID, :categoryID, :date_time, :score, :passed)";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':userID', $user_id);
        $statement->bindValue(':categoryID', $category_id);
        $statement->bindValue(':date_time', date('Y-m-d H:i:s'));
        $statement->bindValue(':score', $score);
        $statement->bindValue(':passed', $passed);
        $statement->execute();
        $statement->closeCursor();
    }
    
    function get_quizes_by_userid($user_id) {
        global $db;
        
        $query = "SELECT c.categoryName as categoryName, "
                . "t.date_time as date_time, "
                . "t.score as score, "
                . "t.passed as passed"
                . " FROM ".TEST_TABLENAME." as t INNER JOIN ".CATEGORY_TABLENAME.
                " as c ON t.categoryID = c.categoryID"
                . " WHERE t.userID = :user_id";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $quizes = $statement->fetchAll();
        $statement->closeCursor();
        return $quizes;
    }
    
    function get_quizattemps_by_userid($user_id) {
        global $db;
        
        $query = "SELECT c.categoryName as categoryName,"
                . " t.cnt as attempts, t.avg_score as avg_score,"
                . " t.min_score as min_score, t.max_score as max_score"
                . " FROM ".CATEGORY_TABLENAME." as c"
                . " INNER JOIN"
                . " (SELECT categoryID,"
                . " count(*) as cnt, avg(score) as avg_score,"
                . " min(score) as min_score,"
                . " max(score) as max_score FROM ".TEST_TABLENAME
                . " WHERE userID = :user_id"
                . " GROUP BY categoryID) as t"
                . " ON t.categoryID = c.categoryID";
        
        //echo $query;
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $quizes = $statement->fetchAll();
        $statement->closeCursor();
        return $quizes;
    }

?>
