<?php
function get_all_tests() {
    global $db;
    $query = 'SELECT * FROM test             
              ORDER BY date_time';
    $statement = $db->prepare($query);
    
    $statement->execute();
    $allTests = $statement->fetchAll();
    $statement->closeCursor();
   
    return $allTests;
}
function get_all_tests_with_users() {
	global $db;
	$query = 'SELECT *, `user`.firstName, `user`.lastName, `category`.categoryName
FROM `test`
   JOIN user ON test.userID = user.userId
			 JOIN category ON test.categoryID = category.categoryID
 ORDER BY date_time DESC';
	$statement = $db->prepare($query);

	$statement->execute();
	$allTests = $statement->fetchAll();
	$statement->closeCursor();
	 
	return $allTests;
}

function get_test_by_date($date1,$date2) {
    global $db;
    $date1 = new DateTime($date1);
    $date1 = $date1->format("Y-m-d H:i:s");
    $date2 = new DateTime($date2);
    $date2 = $date2->format("Y-m-d H:i:s");
    $query = "SELECT *, `user`.firstName, `user`.lastName, `category`.categoryName
FROM `test`
   JOIN user ON test.userID = user.userId
			 JOIN category ON test.categoryID = category.categoryID
              WHERE  date_time  >= '{$date1}' AND date_time<= '{$date2}' ORDER BY date_time DESC";
    $statement = $db->prepare($query);
    $statement->execute();
    $tests = $statement->fetchAll();
    $statement->closeCursor();
    return $tests;
}
function get_test_by_testId($test_id) {
	global $db;
	$query = 'SELECT * FROM TEST
              WHERE testID = :test_id';
	$statement = $db->prepare($query);
	$statement->bindValue(":test_id", $test_id);
	$statement->execute();
	$test = $statement->fetch();
	$statement->closeCursor();
	return $test;
}

function delete_test($test_id) {
    global $db;
    $query = 'DELETE FROM test
              WHERE testID = :test_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':test_id', $test_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_test($userID,$categoryID, $score, $passed, $date_time) {
    global $db;
    $query = 'INSERT INTO test
                 (userID,categoryID,score,passed,date_time)
              VALUES
                 (:userID, :classID, :score, :passed, :date_time)';
    $statement = $db->prepare($query);
    $statement->bindValue(':userID', $userID);
    $statement->bindValue(':classID', $categoryID);
    $statement->bindValue(':date_time', $date_time);
    $statement->bindValue(':score', $score);
    $statement->bindValue(':passed', $passed);
    $statement->execute();
    $statement->closeCursor();
}


function oku(){
	$query = mysql_query("SELECT * FROM TEST WHERE testID = :test_id") ;
	$oku = mysql_fetch_array($query);
	
	return $oku;
}
?>