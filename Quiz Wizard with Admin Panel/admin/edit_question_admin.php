 <?php 
require('../model/database.php');
require('../model/query/db_category.php');

$selectedQuestionId = filter_input(INPUT_POST, 'question_id',FILTER_VALIDATE_INT);
$question = get_question_by_question_id($selectedQuestionId);

include('../view/header.php');
include('../view/admin_menu_bar.php');
 ?>
    <div class="container-fluid">
      <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Edit Question</h1>

    <div class="row">
      
                <form action="edit_category_list.php" method="POST">
                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="question_body">Question Body</label><br>
                       
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea  type="text" id="question_body" name="question_body" class="form-control" required><?php echo $question["questionBody"]; ?></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionA">Option A</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea type="text" id="optionA" name="optionA" class="form-control"required><?php echo $question["optionA"]; ?></textarea>
                      </div>
                    </div>

         
                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionB">Option B</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea type="text" id="optionB" name="optionB" class="form-control" required><?php echo $question["optionB"]; ?></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionC">Option C</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea type="text" id="optionC" name="optionC" class="form-control"required><?php echo $question["optionC"]; ?></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionD">Option D</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea type="text" id="optionD" name="optionD" class="form-control"  required><?php echo $question["optionD"]; ?></textarea>
                     <input type="hidden" name="category_id" value="<?php echo $question["categoryID"]; ?>">
                     <input type="hidden" name="question_id" value="<?php echo $question["questionID"]; ?>">
                      </div>
                    </div>
                           <div class="row">
                           
                      <div class="col-md-2 text-right">
                     
                        <label for="answer">Answer</label>
                      </div>
                         <div class="col-md-4 form-group">
                        <select id="answer" name="answer" class="form-control">
                          <option value="">Select Answer</option>
                          <option value="A" <?php if($question["answer"] == "A"){ echo 'selected';} ?>>A</option>
                          <option value="B" <?php if($question["answer"] == "B"){ echo 'selected';} ?>>B</option>
                           <option value="C" <?php if($question["answer"] == "C"){ echo 'selected';} ?>>C</option>
                          <option value="D" <?php if($question["answer"] == "D"){ echo 'selected';} ?>>D</option>
                        </select>
                      </div>
                 </div>
                      <div class="row">
                      <div class="col-md-2 col-md-offset-2 form-group">
                        <button type="submit" name="update_question_btn" class="btn btn-primary">Update</button>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" name="delete_question_btn" class="btn btn-danger">Delete</button>
                      </div>
                    </div>
                  </form>
    </div>
      
        </div>
      </div>
    </div>
    
<?php include '../view/footer.php'; ?>
