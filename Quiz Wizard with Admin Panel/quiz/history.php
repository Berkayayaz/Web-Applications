<?php
    session_start();
    
    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    
    check_login();
    
    include_once('../model/test_db.php');
    $quizes = get_quizes_by_userid($_SESSION['user_id']);
    $attempts = get_quizattemps_by_userid($_SESSION['user_id']);
    
    include('../view/header.php');
    include('../view/user_menu_bar.php');
?>

<div class="container">
    <div class="row">
        <?php include 'side_menu.php'; ?>
        
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">History</h1>
            
            <h3 class="sub-header">Previous Tests</h3>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz</th>
                            <th>Date</th>
                            <th>Score</th>
                            <th>Passed</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($quizes as $index => $quiz): ?>
                        <tr class="<?php echo $quiz['passed'] == 0 ? 'danger' : '' ?>">
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $quiz['categoryName']; ?></td>
                            <td><?php echo $quiz['date_time']; ?></td>
                            <td><?php echo $quiz['score']; ?></td>
                            <td><?php echo $quiz['passed'] ? 'PASSED' : 'FAILED'; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>

                    <tfoot></tfoot>    
                </table>
            </div>
            <br>
            
            <h3 class="sub-header">Statistics</h3>
            
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Quiz</th>
                            <th>Attempts</th>
                            <th>Min Score</th>
                            <th>Avg Score</th>
                            <th>Max Score</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($attempts as $index => $attempt): ?>
                        <tr class="<?php echo $attempt['avg_score'] < QUIZ_PASS_CRITERIA ? 'danger' : ''?>">
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $attempt['categoryName']; ?></td>
                            <td><?php echo $attempt['attempts']; ?></td> 
                            <td><?php echo $attempt['min_score']; ?></td>
                            <td><?php echo sprintf("%.1f", $attempt['avg_score']); ?></td>
                            <td><?php echo $attempt['max_score']; ?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>

                    <tfoot></tfoot>    
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>

