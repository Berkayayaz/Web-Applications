<?php
require('../model/database.php');
require('../model/query/db_test.php');

if (isset($_POST['delete_test_btn'])) {
    $test_id_for_delete = filter_input(INPUT_POST, 'test_id');
    delete_test($test_id_for_delete);
}

if (isset($_POST['search_submit'])) {
  	$fromDate = filter_input(INPUT_POST, 'fromDate');
	$toDate = filter_input(INPUT_POST, 'toDate');
	if (!isset($fromDate)){
		
		$time=mktime(0,0,0,1,1,1995,-1);
		$fromDate = date('m/d/Y h:i:s a', $time);
	}
	if (!isset($toDate)){
	date_default_timezone_set('Canada/Toronto');
	$toDate = date('m/d/Y h:i:s a', time());
	}
	$alltestswithUser = get_test_by_date($fromDate, $toDate);
}   
else{
$alltestswithUser = get_all_tests_with_users();
}
include('../view/header.php');
include('../view/admin_menu_bar.php');

?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'admin_side_menu.php'; ?>

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Test List</h1>    
                <div class="container">
                    <form action="test_admin.php" method="POST">
                        <div class="row">
                            <div class='col-xs-4 col-md-4 col-lg-3'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker6'>
                                        <input type='text' class="form-control" name="fromDate" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class='col-xs-4 col-md-4 col-lg-3'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker7'>
                                        <input type='text' class="form-control" name="toDate" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div> 

                            <div class='col-xs-4 col-md-4 col-lg-6'>
                                <div class="form-group">
                                    <div class='input-group button' id='button_div'>
                                        <input type='submit' name="search_submit" id="search_submit" class="btn btn-primary" value="Search"  style="left:20px; top:3px;"/><br>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </form> 
                </div>

                <div class="form-group pull-right">
                    <input type="text" class="search form-control" placeholder="Search..">
                </div>

                <span class="counter pull-right"></span>
                <table class="table table-hover table-bordered results">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz Name</th>              
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Score</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>

                        <tr class="warning no-result">
                            <td colspan="10"><i class="fa fa-warning"></i> No result</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=1; foreach ($alltestswithUser as $test) : ?>
                        <tr>
                            <td scope="row"><?php echo $i;?></td>
                            <td><?php echo $test['categoryName']; ?></td>
                            <td><?php echo ($test['firstName']); ?></td>
                            <td><?php echo $test['lastName']; ?></td>
                            <td><?php echo $test['score']; ?></td>
                            <td><?php  if($test['passed'] == 0){ echo 'Pass';}else{ echo 'Faild';} ?></td>
                            <td class="date_cells"><?php echo $test['date_time']; ?></td>
                            <td>
                                <form action="test_admin.php" method="post">
                                    <input type="hidden" name="action" value="edit_user">
                                    <input type="hidden" name="test_id" value="<?php echo $test['testID']; ?>">
                                    <input class="btn-danger" type="submit" name="delete_test_btn" value="Delete">
                                </form>
                            </td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/moment.min.js"></script>
    <script type="text/javascript" src="../js/transition.js"></script>
    <script type="text/javascript" src="../js/collapse.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
      $(function () {
          $('#datetimepicker6').datetimepicker({format: 'YYYY-MM-DD HH:mm:00'});
          $('#datetimepicker7').datetimepicker({
                  format: 'YYYY-MM-DD HH:mm:00',
              useCurrent: false 
          });
          $("#datetimepicker6").on("dp.change", function (e) {
              $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
          });
          $("#datetimepicker7").on("dp.change", function (e) {
              $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
          });
      });
    </script>
    <script type="text/javascript" src="../js/searchbar.js"></script>
    
<?php include '../view/footer.php'; ?>
