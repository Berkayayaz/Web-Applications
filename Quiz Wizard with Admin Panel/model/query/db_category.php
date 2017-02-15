<?php
function get_all_categories() {
    global $db;
    $query = 'SELECT * FROM CATEGORY             
              ORDER BY categoryName';
    $statement = $db->prepare($query);
    
    $statement->execute();
    $allcategory = $statement->fetchAll();
    $statement->closeCursor();
   
    return $allcategory;
}
// function get_all_categories($search_query) {
// 	global $db;
// 	$query  "SELECT  *  FROM category WHERE categoryName LIKE '%" . $search_query .  "%' ";
// 	$statement = $db->prepare($query);

// 	$statement->execute();
// 	$allcategory = $statement->fetchAll();
// 	$statement->closeCursor();
	 
// 	return $allcategory;
// }

function get_question_by_question_id($question_id) {
	global $db;
	$query = 'SELECT * FROM question
              WHERE questionID = :question_id';
	$statement = $db->prepare($query);
	$statement->bindValue(":question_id", $question_id);
	$statement->execute();
	$question = $statement->fetch();
	$statement->closeCursor();
	return $question;
}

function get_all_questions() {
	global $db;
	$query = 'SELECT * FROM question
              ORDER BY categoryID, questionID DSC' ;
	$statement = $db->prepare($query);

	$statement->execute();
	$questions = $statement->fetchAll();
	$statement->closeCursor();
	 
	return $questions;
}

function get_tests_by_category_id($category_id) {
	global $db;
	$query = 'SELECT * FROM test WHERE categoryID = :category_id' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$tests = $statement->fetchAll();
	$statement->closeCursor();

	return $tests;
}



function get_number_of_tests_by_category_id($category_id) {
	global $db;
	$query = 'SELECT count(*) FROM test WHERE categoryID = :category_id' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$count_of_tests = $statement->fetch();
	$statement->closeCursor();

	return $count_of_tests;
}

function get_number_of_succesful_attempts_by_category_id($category_id) {
	global $db;
	$query = 'SELECT count(*) FROM test WHERE categoryID = :category_id AND status = :status' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->bindValue(":status", 0);
	$statement->execute();
	$count_of_tests = $statement->fetch();
	$statement->closeCursor();

	return $count_of_tests;
}

function get_number_of_faild_attempts_by_category_id($category_id) {
	global $db;
	$query = 'SELECT count(*) FROM test WHERE categoryID = :category_id AND status = :status' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->bindValue(":status", 1);
	$statement->execute();
	$count_of_tests = $statement->fetch();
	$statement->closeCursor();

	return $count_of_tests;
}

function get_highest_score_by_category_id($category_id) {
	global $db;
	$query = 'SELECT MAX(score) FROM test WHERE categoryID = :category_id' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$max_score = $statement->fetch();
	$statement->closeCursor();

	return $max_score;
}
function get_lowest_score_by_category_id($category_id) {
	global $db;
	$query = 'SELECT MIN(score) FROM test WHERE categoryID = :category_id' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$min_score = $statement->fetch();
	$statement->closeCursor();

	return $min_score;
}
function get_average_score_by_category_id($category_id){
	global $db;
	$query = 'SELECT AVG(score) FROM test WHERE categoryID = :category_id' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$min_score = $statement->fetch();
	$statement->closeCursor();
	
	return $min_score;
}

function get_all_questions_by_category_id($category_id) {
	global $db;
	$query = 'SELECT * FROM question WHERE categoryID = :category_id
              ORDER BY questionID' ;
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$questions = $statement->fetchAll();
	$statement->closeCursor();

	return $questions;
}
function get_number_of_questions_by_categoryId($category_id) {
	global $db;
	$query = 'SELECT question.*, category.categoryName FROM question INNER join `category`
              ON `category`.categoryID = `question`.categoryID WHERE categoryID = :category_id';
	$statement = $db->prepare($query);
	$statement->bindValue(":category_id", $category_id);
	$statement->execute();
	$questionsByGivenCategory = $statement->fetch();
	$statement->closeCursor();
	return $questionsByGivenCategory;
}



function delete_category($category_id) {
    global $db;
    $query = "DELETE FROM category
              WHERE categoryID = {$category_id}";
    $statement = $db->prepare($query);
  //  $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_category($categoryName) {
    global $db;
    $query = 'INSERT INTO category
                 (categoryName)
              VALUES
                 (:categoryName)';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryName', $categoryName);
  
    $statement->execute();
    $statement->closeCursor();
}
function get_category_name($category_id) {
	global $db;
	$query = 'SELECT * FROM category
              WHERE categoryID = :category_id';
	$statement = $db->prepare($query);
	$statement->bindValue(':category_id', $category_id);
	$statement->execute();
	$category = $statement->fetch();
	$statement->closeCursor();
	$category_name = $category['categoryName'];
	return $category_name;
}

function update_question($question_id, $questionBody,$optionA, $optionB, $optionC, $optionD, $answer){
	global $db;

	$update_user = 'UPDATE `question` SET questionBody = :questionBody, optionA = :optionA, optionB = :optionB, optionC = :optionC, optionD = :optionD, answer = :answer WHERE questionID = :question_id';
	$statement2 = $db->prepare($update_user);
	$statement2->bindValue(':questionBody', $questionBody);
	$statement2->bindValue(':optionA', $optionA);
	$statement2->bindValue(':optionB', $optionB);
	$statement2->bindValue(':optionC', $optionC);
	$statement2->bindValue(':optionD', $optionD);
	$statement2->bindValue(':answer', $answer);
	$statement2->bindValue(':question_id', $question_id);
	$statement2->execute();

}
function add_question($category_id,$questionBody,$optionA,$optionB,$optionC,$optionD,$answer) {
	global $db;
	$query = "INSERT INTO question
                 (categoryID,questionBody,optionA,optionB,optionC,optionD,answer)
              VALUES  ({$category_id}, {$questionBody}, {$optionA}, {$optionB}, {$optionC}, {$optionD}, {$answer})";
	$querynew = "INSERT INTO question
	(categoryID,questionBody,optionA,optionB,optionC,optionD,answer)
	VALUES
	(:category_id, :questionBody, :optionA, :optionB, :optionC, :optionD, :answer)";
	$statement = $db->prepare($querynew);
	$statement->bindValue(':category_id', $category_id);
	$statement->bindValue(':questionBody', $questionBody);
	$statement->bindValue(':optionA', $optionA);
	$statement->bindValue(':optionB', $optionB);
	$statement->bindValue(':optionC', $optionC);
	$statement->bindValue(':optionD', $optionD);
	$statement->bindValue(':answer', $answer);
	$statement->execute();
	$statement->closeCursor();
}

function delete_question($question_id) {
	global $db;
	$query = "DELETE FROM question
	WHERE questionID = {$question_id}";
	$statement = $db->prepare($query);
	$statement->execute();
	$statement->closeCursor();
}
function select_category_status_by_category_id($category_id){
	global $db;

	$select_status = "Select * FROM `category` WHERE categoryID = :category_id";
	$statement = $db->prepare($select_status);
	$statement->bindValue(':category_id', $category_id);
	$statement->execute();
	$status = $statement->fetch();
	$statement->closeCursor();
return $status['status'];
}
function update_category_status($category_id, $status){
	global $db;
	$sql = "UPDATE `category` SET status= :status WHERE categoryID= :category_id";
	$update_user = "UPDATE `category` SET (status = :status) WHERE categoryID = :category_id";
	$statement2 = $db->prepare($sql);
	$statement2->bindValue(':status', $status);
	$statement2->bindValue(':category_id', $category_id);
	$statement2->execute();

}
?>