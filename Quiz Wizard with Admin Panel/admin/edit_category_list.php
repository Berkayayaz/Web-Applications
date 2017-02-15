<?php
require('../model/database.php');
require('../model/query/db_category.php');
require('../utils/utils.php');

// BURAYA BIR DATABASEDEN GET_STATUS_OF_TEST YAPIP TOGGLE DEGISTIRECEGIZ TOGGLE ID status-toggle-event

if (isset($_POST['update_question_btn'])) {
    $question_id = filter_input(INPUT_POST, 'question_id');
    $questionBody = filter_input(INPUT_POST, 'question_body');
    $optionA = filter_input(INPUT_POST, 'optionA');
    $optionB = filter_input(INPUT_POST, 'optionB');
    $optionC = filter_input(INPUT_POST, 'optionC');
    $optionD = filter_input(INPUT_POST, 'optionD');
    $answer = filter_input(INPUT_POST, 'answer');
    update_question($question_id, $questionBody, $optionA, $optionB, $optionC, $optionD, $answer);
}

if (isset($_POST['status-toggle-event'])){
 	$buttonValue= filter_input(INPUT_POST, 'status-toggle-event');
 	if ($buttonValue == 'Disable'){
	$category_id= filter_input(INPUT_POST, 'category_id');
	update_category_status($category_id, 1);
}else {
	$category_id= filter_input(INPUT_POST, 'category_id');
	update_category_status($category_id, 0);
    
}}
if (isset($_POST['add_question_btn'])){
		$category_id= filter_input(INPUT_POST, 'category_id');
	$questionBody= filter_input(INPUT_POST, 'question_body');
	$optionA= filter_input(INPUT_POST, 'optionA');
	$optionB= filter_input(INPUT_POST, 'optionB');
	$optionC= filter_input(INPUT_POST, 'optionC');
	$optionD= filter_input(INPUT_POST, 'optionD');
	$answer= filter_input(INPUT_POST, 'answer');
	add_question($category_id, $questionBody, $optionA, $optionB, $optionC, $optionD, $answer);

}

if (isset($_POST['delete_question_btn'])) {
    $question_id = filter_input(INPUT_POST, 'question_id');
    delete_question($question_id);
}
$category_id = filter_input(INPUT_POST, 'category_id');
$statusofcategory= select_category_status_by_category_id($category_id);
$question_by_cateogry_id = get_all_questions_by_category_id($category_id);
$category_name = get_category_name($category_id);


$successful_attempts = 0;
$faild_attempts = 0;

$tests_by_category_id = get_tests_by_category_id($category_id);
$total_attempts = count($tests_by_category_id);
$max_score = 0;
$min_score = 11;
$avg = 0;
foreach ($tests_by_category_id as $test):
    $avg+=$test['score'];
    if ($test['passed'] == 0) {
        $successful_attempts++;
    } else {
        $faild_attempts++;
    }
    if ($test['score'] >= $max_score) {
        $max_score = $test['score'];
    }
    if ($test['score'] <= $min_score) {
        $min_score = $test['score'];
    }
endforeach;

if ($min_score == 11) {
    $min_score = 0;
}

$avg = ($total_attempts != 0) ? (round($avg / $total_attempts)) : 0;

include('../view/header.php');
include('../view/admin_menu_bar.php');
?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo $category_name;?></h1>
             <div class="container">
			<div id="all_user_stats" class="well" >
			<div class="row">
          
      <div class="clearfix"></div>
 <div class="col-xs-6 col-sm-6 col-lg-4">

          <ul>
           <li> Total Number of Questions: <?php echo count($question_by_cateogry_id);?></li>
           <li id="status_show"> Status:<span id="status_show_span"><?php if ($statusofcategory==0){echo 'Active'; }else {echo 'Deactive'; }?></span> </li>
           <li>Average Score:<?php echo $avg;?></li>
           <li>Highest Score:<?php echo $max_score;?></li>
           <li>Lowest Score:<?php if ($min_score==11){ echo 0;}else{echo $min_score;}?></li>
           <li> Total Attempts:<?php echo $total_attempts;?></li>
           <li>Successful Attempts:<?php echo $successful_attempts;?> </li>
           <li>Faild Attempts:<?php echo $faild_attempts;?></li>
           
          </ul>
        	</div>
      <div class="form-group  pull-left">
           <div class="col-xs-6 col-sm-6 col-lg-3">
<form action="edit_category_list.php" method="POST" id="toggle_submit" name="toggle_submit">         
<input type="hidden" id="category_id" name="category_id" value="<?php echo $category_id;?>">
<input id="status-toggle-event" name="status-toggle-event" class="btn btn-info" type="submit" data-toggle="toggle" value="<?php if ($statusofcategory == 1){ echo 'Enable';}else{ echo 'Disable';  }?>" >
</form>
</div>
	<div class="col-xs-6 col-sm-6 col-lg-8 "><br><br></div>
            <div class="col-xs-2 col-sm-3 col-lg-3">
            <form  action="category_admin.php" method="POST">
            <div class="form-group">
            <input type="hidden"  name="category_id" id="category_id" value="<?php echo $category_id; ?>" >
             <button type="submit" name="delete_cat_btn" id="delete_cat_btn" class="btn btn-danger">Delete</button>
             </div>
             </form>
            </div>
            </div>
        
            </div>
          </div>
          </div>

          <h2 class="sub-header"><?php echo $category_name.' ';?> Question List </h2>
        <div class="form-group">
        <div class="col-xs-6 col-sm-6 col-lg-8">
        <form action="add_question_admin.php" method="POST">
            <input type="hidden"  name="category_id"  id="category_id" value="<?php echo $category_id; ?>" >
        <button class="btn btn-primary" type="submit" name="add_question_btn" style="top:10px; left:50px;">Add Question</button>
        </form>
        </div>
            </div>
     
        <div class="form-group pull-right">
      
    <input type="text" class="search form-control" placeholder="Search..">
            </div>

          <span class="counter pull-right"></span>
            <table class="table table-hover table-bordered results">
              <thead>
                <tr>
                 <th>#</th>
                  <th>Question</th>
                  <th>Option A</th>
                  <th>Option B</th>
                   <th>Option C</th>
                    <th>Option D</th>
                     <th>Answer</th>
                     <th></th>
                     
                </tr>
              </thead>
              <tbody>
              
                <?php $i=1; foreach ($question_by_cateogry_id as $question) : ?>
            <tr>
            <td> <?php echo $i;?></td>
                
              
                 <td><?php echo make_printable($question['questionBody']); ?></td>
                <td><?php echo make_printable($question['optionA']); ?></td>
                 <td><?php echo make_printable($question['optionB']); ?></td>
                <td><?php echo make_printable($question['optionC']); ?></td>
                 <td><?php echo make_printable($question['optionD']); ?></td>
                <td><?php echo make_printable($question['answer']); ?></td>
                <td><form action="edit_question_admin.php" method="post">
                    <input type="hidden" name="action"
                           value="edit_user">
                    <input type="hidden" name="question_id" id="question_id"
                           value="<?php echo $question['questionID']; ?>">
                  
                    <input class="btn-warning" type="submit" name="edit_question" value="Edit">
                </form></td>
            </tr>
            <?php $i++; endforeach; ?>
               
              </tbody>
            </table>
          </div>
            </div>
        </div>
      
   
    <script src="../js/bootstrap-toggle.min.js"></script>
 
    <script>
        function clicked() {
            if (confirm('Are you sure to delete it?')) {
                $('#delete_user_btn').submit();
            } else {
                return false;
            }
         }
        $(function() {
            $('#status-toggle-event').change(function() {
              
                if($(this).prop('checked')){ var status = "Activated"; } else { var status= "Deactivated";}
              $('#status_show').html('Status: ' + status );
                })
          })
           
    $(document).ready(function() {
          $(".search").keyup(function () {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    	    
          $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
          });
    	    
          $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
          });

          $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
          });

          var jobCount = $('.results tbody tr[visible="true"]').length;
            $('.counter').text(jobCount + ' item');

          if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
                          });
        });
    </script>

<?php include '../view/footer.php'; ?>
