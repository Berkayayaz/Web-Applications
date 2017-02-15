<?php
    session_start();
    include_once('../utils/utils.php');
    include_once('../common/globals.php');

    check_login();

    //require_once("../model/database.php");
    include_once('../model/category_db.php');

    $categories = get_categories();
    //unset($_SESSION['category']);
    $CATEGORY->clear();

    include('../view/header.php');
    include('../view/user_menu_bar.php');
?>

<div class="container">
    <div class="row">
        <?php include 'side_menu.php'; ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header">Quizes</h1>

            <form action="quiz.php" id="category_form" method="POST">
                <input type="hidden" name="category_id" id="category_id" value="0">

                <?php foreach ($categories as $index => $category): ?>  
                    <?php if ($category['status'] == CATEGORY_STAT_ENABLED) :?>
                        <?php if (($index % 4) === 0): ?>
                            <?php if ($index !== 0): ?>
                                </div>
                            <?php endif; ?>
                            <div class="row placeholders center-block">
                            <?php endif; ?>

                            <div class="col-xs-3 placeholder">
                                <?php
                                $category_id = $category['categoryID'];
                                $thumnail = $category['thumbnail'];
                                if (!isset($thumnail_path) || $thumnail_path == NULL) {
                                    $thumnail = CATEGORY_DEFAULT_IMAGE;
                                }
                                $onCategoryClick = 'onCategoryClick(' . $category_id . ');';
                                ?>

                                <a href="#" onclick="<?php echo $onCategoryClick; ?>">
                                    <img src="<?php echo $thumnail; ?>" 
                                         width="100" height="100" 
                                         class="img-circle" alt="<?php echo $category_id; ?>">
                                </a>
                                <br><br>

                                <a href="#" onclick="<?php echo $onCategoryClick; ?>">
                                    <?php echo $category['categoryName']; ?>
                                </a>
                                <br><br>

                                <a href="#" onclick="<?php echo $onCategoryClick; ?>">
                                    <span class="text-muted"><?php echo $category['categoryDesc']; ?></span>
                                </a>

                            </div>
                    <?php  endif; ?>
                <?php endforeach; ?>    
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">

    function onCategoryClick(category_id) {
        document.getElementById('category_id').value = category_id;
        document.getElementById('category_form').submit();
    }
</script>


<?php include '../view/footer.php'; ?>
