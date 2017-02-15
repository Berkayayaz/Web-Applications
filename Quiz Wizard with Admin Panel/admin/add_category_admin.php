 <?php 
require('../model/database.php');
require('../model/query/db_category.php');

include('../view/header.php');
include('../view/admin_menu_bar.php');
 ?>

<div class="container-fluid">
    <div class="row">
        <?php include 'admin_side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Add Quiz</h1>
            <div class="row">
                <form action="category_admin.php"  method="POST">
                    <div class="row">
                        <div class="col-md-2  text-right">
                            <label for="category-name">Quiz Name:</label><br>
                        </div>
                        <div class="col-md-4 col-lg-4 form-group">
                            <input type="text" id="category-name" name="category-name" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2 col-md-offset-2">
                            <button type="submit" name="submit_add_category" id="submit_add_category" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript">
    $(document).ready( function() {
        $("#submit_add_category").click( function() {
            JConfirm('Are You Sure ?', 'Confirmation Dialog', function(r) {
            JAlert('Click Result: ' + r, 'Visitor Response');
            });
        });
    });
</script>
     
<?php include '../view/footer.php'; ?>
