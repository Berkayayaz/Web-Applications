 <?php 
require('../model/database.php');
require('../model/query/db_category.php');

$category_id = filter_input(INPUT_POST, 'category_id');


include('../view/header.php');
include('../view/admin_menu_bar.php');
 ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Add Question</h1>

            <div class="row">
         <form id="add_question_submit" action="edit_category_list.php" method="POST">
                 
                  
                   
                         
                        <input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                       
                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="question_body">Question Body</label><br>
                       
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea type="text" id="question_body" name="question_body" class="form-control"  required></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionA">Option A</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea  type="text" id="optionA" name="optionA" class="form-control"  required></textarea>
                      </div>
                    </div>

         
                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionB">Option B</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea  type="text" id="optionB" name="optionB" class="form-control" required></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionC">Option C</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea  type="text" id="optionC" name="optionC" class="form-control" required></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-2 text-right">
                        <label for="optionD">Option D</label>
                      </div>
                      <div class="col-md-4 form-group">
                          <textarea  type="text" id="optionD" name="optionD" class="form-control"  required></textarea>
                 
                   
                      </div>
                    </div>
                    
                           <div class="row">
                           
                      <div class="col-md-2 text-right">
                     
                        <label for="answer">Answer</label>
                      </div>
                         <div class="col-md-4 form-group">
                        <select id="answer" name="answer" class="form-control">
                          <option value="">Select Answer</option>
                          <option value="A" >A</option>
                          <option value="B">B</option>
                           <option value="C">C</option>
                          <option value="D" >D</option>
                        </select>
                      </div>
                    </div>
                

                    <div class="row">
                      <div class="col-md-4 col-md-offset-2 form-group">
                        <button type="submit" id="add_question_btn" name="add_question_btn" class="btn btn-primary">Add</button>
                        
                      </div>
                    </div>
                  </form>
                
                
    
    </div>
 

      
        </div>
      </div>
    </div>

<?php include '../view/footer.php'; ?>
