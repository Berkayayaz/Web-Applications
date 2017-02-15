<?php
    session_start();
    
    include_once('../utils/utils.php');
    include_once('../common/globals.php');
    
    check_login();

    include_once('../model/question_db.php');
    include_once('../model/category_db.php');
    include_once('../model/user_db.php');

    function generate_quiz_set($q_pool, $q_size) {
        if ($q_size >= count($q_pool)) {
            return NULL;
        }

        shuffle($q_pool);

        $q_set = array();
        for ($i = 0; $i < $q_size; $i++) {
            $q_set[] = $q_pool[$i];
        }
        return $q_set;
    }

    if ($CATEGORY->has_value()) {
        // Test is already started!
        $category = $CATEGORY->get_value();
        $quiz_set = $_SESSION['quiz_set'];
        $question_id = $_SESSION['question_id'];
        $score = $_SESSION['score'];

        $answer = filter_input(INPUT_POST, 'answer');

        $last_question = $quiz_set[$question_id];
        // right answer should be in the form of "A", "B", "C" or "D"
        $right_answer = substr(strtoupper(trim($last_question['answer'])), 0, 1);

        if ($answer != NULL && $answer == $right_answer) {
            $_SESSION['score'] = ++$score;
        }

        if (++$question_id < count($quiz_set)) {
            $current_question = $quiz_set[$question_id];
            $is_last = ($question_id == count($quiz_set) - 1);
            $_SESSION['question_id'] = $question_id;
        } else {
            // Quiz finishes!
            header('Location: result.php');
            exit();
        }
    } else {
        $category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

        if ($category_id != NULL && $category_id != FALSE) {
            //echo "category_id = $category_id";
            
            /* Quiz is starting */
            $category = get_category_by_id($category_id);
            $question_pool = get_questions_by_category($category_id);
            
            if (count($question_pool) >= QUIZ_POOL_SIZE) {          
                $quiz_set = generate_quiz_set($question_pool, QUIZ_SET_SIZE);

                $question_id = 0;
                $score = 0;
                $is_last = FALSE;

                $current_question = $quiz_set[$question_id];

                $CATEGORY->set_value($category);
                $_SESSION['quiz_set'] = $quiz_set;
                $_SESSION['question_id'] = $question_id;
                $_SESSION['score'] = $score;

                // Mark user as writing a test:
                set_user_status($_SESSION['user_id'], USER_STAT_TESTING);
            }
        } else {
            echo "<p>ERROR: Category ID should be given!</p>";
            exit();
        }
    }

    include('../view/header.php');
    include('../view/user_menu_bar.php');
?>

<?php 
    if (isset($question_pool) &&
            count($question_pool) < QUIZ_POOL_SIZE) {
        show_error("Quiz must have at least ".QUIZ_POOL_SIZE." questions!");
        header('Location: .');
    }
    
    show_info("Hint: answer is {$quiz_set[$question_id]['answer']}");
?>

<div class="container">
    <div class="row">
        <div class="main">
            <h1 class="page-header">Quiz: <?php echo $category['categoryName']; ?></h1>
            <h2 class="sub-header">Question - <?php echo $question_id + 1; ?></h2>

            <div class="panel panel-default" style="text-align: left">
                <div class="panel-body form-container">
                    <form action="<?php echo make_printable($_SERVER['PHP_SELF']); ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <p><?php echo make_printable($current_question['questionBody']); ?></p>
                                </div>

                                <div class="form-group">
                                    <div class = "radio">
                                        <label><input type="radio" name="answer" value="A">
                                            <?php echo '<b>A.</b> '. make_printable($current_question['optionA']); ?>
                                        </label>
                                    </div>

                                    <div class = "radio">
                                        <label><input type="radio" name="answer" value="B">
                                            <?php echo '<b>B.</b> '.make_printable($current_question['optionB']); ?>
                                        </label>
                                    </div>

                                    <div class = "radio">
                                        <label><input type="radio" name="answer" value="C">
                                            <?php echo '<b>C.</b> '.make_printable($current_question['optionC']); ?>
                                        </label>
                                    </div>

                                    <div class = "radio">
                                        <label><input type="radio" name="answer" value="D">
                                            <?php echo '<b>D.</b> '.make_printable($current_question['optionD']); ?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <?php $is_last ? print('FINISH') : print('NEXT >>'); ?> 
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../view/footer.php'; ?>
