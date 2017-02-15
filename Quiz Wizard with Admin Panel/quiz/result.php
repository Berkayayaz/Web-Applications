<?php
    session_start();
    
    include_once('../utils/utils.php');
    include_once('../common/globals.php');

    check_login();

    $category = $CATEGORY->get_value();
    $score = $_SESSION['score'];
    $passed = $score >= QUIZ_PASS_CRITERIA;

    include_once '../model/test_db.php';
    write_quiz_score($_SESSION['user_id'], $category['categoryID'], $score, $passed);

    // Mark user as not writing a test:
    set_user_status($_SESSION['user_id'], USER_STAT_ONLINE);
            
    /*
     * Cleanup session variables:
     */

    //unset($_SESSION['category']);
    $CATEGORY->clear();

    include('../view/header.php');
    include('../view/user_menu_bar.php');
?>

<div class="container" style="text-align: center;">
    <div class="panel panel-primary" style="width: 50%; margin: 10% auto auto auto;">
        <div class="panel-heading">RESULT</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 well well-lg" style="font-size: 125%;">
                    <p>Your score is <?php echo '<b>'.$score.'</b>'.' out of '.
                        '<b>'.QUIZ_SET_SIZE.'</b>' ?></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 col-md-offset-1 well well-lg" 
                     style="color: <?php echo $passed ? 'green' : 'red'?>; font-size: 150%; font-weight: bold;">
                    <p><?php echo $passed ? 
                            "You have successfully passed the test."
                            . "You are now certified in {$category['categoryName']}."
                            . " Where {$category['categoryName']} is the certification"
                            . " topic you have chosen for this assignment.!" : 
                            "Unfortunately you did not pass the test. Please try again later!"; 
                    ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>


